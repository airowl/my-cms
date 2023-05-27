<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import UserAvatar from "@/components/UserAvatar.vue";
import { useMainStore } from "@/stores/main";

const mainStore = useMainStore();

const fullName = computed(() => mainStore.getFullName);
const avatar = computed(() => mainStore.avatar);
</script>

<template>
    <UserAvatar :fullName="fullName" :avatar="avatar" api="initials">
        <slot />
    </UserAvatar>
</template>
