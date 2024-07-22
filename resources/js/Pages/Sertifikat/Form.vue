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
})
const Form = useForm({
    balita_id: '',
    nik: '',
    nama_balita: '',
    tempat_lahir: '',
    tgl_lahir: '',
    tinggi_badan: '',
    jenkel: '',
    nama_orang_tua: '',
    alamat_orang_tua: '',
    no_telpon_orang_tua: '',
    jenis_imunisasi: [],
    catatan: '',
})

const NamaOrangTua = ref('')
const NamaAnak = ref('')
function submit() {
    Form.post(route('Sertifikat.store'), {
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
        axios.get(route('data.balita.getDataBalita', { search: value }))
            .then((response) => {

                if (response.status == 200) {
                    const element = response.data;

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

const JenisImunisasi = ref([
    'Vitamin A - 1',
    'Vitamin A - 2',
    'Oralit',
    'BH (NOL)',
    'BCG',
    'POLIO - 1',
    'POLIO - 2',
    'POLIO - 3',
    'DPT/HB - 1',
    'DPT/HB - 2',
    'DPT/HB - 3',
    'Campak',
]);
const data_imunisasi = ref({});

const getSameValue = (obj1, obj2) => {
    const jenis_imunisasi = Object.values(obj2);
    const data_imunisasi = Object.values(obj1).map((elem, idx, self) => {
        return elem.jenis_imunisasi;
    });
    const filterUnique = jenis_imunisasi.reduce((acc, current) => {
        if (!acc.includes(current) && data_imunisasi.includes(current)) {
            acc.push(current);
            Form.jenis_imunisasi.push(true)
        }else{
            Form.jenis_imunisasi.push(false)

            acc.push(false)
        }
        return acc;
    }, [])
    return filterUnique;
}

function SelectChangeElement(event) {
    const Value = JSON.parse(event.target.value);
    PJ.value = '';
    Form.nama_orang_tua = Value.orang_tua.nama;
    Form.alamat_orang_tua = Value.orang_tua.alamat;
    Form.no_telpon_orang_tua = Value.orang_tua.no_telpon;
    Form.nama_balita = Value.nama;
    Form.nik = Value.nik;
    Form.jenkel = Value.jenkel;
    Form.tempat_lahir = Value.tempat_lahir;
    Form.tgl_lahir = Value.tgl_lahir;
    Form.balita_id = Value.id;
    data_imunisasi.value = getSameValue(Value.riwayat_imunisasis, JenisImunisasi.value);
    // console.log(data_imunisasi);
    // Form.jenis_imunisasi = getSameValue(Value.riwayat_imunisasis, JenisImunisasi.value);
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

function cekJenisImunisasi(idx) {
    const imun = data_imunisasi.value
    if (Form.jenis_imunisasi[idx]) {
        return 'Selesai';
    } else {
        return 'Belum';
    }
}
console.log(cekJenisImunisasi('Campak'));
</script>

<template>

    <Head title="Form Sertifikat" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah Sertifikat</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">

                <form @submit.prevent="submit()" novalidate="" action=""
                    class="container flex flex-col mx-auto space-y-3">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Data Tambah Sertifikat</p>
                        <p class="text-xs">Tambah Data Balita dengan Memilih Nama Orang Tua</p>
                        <ul class="list-decimal pl-10 space-y-2 text-xs " v-if="Form.errors">
                            <li class="text-xs text-red-500" v-for="item in Form.errors">
                                <span> {{ item }} </span>
                            </li>

                        </ul>
                    </div>
                    <div class="p-2 md:p-6 bg-gray-50">
                        <p class="font-medium mb-2">Pilih Bayi</p>
                        <div class="w-full flex items-center justify-center gap-3 relative">
                            <label for="firstname" class="text-sm whitespace-nowrap">Cari Nama/NIK Bayi/Balita</label>
                            <TextInput id="firstname" type="text" placeholder="Cari nama lengkap" v-model.prevent="PJ"
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
                            <label for="alamat_orang_tua" class="text-sm">Alamat Orang Tua</label>
                            <TextInput id="alamat_orang_tua" readonly type="text" placeholder="Alamat Orang Tua"
                                v-model="Form.alamat_orang_tua" class="w-full text-gray-900 text-sm" />
                        </div>
                        <div class="col-span-full sm:col-span-3">
                            <label for="no_telpon_orang_tua" class="text-sm">No. Telpon Orang Tua</label>
                            <TextInput id="no_telpon_orang_tua" readonly type="text" placeholder="No. Telpon"
                                v-model="Form.no_telpon_orang_tua" class="w-full text-gray-900 text-sm" />
                        </div>

                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full sm:col-span-3">
                                <label for="nik" class="text-sm">Nomor Induk Kependudukan (NIK) - Bayi/Balita</label>
                                <TextInput id="nik" readonly type="number" placeholder="Nomor Induk Kependudukan (NIK)"
                                    v-model="Form.nik" class="w-full text-gray-900 text-sm" />
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="namaAnak" class="text-sm">Nama Bayi/Balita</label>
                                <TextInput id="namaAnak" readonly type="text" placeholder="nama lengkap"
                                    v-model="Form.nama_balita" class="w-full text-gray-900 text-sm" />
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="tempat_lahir" class="text-sm">Tempat Lahir</label>

                                <TextInput id="tempat_lahir" type="text" placeholder="Tempat Lahir"
                                    v-model="Form.tempat_lahir" class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-1">
                                <label for="tgl_lahir" class="text-sm">Tanggal Lahir</label>

                                <TextInput id="tgl_lahir" type="date" placeholder="Tanggal lahir"
                                    v-model="Form.tgl_lahir" class="w-full text-gray-900 text-sm" />

                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="jenkel" class="text-sm mb-8">Jenis Kelamin</label>

                                <div class="flex items-center gap-4">
                                    <div class="flex items-center">
                                        <input id="jenkel-1" type="radio" value="Laki-Laki" name="jenkel"
                                            v-model="Form.jenkel"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                                        <label for="jenkel-1"
                                            class="ms-2 text-sm font-medium text-gray-900">Laki-Laki</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="jenkel-2" type="radio" value="Perempuan" name="jenkel"
                                            v-model="Form.jenkel"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                                        <label for="jenkel-2"
                                            class="ms-2 text-sm font-medium text-gray-900">Perempuan</label>
                                    </div>
                                </div>

                                <InputError :message="Form.errors.jenkel" />

                            </div>
                            <div class="col-span-full">
                                <label for="jenis_imunisasi" class="text-sm">Jenis Imunisasi</label>
                                <table class="table w-full border">
                                    <colgroup>
                                        <col class="w-96">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="px-2 py-1 text-xs border border-gray-700" colspan="2">Catatan
                                                Pemberian
                                                Imunisasi</th>
                                        </tr>
                                        <tr>
                                            <th class="px-2 py-1 text-xs border border-gray-700">Antigen</th>
                                            <th class="px-2 py-1 text-xs border border-gray-700">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, idx) in JenisImunisasi">
                                            <td class="font-semibold px-2 py-1 text-xs border border-gray-700">{{ item
                                                }}</td>
                                            <td class="px-2 py-1 text-xs border border-gray-700">
                                                <div class="flex justify-start gap-4">
                                                    <input type="checkbox" :name="item" :id="item" :value="item"
                                                        v-model="Form.jenis_imunisasi[idx]">
                                                    {{ cekJenisImunisasi(idx) }}
                                                    {{ Form.jenis_imunisasi[item] }}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-span-full ">
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
