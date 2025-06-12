<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('screens.admin.category.index', get_defined_vars());
    }

    public function create()
    {
        return view('screens.admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        if ($request->has('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('images/category'), $imageName);
        }
        Category::create([
            'name' => $request->name,
            'image' => $imageName
        ]);
        return back()->with('message', 'Category Added Successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('screens.admin.category.edit', get_defined_vars());
    }
    public function update($id, StoreUpdateCategoryRequest $request)
    {


        $category = Category::find($id);

        if ($request->has('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('images/category'), $imageName);
    
        } else {
            $imageName = $category->image;
        }
        $category->update([
            'name' => $request->name,
            'image' => $imageName
        ]);
        return redirect()->route('admin.category.index')->with('message', 'category updated Successfully');
    }

    public function updateStatus(Request $request)
    {
        $category = Category::find($request->category);
        if ($request->status == 'unavailable') {

            $category->products()->update([
                'status' => "discontinued"
            ]);
            $category->update([
                'status' => $request->status
            ]);
        } else {

            $category->update([
                'status' => $request->status
            ]);
        }


        return response()->json([
            'message' => 'Successfully',
            'category' => $category
        ]);
    }
}
