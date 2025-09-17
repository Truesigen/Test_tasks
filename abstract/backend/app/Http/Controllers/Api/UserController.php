<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = UserResource::collection(User::all());

        return response()->json(['users' => $users]);
    }

    public function createUser(Request $request)
    {
        $validation = Validator::make($request->input(), ['name' => 'required|string', 'email' => 'required|string|unique:App\Models\User,email']);

        if ($validation->fails()) {
            return response()->json(['message' => 'Unprocessable Content', 'error' => $validation->errors()->all()], 422);
        }

        User::create(['name' => $request->name, 'email' => $request->email]);

        return response()->json(['message' => 'success'], 200);
    }
}
