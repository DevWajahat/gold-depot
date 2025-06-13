<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Variant;
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

        $attributes = Attribute::all();


        return view('screens.admin.product.create', get_defined_vars());
    }

    public function store(StoreProductRequest $request)
    {


        $productCategory = Category::find($request->category);

        if ($request->has('image')) {
            $FeaturedImageName = time() . '_' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('images/products/featured'), $FeaturedImageName);
        }
        $product = $productCategory->products()->create([
            'name' => $request->name,
            'image' => $FeaturedImageName,
            'price' => $request->price,
            'short_description' => $request->shortdescription,
            'long_description' => $request->longdescription
        ]);
        if ($request->product_attributes[0] != null) {
            // dd($request->product_attributes);
            $product->attributes()->attach($request->product_attributes);
            foreach ($request->variants as $variant) {
                $product->variants()->attach($variant);
            }
        }


        if ($request->file('images')) {
            $imageNameArray = [];
            foreach ($request->images as $image) {
                if ($image) {
                    $imageName = time() . "_" . $image->getClientOriginalExtension();
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
        $attributes = Attribute::all();

        $categories = Category::all();

        $variants = Variant::all();
        return view('screens.admin.product.edit', get_defined_vars());
    }



    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        // dd($request->product_attributes, $request->variants);

        if ($request->has('image')) {

            $FeaturedImageName = time() . '_' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('images/products/featured'), $FeaturedImageName);
        } else {
            $FeaturedImageName = $product->image;
        }



        if ($request->product_attributes[0] != null) {

            $product->attributes()->sync($request->product_attributes);
            $product->variants()->sync($request->variants);
        } else{
            $product->attributes()->detach();
             $product->variants()->detach();
        }


        $product->update([

            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image' => $FeaturedImageName,
            'category_id' => $request->category
        ]);




        if ($request->file('images')) {
            // $product->productImages()->delete();
            $imageNameArray = [];
            foreach ($request->images as $image) {
                if ($image) {
                    $imageName = time() . "_" . $image->getClientOriginalExtension();
                    $imageNameArray[] = ['image' => $imageName];
                    $image->move(public_path('images/products'), $imageName);
                }
            }
            $product->productImages()->createMany($imageNameArray);
        }


        return back()->with('message', 'Product Updated Successfully.');
    }


    public function updateStatus(Request $request)
    {

        $product = Product::find($request->product);

        $product->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => "Done Successfully"
        ]);
    }
}
