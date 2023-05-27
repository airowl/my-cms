import { defineStore } from "pinia";
import axios from "axios";
import { usePage, router } from "@inertiajs/vue3";

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
        getFullName(state){
            if (!state.middleName == null) {
                return state.firstName + ' ' + state.middleName + ' ' + state.lastName;
            }
            return state.firstName + ' ' + state.lastName;
        }
    },
    actions: {
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
            const user = usePage().props.auth.user;
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
            });
        },

        updatePassCurrentUser(form) {
            router.put("/password", form);
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
