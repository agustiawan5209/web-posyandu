<script setup>

import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref, watch, defineProps } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const props = defineProps({
    links: Array,
    search: {
        type: String,
        default: '',
    },
    slug: {
        type: String,
        default: '',
    },
    path: {
        type: String,
        default: '',
    },
    TableData: {
        type: Object,
        default: () => ({}),
    },
    tableColums: {
        type: Object,
        default: () => ({}),
    },
})

const Form = useForm({
    search: props.search,
})

const SearchData = ref(props.search);

const ColumData = ref(props.TableData.data);
watch(SearchData, (value) => {
    Form.search = value;
    Form.get(route(props.path), {
        preserveState: true,
        preserveScroll: true,
    })
    // ColumData.value = ref(props.TableData.data);
})

console.log(ColumData.value)


</script>

<template>
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200">
                    <div class="py-3 px-4">
                        <div class="relative max-w-xs">
                            <label class="sr-only">Search</label>
                            <input type="search" name="hs-table-with-pagination-search"
                                id="hs-table-with-pagination-search" v-model.prevent="SearchData"
                                class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="Search for items">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" v-for="item in tableColums"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        <span v-if="item == 'id' || item == 'slug'">
                                            No.
                                        </span>
                                        <span v-else>{{ item }}</span>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="(item, index) in TableData.data" :key="item.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800"
                                        v-for="col in tableColums">

                                        <span v-if="col == 'id' || col == 'slug'">
                                            {{ (TableData.current_page - 1) * TableData.per_page + index + 1 }}
                                        </span>
                                        <span v-else>{{ item[col] }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <!-- Settings Dropdown -->
                                        <div class="ml-3 relative">
                                            <Dropdown align="top" width="48">
                                                <template #trigger>
                                                    <span class="inline-flex rounded-md">
                                                        <button type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                            Aksi

                                                            <font-awesome-icon :icon="['fas', 'ellipsis-vertical']" class="ml-2 -mr-0.5 h-4 w-4"/>

                                                        </button>
                                                    </span>
                                                </template>

                                                <template #content>
                                                    <DropdownLink :href="route('profile.edit')">Edit</DropdownLink>
                                                    <DropdownLink :href="route('profile.edit')"> Hapus</DropdownLink>
                                                    <DropdownLink :href="route('profile.edit')"> Show</DropdownLink>
                                                </template>
                                            </Dropdown>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="py-1 px-4 ">
                        <div class="flex flex-wrap">
                            <template v-for="(link, key) in TableData.links">
                                <div v-if="link.url === null" :key="key"
                                    class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
                                    v-html="link.label" />
                                <Link v-else :key="`link-${key}`"
                                    class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 active:border-blue-400 hover:bg-gray-200 border focus:border-indigo-500 rounded"
                                    :class="{ 'bg-white border-blue-500 text-black': link.active }" preserve-state
                                    preserve-scroll :data="{ search, slug }" :href="link.url" v-html="link.label" />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
