<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return view('screens.admin.blog.index', get_defined_vars());
    }

    public function create()
    {
        return view('screens.admin.blog.create');
    }
    public function store(StoreBlogRequest $request)
    {

        if ($request->has('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('images/blogs'), $imageName);
        }
        Blog::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.blog.index')->with('message', 'blog has been added successfully');
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('screens.admin.blog.edit', get_defined_vars());
    }
    public function update(UpdateBlogRequest $request, $id)
    {
        $blog = Blog::find($id);

        if ($request->has('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('images/blogs'), $imageName);
            // dd($imageName);
        } else {
            $imageName = $blog->image;
        }

        $blog->update([
            'name' => $request->name,
            'image' => $imageName,
            'description' => $request->description
        ]);


        return back();
    }

    public function destroy($id)
    {

        $blog =  Blog::find($id);
        $blog->delete();

        return back()->with('message','blog Deleted Successfully');
    }
}
