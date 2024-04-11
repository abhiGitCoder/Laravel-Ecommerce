<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Cartitem;

class ProductController extends Controller
{
    public function displayAll()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function cartDetails($email)
    {
        $cartItems = Cartitem::where('email', $email)->get();
        $productIds = $cartItems->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->get();
        return response()->json($products);
    }

    public function getProductById($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    // public function updateStock(Request $request)
    // {
    //     $product_id = $request->input('product_id');
    //     $product = Product::find($product_id);
    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found.'], 404);
    //     }
    //     $currentStock = $product->stock;
    //     $quantity = $request->input('qty');
    //     if (!is_numeric($quantity) || $quantity < 0) {
    //         return response()->json(['message' => 'Invalid quantity.'], 400);
    //     }
    //     $updatedStock = $currentStock - $quantity;
    //     $product->stock = $updatedStock;
    //     $product->save();
    //     return response()->json(['product' => $product]);

    // }

    // // public function uploadImages(Request $request, $productId)
    // // {
       
    // //     $validator = Validator::make($request->all(), [
    // //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
    // //     ]);

    // //     if ($validator->fails()) {
    // //         return response()->json(['error' => $validator->errors()], 400);
    // //     }

       
    // //     if ($request->hasFile('images')) {
    // //         $uploadedImages = $request->file('images');
    // //         foreach ($uploadedImages as $uploadedImage) {
    // //             $imagePath = $uploadedImage->store('product_images'); 
               
    // //             ProductImage::create([
    // //                 'product_id' => $productId,
    // //                 'image_url' => $imagePath,
    // //             ]);
    // //         }
    // //     }

    // //     return response()->json(['message' => 'Images uploaded successfully'], 200);
    // // }

    
}