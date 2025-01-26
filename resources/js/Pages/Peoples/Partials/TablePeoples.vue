<script setup>
import { Link } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref } from "vue";

const props = defineProps({
    peoples: {
        type: Object,
        default: () => {},
    },
});
</script>

<template>
    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-200 px-4 py-2 text-left">#</th>
                <th class="border border-gray-200 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-200 px-4 py-2 text-left">
                    Gender
                </th>
                <th class="border border-gray-200 px-4 py-2 text-left">
                    Date Of Birth
                </th>

                <th class="border border-gray-200 px-4 py-2 text-left">
                    Phone
                </th>
                <th class="border border-gray-200 px-4 py-2 text-left">
                    Address
                </th>
                <th class="border border-gray-200 px-4 py-2 text-left">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(person, index) in peoples.data" :key="index">
                <td class="border border-gray-200 px-4 py-2">
                    {{ peoples.from + index }}
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ person.first_name }} {{ person.last_name }}
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ person.gender }}
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    {{
                        new Date(person.dob).toLocaleString("id-ID", {
                            year: "numeric",
                            month: "long",
                            day: "2-digit",
                        })
                    }}
                </td>

                <td class="border border-gray-200 px-4 py-2">
                    {{ person.phone }}
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ person.street }} - {{ person.state }}
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    <Link :href="route('peoples.show', person.id)">
                        <SecondaryButton> Detail </SecondaryButton>
                    </Link>
                </td>
            </tr>
            <tr v-if="peoples.data.length === 0">
                <td colspan="7" class="p-4 text-center text-gray-500">
                    No data found
                </td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-center gap-2 py-6">
        <Link
            v-for="(link, index) in peoples.links"
            :key="index"
            :href="link.url || ''"
            v-html="link.label"
            :class="[
                link.active ? 'bg-slate-600 text-white' : 'bg-slate-200',
                'p-2 min-w-7 text-center hover:bg-slate-400 rounded',
            ]"
        >
        </Link>
    </div>
</template>
