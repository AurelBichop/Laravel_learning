<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index($id){
        $course = Course::find($id);
        return view('instructor.curriculum.index',[
            'course' => $course
        ]);
    }
}
