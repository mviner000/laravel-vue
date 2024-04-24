<template>
  <div>
    <h2>Create New Product</h2>
    <form @submit.prevent="createProduct">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="formData.name" required>
      </div>
      <div class="form-group">
        <label for="barcode">Barcode:</label>
        <input type="text" id="barcode" v-model="formData.barcode">
      </div>
      <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" v-model.number="formData.quantity">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" v-model="formData.description"></textarea>
      </div>
      <div class="form-group">
        <label for="selling_price">Selling Price:</label>
        <input type="number" id="selling_price" v-model.number="formData.selling_price">
      </div>
      <div class="form-group">
        <label for="grocery_price">Grocery Price:</label>
        <input type="number" id="grocery_price" v-model.number="formData.grocery_price">
      </div>
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" id="image" @change="onFileChange">
      </div>
      <button type="submit" :disabled="loading">Create Product</button>
      <div v-if="loading" class="loading">Creating...</div>
      <div v-if="success" class="success">{{ success }}</div>
      <div v-if="error" class="error">{{ error }}</div>
    </form>


    <h2>Product List</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Barcode</th>
          <th>Quantity</th>
          <th>Description</th>
          <th>Selling Price</th>
          <th>Grocery Price</th>
          <th>Product Created</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.barcode }}</td>
          <td>{{ product.quantity }}</td>
          <td>{{ product.description }}</td>
          <td>{{ product.selling_price }}</td>
          <td>{{ product.grocery_price }}</td>
          <td>{{ formatTimeAgo(product.created_at) }}</td>
          <td>
            <img :src="product.image_url" alt="Product Image" style="width: 100px; height: auto;">
          </td>
        </tr>
      </tbody>
    </table>

    <div class="card">
      <div v-if="loading" class="loading">Loading...</div>
      <div v-if="error" class="error">{{ error }}</div>
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
      }
    };
  },
  mounted() {
    this.fetchProducts();
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
      axios.post('/api/addnewproduct', formData)
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
        });
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