<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return ProfileResource::collection(Profile::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);

        $profile = Profile::create($data);

        return response()->json($profile, 201);
    }

    public function show(Profile $profile)
    {
        return new ProfileResource($profile);
    }

    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
        ]);

        $profile->update($data);

        return response()->json($profile, 200);
    }

    public function destroy(Profile $profile)
    {
        // Bloqueia exclusão do perfil Administrador (por id ou por nome)
        if ($profile->id === 1 || $profile->name === 'Administrador') {
            return response()->json([
                'message' => 'Nao é permitido excluir o perfil Administrador.',
            ], 403);
        }

        $profile->delete();

        return response()->json(null, 204);
    }
}
