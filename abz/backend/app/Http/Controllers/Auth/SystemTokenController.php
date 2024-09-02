<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SystemToken;
use Illuminate\Http\Request;

class SystemTokenController extends Controller
{
    public function store(SystemToken $model)
    {

        $token = $model->createToken();

        return response()->json(['success' => true, 'token' => $token]);
    }
}
