import { defineStore } from "pinia";
import axios from "axios";
import { usePage, router } from "@inertiajs/vue3";

export const useMainStore = defineStore("main", {
    state: () => ({
        /* User */
        userName: null,
        userEmail: null,
        userAvatar: null,

        /* Field focus with ctrl+k (to register only once) */
        isFieldFocusRegistered: false,

        /* Sample data (commonly used) */
        clients: [],
        history: [],
    }),
    actions: {
        setUser(payload) {
            if (payload.name) {
                this.userName = payload.name;
            }
            if (payload.email) {
                this.userEmail = payload.email;
            }
            if (payload.avatar) {
                this.userAvatar = payload.avatar;
            }
        },

        getCurrentUser() {
            const user = usePage().props.auth.user;
            this.setUser({
                name: user.name,
                email: user.email,
                avatar: user.avatar,
            });
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
