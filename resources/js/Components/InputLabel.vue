<script setup>
defineProps({
    value: {
        type: String,
    },
    icon: {
        type: String,
    },
});
</script>

<template>
    <label class="block text-sm font-medium text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-if="icon" class="text-red-600">{{ icon }}</span>
        <span v-else><slot /></span>
    </label>
</template>
