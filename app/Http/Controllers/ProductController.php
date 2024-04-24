<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
 
        // Return Json Response
        return response()->json([
            'results' => $product
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
{
    try {
        // Check if an image is uploaded
        if ($request->hasFile('image_url')) {
            // Upload image to Cloudinary
            $cloudinaryImage = $request->file('image_url')->storeOnCloudinary('products');
            $url = $cloudinaryImage->getSecurePath();
            $publicId = $cloudinaryImage->getPublicId();
        } else {
            // Assign default placeholder image URL from placeholder.com
            $url = 'https://picsum.photos/200/300'; // Change dimensions as needed
            $publicId = null; // No need for public ID if using a default placeholder image
        }

        // Create the product with the validated data and image details
        Product::create([
            'name' => $request->name,
            'barcode' => $request->barcode,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'selling_price' => $request->selling_price,
            'grocery_price' => $request->grocery_price,
            'image_url' => $url,
            'image_public_id' => $publicId,
        ]);

        // Return JSON response
        return response()->json([
            'message' => "Product successfully created."
        ], 200);
    } catch (\Exception $e) {
        // Return JSON response with error message
        return response()->json([
            'message' => "Something went wrong: " . $e->getMessage()
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
