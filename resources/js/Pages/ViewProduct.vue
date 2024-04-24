<template>
  <div class="card">
  <div class="p-6">
    <div class="mb-4">
      <h2 class="text-xl font-bold">Upload</h2>
    </div>
    <h2 class="text-2xl font-bold mb-4">Create New Product</h2>
    <form @submit.prevent="createProduct" class="mb-8">
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
        <input type="text" id="name" v-model="formData.name" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
      </div>
      <div class="mb-4">
        <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode:</label>
        <input type="text" id="barcode" v-model="formData.barcode" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
      </div>
      <div class="mb-4">
        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
        <input type="number" id="quantity" v-model.number="formData.quantity" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
      </div>
      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
        <textarea id="description" v-model="formData.description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
      </div>
      <div class="mb-4">
        <label for="selling_price" class="block text-sm font-medium text-gray-700">Selling Price:</label>
        <input type="number" id="selling_price" v-model.number="formData.selling_price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
      </div>
      <div class="mb-4">
        <label for="grocery_price" class="block text-sm font-medium text-gray-700">Grocery Price:</label>
        <input type="number" id="grocery_price" v-model.number="formData.grocery_price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
      </div>
      <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
        <input type="file" id="image" accept="image/*" @change="onFileChange" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
      </div>
      <button type="submit" :disabled="loading" class="bg-indigo-600 text-white px-4 py-2 rounded-md disabled:opacity-50">Create Product</button>
      <!-- Animated loading bar -->
      <div v-if="loading" class="w-full bg-gray-200 rounded-full dark:bg-gray-700 mt-4">
        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" 
          :style="{ width: uploadProgress + '%', height: '20px', transition: 'width 1s linear' }">
          <span class="hidden">{{ Math.round(uploadProgress) }}%</span>
      </div>
      </div>
      <div v-if="success" class="text-green-600 mt-2">{{ success }}</div>
      <div v-if="error" class="text-red-600 mt-2">{{ error }}</div>
    </form>

    <h2 class="text-2xl font-bold mb-4">Product List</h2>
    <table class="w-full">
      <thead>
        <tr>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Barcode</th>
          <th class="px-4 py-2">Quantity</th>
          <th class="px-4 py-2">Description</th>
          <th class="px-4 py-2">Selling Price</th>
          <th class="px-4 py-2">Grocery Price</th>
          <th class="px-4 py-2">Product Created</th>
          <th class="px-4 py-2">Image</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td class="border px-4 py-2">{{ product.name }}</td>
          <td class="border px-4 py-2">{{ product.barcode }}</td>
          <td class="border px-4 py-2">{{ product.quantity }}</td>
          <td class="border px-4 py-2">{{ product.description }}</td>
          <td class="border px-4 py-2">{{ product.selling_price }}</td>
          <td class="border px-4 py-2">{{ product.grocery_price }}</td>
          <td class="border px-4 py-2">{{ formatTimeAgo(product.created_at) }}</td>
          <td class="border px-4 py-2"><img :src="product.image_url" alt="Product Image" class="w-24 h-auto"></td>
          <td class="border px-4 py-2"><button @click="deleteProduct(product.id)" class="bg-red-600 text-white px-2 py-1 rounded-md">Delete</button></td>
        </tr>
      </tbody>
    </table>

    <div class="card mt-8">
      <div v-if="loading" class="text-gray-700 mt-2">Loading...</div>
      <div v-if="error" class="text-red-600 mt-2">{{ error }}</div>
    </div>
  </div>
</div>
</template>


<script>
import axios from 'axios';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.extend(relativeTime);

export default {
  data() {
    return {
      products: [],
      loading: false,
      error: null,
      success: null,
      formData: {
        name: '',
        barcode: '',
        quantity: 0,
        description: '',
        selling_price: 0,
        grocery_price: 0,
        image: null,
      },
      uploadProgress: 0 
    };
  },
  mounted() {
    this.fetchProducts();
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
            // Update formData.image with the uploaded image URL
            this.formData.image = result.info.secure_url;
          }
        });
        
      };
  },
  methods: {
    fetchProducts() {
      this.loading = true;
      axios.get('/api/products')
        .then(response => {
          // Sort products by created_at in descending order
          this.products = response.data.results.sort((a, b) => {
            return new Date(b.created_at) - new Date(a.created_at);
          });
          this.loading = false;
        })
        .catch(error => {
          console.error('Error fetching products:', error);
          this.error = 'Failed to fetch products';
          this.loading = false;
        });
    },
    formatTimeAgo(timestamp) {
      return dayjs(timestamp).fromNow();
    },
    createProduct() {
      this.loading = true;
      const formData = new FormData();
      formData.append('name', this.formData.name);
      formData.append('barcode', this.formData.barcode);
      formData.append('quantity', this.formData.quantity);
      formData.append('description', this.formData.description);
      formData.append('selling_price', this.formData.selling_price);
      formData.append('grocery_price', this.formData.grocery_price);
      formData.append('image', this.formData.image);
      // Use axios' `onUploadProgress` to track upload progress
      axios.post('/api/addnewproduct', formData, {
        onUploadProgress: progressEvent => {
          this.uploadProgress = (progressEvent.loaded / progressEvent.total) * 100;
        }
      })
      .then(response => {
        this.success = response.data.message;
        this.loading = false;
        this.resetForm();
        this.fetchProducts();
      })
      .catch(error => {
        console.error(error);
        this.error = 'Failed to create product';
        this.loading = false;
        this.uploadProgress = 0; // Reset upload progress if upload fails
      });
    },
    deleteProduct(productId) {
      if (confirm("Are you sure you want to delete this product?")) {
        axios.delete(`/api/productsdelete/${productId}`)
          .then(response => {
            // Remove the deleted product from the products array
            this.products = this.products.filter(product => product.id !== productId);
            // Show success message or handle as needed
            console.log(response.data.message);
            // Refresh the page
            window.location.reload();
          })
          .catch(error => {
            // Show error message or handle as needed
            console.error(error);
          });
      }
    },
    onFileChange(event) {
      this.formData.image = event.target.files[0];
    },
    resetForm() {
      this.formData = {
        name: '',
        barcode: '',
        quantity: 0,
        description: '',
        selling_price: 0,
        grocery_price: 0,
        image: null,
      };
      // Reset file input field
      document.getElementById('image').value = '';
    }
  }
};
</script>


<style scoped>
.form-group {
  margin-bottom: 1rem;
}
.loading, .error, .success {
  margin-top: 0.5rem;
}
.error {
  color: red;
}
.success {
  color: green;
}
</style>
