<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::latest()->paginate(6);

        return response()->json(['message' => 'successfull', 'products' => $products], 200);
    }

    public function showProductById($id)
    {
        $product = Product::find($id);

        return response()->json(['message' => 'successfull', 'product' => new ProductResource($product)], 200);
    }

    public function showProductsByCategory($category)
    {
        $category = Category::query()->where('name', '=', $category)->first();

        $category->load('products');

        return response()->json(['message' => 'successfull', 'products' => $category->products], 200);
    }
}
