<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), ['name' => 'required|string', 'email' => 'required|string', 'phone' => 'required|string', 'products' => 'required']);

        if ($validation->fails()) {
            return response()->json(['message' => 'Unprocessable Content', 'error' => $validation->errors()->all()], 422);
        }

        $order = Order::create($request->only(['name', 'email', 'phone']));

        if ($order) {
            foreach ($request->input('products') as $product) {
                $order->purchases()->create(['order_id' => $order->id, 'product_id' => $product['id']]);
            }
        }

        return response()->json(['message' => 'Successfully stored!']);
    }
}
