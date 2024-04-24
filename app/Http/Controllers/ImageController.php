<?php

namespace App\Http\Controllers;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
{
    // Validate the request data
    $request->validate([
        'image' => 'required|image', // Ensure 'image' field is present and is an image file
    ]);

    // Check if the file is present in the request
    if ($request->hasFile('image')) {
        // Get the real path of the uploaded file
        $image = $request->file('image')->getRealPath();

        // Upload the image to Cloudinary
        $cloudinaryUpload = Cloudinary::upload($image, [
            'upload_preset' => config('cloudinary.upload_preset')
        ]);

        // Return JSON response with uploaded image details
        return response()->json([
            'url' => $cloudinaryUpload->getSecurePath(),
            'public_id' => $cloudinaryUpload->getPublicId()
        ]);
    } else {
        // Handle case where no file is uploaded
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
