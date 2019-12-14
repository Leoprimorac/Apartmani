<template>
<div>
<div class="container ">
    <div class="row mx-auto">
        <div class="col mx-auto">
            <b-navbar toggleable="sm" type="light" variant="fadded" class="info-bg fixed-top">
    <b-navbar-brand ><router-link class="router-decoration" :to="'/'+ $i18n.locale">{{ $t('navMain') }}</router-link></b-navbar-brand>

      <b-navbar-toggle target="nav-collapse" ></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav class="padding" style="color: rgb(0, 0, 0) !important;">
        <b-nav-item><router-link :to="'/'+ $i18n.locale + '#AboutUs'" style="color: rgb(0, 0, 0);">{{ $t('navAbout') }}</router-link></b-nav-item>
          <b-nav-item ><router-link :to="'/'+$i18n.locale +  '#Apartments'" style="color: rgb(0, 0, 0);">{{ $t('navApartments') }}</router-link></b-nav-item>
        <b-nav-item class="padding"><router-link :to="'/'+ $i18n.locale + '#Footer'" style="color: rgb(0, 0, 0);">{{ $t('navLocation') }}</router-link></b-nav-item>
        <b-nav-item  class="padding"><router-link :to="'/'+ $i18n.locale + '#Footer'" style="color: rgb(0, 0, 0);">{{ $t('navContact') }}</router-link></b-nav-item>
            <b-nav-item-dropdown :text=" $t('camera')" right>
                <b-dropdown-item href="https://www.livecamcroatia.com/hr/kamera/promajna-plaza-baska-voda?fbclid=IwAR3bqmusGgfoT7yuMvnkzurNRjY9hTe49jh9f2zD0C7S1JrL9nq3F09Wkt0">{{ $t('camera1') }}</b-dropdown-item>
                <b-dropdown-item href="https://dalmacija-live.com/Promajna/promajna-1">{{ $t('camera2') }}</b-dropdown-item>
            </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>

       <b-navbar-nav class="ml-auto">

            <b-nav-item-dropdown right>
                <template slot="button-content"> <img
                :src="icons[currentLanguage]"
                class="country-icon as-toggle"
            /></template>
                <b-dropdown-item v-for="lang in supportedLanguages"
                                :key="lang"
                                :selected="isCurrentLanguage(lang)"
                                :class="{ 'is-selected': isCurrentLanguage(lang) }"
                                :value="lang"
                                 @click="changeLanguage(lang)"
                                :img-src="icons[lang]"><img :src="icons[lang]" class="country-icon" /></b-dropdown-item>
        </b-nav-item-dropdown>
        <b-collapse is-nav id="nav_collapse">
                <b-navbar-nav class="ml-auto text-center text-uppercase">
                    <template v-if="$parent.isGuest">
                        <li class="nav-item">
                            <router-link to="/auth/login" class="nav-link">Prijava</router-link>
                        </li>
                    </template>
                    <li v-else-if="!$parent.isApp" class="nav-item">
                        <router-link to="/app" class="nav-link">Nastavi</router-link>
                    </li>
                    <template v-else-if="$parent.isApp">
                        <li class="nav-item">
                            <router-link to="/app" class="nav-link">Profil</router-link>
                        </li>
                        <b-nav-item class="nav-item" @click="logout">
                            Odjava
                        </b-nav-item>
                    </template>
                </b-navbar-nav>
            </b-collapse>
    </b-navbar-nav>

  </b-navbar>
        </div>
    </div>
</div>

<div class="container-flud">
    <div class="row ">
        <div class="col justify-content-center">

        </div>
    </div>
</div>




</div>

</template>

<script>
import { Trans } from './../lang/Translations'
import enIcon from './../../img/ikone/en.png'
import deIcon from './../../img/ikone/de.png'
import croIcon from './../../img/ikone/cro.png'
    export default {
        name: 'navbar',
        data: function(){
            return{

        langs: [
            'cro',
            'de',
            'en'] ,
        icons: {
                en: enIcon,
                de: deIcon,
                cro: croIcon,
            },
            }

        },

        computed: {
            supportedLanguages () {
      return Trans.supportedLanguages
    },
    currentLanguage () {
      return Trans.currentLanguage
    }
        },
        methods: {
            logout() {
                swatApi.post(api.logout).then(response => {
                    if (response.status === 200) {
                        this.$parent.isGuest = true;
                        this.$cookie.delete('api_token');
                        this.$router.push('/auth/login');
                    }
                })
            },
            changeLanguage (language) {
                const lang = language
                const to = this.$router.resolve({ params: { lang } })
                return Trans.changeLanguage(lang).then(() => {
                    this.$router.push(to.location)
                })
            },
            isCurrentLanguage (lang) {
            return lang === this.currentLanguage
            }
                }
            }
</script>
<style>
    .info-bg {
    background-color: #ffffffb4 !important;
}
.country-icon {
        width: 20px;
        height: auto;
        display: inline-block;
        vertical-align: baseline;
        border: 1px solid #dee2e6;
        box-shadow: 0px 1px 3px rgba(24, 29, 38, 0.1);
    }
    .country-icon.as-toggle {
        margin-top: 5px;
        }
    a{
	text-decoration: none;
    color: black !important;
}

    </style>
