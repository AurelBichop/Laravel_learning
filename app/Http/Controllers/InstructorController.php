<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('instructor.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slugify = new Slugify();
        $course = new Course();
        $course->title = $request->input('title');
        $course->slug = $slugify->slugify($request->input('description'));
        $course->subtitle = $request->input('subtitle');
        $course->description = $request->input('description');
        $course->category_id = $request->input('category');
        $course->user_id = Auth::user()->id;

        $image = $request->file('image');
        $imageFullName = $image->getClientOriginalName();
        $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();

        $file = time() . '_' . $imageName . '.' . $extension;
        $image->storeAs('public/courses/'.Auth::user()->id,$file);

        $course->image = $file;
        $course->save();

        return redirect()->route('instructor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $course = Course::find($id);
        return view('instructor.edit',[
            'course'=>$course,
            'categories'=>$categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $slugify = new Slugify();

        $course->title = $request->input('title');
        $course->slug = $slugify->slugify($course->title);
        $course->subtitle = $request->input('subtitle');
        $course->description = $request->input('description');
        $course->category_id = $request->input('category');

        if($request->file('image')){
            $image = $request->file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            $file = time() . '_' . $imageName . '.' . $extension;
            $image->storeAs('public/courses/'.Auth::user()->id,$file);

            $course->image = $file;
        }

        $course->save();
        return redirect()->route('instructor.index')->with('success', 'Vos modifications on été apporté avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('instructor.index')->with('success', 'le cours a bien été supprimé');
    }
}
