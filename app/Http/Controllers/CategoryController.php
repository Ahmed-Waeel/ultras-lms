<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\models\Category;
use App\models\Course;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories(){
        $categories = Category::with('courses')->where('deleted_at', null)->get();
        return view('admin.categories_show', compact('categories'));
    }
    public function searchCategories(Request $request){
        $categories = Category::where('title', 'LIKE', "%$request->title%")->get();
        return view('admin.categories_show',compact('categories'));
    }

    public function create(){
        return view('admin.category_create');
    }

    public function store(CategoryRequest $request){
        if (!$request->cover){
            return redirect()->back()->withErrors(["cover" => "Cover Image can't be Empty"]);
        }
        $imageName = time()."_".$request->title.'.'.$request->cover->extension();
        $request->cover->move(public_path('uploads/images'), $imageName);
        Category::create([
            'title' => $request->title,
            'cover' => $imageName,
        ]);
        return redirect(route('categories.show'));
    }

    public function edit($category_id){
        $category=Category::where('id',$category_id)->first();
        return view('admin.category_update', compact('category'));
    }

    public function update(CategoryRequest $request){
        $imageName=Category::where('id',$request->id)->first()->cover;
        if ($request->cover){
            $imageName = time()."_".$request->title.'.'.$request->cover->extension();
            $request->cover->move(public_path('uploads/images'), $imageName);
        }
        Category::where('id',$request->id)->update([
            'title' => $request->title,
            'cover' => $imageName
        ]);
        return redirect(route('categories.show'));
    }

    public function delete($category_id){
        Category::where('id',$category_id)->update([
            'deleted_at'=>now()
        ]);
        return redirect(route('categories.show'));
    }
}
