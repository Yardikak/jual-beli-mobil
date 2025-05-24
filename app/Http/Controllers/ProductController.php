<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|not_regex:/-/',
            'description' => 'required|string|not_regex:/-/',
            'price' => 'required|numeric|min:15000000',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|not_regex:/-/',
            'description' => 'required|string|not_regex:/-/',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
