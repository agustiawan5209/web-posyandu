<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import FormAnak from '@/Pages/Anak/Form.vue';
import { ref, defineProps, watch, onMounted } from 'vue';

const page = usePage();
const props = defineProps({
    balita: {
        type: Object,
        default: () => ({})
    }
})

const dataBalita = Object.keys(props.balita)
const Filter = dataBalita.filter(function (param) {
    return !/id/g.test(param) && !/orang_tua/g.test(param)
 })
console.log(Filter)

</script>

<template>

    <Head title="Jadwal Imunisasi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Edit Jadwal Imunisasi</h2>
        </template>

        <div class="md:py-4 relative box-content">
            <section class=" py-2 px-0 md:px-6  md:py-6 bg-gray-100 text-gray-900">
                <form novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1 px-3 md:px-0">
                        <p class="font-medium">Detail Informasi Jadwal Imunisasi</p>
                        <p class="text-xs">Detail data Jadwal Imunisasi dari puskesmas</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full  ">
                                <ul class="flex flex-col space-y-20">
                                    <li class="flex gap-3 py-2 border-b">
                                        <span class="text-lg">Detail</span>
                                    </li>
                                </ul>

                                <table class="w-full table">
                                    <colgroup>
                                    <col>
                                    <col class="w-3">
                                    <col>
                                    </colgroup>
                                    <tr class="" >
                                        <td class="text-sm border-b py-2 font-bold capitalize">Nama</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ balita.nama }} </td>
                                    </tr>
                                    <tr class="" >
                                        <td class="text-sm border-b py-2 font-bold capitalize">Tanggal Lahir</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ balita.tgl_lahir }} </td>
                                    </tr>
                                    <tr class="" >
                                        <td class="text-sm border-b py-2 font-bold capitalize">Usia</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ balita.hitung_usia }} </td>
                                    </tr>
                                    <tr class="" >
                                        <td class="text-sm border-b py-2 font-bold capitalize">Nama Orang Tua</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ balita.nama_orang_tua }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
