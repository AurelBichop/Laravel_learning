<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Illuminate\Support\Facades\Auth;


class CoursesController extends Controller
{
    public function courses(){
        $courses = Course::where('is_published', true)->get();
        return view('courses.index',[
            'courses'=>$courses
        ]);
    }

    public function course($slug){
        $course = Course::where('slug',$slug)->firstOrFail();

        if (Auth::user()->paidCourses->where('title',$course->title)->count() != 0 || Auth::user()->courses->where('title',$course->title)->count() != 0){
            die('propriétaire du cours ou cours déja acheté');
        }

        $recommendations = Course::where('is_published', true)
            ->where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->limit(3)
            ->get();

        return view('courses.show',[
            'course'=>$course,
            'recommendations'=>$recommendations
        ]);
    }

    public function filter($id){
        $category = Category::find($id);
        $courses = Course::where('category_id', $category->id)->get();

        return view('courses.index',[
            'courses'=>$courses
        ]);
    }
}
