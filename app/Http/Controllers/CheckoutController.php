<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Exception;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout(){
        return view('checkout.payment');
    }

    public function charge(Request $request){
        Stripe::setApiKey(env('STRIPE_PRIVATE_KEY'));

        $cart = \Cart::session(Auth::user()->id);

        $tax = \Cart::getTotal() / 10;
        $roundedTax = round($tax, 2);

        try {
            $charge = Charge::create([
                'amount' => ($cart->getTotal()+ $roundedTax)*100,
                'currency' => 'EUR',
                'description' => 'Paiement via laravel elearning',
                'source' => $request->input('stripeToken'),
                'receipt_email' => Auth::user()->email
            ]);

            return redirect()->route('checkout.success')->with('success', 'Paiement accepté');

        }catch (Exception\CardException $error){
            throw  $error;
        }
    }

    public function success(){

        if(!session()->has('success')){
            return redirect()->route('main.home');
        }

        $order = \Cart::session(Auth::user()->id)->getContent();

        foreach (\Cart::session(Auth::user()->id)->getContent() as $cardItem){
            \Cart::remove($cardItem->id);
        }

        return view('checkout.success',['order'=>$order]);
    }
}
