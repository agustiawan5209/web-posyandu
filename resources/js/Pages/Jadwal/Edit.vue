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
import { ref, defineProps } from 'vue';

const props = defineProps({
    jadwal: {
        type: Object,
        default: ()=>({}),
    }
})
const Form = useForm({
    slug:props.jadwal.id,
    usia:props.jadwal.usia,
    tanggal:props.jadwal.tanggal,
    jenis_imunisasi:props.jadwal.jenis_imunisasi,
    deskripsi:props.jadwal.deskripsi,
    penanggung_jawab:props.jadwal.penanggung_jawab,
})

function submit() {
    Form.put(route('Jadwal.update'), {
        onError: (err) => {
            console.log(err)
        }
    });
}


</script>

<template>

    <Head title="Jadwal Imunisasi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah Jadwal Imunisasi</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">
                <form @submit.prevent="submit()" novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Data Informasi Jadwal Imunisasi</p>
                        <p class="text-xs">Tambahkan data pegawai/staff dari puskesmas</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full sm:col-span-3">
                                <label for="usia" class="text-sm">Usia</label>
                                <TextInput id="usia" type="text" placeholder="0 - 5 Tahun" v-model="Form.usia"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.usia"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="jenis_imunisasi" class="text-sm">Jenis Imunisasi</label>
                                <TextInput id="jenis_imunisasi" type="text" v-model="Form.jenis_imunisasi" placeholder="Jenis Imunisasi" class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.jenis_imunisasi"/>

                            </div>
                            <div class="col-span-full sm:col-span-2">
                                <label for="tanggal" class="text-sm">Tanggal</label>
                                <TextInput id="tanggal" type="text" v-model="Form.tanggal" placeholder="tanggal..." class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.tanggal"/>

                            </div>

                            <div class="col-span-full sm:col-span-2">
                                <label for="penanggung_jawab" class="text-sm">Penanggung Jawab</label>
                                <TextInput id="penanggung_jawab" type="text" placeholder="Penanggung Jawab" v-model="Form.penanggung_jawab" class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.penanggung_jawab"/>
                            </div>

                            <div class="col-span-full">
                                <label for="deskripsi" class="text-sm">deskripsi</label>
                                <quill-editor id="deskripsi" contentType="html" theme="snow" v-model:content="Form.deskripsi" placeholder="@deskripsi" class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.deskripsi"/>

                            </div>
                        </div>
                        <PrimaryButton type="submit" class="col-span-full mt-20 text-center z-[100]">Simpan</PrimaryButton>

                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
