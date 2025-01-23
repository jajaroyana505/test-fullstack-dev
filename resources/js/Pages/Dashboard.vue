<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/BaseLayout.vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";
import { ref } from "vue";

const dataPieChartGender = ref([]);
const dataColumnChartDob = ref([]);
const filter = ref({ from: null, to: null });

const getDob = () => {
    axios
        .get(route("api.chart.dob"), {
            params: filter.value,
        })
        .then((response) => {
            dataColumnChartDob.value = response.data.dob;
            filter.value.from = response.data.range.earliest;
            filter.value.to = response.data.range.latest;
        })
        .catch((error) => {
            alert(error.response.data.message);
            dataColumnChartDob.value = [];
        });
};
const getGender = () => {
    axios.get(route("api.chart.gender")).then((response) => {
        dataPieChartGender.value = response.data;
    });
};

const subtitle = (from, to) => {
    return "Tahun : " + from.split("-")[0] + " - " + to.split("-")[0];
};

const changeFilter = () => {
    getDob();
};

getDob();
getGender();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-5">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 grid grid-cols-2 gap-2">
                            <div class="flex items-center gap-4 w-full">
                                <InputLabel value="From :"></InputLabel>
                                <TextInput
                                    v-model="filter.from"
                                    type="date"
                                    @change="changeFilter"
                                >
                                </TextInput>
                            </div>
                            <div class="flex items-center gap-4 w-full">
                                <InputLabel value="to :"></InputLabel>
                                <TextInput
                                    v-model="filter.to"
                                    type="date"
                                    @change="changeFilter"
                                >
                                </TextInput>
                            </div>
                        </div>
                        <ColumnChart
                            :raw-data="dataColumnChartDob"
                            title="Jumlah Kelahiran Bedasarkan Bulan"
                            subtitle=""
                            class="p-6"
                        ></ColumnChart>
                    </div>
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <PieChart
                            title="Persentase Berdasarkan Jenis kelamin"
                            :data-chart="dataPieChartGender"
                            class="p-6"
                        ></PieChart>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
