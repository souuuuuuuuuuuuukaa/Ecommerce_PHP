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
        //Récupère tous les produits depuis la base de données avec Product::all().
        $products = Product::all();
        //Passe ces produits à la vue products.index (ex: pour les afficher sous forme de cartes).
        return view('products.index', compact('products'));
    }
    public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}

}
