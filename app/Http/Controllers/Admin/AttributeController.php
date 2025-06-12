<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Models\Attribute;
use App\Models\Variant;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();

        return view('screens.admin.attribute.index', get_defined_vars());
    }
    public function create()
    {
        return view('screens.admin.attribute.create');
    }
    public function store(StoreAttributeRequest $request)
    {


        $attribute = Attribute::create([
            'name' => $request->attr_name
        ]);

        foreach ($request->variant_name as $value) {
            $attribute->variants()->create([
                'name' => $value
            ]);
        }
        return back()->with('message', 'Attribute And Variant Added Successfully');
    }

    public function edit($id)
    {

        $attribute = Attribute::find($id);

        return view('screens.admin.attribute.edit', get_defined_vars());
    }

    public function update(StoreAttributeRequest $request, $id)
    {

        $attribute = Attribute::find($id)->update([
            'name' => $request->attr_name
        ]);

        $attribute = Attribute::find($id);

        $attribute->variants()->delete();

        foreach ($request->variant_name as $key => $value) {
            $attribute->variants()->create([
                'name' => $value
            ]);
        }
        return back()->with('message','Attribute Variant updated successfully.');
    }

    public function getVariant($id)
    {
        $attribute = Attribute::find($id);
        $variants = $attribute->variants;
        // $variant= Variant::find($id);

        return response()->json([
            'message' => 'Data Get Successfully.',
            'variants' => $variants,
        ]);
    }
}
