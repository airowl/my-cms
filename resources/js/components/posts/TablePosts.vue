<script setup>
import { computed, reactive, ref, watch } from "vue";
import { useMainStore } from "@/stores/main";
import { mdiEye, mdiTrashCan } from "@mdi/js";
import CardBoxModal from "@/components/CardBoxModal.vue";
import CardBox from "@/components/CardBox.vue";
import TableCheckboxCell from "@/components/TableCheckboxCell.vue";
import BaseLevel from "@/components/BaseLevel.vue";
import BaseButtons from "@/components/BaseButtons.vue";
import BaseButton from "@/components/BaseButton.vue";
import UserAvatar from "@/components/UserAvatar.vue";
import { router, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import {
    mdiAccount,
    mdiMail,
    mdiAsterisk,
    mdiFormTextboxPassword,
    mdiGithub,
} from "@mdi/js";

const props = defineProps({
    checkable: Boolean,
    posts: Array,
    errors: {
        type: Object,
        default: null,
    },
});

const toast = useToast();

const mainStore = useMainStore();

const items = computed(() => props.posts);

const isModalActive = ref(false);

const isModalDangerActive = ref(false);

const perPage = ref(5);

const currentPage = ref(0);

const checkedRows = ref([]);

const itemsPaginated = computed(() =>
    items.value.slice(
        perPage.value * currentPage.value,
        perPage.value * (currentPage.value + 1)
    )
);

const numPages = computed(() => Math.ceil(items.value.length / perPage.value));

const currentPageHuman = computed(() => currentPage.value + 1);

const pagesList = computed(() => {
    const pagesList = [];

    for (let i = 0; i < numPages.value; i++) {
        pagesList.push(i);
    }

    return pagesList;
});

const remove = (arr, cb) => {
    const newArr = [];

    arr.forEach((item) => {
        if (!cb(item)) {
            newArr.push(item);
        }
    });

    return newArr;
};

const checked = (isChecked, item) => {
    if (isChecked) {
        checkedRows.value.push(item);
    } else {
        checkedRows.value = remove(
            checkedRows.value,
            (row) => row.id === item.id
        );
    }
};

const translateToDelete = reactive({
    id: null,
    translation: null,
    languageCode: null,
});
const openModalDelete = (item) => {
    isModalDangerActive.value = true;
    translateToDelete.id = item.id;
    translateToDelete.translation = item.translation;
    translateToDelete.languageCode = item.languageCode;
};
const confirmDelete = () => {
    router.delete(`/translations/${translateToDelete.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Successfully delete");
        },
        onError: () => toast.error("Error deleting"),
    });
};

const translateToUpdate = useForm({
    id: null,
    translation: null,
    languageCode: null,
});
const openModalUpdate = (item) => {
    isModalActive.value = true;
    translateToUpdate.id = item.id;
    translateToUpdate.translation = item.translation;
    translateToUpdate.languageCode = item.languageCode;
};
const confirmUpdate = () => {
    translateToUpdate.put("/translations", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Successfully update user profile");
        },
        onError: () => toast.error("Check inputs"),
    });
};
</script>

<template>
    <CardBoxModal
        v-model="isModalActive"
        title="Edit translation"
        @confirm="confirmUpdate"
        has-cancel
    >
        <FormField label="Language">
            <p class="uppercase">
                {{ translateToUpdate.languageCode }}
            </p>
        </FormField>
        <FormField
            label="Translation"
            :help="errors.translation ?? 'Required. Translation'"
            :isError="errors.translation != null"
        >
            <FormControl
                v-model="translateToUpdate.translation"
                :icon="mdiMail"
                type="text"
                name="translation"
                required
            />
        </FormField>
    </CardBoxModal>

    <CardBoxModal
        v-model="isModalDangerActive"
        title="Please confirm"
        button="danger"
        has-cancel
        @confirm="confirmDelete"
    >
        <p>Sei sicure di voler eliminare?</p>
        <p>
            <b class="uppercase">
                {{ translateToDelete.languageCode }}
            </b>
            -
            {{ translateToDelete.translation }}
        </p>
    </CardBoxModal>

    <div v-if="checkedRows.length" class="p-3 bg-gray-100/50 dark:bg-slate-800">
        <span
            v-for="checkedRow in checkedRows"
            :key="checkedRow.id"
            class="inline-block px-2 py-1 rounded-sm mr-2 text-sm bg-gray-100 dark:bg-slate-700"
        >
            {{ checkedRow.name }}
        </span>
    </div>

    <table>
        <thead>
            <tr>
                <th v-if="checkable" />
                <th />
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>summury</th>
                <th>Published</th>
                <th>PublishedAt</th>
                <th />
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in itemsPaginated" :key="item.id">
                <TableCheckboxCell
                    v-if="checkable"
                    @checked="checked($event, item)"
                />
                <td class="border-b-0 lg:w-6 before:hidden">
                    <!--<UserAvatar
                        :username="item.name"
                        class="w-24 h-24 mx-auto lg:w-6 lg:h-6"
                    />-->
                </td>
                <td data-label="id">
                    {{ item.id }}
                </td>
                <td data-label="image" class="uppercase">
                    {{ item.languageCode }}
                </td>
                <td data-label="title">
                    {{ item.title }}
                </td>
                <td data-label="summury">
                    {{ item.summery }}
                </td>
                <!--<td data-label="Progress" class="lg:w-32">
                    <progress
                        class="flex w-2/5 self-center lg:w-full"
                        max="100"
                        :value="item.progress"
                    >
                        {{ item.progress }}
                    </progress>
                </td>-->
                <td data-label="created" class="lg:w-1 whitespace-nowrap">

                    <small
                        class="text-gray-500 dark:text-slate-400"
                        :title="item.published"
                        v-if="item.published == 0"
                        >Draft</small
                    >
                    <small
                        class="text-gray-500 dark:text-slate-400"
                        :title="item.published"
                        v-else
                        >Published</small
                    >
                </td>
                <td data-label="updated" class="lg:w-1 whitespace-nowrap">
                    <small
                        class="text-gray-500 dark:text-slate-400"
                        :title="item.updated_at"
                        >{{ item.updated_at }}</small
                    >
                </td>
                <td class="before:hidden lg:w-1 whitespace-nowrap">
                    <BaseButtons type="justify-start lg:justify-end" no-wrap>
                        <BaseButton
                            color="info"
                            :icon="mdiEye"
                            small
                            @click="openModalUpdate(item)"
                        />
                        <BaseButton
                            color="danger"
                            :icon="mdiTrashCan"
                            small
                            @click="openModalDelete(item)"
                        />
                    </BaseButtons>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
        <BaseLevel>
            <BaseButtons>
                <BaseButton
                    v-for="page in pagesList"
                    :key="page"
                    :active="page === currentPage"
                    :label="page + 1"
                    :color="page === currentPage ? 'lightDark' : 'whiteDark'"
                    small
                    @click="currentPage = page"
                />
            </BaseButtons>
            <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
        </BaseLevel>
    </div>
</template>
