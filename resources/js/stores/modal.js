import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
const toast = useToast();

export const useModalStore = defineStore("modal", {
    state: () => ({
        type: null,
        title: null,
        text: null,
        link: null,
        count: 0,
    }),
    getters: {
        increments(state) {
            state.count++;
            console.log(state.count);
        },
    },
    actions: {
        increment(context) {
            //context.commit("increment");
            toast.success("incremented!");
        },
    },
});
