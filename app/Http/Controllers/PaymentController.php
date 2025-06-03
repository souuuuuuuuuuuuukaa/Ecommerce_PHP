<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // Affiche la page de paiement avec résumé du panier
    public function showPaymentPage()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    // Envoie vers la page de paiement Payzone
    public function launchPayzone(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Prépare les données de paiement
        $order_id = uniqid('ORDER_'); // identifiant unique
        $customer_email = $request->input('email', 'client@example.com'); // facultatif
        $customer_name = $request->input('name', 'Client'); // facultatif

        // Redirection vers la vue de formulaire qui contient Payzone
        return view('payzone.launch_paywall', [
            'amount' => $total,
            'order_id' => $order_id,
            'client_name' => $customer_name,
            'client_email' => $customer_email,
        ]);
    }

    // Callback (retour de Payzone)
    /*public function callback(Request $request)
    {
        $responseCode = $request->input('response_code');
        $orderId = $request->input('order_id');

        if ($responseCode === '00') {
            // Paiement réussi
            session()->forget('cart'); // vider le panier
            return view('payment.success', compact('orderId'));
        }

        // Paiement échoué
        return view('payment.failed', compact('orderId'));
    }*/

    // Lancement du paywall avec signature
    public function launch(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Le panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $orderId = uniqid('order_');
        $merchantAccount = 'Test_integration';
        $paywallSecretKey = '9uhPPPQH14ThccEn';

        $paywallUrl = 'https://payment-sandbox.payzone.ma/pwthree/launch';
        $notificationKey = '0c4ihAHdWwcJV60s';

        // Construire le payload avec les bonnes valeurs dynamiques
        $payload = [

            'merchantAccount' => $merchantAccount,
            'timestamp' => time(),
            'skin' => 'vps-1-vue',
            //'skin' => 'abb', // abb
            'customerId' => 'test_19',
            'customerCountry' => 'MA',
            'customerLocale' => 'fr_FR',

            'customerStateProvince' => '',
            // 'skipConfirmationPage' => true,
            'chargeId' => time(),
            'orderId' => $orderId,
            'price' => $total,
            'currency' => 'MAD',
            //'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat, velit repellendus totam saepe eos quisquam rem! Ex beatae ut aliquid odio deleniti laudantium nisi repellat suscipit qui? Aliquam ea nisi, quod dignissimos possimus nam laboriosam provident labore facilis architecto quae sed fuga id vero neque amet earum animi dicta sunt dolor illum soluta officia numquam! Laudantium omnis quos odit, distinctio praesentium harum voluptas consequuntur veniam deserunt debitis explicabo itaque. Neque, assumenda quaerat omnis maiores ut unde, tenetur cupiditate natus laudantium corrupti harum quod impedit molestiae. Fugiat eligendi vel dolor ex porro quas repellat, impedit error, neque non quasi rem, optio inventore voluptate illum itaque. Necessitatibus iusto obcaecati voluptatem quidem rem numquam voluptate temporibus velit dolor provident. Harum facilis eligendi, accusamus dolorem adipisci ipsam id hhhhhhhhhhhhhhh!',
            'description' => "description",
            'mode' => 'DEEP_LINK',
            'paymentMethod' => 'CREDIT_CARD',
            'showPaymentProfiles' =>  true,



            ////////////////////////////////////

            // 'customerEmail' => 'testmail.com',
            //'chargeProperties' => ["desc" => "hat", "price" => "122"],


            //////////////////////////////////////

            "callbackUrl"    => "https://645d-102-53-10-153.ngrok-free.app/api/callback",
            // bouton 
            'successUrl' => "https://645d-102-53-10-153.ngrok-free.app",
            'failureUrl' => "https://test-merchant.ma/failure",
            'cancelUrl' => "https://test-merchant.ma/cancel",
        ];


        // $payload = array(
        //     // Authentication parameters
        //     'merchantAccount'      => $merchantAccount,
        //     'timestamp'       => time(),
        //     'skin'        => 'vps-1-vue',

        //     // Customer parameters
        //     'customerId'      => 'said-12345',
        //     'customerCountry' => 'MA',
        //     'customerLocale' => 'en_US',
        //     'orderId' => $orderId,

        //     // Charge parameters
        //     'price'           => 100,
        //     'currency'        => 'MAD',
        //     'description'     => 'A Big Hat',

        //     // Deep linking
        //     'mode' => 'DEEP_LINK',
        //     'paymentMethod' => 'CREDIT_CARD',
        //     'showPaymentProfiles' => false,
        //     "callbackUrl"    => "https://645d-102-53-10-153.ngrok-free.app/api/callback",
        //     "successUrl"    => "https://mealbox.ma/PayzonePaywall/success.html",
        //     "failureUrl"    => "https://mealbox.ma/PayzonePaywall/failure.html",
        //     "cancelUrl"    => "https:'//mealbox.ma",
        // );



        // Encoder le payload en JSON


        //bad request Sorry, but the request was malformed and the page cannot be displayed. payload must be an object
        //  $json_payload = json_encode('{"merchantAccount":"Test_integration","timestamp":1748612122,"skin":"vps-1-vue","customerId":"said-12345","customerCountry":"MA","customerLocale":"en_US","orderId":"a test order","price":100,"currency":"MAD","description":"A Big Hat","mode":"DEEP_LINK","paymentMethod":"CREDIT_CARD","showPaymentProfiles":false,"callbackUrl":"https:\/\/645d-102-53-10-153.ngrok-free.app\/api\/callback","successUrl":"https:\/\/mealbox.ma\/PayzonePaywall\/success.html","failureUrl":"https:\/\/mealbox.ma\/PayzonePaywall\/failure.html","cancelUrl":"https:');

        $json_payload = json_encode($payload);
        Log::info($json_payload);

        //  $json_payload = ''; // erreur bad request "car il est vide "

        // Générer la signature avec la clé secrète
        $signature = hash('sha256', $paywallSecretKey . $json_payload);
        Log::info($signature);

        // Envoyer à la vue payzone.launch_paywall les données nécessaires
        return view('payzone.launch_paywall', [
            'payload' => $payload,
            'signature' => $signature,
            'paywallUrl' => $paywallUrl,
            'json_payload' => $json_payload,
            'notificationKey' => $notificationKey
        ]);
    }

    // Page checkout (résumé panier)
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }
}