<script setup>
import { computed, ref, onMounted } from "vue";
import { Chart } from "highcharts-vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const dataDob = ref([]);
const filter = ref({ from: "", to: "" });

const getDob = async () => {
    try {
        const response = await axios.get(route("api.chart.dob"), {
            params: filter.value,
        });
        dataDob.value = response.data.dob;
        filter.value.from = response.data.range.earliest;
        filter.value.to = response.data.range.latest;
    } catch (error) {
        console.error("Error fetching gender data:", error);
        alert(error.response.data.message);
        dataDob.value = [];
    }
};

let timeout = null;
const changeFilter = () => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        getDob();
    }, 1000);
};

const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

const aggregatedData = computed(() => {
    const result = months.map((month) => ({ month, total: 0 }));

    dataDob.value.forEach((item) => {
        const monthIndex = parseInt(item.dob.split("-")[1], 10) - 1;
        result[monthIndex].total += 1;
    });
    return result;
});

const formattedData = computed(() =>
    aggregatedData.value.map((item) => ({
        name: item.month,
        y: item.total,
    }))
);

const chartOptions = computed(() => ({
    chart: {
        type: "column",
    },
    title: {
        text: "Jumlah Kelahiran Bedasarkan Bulan",
    },
    xAxis: {
        type: "category",
        title: {
            text: "Bulan Kelahiran",
        },
    },
    yAxis: {
        title: {
            text: "Jumlah",
        },
    },
    tooltip: {
        pointFormat: "total  <b>{point.y}</b> ",
    },
    series: [
        {
            name: "Bulan",
            colorByPoint: true,
            data: formattedData.value,
        },
    ],
}));

onMounted(() => {
    getDob();
});
</script>

<template>
    <div class="p-6 grid grid-cols-2 gap-2">
        <div class="flex items-center gap-4 w-full">
            <InputLabel value="From :"></InputLabel>
            <TextInput v-model="filter.from" type="date" @change="changeFilter">
            </TextInput>
        </div>
        <div class="flex items-center gap-4 w-full">
            <InputLabel value="to :"></InputLabel>
            <TextInput v-model="filter.to" type="date" @change="changeFilter">
            </TextInput>
        </div>
    </div>
    <Chart :options="chartOptions" />
</template>
