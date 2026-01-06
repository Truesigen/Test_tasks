<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthRequest;
use App\Http\Requests\User\CreateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(private readonly UserService $service) {}

    public function register(CreateRequest $request): JsonResponse
    {
        dd($request->toDTO());
        $user = $this->service->store($request->toDTO());

        return response()->json(['message' => 'success', 'user' => new UserResource($user)], 201);
    }

    public function login(AuthRequest $request): JsonResponse
    {
        $userToken = $this->service->login($request->toDTO());

        return response()->json(['message' => 'success', 'token' => $userToken], 201);
    }

    public function logout(Request $request): Response
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}
