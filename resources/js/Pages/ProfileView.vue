<script setup>
import { reactive } from "vue";
import { useMainStore } from "@/stores/main";
import {
    mdiAccount,
    mdiMail,
    mdiAsterisk,
    mdiFormTextboxPassword,
    mdiGithub,
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import CardBox from "@/components/CardBox.vue";
import BaseDivider from "@/components/BaseDivider.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import FormFilePicker from "@/components/FormFilePicker.vue";
import BaseButton from "@/components/BaseButton.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import UserCard from "@/components/UserCard.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import { router, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const props = defineProps({
    errors: {
        type: Object,
        default: null,
    },
    auth: {
        type: Object,
        default: null,
    },
});

const toast = useToast();
const mainStore = useMainStore();

const profileForm = useForm({
    firstName: mainStore.firstName,
    middleName: mainStore.middleName,
    lastName: mainStore.lastName,
    email: mainStore.email,
    avatar: null,
});

const passwordForm = useForm({
    password_current: "",
    password: "",
    password_confirmation: "",
});

const submitProfile = () => {
    console.log(profileForm);
    profileForm.post("/profile", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Successfully update user profile");
            mainStore.getCurrentUser();
        },
        onError: () => toast.error("Check inputs"),
    });
};

const submitPass = () => {
    passwordForm.put("/password", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Successfully update user password");
            mainStore.getCurrentUser();
        },
        onError: () => toast.error("Check inputs"),
    });
};
</script>

<template>
    <LayoutAuthenticated>
        <SectionMain>
            <!--<SectionTitleLineWithButton :icon="mdiAccount" title="Profile" main>
                <BaseButton
                    href="https://github.com/justboil/admin-one-vue-tailwind"
                    target="_blank"
                    :icon="mdiGithub"
                    label="Star on GitHub"
                    color="contrast"
                    rounded-full
                    small
                />
            </SectionTitleLineWithButton>-->

            <UserCard class="mb-6" />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <CardBox
                    is-form
                    @submit.prevent="submitProfile"
                    enctype="multipart/form-data"
                >
                    <FormField label="Avatar" help="Max 500kb">
                        <FormFilePicker
                            label="Upload"
                            v-model:modelValue="profileForm.avatar"
                        />
                    </FormField>

                    <FormField
                        label="Name"
                        :help="errors.firstName ?? 'Required. Your name'"
                        :isError="errors.firstName != null"
                    >
                        <FormControl
                            v-model="profileForm.firstName"
                            :icon="mdiAccount"
                            name="firtName"
                            required
                            autocomplete="firtName"
                        />
                    </FormField>
                    <FormField
                        label="Middle Name"
                        :help="errors.middleName ?? 'Required. Your middlename'"
                        :isError="errors.middleName != null"
                    >
                        <FormControl
                            v-model="profileForm.middleName"
                            :icon="mdiAccount"
                            name="middleName"
                            required
                            autocomplete="middleName"
                        />
                    </FormField>
                    <FormField
                        label="Surname"
                        :help="errors.lastName ?? 'Required. Your lastname'"
                        :isError="errors.lastName != null"
                    >
                        <FormControl
                            v-model="profileForm.lastName"
                            :icon="mdiAccount"
                            name="lastName"
                            required
                            autocomplete="lastName"
                        />
                    </FormField>
                    <FormField
                        label="E-mail"
                        :help="errors.email ?? 'Required. Your e.mail'"
                        :isError="errors.email != null"
                    >
                        <FormControl
                            v-model="profileForm.email"
                            :icon="mdiMail"
                            type="email"
                            name="email"
                            required
                            autocomplete="email"
                        />
                    </FormField>

                    <template #footer>
                        <BaseButtons>
                            <BaseButton
                                color="info"
                                type="submit"
                                label="Submit"
                            />
                            <!--<BaseButton color="info" label="Options" outline />-->
                        </BaseButtons>
                    </template>
                </CardBox>

                <CardBox is-form @submit.prevent="submitPass">
                    <FormField
                        label="Current password"
                        :help="
                            errors.password_current ??
                            'Required. Your current password'
                        "
                        :isError="errors.password_current != null"
                    >
                        <FormControl
                            v-model="passwordForm.password_current"
                            :icon="mdiAsterisk"
                            name="password_current"
                            type="password"
                            required
                            autocomplete="current-password"
                        />
                    </FormField>

                    <BaseDivider />

                    <FormField
                        label="New password"
                        :help="errors.password ?? 'Required. New password'"
                        :isError="errors.password != null"
                    >
                        <FormControl
                            v-model="passwordForm.password"
                            :icon="mdiFormTextboxPassword"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                        />
                    </FormField>

                    <FormField
                        label="Confirm password"
                        :help="
                            errors.password_confirmation ??
                            'Required. New password one more time'
                        "
                        :isError="errors.password_confirmation != null"
                    >
                        <FormControl
                            v-model="passwordForm.password_confirmation"
                            :icon="mdiFormTextboxPassword"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                        />
                    </FormField>

                    <template #footer>
                        <BaseButtons>
                            <BaseButton
                                type="submit"
                                color="info"
                                label="Submit"
                            />
                            <BaseButton color="info" label="Options" outline />
                        </BaseButtons>
                    </template>
                </CardBox>
            </div>
        </SectionMain>
    </LayoutAuthenticated>
</template>
