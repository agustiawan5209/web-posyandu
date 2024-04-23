<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, watch, defineProps, inject } from 'vue';

const swal = inject('$swal');


const props = defineProps({
    orangTua: {
        type: Object,
        default: () => ({})
    },
})
const Form = useForm({
    nama: '',
    tgl_lahir: '',
    jenkel: '',
    org_tua_id: props.orangTua.id,
})

function submit() {
    Form.post(route('Balita.store'), {
        onError: (err) => {
            console.log(err)
        }
    });
}


</script>

<template>
    <section class="p-6 bg-gray-100 text-gray-900">
        <form @submit.prevent="submit()" novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
            <div class="space-y-2 col-span-full lg:col-span-1">
                <p class="font-medium">Form Tambah Balita/Anak</p>
                <p class="text-xs">. Nama Orang Tua = {{ orangTua.nama }}</p>
            </div>
            <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50 tab">
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="firstname" class="text-sm">Nama Lengkap Anak</label>
                        <TextInput id="firstname" type="text" placeholder="nama lengkap" v-model="Form.nama"
                            class="w-full text-gray-900 text-sm" />
                        <InputError :message="Form.errors.nama" />
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="tgl_lahir" class="text-sm">Tanggal Lahir</label>
                        <TextInput id="tgl_lahir" type="date" v-model="Form.tgl_lahir"
                            class="w-full text-gray-900 text-sm" />
                        <InputError :message="Form.errors.tgl_alhir" />

                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="jenkel" class="text-sm mb-8">Jenis Kelamin</label>

                        <div class="flex items-center gap-4">
                            <div class="flex items-center">
                                <input id="jenkel-1" type="radio" value="Laki-Laki" name="jenkel" v-model="Form.jenkel"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                                <label for="jenkel-1" class="ms-2 text-sm font-medium text-gray-900">Laki-Laki</label>
                            </div>
                            <div class="flex items-center">
                                <input id="jenkel-2" type="radio" value="Perempuan" name="jenkel" v-model="Form.jenkel"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                                <label for="jenkel-2" class="ms-2 text-sm font-medium text-gray-900">Perempuan</label>
                            </div>
                        </div>

                        <InputError :message="Form.errors.jenkel" />

                    </div>
                </div>
                <PrimaryButton type="submit" class="col-span-full text-center">Simpan</PrimaryButton>
                <slot name="close"/>
            </fieldset>
        </form>
    </section>
</template>
