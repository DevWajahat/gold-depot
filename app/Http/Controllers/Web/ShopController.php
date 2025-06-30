<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        $Products = Product::where('status', 'available');

        $Products = app(Pipeline::class)
            ->send($Products)
            ->through([
                \App\Filters\ProductPriceFilter::class,
                \App\Filters\ProductDateFilter::class,
                \App\Filters\ProductVariantFilter::class,
                \App\Filters\ProductRangeFilter::class,
            ])
            ->thenReturn()
            ->paginate(20);

        $minimumPrice = Product::min('price');
        $maximumPrice = Product::max('price');

        $Products->appends([
            'price' => $request->price,
            'date' => $request->date,
            'variants' => $request->variants,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
        ]);

        $attributes = Attribute::with('variants')->get();
        $variants = Variant::all();
        if ($request->ajax()) {
            return response()->json([
                'products' => $Products,
                'pagination' => $Products->links()->toHtml(),
            ]);
        }

        return view('screens.web.shop.index', get_defined_vars());
    }

    public function category($id, Request $request)
    {
        $category = Category::find($id);
        if (!$category) {
            return abort('404');
        }
        $Products = $category->products();

        $Products = app(Pipeline::class)
            ->send($Products)
            ->through([
                
                \App\Filters\ProductPriceFilter::class,
                \App\Filters\ProductDateFilter::class,
                \App\Filters\ProductVariantFilter::class,
                \App\Filters\ProductRangeFilter::class,
            ])
            ->thenReturn()
            ->paginate(20);

        $minimumPrice = Product::min('price');
        $maximumPrice = Product::max('price');

        $Products->appends([
            'price' => $request->price,
            'date' => $request->date,
            'variants' => $request->variants,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
        ]);

        $attributes = Attribute::with('variants')->get();
        $variants = Variant::all();

        if ($request->ajax()) {
            return response()->json([
                'products' => $Products,
                'pagination' => $Products->links()->toHtml(),
            ]);
        }


        return view('screens.web.shop.cateogory', get_defined_vars());
    }
    public function details($id)
    {
        $product = Product::with('productImages', 'category', 'reviews')->find($id);

        $attributes = Attribute::all();
        $variants = Variant::all();


        if (auth()->user()) {
            $userOrders =  auth()->user()->orders()->whereHas('products', function ($queryproduct) use ($id) {
                $queryproduct->where('product_id', $id);
            })->count();
        }


        return view('screens.web.shop.detail', get_defined_vars());
    }

    public function calculatePrice(Request $request)
    {


        $product = Product::find($request->product_id);


        $sumPrice = 0;
        foreach ($request->dropdownValues as $dropdownvalue) {
            // dd($product->variants->find($dropdownvalue),$product->variants,$dropdownvalue);
            $price = $product->variants->find($dropdownvalue)->pivot->price;
            $sumPrice += $price;
        }

        $calculatedPrice = $sumPrice + $product->price;

        return response()->json([
            'message' => 'Calculated Successfully',
            'calculatedPrice' => $calculatedPrice,
            'price' => $price
        ]);
    }
}
