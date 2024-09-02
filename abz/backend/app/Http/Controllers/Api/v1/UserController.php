<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\SystemToken;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\TinifyService;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function show(Request $request)
    {
        $validation = Validator::make($request->query(), ['page' => 'required|integer|min:1', 'count' => 'required|integer']);

        if ($validation->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'fails' => $validation->errors()->all()], 422);
        }

        $users = User::with(['position'])->paginate($request->count)->appends(['count' => $request->count]);

        if (empty($users->items())) {
            return response()->json(['success' => false, 'message' => 'page not found'], 404);
        }

        return response()->json(new UserCollection($users), 200);
    }

    public function getUserById($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => 'false', 'message' => 'User not found'], 404);
        }

        return response()->json(['success' => true, 'user' => new UserResource($user)]);
    }

    public function create(Request $request, TinifyService $service,  SystemToken $sysToken)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:60',
            'email' => 'required|string|email:rfc',
            'phone' => 'required|string|starts_with:+380',
            'photo' => 'required|image|max:5120|mimes:jpeg,jpg',
            'position_id' => 'required|integer|exists:App\Models\Position,id'
        ]);

        if ($validation->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'fails' => $validation->errors()->all()], 422);
        };

        $validation = Validator::make($request->all(), [
            'email' => 'unique:App\Models\User,email',
            'phone' => 'unique:App\Models\User,phone'
        ]);

        if ($validation->fails()) {
            return response()->json(['success' => false, 'message' => 'User with this phone or email already exist'], 409);
        }

        $image = $service->compressAndSaveImage($request->photo);

        if (!$image) {

            return response()->json(['success' => false, 'message' => 'Image error'], 404);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $image,
            'position_id' => $request->position_id
        ]);

        $sysToken->deleteToken($request->header('Authorization'));

        return response()->json(['success' => true, 'user_id' => 1, 'message' => 'New user successfully registered'], 201);
    }
}
