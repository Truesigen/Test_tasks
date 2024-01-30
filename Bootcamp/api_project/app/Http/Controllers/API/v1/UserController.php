<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends BaseController
{
    public function __construct()
    {
    }

    /**
     * route(/tokens/create)
     * returning newly created sanctum access token
     *
     * @param  Illuminate\Http\Request  $request
     */
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(6)->mixedCase()],
        ];

        $validatedData = Validator::make($request->input(), $rules);

        if ($validatedData->fails()) {
            return response()->json(['status' => 'Unprocessable Content', 'code' => 422, 'message' => $validatedData->errors()->all()], 422);
        }

        $userData = $validatedData->validated();

        $user = User::firstOrCreate(['email' => $userData['email']], [
            'email' => $userData['email'],
            'name' => $userData['name'],
            'password' => Hash::make($userData['password']),
        ]);

        $token = $user->createToken($userData['name'].'_token', ['*'], now()->addHours(30))->plainTextToken;
        //$user->withAccessToken($token);

        return response()->json(['status' => 'Created', 'code' => '201', 'access_token' => $token], 201);
    }
}
