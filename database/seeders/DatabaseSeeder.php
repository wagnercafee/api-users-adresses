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
        // cria perfil default
        Profile::updateOrCreate(
            ['id' => 1],
            ['name' => 'Administrador']
        );

        // cria 5 usuários
        $users = User::factory(5)->create();

        // cria 3 endereços
        $addresses = Address::factory(3)->create();

        // liga aleatoriamente usuários e endereços (N:N)
        $users->each(function (User $user) use ($addresses) {
            // pega de 1 a 3 endereços aleatórios
            $randomAddresses = $addresses->random(rand(1, 3))->pluck('id')->toArray();
            $user->addresses()->attach($randomAddresses);
        });


    }
}
