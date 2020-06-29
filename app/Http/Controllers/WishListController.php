<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function store($id){
        $course = Course::find($id);

        $wishList = \Cart::session(Auth::user()->id . '_wishlist');
        $wishList->add([
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
        ]);

        return redirect()->route('cart.index')->with('success', 'Souhait ajouté');
    }

    public function destroy($id){
        \Cart::session(Auth::user()->id . '_wishlist')->remove($id);

        return redirect()->route('cart.index')->with('success', 'Souhait supprimé.');
    }

    public function toCart($id){
        //remove from wishlist
        \Cart::session(Auth::user()->id . '_wishlist')->remove($id);

        //ajouter au cart
        $course = Course::find($id);

        $cartList = \Cart::session(Auth::user()->id);
        $cartList->add([
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
        ]);

        return redirect()->route('cart.index')->with('success', 'Souhait placé dans votre panier.');
    }

    public function toWishList($id){
        //remove from cartlist
        \Cart::session(Auth::user()->id)->remove($id);

        //ajouter au wish
        $course = Course::find($id);

        $wishList = \Cart::session(Auth::user()->id. '_wishlist');
        $wishList->add([
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
        ]);

        return redirect()->route('cart.index')->with('success', 'Cours placé en liste de souhaits.');
    }
}
