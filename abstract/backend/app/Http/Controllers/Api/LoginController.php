<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::firstOrCreate(['email' => $request->email], ['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);


        $token = $user->createToken(name: uniqid())->plainTextToken;


        return response()->json(['status' => 'ok', 'token' => $token], 201);
    }
}
