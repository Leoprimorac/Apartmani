import Vue from 'vue';
import Vuex from 'vuex';
import * as api from "./api";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
    },
    getters: {
        loggedUser: state => {
            return state.user;
        },
        isAdmin: state => {
            if (state.user != null) {
                return state.user.admin === 1;
            }
            return false;
        },
    },
    mutations: {
        getUser(state) {
            swatApi.get(api.logged).
            then( response => {
                if (response.status === 200) {
                    state.user = response.data;
                }
            })
        },
    },
    actions: {
        getUser(context) {
            context.commit('getUser');
        },
    }
});
