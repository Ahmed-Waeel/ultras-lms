<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\models\Category;
use App\models\Course;
use App\models\User;
use Illuminate\Http\Request;

class  CourseController extends Controller
{
    public function showCourses(){
        $courses= Course::where('deleted_at', null)->get();
        foreach ($courses as $course){
            $course->category=Category::where('id',$course->category)->first()->title;
            $course->instructor="Muhammed Amr";
        }
        return view('admin.courses_show', compact('courses'));
    }
    public function searchCourses(Request $request){
        $courses=  Course::where('title', 'LIKE', "%$request->title%")->get();
        foreach ($courses as $course){
            $course->category=Category::where('id',$course->category)->first()->title;
            $course->instructor="Muhammed Amr";
        }
        return view('admin.courses_show',compact('courses'));
    }

    public function showCourse($course_id){
        $course = Course::where('id', $course_id)->first();
        $course->category=Category::where('id', $course->category)->first()->title;
        $course->instructor="Muahhmed Amr";
        return view('admin.course_show', compact('course'));
    }

    public function create(){
        $categories=Category::all();
        return view('admin.course_create', compact('categories'));
    }

    public function store(CourseRequest $request){
        if (!$request->cover){
            return redirect()->back()->withErrors(["cover" => "Cover Image can't be Empty"]);
        }
        $imageName = time()."_".$request->title.'.'.$request->cover->extension();
        $request->cover->move(public_path('uploads/images'), $imageName);
        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $imageName,
            'category' => $request->category,
            'instructor' => $request->instructor,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);
        return redirect(route('courses.show'));
    }

    public function edit($course_id){
        $course=Course::where('id',$course_id)->first();
        $categories=Category::all();
        return view('admin.course_update', compact('course','categories'));
    }

    public function update(CourseRequest $request){
        $imageName=Course::where('id',$request->id)->first()->cover;
        if ($request->cover){
            $imageName = time()."_".$request->title.'.'.$request->cover->extension();
            $request->cover->move(public_path('uploads/images'), $imageName);
        }
        Course::where('id',$request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $imageName,
            'category' => $request->category,
            'instructor' => $request->instructor,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);
        return redirect(route('courses.show'));
    }

    public function delete($course_id){
        Course::where('id',$course_id)->update([
            'deleted_at'=>now()
        ]);
        return redirect(route('courses.show'));
    }
}
