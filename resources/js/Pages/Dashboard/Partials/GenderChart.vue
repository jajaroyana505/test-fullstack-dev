<script setup>
import axios from "axios";
import { Chart } from "highcharts-vue";
import { ref, computed, onMounted } from "vue";

const dataGender = ref([]);

const getGender = async () => {
    try {
        const response = await axios.get(route("api.chart.gender"));
        dataGender.value = response.data;
    } catch (error) {
        console.error("Error fetching gender data:", error);
    }
};

onMounted(() => {
    getGender();
});

const totalSum = computed(() =>
    dataGender.value.reduce((sum, item) => sum + item.total, 0)
);

const formattedData = computed(() =>
    dataGender.value.map((item) => ({
        name: item.gender,
        y: (item.total / totalSum.value) * 100,
    }))
);

const chartOptions = computed(() => ({
    chart: {
        type: "pie",
    },
    title: {
        text: "Persentase Gender",
    },
    tooltip: {
        valueSuffix: "%",
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: "pointer",
            dataLabels: [
                {
                    enabled: true,
                    distance: 20,
                },
                {
                    enabled: true,
                    distance: -40,
                    format: "{point.percentage:.1f}%",
                    style: {
                        fontSize: "1.2em",
                        textOutline: "none",
                        opacity: 0.7,
                    },
                    filter: {
                        operator: ">",
                        property: "percentage",
                        value: 10,
                    },
                },
            ],
        },
    },
    series: [
        {
            name: "Percentage",
            colorByPoint: true,
            data: formattedData.value,
        },
    ],
}));
</script>

<template>
    <Chart :options="chartOptions" />
</template>
