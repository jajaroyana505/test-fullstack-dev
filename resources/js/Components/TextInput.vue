<script setup>
import { onMounted, ref } from "vue";

const model = defineModel({
    type: String,
    required: true,
});
defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        :class="[
            disabled ? 'text-slate-600 disabled' : '',
            'rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
        ]"
        :disabled="disabled"
        v-model="model"
        ref="input"
    />
</template>
