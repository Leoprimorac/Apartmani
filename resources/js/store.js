import Vue from 'vue';
import Vuex from 'vuex';
import * as api from "./api";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        apartment: {}

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
        name(state) {
            return state.name
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
        SET_APARTMENT(state, apartment) {
            // merge data with previous state
            state.apartment = Object.assign({}, state.apartment, apartment)
          }

    },
    actions: {
        getUser(context) {
            context.commit('getUser');
        },
        GET_APARTMENT({ commit }, id) {
            swatApi.get(api.apartments + id)
            .then(resp => resp.data).
              then(apartment => commit('SET_APARTMENT', apartment))
          },

    }
});
