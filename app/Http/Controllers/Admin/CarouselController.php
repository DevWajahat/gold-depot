<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarouselRequest;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {

        $carousels = Carousel::all();

        return view('screens.admin.carousel.index', get_defined_vars());
    }

    public function create()
    {
        return view('screens.admin.carousel.create');
    }

    public function store(StoreCarouselRequest $request)
    {

        if ($request->has('banner')) {
            $imageName = time() . '_' . $request->banner->getClientOriginalExtension();

            $request->banner->move(public_path('images/banner'), $imageName);
        }

        Carousel::create([
            'title' => $request->title,
            'description' => $request->description,
            'banner' => $imageName
        ]);




        return back()->with('message', 'Slide Stored Successfully.');
    }

    public function edit($id)
    {

        $carousel = Carousel::find($id);



        return view('screens.admin.carousel.edit', get_defined_vars());
    }

    public function update($id, Request $request)
    {

        $carousel = Carousel::find($id);
        if ($request->has('banner')) {
            $imageName = time() . '_' . $request->banner->getClientOriginalExtension();

            $request->banner->move(public_path('images/banner'), $imageName);
        }
         else {
            $imageName = $carousel->banner;
        }
        // dd($imageName, $request->file('banner'));

        $carousel->update([
            'title' => $request->title,
            'description' => $request->description,
            'banner' => $imageName
        ]);

        return back()->with('message', 'Carousel Updated Successfully');
    }

    public function destroy($id)
    {
        $carousel = Carousel::find($id);

        $carousel->delete();

        return back();
    }
}
