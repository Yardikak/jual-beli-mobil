<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::all();
        return response()->json(['data' => $products]);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
        return response()->json($product);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|not_regex:/-/',
            'description' => 'required|string|not_regex:/-/',
            'price' => 'required|numeric|min:15000000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validated);
        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    // PUT/PATCH /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|not_regex:/-/',
            'description' => 'required|string|not_regex:/-/',
            'price' => 'required|numeric|min:15000000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data' => $product
        ]);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
