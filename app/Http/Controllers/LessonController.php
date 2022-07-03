<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function showLessons(){
        $lessons = Lesson::with('courses')->where('deleted_at', null)->get();
        return view('admin.lessons_show', compact('lessons'));
    }
    public function searchLessons(LessonRequest $request){
        $lessons = Lesson::where('title', 'LIKE', "%$request->title%")->get();
        return view('admin.lessons_show',compact('lessons'));
    }

    public function create(){
        return view('admin.lesson_create');
    }

    public function store(LessonRequest $request){
        if (!$request->video){
            return redirect()->back()->withErrors(["video" => "Lesson Video can't be Empty"]);
        }
        Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'video' => $request->video,
            'course' => $request->course,
        ]);
        return redirect(route('lessons.show'));
    }

    public function edit($lesson_id){
        $lesson=Lesson::where('id',$lesson_id)->first();
        return view('admin.lesson_update', compact('lesson'));
    }

    public function update(LessonRequest $request){
        Lesson::where('id',$request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'video' => $request->video,
            'course' => $request->course,
        ]);
        return redirect(route('lessons.show'));
    }

    public function delete($lesson_id){
        Lesson::where('id',$lesson_id)->update([
            'deleted_at'=>now()
        ]);
        return redirect(route('lessons.show'));
    }
}
