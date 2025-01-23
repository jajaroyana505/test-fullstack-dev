<script setup>
import { computed, ref, onMounted } from "vue";
import { Chart } from "highcharts-vue";

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

const aggregatedData = computed(() => {
    const years = [];
    dataDob.value.forEach((item) => {
        let year = item.dob.split("-")[0];
        const existing = years.find((entry) => entry.year === year);
        if (existing) {
            existing.total += 1;
        } else {
            years.push({ year, total: 1 });
        }
    });
    return years;
});

const formattedData = computed(() =>
    aggregatedData.value.map((item) => ({
        name: item.year,
        y: item.total,
    }))
);

const chartOptions = computed(() => ({
    chart: {
        type: "spline",
        scrollablePlotArea: {
            minWidth: 600, // Tentukan lebar minimum untuk membuat scroll area
        },
    },
    title: {
        text: "Tingkat Kelahiran",
    },
    xAxis: {
        type: "category",
        title: {
            text: "Tahun",
        },

        scrollbar: {
            enabled: true,
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
            name: "Tahun",
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
    <div>
        <Chart :options="chartOptions" />
    </div>
</template>
