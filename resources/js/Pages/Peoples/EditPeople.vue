<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

import { useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Selection from "@/Components/Selection.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const genderOptions = [
    { label: "Female", value: "female" },
    { label: "Male", value: "male" },
];

const { props } = usePage();
const people = props.people;

const form = useForm({
    first_name: people.first_name,
    last_name: people.last_name,
    dob: people.dob,
    gender: people.gender,
    street: people.street,
    state: people.state,
    city: people.city,
    country: people.country,
    postal_code: people.postal_code,
    phone: people.phone,
    email: people.email,
    filter: "",
});
</script>

<template>
    <Head title="Crete Peoples" />

    <BaseLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Peoples
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <section>
                            <form
                                @submit.prevent="
                                    form.patch(
                                        route('peoples.update', props.people.id)
                                    )
                                "
                                class="mt-6 space-y-6"
                            >
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
                                                    id="first_name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.first_name"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.first_name
                                                    "
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="last_name"
                                                    value="Last Name"
                                                />

                                                <TextInput
                                                    id="last_name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.last_name"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.last_name
                                                    "
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="gender"
                                                    value="Gender"
                                                />
                                                <Selection
                                                    class="mt-1"
                                                    v-model="form.gender"
                                                    :default="'Select'"
                                                    :options="genderOptions"
                                                >
                                                </Selection>
                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.gender
                                                    "
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="dob"
                                                    value="Date Of Birth"
                                                />

                                                <TextInput
                                                    id="dob"
                                                    type="date"
                                                    class="mt-1 block w-full"
                                                    v-model="form.dob"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.dob"
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="phone"
                                                    value="Phone Number"
                                                />

                                                <TextInput
                                                    id="phone"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.phone"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.phone"
                                                />
                                            </div>
                                        </div>

                                        <div class="w-full">
                                            <InputLabel
                                                for="email"
                                                value="Email Address"
                                            />

                                            <TextInput
                                                id="email"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.email"
                                                required
                                            />

                                            <InputError
                                                class="mt-2"
                                                :message="form.errors.email"
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
                                                id="street"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.street"
                                                required
                                            />

                                            <InputError
                                                class="mt-2"
                                                :message="form.errors.street"
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
                                                    id="city"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.city"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.city"
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="state"
                                                    value="State"
                                                />

                                                <TextInput
                                                    id="state"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.state"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.state"
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="country"
                                                    value="Country"
                                                />

                                                <TextInput
                                                    id="country"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.country"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.country
                                                    "
                                                />
                                            </div>
                                            <div class="w-full">
                                                <InputLabel
                                                    for="postal_code"
                                                    value="Postal Code"
                                                />

                                                <TextInput
                                                    id="postal_code"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.postal_code"
                                                    required
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.postal_code
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton>Save</PrimaryButton>
                                    <Link
                                        :href="route('peoples.show', people.id)"
                                    >
                                        <SecondaryButton
                                            >Cancel</SecondaryButton
                                        >
                                    </Link>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
