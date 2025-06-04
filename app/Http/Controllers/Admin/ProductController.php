<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('screens.admin.product.index', get_defined_vars());
    }

    public function create()
    {
        $categories = Category::all();

        return view('screens.admin.product.create', get_defined_vars());
    }

    public function store(StoreProductRequest $request)
    {

        $productCategory = Category::find($request->category);

        if ($request->has('image')) {
            // dd($request->image);
            $FeaturedImageName = time() . '_' . $request->image->getClientOriginalName();

            $request->image->move(public_path('images/products/featured'), $FeaturedImageName);
        }

        $product = $productCategory->products()->create([
            'name' => $request->name,
            'image' => $FeaturedImageName,
            'price' => $request->price,
            'short_description' => $request->shortdescription,
            'long_description' => $request->longdescription
        ]);

        if ($request->file('images')) {
            $imageNameArray = [];
            foreach ($request->images as $image) {
                if ($image) {
                    $imageName = time() . "_" . $image->getClientOriginalName();
                    $imageNameArray[] = ['image' => $imageName];
                    $image->move(public_path('images/products'), $imageName);
                }
            }
            $product->productImages()->createMany($imageNameArray);
        }


        return back()->with('message', 'Product Added Successfully');
    }

    public function detail($id)
    {

        $product = Product::find($id);
        $productImages = ProductImage::where('product_id', $id)->get();

        return view('screens.admin.product.detail', get_defined_vars());
    }
    public function edit($id)
    {
        $product = Product::find($id);

        $categories = Category::all();

        return view('screens.admin.product.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {

        // dd($request->name,$request->price,$request->short_description,$request->long_description, $request->has('image'),$request->file('image'));
        $product = Product::find($id);

        if ($request->has('image')) {
            // dd($request->image);


            $FeaturedImageName = time() . '_' . $request->image->getClientOriginalName();

            $request->image->move(public_path('images/products/featured'), $FeaturedImageName);
        } else {
            $FeaturedImageName = $product->image;
        }

        $category = Category::find($request->category);
        $category->products()->update([
            'name' => $request->name,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image' => $FeaturedImageName
        ]);

        if ($request->file('images')) {
               $product->productImages()->delete();
            $imageNameArray = [];
            foreach ($request->images as $image) {
                if ($image) {
                    $imageName = time() . "_" . $image->getClientOriginalName();
                    $imageNameArray[] = ['image' => $imageName];
                    $image->move(public_path('images/products'), $imageName);
                }
            }
            $product->productImages()->createMany($imageNameArray);
        }


        return back()->with('message', 'Product Updated Successfully.');
    }

    public function destroy($id)
    {

        $product = Product::find($id);

        if ($product) {

            ProductImage::where('product_id', $id)->delete();

            $product->delete();

            return back()->with('message', 'Product Deleted Successfully');
        } else {
            return back()->with('error', 'Product Not Found');
        }
    }
}
