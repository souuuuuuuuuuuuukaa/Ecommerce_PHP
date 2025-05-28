<?php

// CheckoutController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CheckoutController extends Controller {
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }
    public function process()
    {
        // Ici tu pourrais intégrer un système de paiement réel
        session()->forget('cart'); // vider le panier après paiement
        return redirect()->route('products.index')->with('success', 'Commande passée avec succès !');
    }
}