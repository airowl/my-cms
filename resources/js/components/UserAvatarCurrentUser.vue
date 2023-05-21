<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import UserAvatar from "@/components/UserAvatar.vue";

const userName = computed(() => usePage().props.auth.user.name);
const avatar = computed(() => usePage().props.auth.user.avatar);
</script>

<template>
    <UserAvatar :username="userName" :avatar="avatar" api="initials">
        <slot />
    </UserAvatar>
</template>
