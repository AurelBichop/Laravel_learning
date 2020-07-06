<?php

namespace App\Http\Controllers;

use App\CourseUser;
use App\Http\Managers\PayementManager;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Exception;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    private $payementManager;

    public function __construct(PayementManager $payementManager)
    {
        $this->payementManager = $payementManager;
    }

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

            foreach (\Cart::getContent() as $item){
                $instructor_part = $this->payementManager->getInstructorPart($cart->getTotal()+ $roundedTax);
                $elearning_part = $this->payementManager->getElearningPart($cart->getTotal()+ $roundedTax);
                Payment::create([
                    'course_id' => $item->model->id,
                    'amount' => $cart->getTotal()+ $roundedTax,
                    'instructor_part' => $instructor_part,
                    'elearning_part' => $elearning_part,
                    'email' => Auth::user()->email
                ]);

                CourseUser::create([
                    'user_id'=> Auth::user()->id,
                    'course_id'=> $item->model->id
                ]);
            }

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
