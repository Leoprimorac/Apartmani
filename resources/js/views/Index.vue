<template>
    <div>
        <b-container fluid id="main">
            <b-container id="pocetna" title="Promajna zalazak sunca">
                <!-- <b-row> -->
                    <b-col cols="12">
                        <div class="viewpoint">
                            
                        </div>
                    </b-col>
                <!-- </b-row> -->
                <div class="ime mt-5">
                    <div style="display: inline-block;">
                        <h1 class="ime-title"> Villa Lara </h1>
                        <h4 class="ime-pr">PROMAJNA</h4>
                    </div>
                               
                            </div>
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
        <b-container id="promajna" class="pt-3 pb-5">
            <b-row >

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
                        <b-carousel-slide v-for="image in images" v-bind:key="image" :img-src="image" tag="Apartmani Villa Lara"></b-carousel-slide>



                    </b-carousel>
                    </div>
                    <div>
                        <b-button class="promajna-button" v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >{{ $t('galleryButton') }}</b-button>
                            <b-collapse id="collapse-1" class="mt-2">
                                <b-card>
                                    <gallery :images="images" :index="index" @close="index = null;document.body.style.overflow = '';"></gallery>
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
                                        title="Villa Lara">
                                        </div>

                                </b-card>
                            </b-collapse>
                        </div>
                </b-col>
                 <b-col sm>
                    <div class="glavna-slova resize-center pt-4" >
                        <blockquote class="blockquote">
                            <h2>Villa Lara</h2>
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
        mounted() {
    // In case the modal was opened and overflow was set when the page loads
    document.body.style.overflow = '';
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
          
          text-align: center;
          vertical-align:middle;
          width: 100%;
    background: rgba(255, 255, 255, 0.5);
    position: absolute;
           }
           .ime-title{
            font-family: 'Parisienne', serif;
           }
    .viewpoint {
    display: flex;
    justify-content: center; /* Centers content horizontally */
    align-items: center; /* Centers content vertically */
    width: 100%;
}
    .glavna-slova{
        font-family: 'Lora', cursive;
    }
    h1{
        font-size: 4rem !important;
    }
    .ime-pr {
    display: flex;
    align-items: center; /* Aligns text and lines in the center */
    justify-content: center; /* Centers everything */
    text-align: center;
    font-size: 1.5rem; /* Adjust as needed */
    font-weight: 300; 
    letter-spacing: 2.5px ;
    position: relative;
}
    .ime-pr::before,
.ime-pr::after {
    content: "";
    flex: 1; /* Makes the lines expand equally */
    height: 2px; /* Line thickness */
    background-color: black; /* Line color */
    margin: 0 15px; /* Space between text and lines */
}
    #main{
        background: url(../../img/naslovna.jpg) no-repeat center;
    }
    #main::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(255, 255, 255, 0.5); 
}
    #pocetna{

    height:100vh;
    -webkit-background-size: cover; /* For WebKit*/
    -moz-background-size: cover;    /* Mozilla*/
    -o-background-size: cover;      /* Opera*/
    background-size: cover;
    display: flex;
    justify-content: center; /* Centers horizontally */
    align-items: center; /* Centers vertically */
    text-align: center; 
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
       // padding: 30px;
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


    }

    .card-img{
        object-fit: cover;
    }
    @media (max-width: 768px) {
    h1{
        font-size: 3rem !important;
    }
    .ime-pr{
        font-size: 1rem;
    }
    .ime{
margin-bottom: 100px;
    }
}

</style>
