<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Carousel;
use App\Models\Product;
use App\Models\Review;


class IndexController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        $reviews = Review::all();
        $Products = Product::inRandomOrder()->where('status','available')->limit(4)->get();
        $carousels = Carousel::all();
        return view('screens.web.index', get_defined_vars());
    }
}
