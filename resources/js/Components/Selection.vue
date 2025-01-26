<script setup>
const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    default: {
        type: String,
        default: "",
    },
    options: {
        type: Array,
        required: true,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div>
        <select
            :disabled="disabled"
            v-model="model"
            :class="[
                disabled ? 'bg-slate-100 disabled' : '',
                'rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 block w-full',
            ]"
        >
            <option :value="''" disabled>{{ default }}</option>
            <option
                v-for="(option, index) in options"
                :key="index"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>
    </div>
</template>
