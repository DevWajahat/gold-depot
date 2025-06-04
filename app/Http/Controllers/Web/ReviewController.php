<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, $id)
    {

        if (auth()->user()) {
            $product =  Product::find($id);

            $user = User::find(auth()->user()->id);


            if (!$user->orders->isEmpty()) {
                $product->reviews()->create([
                    'user_id' => $user->id,
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'message' => $request->message
                ]);
            }
        }

        return back();
    }
}
