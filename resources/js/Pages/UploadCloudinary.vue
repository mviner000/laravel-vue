<template>
    <div>
      <h2>upload</h2>
      <button id="upload_widget" class="cloudinary-button">Upload files</button>
    </div>
  </template>
  
  <script>
  export default {
    mounted() {
      // Load Cloudinary upload widget script
      const script = document.createElement('script');
      script.src = 'https://upload-widget.cloudinary.com/global/all.js';
      script.type = 'text/javascript';
      script.async = true;
      document.head.appendChild(script);
      
      // Initialize Cloudinary upload widget
      script.onload = () => {
        const widget = cloudinary.createUploadWidget({
          cloudName: 'dqpzvvd0v',
          uploadPreset: 'mrpfvufw'
        }, (error, result) => {
          if (!error && result && result.event === 'success') {
            console.log('Upload successful! Here is the result:', result.info);
            // You can handle successful upload here
          }
        });
        
        // Open Cloudinary upload widget on button click
        document.getElementById('upload_widget').addEventListener('click', function () {
          widget.open();
        }, false);
      };
    }
  }
  </script>
  
  <style scoped>
  /* Add your scoped styles here */
  </style>
  