<template>
    <div class="card">
      <DataTable :value="products" tableStyle="min-width: 50rem">
        <Column field="id" header="ID"></Column>
        <Column field="name" header="Name"></Column>
        <Column field="selling_price" header="Selling Price"></Column>
        <Column field="grocery_price" header="Grocery Price"></Column>
        <Column field="quantity" header="Quantity"></Column>
      </DataTable>
      <div v-if="loading" class="loading">Loading...</div>
      <div v-if="error" class="error">{{ error }}</div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import DataTable from 'primevue/datatable';
  import Column from 'primevue/column';
  
  export default {
    components: {
      DataTable,
      Column
    },
    data() {
      return {
        products: [],
        loading: false,
        error: null
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
            this.products = response.data.results;
            console.log('Products:', this.products);
            this.loading = false;
          })
          .catch(error => {
            console.error('Error fetching products:', error);
            this.error = 'Failed to fetch products';
            this.loading = false;
          });
      }
    }
  }
  </script>
  