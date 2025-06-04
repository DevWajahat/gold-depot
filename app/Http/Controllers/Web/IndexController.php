<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        $reviews = Review::all();

        $Products = Product::inRandomOrder()->limit(4)->get();

        return view('screens.web.index', get_defined_vars());
    }
}
