<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

import { useForm, usePage } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import DangerButton from "@/Components/DangerButton.vue";

const { props } = usePage();
const form = useForm({});
const people = props.people;
</script>

<template>
    <Head title="Crete Peoples" />

    <BaseLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Detail Peoples
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <section>
                            <div class="mt-6 space-y-6">
                                <div
                                    class="grid lg:grid-cols-2 grid-cols-1 gap-20"
                                >
                                    <div class="grid grid-flow-row gap-5">
                                        <h2
                                            class="text-lg font-medium text-gray-700"
                                        >
                                            Profile Information
                                        </h2>
                                        <div
                                            class="grid lg:grid-cols-2 grid-cols-1 gap-5"
                                        >
                                            <div class="w-full">
                                                <InputLabel
                                                    for="first_name"
                                                    value="First Name"
                                                />
                                                <TextInput
                                                    disabled
                                                    id="first_name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="people.first_name"
                                                    required
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="last_name"
                                                    value="Last Name"
                                                />

                                                <TextInput
                                                    disabled
                                                    id="last_name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="people.last_name"
                                                    required
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="gender"
                                                    value="Gender"
                                                />
                                                <TextInput
                                                    disabled
                                                    v-model="people.gender"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                >
                                                </TextInput>
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="dob"
                                                    value="Date Of Birth"
                                                />

                                                <TextInput
                                                    disabled
                                                    id="dob"
                                                    type="date"
                                                    class="mt-1 block w-full"
                                                    v-model="people.dob"
                                                    required
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="phone"
                                                    value="Phone Number"
                                                />

                                                <TextInput
                                                    disabled
                                                    id="phone"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="people.phone"
                                                    required
                                                />
                                            </div>
                                        </div>

                                        <div class="w-full">
                                            <InputLabel
                                                for="email"
                                                value="Email Address"
                                            />

                                            <TextInput
                                                disabled
                                                id="email"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="people.email"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="grid align-top self-start grid-flow-row gap-5"
                                    >
                                        <h2
                                            class="text-lg font-medium text-gray-700"
                                        >
                                            Address Information
                                        </h2>
                                        <div class="w-full">
                                            <InputLabel
                                                for="street"
                                                value="Street"
                                            />

                                            <TextInput
                                                disabled
                                                id="street"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="people.street"
                                                required
                                            />
                                        </div>
                                        <div
                                            class="grid lg:grid-cols-2 grid-cols-1 gap-5"
                                        >
                                            <div class="w-full">
                                                <InputLabel
                                                    for="city"
                                                    value="City"
                                                />
                                                <TextInput
                                                    disabled
                                                    id="city"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="people.city"
                                                    required
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="state"
                                                    value="State"
                                                />

                                                <TextInput
                                                    disabled
                                                    id="state"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="people.state"
                                                    required
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="country"
                                                    value="Country"
                                                />

                                                <TextInput
                                                    disabled
                                                    id="country"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="people.country"
                                                    required
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="postal_code"
                                                    value="Postal Code"
                                                />

                                                <TextInput
                                                    disabled
                                                    id="postal_code"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="people.postal_code"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-between gap-4"
                                >
                                    <Link
                                        :href="route('peoples.edit', people.id)"
                                    >
                                        <PrimaryButton> Edit </PrimaryButton>
                                    </Link>
                                    <form
                                        @submit.prevent="
                                            form.delete(
                                                route(
                                                    'peoples.destroy',
                                                    people.id
                                                )
                                            )
                                        "
                                    >
                                        <DangerButton>Delete</DangerButton>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
