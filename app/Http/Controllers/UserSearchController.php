<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function search(Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string'],
            'cpf'  => ['nullable', 'string'],
            'from' => ['nullable', 'date'],
            'to'   => ['nullable', 'date'],
        ]);

        $query = User::with(['profile', 'addresses']);

        if (!empty($data['name'])) {
            $query->where('name', 'like', '%'.$data['name'].'%');
        }

        if (!empty($data['cpf'])) {
            $query->where('cpf', 'like', '%'.$data['cpf'].'%');
        }

        if (!empty($data['from']) && !empty($data['to'])) {
            $query->whereBetween('created_at', [
                $data['from'].' 00:00:00',
                $data['to'].' 23:59:59',
            ]);
        }

        $users = $query->get();

        return UserResource::collection($users);
    }
}
