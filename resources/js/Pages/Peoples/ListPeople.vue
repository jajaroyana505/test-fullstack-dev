<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import TablePeoples from "./Partials/TablePeoples.vue";
import TextInput from "@/Components/TextInput.vue";
import Selection from "@/Components/Selection.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import axios from "axios";
import SuccessAlert from "@/Components/SuccessAlert.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Loading from "@/Components/Loading.vue";

const { props } = usePage();
const peoples = ref(props.peoples || []);
const isLoading = ref(false);

const filterOptions = [
    { label: "Female", value: "female" },
    { label: "Male", value: "male" },
    { label: "All", value: "" },
];

const form = useForm({
    key: props.query.key || "",
    filter: props.query.filter || "",
});

const fetch = async () => {
    try {
        isLoading.value = true;
        const response = await axios.get(route("api.fetch.peoples"));
        window.location.reload();
        peoples.value = response.data.peoples;
    } catch (error) {
        console.error("Error fetching gender data:", error);
        alert(error.response.data.message);
    } finally {
        isLoading.value = false;
    }
};
</script>

<template>
    <Loading :is-visible="isLoading"></Loading>
    <Head title="List Peoples" />

    <BaseLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <div class="flex justify-between">
                    List Peoples
                    <Link :href="route('peoples.create')">
                        <PrimaryButton> Create People </PrimaryButton>
                    </Link>
                </div>
            </h2>
        </template>

        <div class="pt-3" v-if="props.flash.success">
            <div
                class="mx-auto max-w-7xl bg-transparent space-y-1 sm:px-6 lg:px-8"
            >
                <SuccessAlert :message="props.flash.success"></SuccessAlert>
            </div>
        </div>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form
                            @submit.prevent="form.get(route('peoples.index'))"
                            class="mt-6 flex gap-3"
                        >
                            <TextInput
                                id="search"
                                type="text"
                                class="w-full"
                                v-model="form.key"
                                placeholder="Search"
                            />
                            <Selection
                                default="All"
                                v-model="form.filter"
                                :options="filterOptions"
                                class="min-w-fit rounded-l-none"
                            />
                            <PrimaryButton class="h-full">
                                Search
                            </PrimaryButton>
                        </form>
                    </div>

                    <div class="p-6">
                        <TablePeoples :peoples="peoples" />
                    </div>
                </div>

                <div
                    v-if="props.peoples.data.length == 0"
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-center">
                        <p class="my-5">Fetch Data Dari API Public</p>
                        <SecondaryButton @click="fetch">
                            Fetch Data Dari Api
                        </SecondaryButton>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
