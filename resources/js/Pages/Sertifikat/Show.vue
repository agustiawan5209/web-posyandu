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
import CardEmbedPDF from '@/Components/Card/CardEmbedPDF.vue';
import { ref, defineProps, watch, onMounted } from 'vue';

const page = usePage();
const props = defineProps({
    sertifikat: {
        type: Object,
        default: () => ({})
    }
})
const columsReplace = (element) => {

    return element.replace(/_|\b_id\b/g, ' ');
};
console.log(props.sertifikat)

</script>

<template>

    <Head title="Sertifikat Imunisasi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Show Sertifikat Imunisasi</h2>
        </template>

        <div class="md:py-4 relative box-content">
            <section class=" py-2 px-0 md:px-6  md:py-6 bg-gray-100 text-gray-900">
                <form novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1 px-3 md:px-0">
                        <p class="font-medium">Detail Informasi Sertifikat Imunisasi</p>
                        <p class="text-xs">Detail data Sertifikat Imunisasi dari puskesmas</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full  ">
                                <div class="container">
                                    <CardEmbedPDF :pdf-url="sertifikat.file_url"/>
                                </div>

                                <table class="w-full table">
                                    <colgroup>
                                        <col>
                                        <col class="w-3">
                                        <col>
                                    </colgroup>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">Nomor Sertifikat</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600" v-html="sertifikat.nomor"> </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">Nomor
                                            Induk
                                            Kependudukan - Bayi/Balita</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600" v-html="sertifikat.nik"> </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">Nama
                                            Bayi/Balita</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600" v-html="sertifikat.nama_balita">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">Nama
                                            Tempat/Tanggal Lahir</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ sertifikat.tempat_lahir }}/ {{
                                            sertifikat.tgl_lahir }} </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">Jenis
                                            Kelamin
                                        </td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ sertifikat.jenkel }} </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">Nama
                                            Orang Tua
                                        </td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ sertifikat.nama_orang_tua }}
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">alamat
                                            Orang
                                            Tua</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ sertifikat.alamat_orang_tua }}
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize whitespace-nowrap">No.
                                            Telpon
                                            Orang Tua</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ sertifikat.no_telpon_orang_tua }}
                                        </td>
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
