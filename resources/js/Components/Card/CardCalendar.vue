
<script setup>
import { ref } from 'vue';
import { Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/style.css';

const dates = ref('')
const attributes = ref([
    {
        highlight: true,
        dates: new Date(),
    },
    {
        // Boolean
        content: true,
        dates: [
            new Date(2018, 0, 1),
            new Date(2018, 0, 10),
            new Date(2018, 0, 22),
        ],
    },
    {
        // String
        content: 'red',
        dates: [
            new Date(2018, 0, 4),
            new Date(2018, 0, 10),
            new Date(2018, 0, 15),
        ],
    },
    {
        // Object
        content: {
            color: 'purple',
            style: {
                fontStyle: 'italic',
            },
        },
        dates: [
            new Date(2018, 0, 12),
            new Date(2018, 0, 26),
            new Date(2018, 0, 15),
        ],
    },
]);
</script>


<template>
    <div class="w-full h-full">
        <DatePicker v-model="dates" :attributes="attributes" :min-date="new Date()" expanded class="border shadow-lg" />
    </div>
</template>
