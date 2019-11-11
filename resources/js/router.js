import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/Index'
import App from './views/App'

import Login from './views/auth/Login'
import Register from './views/auth/Register'
import NewApartment from './views/AppPanel/NewApartment'
import EditApartment from './views/AppPanel/EditApartment'

Vue.use(Router);

export default new Router({
    linkActiveClass: 'open active',
    routes: [
        {
            path: '/',
            name: 'Index',
            component: Index
        },
        {
            path: '/app',
            name: 'App',
            component: App
        },
        {
            path: '/app/NewApartment',
            name: 'NewApartment',
            component: NewApartment
        },
        {
            path: '/app/EditApartment',
            name: 'EditApartment',
            component: EditApartment
        },
        {
            path: '/app/EditApartment/:id',
            name: 'EditApartment',
            component: EditApartment
        },
        {
            path : '/auth',
            name: 'auth',
            component: { render (c) { return c('router-view') }},
            children:[
                {
                    path: '/auth/login',
                    component: Login,
                    name: 'login'
                },
                {
                    path: '/auth/register',
                    component: Register,
                    name: 'Register'
                }
            ]
        }
    ]
})
