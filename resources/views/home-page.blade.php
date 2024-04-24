@extends('components.layouts.app')
@section('content')

Home

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
    <button id="upload_widget" class="cloudinary-button">Upload files</button>
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


<script type="text/javascript">  
var myWidget = cloudinary.createUploadWidget({
    cloudName: 'dqpzvvd0v', 
    uploadPreset: 'mrpfvufw'}, (error, result) => { 
    if (!error && result && result.event === "success") { 
        console.log('Done! Here is the image info: ', result.info); 
    }
    }
)

    document.getElementById("upload_widget").addEventListener("click", function(){
    myWidget.open();
    }, false);
</script>



@endsection