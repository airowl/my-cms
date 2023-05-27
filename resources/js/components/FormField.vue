<script setup>
import { computed, useSlots } from "vue";

defineProps({
    label: {
        type: String,
        default: null,
    },
    labelFor: {
        type: String,
        default: null,
    },
    help: {
        type: String,
        default: null,
    },
    isError: {
        type: Boolean,
        default: false,
    },
});

const slots = useSlots();

const wrapperClass = computed(() => {
    const base = [];
    const slotsLength = slots.default().length;

    if (slotsLength > 1) {
        base.push("grid grid-cols-1 gap-3");
    }

    if (slotsLength === 2) {
        base.push("md:grid-cols-2");
    }

    return base;
});
</script>

<template>
    <div class="mb-6 last:mb-0">
        <label v-if="label" :for="labelFor" class="block font-bold mb-2">{{
            label
        }}</label>
        <div :class="wrapperClass">
            <slot />
        </div>
        <div
            v-if="help"
            class="text-xs mt-1"
            :class="
                isError ? 'text-red-600' : 'text-gray-500 dark:text-slate-400'
            "
        >
            {{ help }}
        </div>
    </div>
</template>
