@extends('components.layouts.app')
@section('content')

Home

{{-- <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" accept="image/*">
    <button type="submit">Upload Image</button>
</form> --}}



@php
    // Include the Cloudinary PHP SDK
    use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

    // Get all the images in the "samples/animals" folder with a grayscale effect
    $images = Cloudinary::search()
                        ->expression("folder:samples/animals")
                        ->maxResults(100)
                        ->execute(['transformation' => ['effect' => 'grayscale']]);
@endphp

<div class="container">
    <div class="row">
        @foreach ($images['resources'] as $image)
        <div class="col-md-4 mb-3">
            <img 
                src="{{ $image['url'] }}" 
                data-src="{{ $image['url'] }}" 
                class="img-fluid lazyload" 
                alt="{{ $image['public_id'] }}" 
                width="400" 
                height="300"
            >
        </div>
        @endforeach
    </div>
</div>






@endsection