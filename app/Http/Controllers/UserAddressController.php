<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'address_ids'   => ['required', 'array'],
            'address_ids.*' => ['integer', 'exists:addresses,id'],
        ]);

        $user->addresses()->sync($data['address_ids']);

        return response()->json([
            'message' => 'Enderecos atualizados para o usuario.',
        ], 200);
    }
}
