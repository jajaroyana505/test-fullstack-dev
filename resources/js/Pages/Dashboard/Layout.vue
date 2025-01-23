<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head } from "@inertiajs/vue3";
import GenderChart from "./Partials/GenderChart.vue";
import BulanKelahiranChart from "./Partials/BulanKelahiranChart.vue";
import AngkaKelahiranChart from "./Partials/AngkaKelahiranChart.vue";
</script>

<template>
    <Head title="Dashboard" />

    <BaseLayout>
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
                        <div class="p-6">
                            <BulanKelahiranChart></BulanKelahiranChart>
                        </div>
                    </div>
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6">
                            <GenderChart class="p-6"></GenderChart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <AngkaKelahiranChart></AngkaKelahiranChart>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
