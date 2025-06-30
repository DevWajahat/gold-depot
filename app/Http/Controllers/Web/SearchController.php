<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchProducts = Product::whereLike('name', $request->search)->paginate(6);
        // dd($searchProducts);
        return response()->json([
            'searchProducts' => $searchProducts,

        ]);
    }
}
