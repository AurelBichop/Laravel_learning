<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){

        $instructors = User::all();
        //$category = Category::where('id',2)->firstOrFail();
        //dd($category->courses);
        return view('main.home',['instructors'=>$instructors]);
    }
}
