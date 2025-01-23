<script setup>
import { onMounted, defineProps } from "vue";

defineProps({
    message: {
        type: String,
        default: "This is message alert",
    },
});

onMounted(() => {
    setInterval(() => {
        document.getElementById("alert-success").classList.add("hidden");
    }, 3000);
});
</script>

<template>
    <div
        id="alert-success"
        class="bg-green-100 border shadow border-green-300 text-green-700 px-4 py-3 rounded relative"
        role="alert"
    >
        <strong class="font-bold">Success! </strong>
        <span class="block sm:inline">{{ message }}</span>
    </div>
</template>
