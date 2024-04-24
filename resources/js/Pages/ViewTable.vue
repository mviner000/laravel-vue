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

import CustomerService from './Data/CustomerService';

interface Customer {
    // Define the structure of your customer object
    name: string;
    country: { name: string };
    representative: string;
    status: string;
    verified: boolean;
    date: Date;
    // Add other properties as needed
}

const customers = ref();
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    representative: { value: null, matchMode: FilterMatchMode.IN },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
    verified: { value: null, matchMode: FilterMatchMode.EQUALS }
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
const loading = ref(true);


onMounted(() => {
    CustomerService.getCustomersMedium().then((data: any[]) => {
        customers.value = getCustomers(data);
        loading.value = false;

        // Log all values from the "verified" property
        console.log("Verified values:");
        customers.value.forEach((customer: Customer) => {
            console.log(customer.verified);
        });
    });
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
});

const getCustomers = (data: any[]): Customer[] => {
    return [...(data || [])].map((d: any) => {
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
}
</script>

<template>
    <div class="card">
        
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