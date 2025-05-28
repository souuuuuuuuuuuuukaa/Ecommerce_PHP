<?php

// ProductController.php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Produit ajouté !');
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}

}
