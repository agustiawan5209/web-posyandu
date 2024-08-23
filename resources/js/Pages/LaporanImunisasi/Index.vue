<script setup>
import { ref, defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm,usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
const props = defineProps({
    balita: {
        type: Object,
        default: () => ({})
    },
    datereport: {
        type: Object,
        default: () => ({})
    },
    posyandu: {
        type: Object,
        default: () => ({}),
    },
})

const Page = usePage().props.auth;
const Roles = Page.role;
function roleToCheck(role) {
    if (Array.isArray(Roles)) {
        return Roles.includes(role)
    }else{
        return false;
    }
}

function ArrayToString(){
    if (Array.isArray(Roles)) {
        return Roles.reduce((a,b)=>{

            return String(a+ ','+b).toString();
        })
    }
}


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
const RiwayatImunisasi = ref([]);
const BoolImunisasi = ref([]);
const getHistoryImunisasi = (obj1, current) => {
    const data_imunisasi = Object.values(obj1).map((elem, idx, self) => {
        return elem.jenis_imunisasi;
    });
    const Imunisasi = Object.values(obj1).map((elem, idx, self) => {
        return elem;
    });
    if (data_imunisasi.includes(current)) {
        // Filter data Imunisasi sesuai dengan jenis_imunisasi yang cocok
        const matchedImunisasi = Imunisasi.filter(imun => imun.jenis_imunisasi === current);
        return matchedImunisasi[0].tanggal;
    } else {
        // Jika tidak ada yang cocok, tambahkan array kosong
        return '---';
    }
}

const downloadPDF = () => {
    axios({
        method: 'get',
        url: route('Laporan-imunisasi.store', {posyandus_id: FormLaporan.posyandus_id}),
        responseType: 'blob'
    })
        .then(response => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'Laporan-Imunisasi.pdf');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        })
        .catch(error => {
            console.log(error);
        });
};
const FormLaporan = useForm({
    posyandus_id : props.datereport.posyandus_id,
})

function searchDate() {
    FormLaporan.get(route('Laporan-imunisasi.index'), {
        preserveState: true,
        preserveScroll: true,
    })
}
</script>


<template>

    <Head title="Laporan Imunisasi" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Imunisasi </h2>
        </template>


        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg divide-y divide-gray-200">
                        <div class="py-3 px-4 flex justify-between" v-if="roleToCheck('Kepala')">
                            <div class="flex gap-3 items-center" >
                                <div class="relative max-w-xs flex items-center">
                                    <label for="posyandus_id" class="text-sm">Posyandu</label>
                                    <select name="posyandus_id" id="posyandus_id" v-model="FormLaporan.posyandus_id" class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm w-full text-gray-900">
                                        <option value="">-----</option>
                                        <option v-for="pos in posyandu" :value="pos.id" >{{pos.nama}}</option>
                                    </select>
                                    <InputError :message="FormLaporan.errors.posyandus_id"/>

                                </div>
                                <div class="relative flex">
                                    <PrimaryButton type="button" @click="searchDate">
                                        <font-awesome-icon :icon="['fas', 'search']" class="mr-2" />
                                        <span>Cari Data</span>
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                        <div class="py-3 px-4">
                            <div class="relative max-w-xs">
                                <PrimaryButton type="button" @click="downloadPDF()">Cetak</PrimaryButton>
                            </div>
                        </div>
                        <div class="w-full overflow-x-auto">
                            <table class="w-full table overflow-x-auto">
                                <colgroup>
                                    <col>
                                </colgroup>
                                <thead class="bg-primary">
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left uppercase border-b border-gray-700 text-white ">
                                        <th scope="col" class="px-2 py-1 capitalize">
                                            No
                                        </th>
                                        <th scope="col" class="px-2 py-1 capitalize">
                                            Nama Balita
                                        </th>
                                        <th scope="col" class="px-2 py-1 capitalize">
                                            Jenis Kelamin
                                        </th>
                                        <th scope="col" class="px-2 py-1 capitalize">
                                            Tanggal Lahir
                                        </th>
                                        <th scope="col" class="px-2 py-1 capitalize">
                                            Nama Orang Tua
                                        </th>
                                        <th scope="col" class="px-2 py-1 capitalize">
                                            Alamat
                                        </th>
                                        <th scope="col" v-for="item in JenisImunisasi"
                                            class="px-2 py-1 md:px-6 md:py-3 text-nowrap text-start font-medium capitalize">
                                            {{ item }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y " v-if="balita.data.length > 0">
                                    <tr v-for="(item, index) in balita.data" :key="item.id"
                                        class="text-gray-700 dark:text-gray-400">
                                        <td class="px-2 py-1 md:px-4 md:py-3  text-xs font-medium text-gray-800 border">
                                            {{ (balita.current_page - 1) * balita.per_page + index + 1 }}
                                        </td>
                                        <td class="px-2 py-1 md:px-4 md:py-3  text-xs font-medium text-gray-800 border">
                                            {{ item.nama }}
                                        </td>
                                        <td class="px-2 py-1 md:px-4 md:py-3  text-xs font-medium text-gray-800 border">
                                            {{ item.jenkel }}
                                        </td>
                                        <td class="px-2 py-1 md:px-4 md:py-3  text-xs font-medium text-gray-800 border">
                                            {{ item.tgl_lahir }}
                                        </td>
                                        <td class="px-2 py-1 md:px-4 md:py-3  text-xs font-medium text-gray-800 border">
                                            {{ item.orang_tua.nama }}
                                        </td>
                                        <td class="px-2 py-1 md:px-4 md:py-3  text-xs font-medium text-gray-800 border">
                                            {{ item.orang_tua.alamat }}
                                        </td>
                                        <td class="px-2 py-1 text-xs font-medium text-gray-800 border"
                                            v-for="col in JenisImunisasi">
                                            <span v-if="item.riwayat_imunisasis.length > 0" class="whitespace-nowrap">
                                                {{ getHistoryImunisasi(item.riwayat_imunisasis, col) }}

                                            </span>
                                        </td>

                                    </tr>

                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td :colspan="balita.length" class="p-5 text-gray-400 text-center">Data Kosong
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="py-1 px-4 ">
                                <div class="flex flex-wrap">
                                    <template v-for="(link, key) in balita.links">
                                        <div v-if="link.url === null" :key="key"
                                            class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
                                            v-html="link.label" />
                                        <Link v-else :key="`link-${key}`"
                                            class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 active:border-blue-400 hover:bg-gray-200 border focus:border-indigo-500 rounded"
                                            :class="{ 'bg-white border-blue-500 text-black': link.active }"
                                            preserve-state preserve-scroll
                                            :href="link.url" v-html="link.label" />
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
