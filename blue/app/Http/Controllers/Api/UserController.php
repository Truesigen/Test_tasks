<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private readonly UserService $service) {}

    public function index()
    {
        return UserResource::collection(User::with('role')->paginate(10));
    }

    public function show(int $id)
    {
        $user = User::query()->with(['projects', 'tasks'])->findOrFail($id);

        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user)
    {
        if ($request->user()->cannot('update', $user)) {
            return response()->json(['message' => 'forbidden'], 403);
        }

        $data = $this->service->update($request->toDTO(), $user);

        return response()->json(['message' => 'success', 'user' => new UserResource($data)]);
    }
}
