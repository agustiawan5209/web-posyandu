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
import { ref, defineProps, watch, onMounted } from 'vue';
import axios from 'axios';
import FormAnak from '../Anak/Form.vue';

const props = defineProps({
    orangTua: {
        type: Object,
        default: () => ({})
    },
    riwayat: {
        type: Object,
        default: () => ({})
    },
})
const DataImunisasi = ref(props.riwayat.data_imunisasi)

const Form = useForm({
    slug: props.riwayat.id,
    balita_id: props.riwayat.balita_id,
    data_imunisasi: props.riwayat.data_imunisasi,
    tanggal: props.riwayat.tanggal,
    catatan: props.riwayat.catatan,
    berat_badan: DataImunisasi.value.berat_badan,
    tinggi_badan: DataImunisasi.value.tinggi_badan,
    lingkar_kepala: DataImunisasi.value.lingkar_kepala,
    kesehatan: DataImunisasi.value.kesehatan,
    nama_anak: DataImunisasi.value.nama_anak,
    nama_orang_tua: DataImunisasi.value.nama_orang_tua,
    usia: DataImunisasi.value.usia_anak,
    jenis_kelamin: DataImunisasi.value.jenis_kelamin,
    jenis_imunisasi: props.riwayat.jenis_imunisasi,
})

const NamaOrangTua = ref('')
const NamaAnak = ref('')
function submit() {
    Form.put(route('Riwayat.update'), {
        preserveState: true,
        onError: (err) => {
            console.log(err)
        },
        onSuccess: () => {
            Form.reset();
            // NamaOrangTua.value = '';
        }
    });
}

const PJ = ref('');
const changeSelect = ref(0);
const SelectElement = ref(null);
const OptiontElement = ref([]);
const ShowSelect = ref(false);

function searchPengguna(value) {
    if (value.length > 0) {
        axios.get(route('api.balita.getBalita', { search: value }))
            .then((response) => {

                if (response.status == 200) {
                    const element = response.data;
                    console.log(element)
                    ShowSelect.value = true;

                    if (SelectElement.value) {
                        const childElements = SelectElement.value.childNodes
                        // loop through the child elements and remove them
                        while (childElements.length > 0) {
                            SelectElement.value.removeChild(childElements[0])
                        }
                    }


                    OptiontElement.value = [];
                    for (let i = 0; i < element.length; i++) {
                        const Balita = element[i];
                        const Option = document.createElement('option');
                        // ID
                        Form.balita_id = Balita.id;

                        // Options
                        Option.value = JSON.stringify(Balita);
                        Option.innerText = Balita.nama;
                        Option.className = 'border-b-2'
                        // Append Option On Parent Element
                        if (SelectElement.value) {
                            SelectElement.value.appendChild(Option);
                        }
                        OptiontElement.value[i] = Option;
                    }

                }
            })
            .catch(err => {
                console.log(err)
            })
    } else {
        ShowSelect.value = false;

    }
}

function SelectChangeElement(event) {
    const Value = JSON.parse(event.target.value);
    PJ.value = '';
    Form.nama_orang_tua = Value.orang_tua.nama;
    Form.nama_anak = Value.nama;
    Form.usia = Value.hitung_usia;
    Form.jenis_kelamin = Value.jenkel;
    if (SelectElement.value) {
        const childElements = SelectElement.value.childNodes
        // loop through the child elements and remove them
        SelectElement.value.removeChild(childElements[0])
        if (childElements.length < 1) {
            changeSelect.value = 1;

        }
    }

}
onMounted(() => {
    watch(PJ, (value) => {
        searchPengguna(value)
    })

})

</script>

<template>

    <Head title="Form Balita" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Edit Balita</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">

                <form @submit.prevent="submit()" novalidate="" action=""
                    class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Data Edit Balita/Anak</p>
                        <p class="text-xs">Edit Data Balita dengan Memilih Nama Orang Tua</p>
                        <ul class="list-decimal pl-10 space-y-2 text-xs " v-if="Form.errors">
                            <li class="text-xs text-red-500" v-for="item in Form.errors">
                                <span> {{ item }} </span>
                            </li>

                        </ul>
                    </div>
                    <div class="p-2 md:p-6 bg-gray-50">
                        <p class="font-medium mb-2">Pilih Nama Bayi/Balita</p>
                        <div class="w-full flex items-center justify-center gap-3 relative">
                            <label for="firstname" class="text-sm whitespace-nowrap">Cari Nama Bayi/Balita</label>
                            <TextInput id="firstname" type="text" placeholder="Cari nama lengkap" v-model="PJ"
                                class="w-full text-gray-900 text-xs" />

                            <div class="w-full mx-auto absolute z-10 -bottom-24" v-if="PJ != ''">
                                <select id="countries" multiple ref="SelectElement"
                                    @change="SelectChangeElement($event)"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                </select>
                            </div>
                        </div>
                        <div class="col-span-full sm:col-span-3">
                            <label for="nama_orang_tua" class="text-sm">Nama Orang Tua</label>
                            <TextInput id="nama_orang_tua" readonly type="text" placeholder="nama lengkap"
                                v-model="Form.nama_orang_tua" class="w-full text-gray-900 text-sm" />
                        </div>
                        <div class="col-span-full sm:col-span-3">
                            <label for="namaAnak" class="text-sm">Nama Bayi/Balita</label>
                            <TextInput id="namaAnak" readonly type="text" placeholder="nama lengkap"
                                v-model="Form.nama_anak" class="w-full text-gray-900 text-sm" />
                        </div>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full">
                                <label for="berat_badan" class="text-sm">Jumlah Berat Badan Bayi/Balita (KG)</label>

                                <TextInput id="berat_badan" type="number" placeholder="Berat Badan (KG)"
                                    v-model="Form.berat_badan" class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-full">
                                <label for="berat_badan" class="text-sm">Tinggi Badan Bayi/Balita (CM)</label>

                                <TextInput id="berat_badan" type="number" placeholder="Tinggi Badan (CM)"
                                    v-model="Form.tinggi_badan" class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-full">
                                <label for="berat_badan" class="text-sm">Ukuran Lingkar Kepala Bayi/Balita</label>

                                <TextInput id="berat_badan" type="number" placeholder="Lingkar Kepala"
                                    v-model="Form.lingkar_kepala" class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-full">
                                <label for="kesehatan_bayi" class="text-sm">Kesehatan Bayi</label>

                                <TextInput id="kesehatan_bayi" type="text" placeholder="Kesehatan Bayi"
                                    v-model="Form.kesehatan" class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-full">
                                <label for="jenis_imunisasi" class="text-sm">Jenis Imunisasi</label>
                                <TextInput id="jenis_imunisasi" type="text" v-model="Form.jenis_imunisasi"
                                    class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-full">
                                <label for="tanggal" class="text-sm">Tanggal Imunisasi</label>
                                <TextInput id="tanggal" type="date" v-model="Form.tanggal"
                                    class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-full">
                                <label for="catatan" class="text-sm">catatan</label>
                                <quill-editor id="catatan" contentType="html" theme="snow"
                                    v-model:content="Form.catatan"
                                    placeholder="@catatan atau rincian imunisasi pada bayi/Balita"
                                    class="w-full text-gray-900" />

                            </div>
                        </div>
                        <PrimaryButton type="submit" class="col-span-full mt-20 text-center z-[100]">Simpan
                        </PrimaryButton>

                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
