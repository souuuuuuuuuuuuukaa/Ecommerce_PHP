<?php

// CartController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
class CartController extends Controller {
    // Affiche la page du panier
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Ajoute un produit au panier
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    // Supprime un produit du panier
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit supprimé du panier !');
    }

    // Vide complètement le panier
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Panier vidé !');
    }
}