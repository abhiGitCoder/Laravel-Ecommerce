<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Product;
use App\Models\ProductImage;

class VoyagerProductController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'description' => 'required',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

    
        $product = Product::create([
            'name' => $request->name,
            'details' => $request->details,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_images', 'public'); 
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                ]);
            }
        }

        return redirect()->route('voyager.products.index')->with([
            'message' => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

}
