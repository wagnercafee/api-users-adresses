<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'profile_id' => ['required', 'integer', 'exists:profiles,id'],
        ]);

        $user->profile_id = $data['profile_id'];
        $user->save();

        return response()->json($user->load('profile'), 200);
    }
}
