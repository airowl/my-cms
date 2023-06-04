<script setup>
import {
    mdiMonitorCellphone,
    mdiTableBorder,
    mdiTableOff,
    mdiGithub,
} from "@mdi/js";
import { computed, reactive, ref, watch } from "vue";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import TableTranslations from "@/components/translations/TableTranslations.vue";
import CardBox from "@/components/CardBox.vue";
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";
import CardBoxModal from "@/components/CardBoxModal.vue";
import { useForm } from "@inertiajs/vue3";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import { useToast } from "vue-toastification";

const props = defineProps({
    listLanguages: Array,
    errors: {
        type: Object,
        default: null,
    },
    languages: Array,
});

const toast = useToast();

const cleanLanguages = props.languages.map((e) => e.languageCode);

const isModalCreateActive = ref(false);

const createForm = useForm({
    languageCode: null,
    translation: null,
});

const confirmCreate = () => {
    console.log(createForm);
    createForm.post("/translations", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Successfully Create");
        },
        onError: () => toast.error("Error Creating"),
    });
};
</script>

<template>
    <LayoutAuthenticated>
        <CardBoxModal
            v-model="isModalCreateActive"
            title="Create translation"
            @confirm="confirmCreate"
            has-cancel
        >
            <FormField
                label="Language"
                :help="errors.languageCode ?? 'Required. Language'"
                :isError="errors.languageCode != null"
            >
                <FormControl
                    v-model="createForm.languageCode"
                    name="language"
                    type="select"
                    :options="cleanLanguages"
                    required
                />
            </FormField>
            <FormField
                label="Translation"
                :help="errors.translation ?? 'Required. Tranlation'"
                :isError="errors.translation != null"
            >
                <FormControl
                    v-model="createForm.translation"
                    type="text"
                    name="translation"
                    required
                />
            </FormField>
        </CardBoxModal>
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiTableBorder"
                title="Translations"
                main
            >
                <BaseButton
                    :icon="mdiGithub"
                    label="Star on GitHub"
                    color="contrast"
                    rounded-full
                    small
                    @click="isModalCreateActive = true"
                />
            </SectionTitleLineWithButton>
            <NotificationBar color="info" :icon="mdiMonitorCellphone">
                <b>Responsive table.</b> Collapses on mobile
            </NotificationBar>

            <CardBox class="mb-6" has-table>
                <TableTranslations
                    :listLanguages="listLanguages"
                    :languages="languages"
                    :errors="errors"
                />
            </CardBox>

            <!--<SectionTitleLineWithButton
                :icon="mdiTableOff"
                title="Empty variation"
            />

            <NotificationBar color="danger" :icon="mdiTableOff">
                <b>Empty table.</b> When there's nothing to show
            </NotificationBar>

            <CardBox>
                <CardBoxComponentEmpty />
            </CardBox>-->
        </SectionMain>
    </LayoutAuthenticated>
</template>
