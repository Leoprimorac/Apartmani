import Vue from 'vue'
import Router from 'vue-router'
import App from './views/App'
import { Trans } from './lang/Translations'
import Login from './views/auth/Login'
import Register from './views/auth/Register'
import NewApartment from './views/AppPanel/NewApartment'
import EditApartment from './views/AppPanel/EditApartment'


import { i18n } from "./lang/i18n";

Vue.use(Router);
export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [

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
                name: 'register'
            }
        ]
    },
    {
      path: "/:lang",
      component: { render (c) { return c('router-view') }},
      beforeEnter(to, from, next) {
        const lang = to.params.lang;
        if (!['en', 'de','cro'].includes(lang)) return next('cro');
        if (i18n.locale !== lang) {
          i18n.locale = lang;
        }
        /*import(`./lang/translations/${lang}.json`).then((messages)=>{
            i18n.setLocaleMessage(lang, messages.default || messages)
            i18n.locale=lang
            return next();
        })*/ return next()

      },
      children: [
        {
            path: '',
            name: 'Index',
            component: () =>
            import(/* webpackChunkName: "[request]" */ "./views/Index.vue")
        },
        {
            path: '#AboutUs',
            name: 'AboutUs',
            component: () =>
            import(/* webpackChunkName: "[request]" */ "./views/Index.vue")

        },
        {
            path: '#Footer',
            name: 'Footer',
            component: () =>
            import(/* webpackChunkName: "[request]" */ "./components/Footer.vue")
        },
        {
            path: 'Apartment/:id',
            name: 'Apartment',
            component: () =>
            import(/* webpackChunkName: "[request]" */ "./views/Apartment.vue")
        },
        {
            path: '/Apartment/:id',
            name: 'apartment-with-redirect',
            component: () =>
            import(/* webpackChunkName: "[request]" */ "./views/Apartment.vue")

        },

      ]
    },
    {
      path: "*",
      redirect (to) {
        return "cro"
      }
    }
  ],
  scrollBehavior (to, from, savedPosition) {
    //https://router.vuejs.org/guide/advanced/scroll-behavior.html
    if (to.hash) {
            return { selector: to.hash }
        } else if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 }
        }
  }
});
