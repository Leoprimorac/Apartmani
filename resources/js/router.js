import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/Index'
import App from './views/App'

import Login from './views/auth/Login'
import Register from './views/auth/Register'


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
