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
    puskesmas: {
        type: Object,
        default: () => ({})
    }
})
const Form = useForm({
    nama_puskesmas: props.puskesmas != null ? props.puskesmas.nama_puskesmas : 'UPT Puskesmas Karassing',
    nip: props.puskesmas != null ? props.puskesmas.nip : '',
    kepala_puskesmas: props.puskesmas != null ? props.puskesmas.kepala_puskesmas : '',
    foto_profile: props.puskesmas != null ? props.puskesmas.foto_profile : '',
    alamat: props.puskesmas != null ? props.puskesmas.alamat : 'Ds. Karassing, Kec. Hero Lange-Lange',
    logo: props.puskesmas != null ? props.puskesmas.logo : '',
    visi: props.puskesmas != null ? props.puskesmas.visi : '',
    misi: props.puskesmas != null ? props.puskesmas.misi : '',
    deskripsi: props.puskesmas != null ? props.puskesmas.deskripsi : '',
})

function submit() {
    Form.post(route('SettingPuskesmas.store'), {
        onError: (err) => {
            console.log(err)
        }
    });
}

const EditorOptions = ref({
    modules: {

    },
    placeholder: 'Compose an epic...',
    readOnly: false,
    theme: 'snow'

})

</script>

<template>

    <Head title="Puskesmas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah Puskesmas</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">
                <form @submit.prevent="submit()" novalidate="" action="" enctype="multipart/form-data"
                    class="container flex flex-col mx-auto space-y-12">
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_puskesmas" class="text-sm capitalize">Nama Puskesmas</label>
                                <TextInput id="nama_puskesmas" type="text" placeholder="nama Puskesmas"
                                    v-model="Form.nama_puskesmas" class="w-full text-gray-900" />
                                <InputError :message="Form.errors.nama_puskesmas" />
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="alamat" class="text-sm capitalize">Alamat</label>
                                <TextInput id="alamat" type="text" v-model="Form.alamat" placeholder="alamat..."
                                    class="w-full text-gray-900" />
                                <InputError :message="Form.errors.alamat" />

                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="kepala_puskesmas" class="text-sm capitalize">Kepala Puskesmas</label>
                                <TextInput id="kepala_puskesmas" type="text" v-model="Form.kepala_puskesmas"
                                    placeholder="Kepala Puskesmas" class="w-full text-gray-900" />
                                <InputError :message="Form.errors.kepala_puskesmas" />

                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="nip" class="text-sm capitalize">Nip Puskesmas</label>
                                <TextInput id="nip" type="number" v-model="Form.nip" placeholder="Nip"
                                    class="w-full text-gray-900" />
                                <InputError :message="Form.errors.nip" />

                            </div>

                            <div class="col-span-full">
                                <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo
                                    Profil Kepala
                                    Puskesmas</label>
                                <div class="mt-2 flex items-center gap-x-3">
                                    <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <input type="file" class="hidden">
                                    <button type="button"
                                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                                </div>
                                <InputError :message="Form.errors.foto_profile" />

                            </div>

                            <div class="col-span-full">
                                <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Logo
                                    Puskesmas</label>
                                <div
                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                            <label for="file-upload"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                                <InputError :message="Form.errors.logo" />

                            </div>
                            <div class="col-span-full">
                                <label for="visi" class="text-sm capitalize">visi</label>
                                <quill-editor id="visi" contentType="html" theme="snow" v-model:content="Form.visi"
                                    :options="EditorOptions" placeholder="@visi Puskesmas"
                                    class="w-full text-gray-900" />
                                <InputError :message="Form.errors.visi" />


                            </div>
                            <div class="col-span-full mb-24 mt-32 sm:mb-16 sm:mt-20">
                                <label for="misi" class="text-sm capitalize">misi</label>
                                <quill-editor id="misi" contentType="html" theme="snow" v-model:content="Form.misi"
                                    :options="EditorOptions" placeholder="@misi Puskesmas"
                                    class="w-full text-gray-900" />
                                <InputError :message="Form.errors.misi" />


                            </div>
                            <div class="col-span-full mb-28 sm:mb-20 mt-5">
                                <label for="deskripsi" class="text-sm capitalize">deskripsi</label>
                                <quill-editor id="deskripsi" contentType="html" theme="snow" :options="EditorOptions"
                                    v-model:content="Form.deskripsi" placeholder="@deskripsi/Sejarah Puskesmas"
                                    class="w-full text-gray-900" />
                                <InputError :message="Form.errors.deskripsi" />


                            </div>
                        </div>
                        <PrimaryButton type="submit" class="col-span-full text-center">Simpan</PrimaryButton>
                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.ql-editor[contenteditable=false] {
    background-color: white;
}
.ql-editor[contenteditable=true] {
    background-color: white;
}
</style>
