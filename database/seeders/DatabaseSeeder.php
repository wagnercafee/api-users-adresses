<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // cria 8 usuários
        $users = User::factory(8)->create();

        // cria 5 endereços
        $addresses = Address::factory(5)->create();

        // liga aleatoriamente usuários e endereços (N:N)
        $users->each(function (User $user) use ($addresses) {
            // pega de 1 a 3 endereços aleatórios
            $randomAddresses = $addresses->random(rand(1, 3))->pluck('id')->toArray();
            $user->addresses()->attach($randomAddresses);
        });

        // cria perfis
        Profile::insert([
            ['name' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gerente',       'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Usuário',       'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
