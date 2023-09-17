<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'nullable',
            'name' => 'required',
            'file_id' => 'nullable'
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'subscriber'
        ]);

        if ($user->role == 'admin') {
            Author::create([
                'user_id' => $user->user_id,
                'name' => $request->name,
                'file_id' => $request->file_id,
            ]);
        } else {
            Subscriber::create([
                'user_id' => $user->user_id,
                'name' => $request->name,
                'file_id' => $request->file_id,
            ]);
        }

        $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json(['user' => $user], 200);
    }
}
