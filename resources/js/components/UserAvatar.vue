<script setup>
import { computed } from "vue";

const props = defineProps({
    fullName: {
        type: String,
        required: true,
    },
    avatar: {
        type: String,
        default: null,
    },
    api: {
        type: String,
        default: "avataaars",
    },
});

const avatar = computed(
    () =>
        props.avatar ??
        `https://avatars.dicebear.com/api/${props.api}/${props.fullName.replace(
            /[^a-z0-9]+/i,
            "-"
        )}.svg`
);

const fullName = computed(() => props.fullName);
</script>

<template>
    <div>
        <img
            :src="avatar"
            :alt="fullName"
            class="rounded-full block w-32 object-contain max-w-full bg-gray-100 dark:bg-slate-800"
        />
        <slot />
    </div>
</template>
