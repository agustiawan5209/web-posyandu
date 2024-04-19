<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChartJenisImunisasi from '@/Components/Chart/ChartJenisImunisasi.vue';
import CardTable from '@/Components/Card/CardTable.vue';
import Dropdown from '@/Components/Dropdown.vue';

import { ref, watch, defineProps } from 'vue';
const props = defineProps({
    search: {
        type: String,
        default: '',
    },
    data: {
        type: Object,
        default: () => ({}),
    },
    table_colums: {
        type: Object,
        default: () => ({}),
    },
})

console.log(props.table_colums)
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Data</h2>
        </template>

        <div class="py-4 relative box-content">
            <CardTable :search="search" :slug="null" :path="'master'" :TableData="data" :tableColums="table_colums" />
        </div>
    </AuthenticatedLayout>
</template>
