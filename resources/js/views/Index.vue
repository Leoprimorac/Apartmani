<template>
    <div>
        <b-container fluid id="main">
            <b-container id="pocetna" title="Promajna zalazak sunca">
                <b-row>
                    <b-col cols="12">
                        <div class="viewpoint">
                            <div class="ime mt-5">
                                <h1> Villa Promajna </h1>
                            </div>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
        </b-container>
        <b-container id="promajna" class="pt-3">
            <b-row id="AboutUs">
                <b-col sm   >
                    <div class="glavna-slova resize-center" >
                        <blockquote class="blockquote">
                            <h2>PROMAJNA</h2>
                            <footer class="blockquote-footer">{{ $t('blackqouteFooter') }}</footer>

                        </blockquote>
                            {{ $t('textPromajna') }}
                           <p> {{ $t('textPromajna2') }}</p>
                    </div>
                </b-col >
                <b-col sm>
                    <div class="sort resize-center" >
                  <div>
                    <b-embed
                        type="iframe"
                        aspect="16by9"
                        src="https://youtube.com/embed/Sn93bmXM6Kg"
                        allowfullscreen
                    ></b-embed>
                    </div>
    </div>

                </b-col>
            </b-row>
        </b-container>
<b-container id="promajna" class="pt-3">
            <b-row id="AboutUs">

                <b-col sm>
                    <div class="sort resize-center" >
                    <b-carousel
                        id="carousel-1"
                        style="text-shadow: 0px 0px 2px #000"
                        fade
                        :interval="3000"
                        no-hover-pause
                        indicators
                        img-width="1024"
                        img-height="480"
                    >
                        <b-carousel-slide v-for="image in images" v-bind:key="image" :img-src="image" tag="Apartmani Villa Promajna"></b-carousel-slide>



                    </b-carousel>
                    </div>
                    <div>
                        <b-button class="promajna-button" v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >{{ $t('galleryButton') }}</b-button>
                            <b-collapse id="collapse-1" class="mt-2">
                                <b-card>
                                    <gallery :images="images" :index="index" @close="index = null"></gallery>
                                        <div
                                        class="image"
                                        v-for="(image, imageIndex) in images"
                                        :key="imageIndex"
                                        @click="index = imageIndex"
                                        :style="{ backgroundImage: 'url(' + image + ')',
                                        width: '10vh',
                                        height: '10vh',
                                        float:'left',
                                        backgroundPosition: 'center center',
                                        backgroundRepeat:'no-repeat',
                                        backgroundSize:'cover'}"
                                        title="Villa Promajna">
                                        </div>

                                </b-card>
                            </b-collapse>
                        </div>
                </b-col>
                 <b-col sm>
                    <div class="glavna-slova resize-center pt-4" >
                        <blockquote class="blockquote">
                            <h2>VILLA PROMAJNA</h2>
                            <footer class="blockquote-footer">{{ $t('blackqouteFooter2')}}</footer>
                        </blockquote>
                        {{ $t('textVillaPromajna')}}<br>
                        {{ $t('textVillaPromajna2')}}

                    </div>
                </b-col >
            </b-row>
        </b-container>

        <b-container fluid id="apartmani">
        <b-container>
            <b-row id="Apartments">
                <b-col lg="4" md="6" sm="2" class="mb-3" v-for="apartment in apartments" :key="apartment.id">
                <div class="card-group deck" >
                    <router-link  :to="$i18n.locale + '/Apartment/' +apartment.id"  v-slot="{href, route, navigate}">
                    <b-card  no-body
                        class="shadow-lg p-10 mb-6 bg-white"
                        style="margin-top:15%; margin-bottom:5%; background-color: #e6e6e6;"
                        :img-src="'/uploads/' + apartment.id + '/' + apartment.images[0].path"
                        img-height="300rem"
                        @click="navigate"
                        >


                    <b-card-footer footer-class="footer"
                    style="background-color:white">

                        <b-button bottom class="button"
                            style="font-size:30px; padding:0"
                            :href="href" variant="primary"
                            @click="navigate"> {{apartment.name}}


                        </b-button>

                    </b-card-footer>
                    </b-card>
                    </router-link>
                </div>
            </b-col>
            </b-row>
        </b-container>
        </b-container>
      <footers id="Footer"></footers>
    </div>



</template>


<script>

import { Trans } from './../lang/Translations'
import Footer from './../components/Footer'
import VueGallery from 'vue-gallery';
import Vuex from 'vuex';
import store from './../store.js';
import { BEmbed } from 'bootstrap-vue'
Vue.component('b-embed', BEmbed)
export default {
    store,


  components: {
     'gallery': VueGallery,
     'footers':Footer,

  },
  data: function () {
      return {
        apartments: [],
        images: [
            '/images/1.jpg',
            '/images/2.jpg',
            '/images/4.jpg',
            '/images/5.jpg',
            '/images/6.jpg',
            '/images/7.jpg',
            '/images/8.jpg',
            '/images/9.jpg',
            '/images/10.jpg',
            '/images/11.jpg',
            '/images/12.jpg',
            '/images/13.jpg',
            '/images/14.jpg',
            '/images/15.jpg',
            '/images/16.jpg',
            '/images/17.jpg',
            '/images/18.jpg',
            '/images/19.jpg',
            '/images/20.jpg',
            '/images/21.jpg',
            '/images/22.jpg',
        ],
        index: null
      };
    },
    created: function() {
    this.getApartments();
    },
  computed: {
            user: function () {
                return this.$store.getters.loggedUser;
            },
            isAdmin: function () {
                return this.$store.getters.isAdmin;
            },

        },
methods: {
     getApartments() {
                    swatApi.get(api.apartments).
                    then(response => {
                        if (response.status === 200) {
                            this.apartments = response.data;
                        }
                    });
                },

},



}
</script>


<style lang="scss">
@import url('https://fonts.googleapis.com/css?family=Lora&display=swap');
@import url('https://fonts.googleapis.com/css?family=Parisienne&display=swap');
    .ime{
          font-family: 'Parisienne', serif;
          text-align: center;
           }
    .glavna-slova{
        font-family: 'Lora', cursive;
    }
    h1{
        font-size: 5rem !important;
    }
    #main{
        background: url(../../img/promajna3.jpeg) no-repeat center;
    }
    #pocetna{

    padding-top:56px;
    height:100vh;
    -webkit-background-size: cover; /* For WebKit*/
    -moz-background-size: cover;    /* Mozilla*/
    -o-background-size: cover;      /* Opera*/
    background-size: cover;
    }
   /* .info-bg {
    background-color: rgba(243, 96, 96, 0.35)!important;
    }*/
    .image-size{
    max-width: 20%;
    height: auto;
    }
    .image-size50{
    max-width: 100vh;
    height: auto;
    }
    .resize-center{
        padding: 5% 0% 5% 0;
    }
    //.offset-sm-1 {
   // margin-left: 3.333333% !important;
    .card-columns{
        height: 100vh;
        width: auto;
    }
    .title{
        background-color: gray;
    }

    .promajna-button{
    color: white !important;
    background-color: #31708e !important;
    border-color: #31708e!important;
    width: 100%;
    height: 100%;
    font-family: 'Lora', cursive;
    }
    #AboutUs{
        min-height:50vh;
        padding: 30px;
        width:auto;
    }
    .Apartments{
        height:"100vh";
    }
    #apartmani{
    background: url(../../img/pozadina.jpg) center;
    min-height:100vh;
    }
    .footer{
        height:3rem;
        width:100%;
        background-color: white;
        padding: 0 !important
    }
    .button {
    color: #31708e !important;
    background-color: white !important;
    border-color: white!important;
    width: 100%;
    height: 100%;
    font-family: 'Lora', cursive;
    font-size: 20px;
    align: center;


    }

    .card-img{
        object-fit: cover;
    }

</style>
