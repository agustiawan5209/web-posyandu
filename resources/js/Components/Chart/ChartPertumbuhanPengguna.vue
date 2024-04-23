<template>
    <div class="container border p-4" v-if="loaded">
        <div class="flex">
            <select name="tahun" id="tahun" v-model="tahun"
                class="w-[30%] border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm">
                <option v-for="year in availableYears()" :key="year" :value="year">{{ year }}</option>
            </select>
        </div>
        <div class="relative" v-if="selectChart">
            <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
        </div>
    </div>
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name: 'BarChart',
    components: { Bar },
    data: () => ({
        loaded: false,
        chartData: null,
        chartOptions: {
            responsive: true,
            plugins: {
                // legend:{
                //     position:'right'
                // },
                title: {
                    display: true,
                    text: 'Pertumbuhan Pengguna '
                }
            }
        },
        tahun: new Date().getFullYear(),
        selectChart: false,
    }),
     mounted() {
        this.getBarChart()
    },
    watch:{
        tahun(newA,oldA){
            this.selectChart = false;
            this.selectChart = true;
            this.getBarChart();
        }
    },
    methods: {
        getRandomInt() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        },
       async getBarChart() {

            axios.get(route('api.pengguna.jumlah', { tahun: this.tahun }))
                .then((response) => {
                    if (response.status == 200) {
                        this.chartData = {
                            labels: response.data.label,
                            datasets: [{
                                label: 'Total Data',
                                data: response.data.data,
                                backgroundColor: [
                                    '#FFBB70',
                                    '#97E7E1',
                                    '#FA7070',
                                    '#C6EBC5',
                                    '#6AD4DD',
                                    '#A5DD9B',
                                    '#F6F193',
                                    '#CDFADB',
                                    '#DCFFB7',
                                    '#80BCBD',
                                    '#92C7CF',
                                    '#A1EEBD',
                                ],
                                borderColor: '#00A9FF',
                                borderWidth: 1,
                            }]
                        }
                        this.loaded = true;
                        this.selectChart = true;
                    } else {
                        console.error('Error loading data:', response.status, response.statusText)
                    }
                })
                .catch((error) => {
                    console.error('Error loading data:', error)
                })
        },
        availableYears() {
            const currentYear = new Date().getFullYear();
            const years = [];
            for (let i = currentYear - 5; i <= currentYear + 1; i++) {
                years.push(i);
            }
            return years;
        },
    }
}
</script>
