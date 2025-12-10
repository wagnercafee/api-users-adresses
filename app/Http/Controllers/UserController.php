<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['profile', 'addresses'])->get();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // separa os ids de addresses (se vierem)
        $addressIds = $data['addresses'] ?? [];
        unset($data['addresses']);

        // cria o usuário
        $user = new User();
        $user->fill($data);
        $user->save();

        if (!empty($addressIds)) {
            $user->addresses()->sync($addressIds);
        }

        return response()->json(
            new UserResource($user->load(['profile', 'addresses'])),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::with(['profile', 'addresses'])->findOrFail($id);
            return new UserResource($user);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Falha ao buscar usuario!'
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        // Verifica existência ANTES da validação
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Usuario nao encontrado!'
            ], 404);
        }

        $data = $request->validated();

        try {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'cpf' => $data['cpf'],
                'profile_id' => $data['profile_id'] ?? $user->profile_id,
            ]);

            if (isset($data['addresses'])) {
                $user->addresses()->sync($data['addresses']);
            }

            $user->load(['profile', 'addresses']);

            return response()->json([
                'data' => $user,
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Falha ao atualizar o usuario!'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $removed = User::destroy($id);
            if (!$removed) {
                throw new Exception();
            }

            return response()->json(null, 204);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Falha ao remover o usuario!'
            ], 400);
        }
    }
}
