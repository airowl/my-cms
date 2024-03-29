import { defineStore } from "pinia";
import axios from "axios";
import { usePage, router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
const toast = useToast();

export const useMainStore = defineStore("main", {
    state: () => ({
        /* User */
        firstName: null,
        middleName: null,
        lastName: null,
        email: null,
        avatar: null,
        lastLogin: null,
        intro: null,

        /* Field focus with ctrl+k (to register only once) */
        isFieldFocusRegistered: false,

        /* Sample data (commonly used) */
        clients: [],
        history: [],
    }),
    getters: {
        getFullName(state) {
            if (!state.middleName == null) {
                return (
                    state.firstName +
                    " " +
                    state.middleName +
                    " " +
                    state.lastName
                );
            }
            return state.firstName + " " + state.lastName;
        },
    },
    actions: {
        resetUser(){
            this.firstName = null;
            this.middleName = null;
            this.lastName = null;
            this.email = null;
            this.avatar = null;
            this.lastLogin = null;
            this.intro = null;
        },
        setUser(payload) {
            if (payload.firstName) {
                this.firstName = payload.firstName;
            }
            if (payload.middleName) {
                this.middleName = payload.middleName;
            }
            if (payload.lastName) {
                this.lastName = payload.lastName;
            }
            if (payload.email) {
                this.email = payload.email;
            }
            if (payload.avatar) {
                this.avatar = payload.avatar;
            }
            if (payload.lastLogin) {
                this.lastLogin = payload.lastLogin;
            }
            if (payload.intro) {
                this.intro = payload.intro;
            }
        },

        getCurrentUser() {
            this.resetUser;
            const user = usePage().props.auth.user;
            //console.log(this.middleName);
            this.setUser(user);
        },

        updateCurrentUser(form) {
            router.patch("/profile", form);
            router.on("success", (event) => {
                console.log(
                    `Successfully made a visit to ${event.detail.page.url}`
                );
                this.getCurrentUser;
            });
            router.on("error", (errors) => {
                console.log("error");
                console.log(errors);
                const allErrors = errors.detail.errors;
                for (const el in allErrors) {
                    toast.error(allErrors[el]);
                }
            });
        },

        fetch(sampleDataKey) {
            axios
                .get(`data-sources/${sampleDataKey}.json`)
                .then((r) => {
                    if (r.data && r.data.data) {
                        this[sampleDataKey] = r.data.data;
                    }
                })
                .catch((error) => {
                    alert(error.message);
                });
        },
    },
});
