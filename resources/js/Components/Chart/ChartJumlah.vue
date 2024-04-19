<template>
    <Doughnut id="my-chart-id" :options="chartOptions" :data="chartData" class="w-[300px] sm:w-[10%] md:max-w-xs object-contain" />
</template>

<script>
import { Chart as ChartJS, ArcElement, Tooltip, Legend, RadialLinearScale } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
ChartJS.register(ArcElement, Tooltip, Legend, RadialLinearScale)


export default {
    name: 'ChartJumlah',
    components: { Doughnut },
    data() {
        return {
            title: 'Jumlah Imunisasi',
            chartData: {
                labels: [
                    'Orang Tua',
                    'Ibut Hamil',
                    'Balita',
                ],
                datasets: [
                    {
                        label: 'Data',
                        data: [
                            this.getRandomInt(),
                            this.getRandomInt(),
                            this.getRandomInt(),
                        ],
                        backgroundColor: [
                            '#ED9455',
                            '#41B06E',
                            '#DF2E38',
                        ],
                        borderColor: [
                            '#FFBB70',
                            '#8DECB4',
                            '#FF8080',
                        ],
                    },
                ]
            },
            chartOptions: {
                responsive: true,

                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Grafik Jumlah Balita dan Anak'
                    }
                },
            }
        }
    },
    methods: {
        getRandomInt() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        }
    },
}
</script>
