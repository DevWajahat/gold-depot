<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function destroy(Request $request)
    {
        $productImage = ProductImage::find($request->imageId);
        $product = Product::find($request->id);
        $productImage->delete();
        // dd($product->productImages);

        return response()->json([
            'message' => 'Deleted Successfully',
            'images' => $product->productImages,
        ]);
    }

    public function index(){
        $productImage = ProductImage::all();
        return response()->json([
            'instance'=> $productImage
        ]);
    }
}
