<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
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
        return $profile;
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
        $profile->delete();

        return response()->json(null, 204);
    }
}
