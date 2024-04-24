<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { FilterMatchMode } from 'primevue/api';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Tag from 'primevue/tag';
import IconField from 'primevue/iconfield';
import InputText from 'primevue/inputtext';
import MultiSelect from 'primevue/multiselect';
import Dropdown from 'primevue/dropdown';
import TriStateCheckbox from 'primevue/tristatecheckbox';
import axios from 'axios';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import CustomerService from './Data/CustomerService';



dayjs.extend(relativeTime);

interface Customer {
    name: string;
    country: { name: string };
    representative: string;
    status: string;
    verified: boolean;
    date: Date;
}

interface Product {
    id: string;
    name: string;
    barcode: string;
    quantity: number;
    description: string;
    selling_price: number;
    grocery_price: number;
    created_at: string; // Assuming created_at is a string representing a date
    image_url: string; // Assuming image_url is a string representing the URL of the product image
}

const products = ref<Product[]>([]);

const loading = ref(false);
const error = ref(null);
const success = ref(null);
const uploadProgress = ref(0);
const formData = ref({
    name: '',
    barcode: '',
    quantity: 0,
    description: '',
    selling_price: 0,
    grocery_price: 0,
    image: null,
});

const customers = ref<Customer[]>([]);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    representative: { value: null, matchMode: FilterMatchMode.IN },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
    verified: { value: null, matchMode: FilterMatchMode.EQUALS },
});
const representatives = ref([
    { name: 'Amy Elsner', image: 'amyelsner.png' },
    { name: 'Anna Fali', image: 'annafali.png' },
    { name: 'Asiya Javayant', image: 'asiyajavayant.png' },
    { name: 'Bernardo Dominic', image: 'bernardodominic.png' },
    { name: 'Elwin Sharvill', image: 'elwinsharvill.png' },
    { name: 'Ioni Bowcher', image: 'ionibowcher.png' },
    { name: 'Ivan Magalhaes', image: 'ivanmagalhaes.png' },
    { name: 'Onyama Limba', image: 'onyamalimba.png' },
    { name: 'Stephen Shaw', image: 'stephenshaw.png' },
    { name: 'XuXue Feng', image: 'xuxuefeng.png' }
]);
const statuses = ref(['unqualified', 'qualified', 'new', 'negotiation', 'renewal', 'proposal']);

onMounted(async () => {
    fetchProducts();
    try {
        loading.value = true;
        const data = await CustomerService.getCustomersMedium();
        customers.value = getCustomers(data);
        loading.value = false;
        
        // Log all values from the "verified" property
        // console.log("Verified values:");
        // customers.value.forEach((customer: Customer) => {
        //     console.log(customer.verified);
        // });

        // Load Cloudinary upload widget script
        const script = document.createElement('script');
        script.src = 'https://upload-widget.cloudinary.com/global/all.js';
        script.type = 'text/javascript';
        script.async = true;
        document.head.appendChild(script);
        
        // Initialize Cloudinary upload widget
        script.onload = () => {
            const widget = (window as any).cloudinary.createUploadWidget({
                cloudName: 'dqpzvvd0v',
                uploadPreset: 'mrpfvufw'
            }, (error: any, result: any) => {
                if (!error && result && result.event === 'success') {
                    console.log('Upload successful! Here is the result:', result.info);
                    // You can handle successful upload here
                }
            });
            // Open Cloudinary upload widget on button click
            document.getElementById('upload_widget')?.addEventListener('click', function () {
                widget.open();
            }, false);
        };
    } catch (error) {
        console.error("Error fetching customers:", error);
        loading.value = false;
    }
});

const getCustomers = (data: any[]): Customer[] => {
    return data.map((d: any) => {
        // Assuming d has the structure of a Customer object
        d.date = new Date(d.date);
        return d as Customer;
    });
};

type CustomSeverity = 'secondary' | 'success' | 'info' | 'warning' | 'danger' | 'contrast';

const getSeverity = (status: string): CustomSeverity | undefined => {
    switch (status) {
        case 'unqualified':
            return 'danger';
        case 'qualified':
            return 'success';
        case 'new':
            return 'info';
        case 'negotiation':
            return 'warning';
        case 'renewal':
            return undefined; // Return undefined instead of null
        default:
            return undefined; // Return undefined for unknown status
    }
};

const fetchProducts = () => {
    loading.value = true;
    axios.get('/api/products')
        .then(response => {
            // Sort products by created_at in descending order
            products.value = response.data.results.sort((a: any, b: any) => {
                // Parse date strings into Date objects
                const dateA = new Date(a.created_at);
                const dateB = new Date(b.created_at);
                // Return the difference between the two dates
                return dateB.getTime() - dateA.getTime();
            });

            // Log each product data
            // products.value.forEach(product => {
            //     console.log('Product Data:', product);
            // });

            loading.value = false;
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            error.value = 'Failed to fetch products';
            loading.value = false;
        });
};



const formatTimeAgo = (timestamp: Date) => {
    return dayjs(timestamp).fromNow();
};

const createProduct = () => {
    loading.value = true;
    const formDataValue = formData.value;
    const formDataInstance = new FormData();
    formDataInstance.append('name', formDataValue.name);
    formDataInstance.append('barcode', formDataValue.barcode);
    formDataInstance.append('quantity', String(formDataValue.quantity));
    formDataInstance.append('description', formDataValue.description);
    formDataInstance.append('selling_price', String(formDataValue.selling_price));
    formDataInstance.append('grocery_price', String(formDataValue.grocery_price));

    // Check if formDataValue.image is not null or undefined before appending
    if (formDataValue.image !== null && formDataValue.image !== undefined) {
        // Check if formDataValue.image is a Blob
        if (isBlob(formDataValue.image)) {
            formDataInstance.append('image', formDataValue.image);
        } else if (typeof formDataValue.image === 'string') {
            // If formDataValue.image is a string, append it as is
            formDataInstance.append('image', formDataValue.image);
        }
    }

    // Use axios' `onUploadProgress` to track upload progress
    axios.post('/api/addnewproduct', formDataInstance, {
        onUploadProgress: progressEvent => {
            if (progressEvent.total !== null && progressEvent.total !== undefined) {
                uploadProgress.value = (progressEvent.loaded / progressEvent.total) * 100;
            }
        }
    })
    .then(response => {
        success.value = response.data.message;
        loading.value = false;
        resetForm();
        fetchProducts();
    })
    .catch(error => {
        console.error(error);
        error.value = 'Failed to create product';
        loading.value = false;
        uploadProgress.value = 0; // Reset upload progress if upload fails
    });
};

// Type guard function to check if a value is a Blob
const isBlob = (value: any): value is Blob => {
    return value instanceof Blob;
};




const deleteProduct = (productId: string) => {
    if (confirm("Are you sure you want to delete this product?")) {
        axios.delete(`/api/productsdelete/${productId}`)
            .then(response => {
                // Remove the deleted product from the products array
                products.value = products.value.filter(product => product.id !== productId);
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
};

const onFileChange = (event: any) => {
formData.value.image = event.target.files[0];
};

const resetForm = () => {
formData.value = {
name: '',
barcode: '',
quantity: 0,
description: '',
selling_price: 0,
grocery_price: 0,
image: null,
};
// Reset file input field
(document.getElementById('image') as HTMLInputElement).value = '';
};
</script>


<template>
    <div class="card container py-6">
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
                <td class="border px-4 py-2">{{ formatTimeAgo(dayjs(product.created_at).toDate()) }}</td>
                <td class="border px-4 py-2"><img :src="product.image_url" alt="Product Image" class="w-24 h-auto"></td>
                <td class="border px-4 py-2"><button @click="deleteProduct(product.id)" class="bg-red-600 text-white px-2 py-1 rounded-md">Delete</button></td>
               
                </tr>
            </tbody>
            </table>

            <div class="card mt-8">
            <div v-if="loading" class="text-gray-700 mt-2">Loading...</div>
            <div v-if="error" class="text-red-600 mt-2">{{ error }}</div>
            </div>

        <div class="flex align-center justify-center">
        <button id="upload_widget" class="cloudinary-button">Upload files</button>
        </div>
        <DataTable v-model:filters="filters" :value="customers" paginator :rows="10" dataKey="id" filterDisplay="row" :loading="loading"
                :globalFilterFields="['name', 'country.name', 'representative.name', 'status']">
            <template #header>
                <div class="flex justify-content-end">
                    <IconField iconPosition="left">
                        <InputText v-model="filters['global'].value" id="keyword-search" placeholder="Keyword Search" />
                    </IconField>
                </div>
            </template>
            <template #empty> No customers found. </template>
            <template #loading> Loading customers data. Please wait. </template>
            <Column field="name" header="Name" style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.name }}
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <InputText v-model="filterModel.value" id="name-search" type="text" @input="filterCallback()" class="p-column-filter outline border-cyan-500" placeholder="Search by name" />
                </template>
            </Column>
            <Column header="Country" filterField="country.name" style="min-width: 12rem">
                <template #body="{ data }">
                    <div class="flex align-items-center gap-2">
                        <img alt="flag" src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png" :class="`flag flag-${data.country.code}`" style="width: 24px" />
                        <span>{{ data.country.name }}</span>
                    </div>
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <InputText v-model="filterModel.value" id="country-search" type="text" @input="filterCallback()" class="p-column-filter outline border-cyan-500" placeholder="Search by country" />
                </template>
            </Column>
            <Column header="Agent" filterField="representative" :showFilterMenu="false" :filterMenuStyle="{ width: '14rem' }" style="min-width: 14rem">
                <template #body="{ data }">
                    <div class="flex align-items-center gap-2">
                        <img :alt="data.representative.name" :src="`https://primefaces.org/cdn/primevue/images/avatar/${data.representative.image}`" style="width: 32px" />
                        <span>{{ data.representative.name }}</span>
                    </div>
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <MultiSelect v-model="filterModel.value" @change="filterCallback()" :options="representatives" optionLabel="name" placeholder="Any" class="p-column-filter" style="min-width: 14rem" :maxSelectedLabels="1">
                        <template #option="slotProps">
                            <div class="flex align-items-center gap-2">
                                <img :alt="slotProps.option.name" :src="`https://primefaces.org/cdn/primevue/images/avatar/${slotProps.option.image}`" style="width: 32px" />
                                <span>{{ slotProps.option.name }}</span>
                            </div>
                        </template>
                    </MultiSelect>
                </template>
            </Column>
            <Column field="status" header="Status" :showFilterMenu="false" :filterMenuStyle="{ width: '14rem' }" style="min-width: 12rem">
                <template #body="{ data }">
                    <Tag :value="data.status" :severity="getSeverity(data.status)" />
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <Dropdown v-model="filterModel.value" @change="filterCallback()" :options="statuses" placeholder="Select One" class="p-column-filter" style="min-width: 12rem" :showClear="true">
                        <template #option="slotProps">
                            <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                        </template>
                    </Dropdown>
                </template>
            </Column>
            <Column field="verified" header="Verified" dataType="boolean" style="min-width: 6rem">
                <template #body="{ data }">
                    <div>{{ data.verified ? 'true' : 'false' }}</div>
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <TriStateCheckbox v-model="filterModel.value" @change="filterCallback()" class="outline outline-offset-1 outline-cyan-500" style="outline-width: thin;" />

                </template>
            </Column>

        </DataTable>
    </div>
</template>