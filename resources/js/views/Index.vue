<template>
        <div>
            <b-container fluid id="main">
                <b-row>
                    <b-col cols="12">
                        <div class="viewpoint">
                            <div class="info-bg mx-auto">
                                <img class=" image-size mx-auto d-block" src="../../img/logo.png" alt="logo">
                            </div>
                        </div>
                    </b-col>
                </b-row>
                <b-row id="Onama">
                    <b-col sm  offset-sm="1" >
                        <div class="resize-center" >
                            <blockquote class="blockquote">

                                <h1>VILLA PROMAJNA</h1>

                                <footer class="blockquote-footer">Mjesto odmora i relaksacije</footer>

                            </blockquote>

                                    Promajna je selo u općini Baška Voda, u Splitsko-dalmatinskoj županiji,
                                    smješteno između naselja Bratuš na istoku i Baška Voda na zapadu.
                                    Naselje u cijelosti leži ispod Jadranske magistrale.
                                    Prema popisu stanovništva iz 2011. godine, u Promajni živi 372 stanovnika.
                        </div>
                    </b-col >

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
                                <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=10"></b-carousel-slide>
                                <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=12"></b-carousel-slide>
                                <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=22" ></b-carousel-slide>
                            </b-carousel>


                        </div>
                        <div>

                            <b-button v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >Otvorite cijelu galeriju</b-button>

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
                                        backgroundSize:'cover'}">
                                        </div>

                                </b-card>
                            </b-collapse>
                        </div>
                    </b-col>
                </b-row>


                <b-row>
                    <b-col>

                <div>
                <b-card-group columns>
                    <b-card v-for="apartment in apartments" :key="apartment.id"
                        :title= 'apartment.name'
                        :img-src="'/uploads/' + apartment.name + '/' + apartment.images[0].path"
                        img-alt="Image"
                        img-top
                        tag="article"
                        style="max-width: 20rem;"
                        class="mb-2"

                    >
                        <b-card-text>

                        </b-card-text>
                            <router-link :to="'/app/EditApartment/' +apartment.id"  v-slot="{href, route, navigate}">
                        <b-button :href="href" variant="primary" @click="navigate">Uredi apartman</b-button> </router-link>
                    </b-card>
                </b-card-group>
</div>

                    </b-col>
                </b-row>
            </b-container>
        </div>



</template>


<script>
import Navbar from '../components/Navbar.vue'
import VueGallery from 'vue-gallery';
import Vuex from 'vuex';
import store from './../store.js';
export default {
    store,

  components: {
    Navbar, 'gallery': VueGallery
  },
  data: function () {
      return {
        apartments: [],
        images: [
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://picsum.photos/1024/480/?image=10',
          'resources\img\logo.png'
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
            }
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
    .viewpoint{
padding-top:56px;
    background: url(../../img/promajna.jpg) no-repeat center;
    height:100vh;
    -webkit-background-size: cover; /* For WebKit*/
    -moz-background-size: cover;    /* Mozilla*/
    -o-background-size: cover;      /* Opera*/
    background-size: cover;
    }

    .info-bg {
    background-color: #ffffffb4 !important;
};
    .image-size{
    max-width: 20%;
    height: auto;
    }
    .image-size50{
    max-width: 100vh;
    height: auto;
    }
    .resize-center{
        padding: 5% 0 5% 0;
    }
    .offset-sm-1 {
    margin-left: 3.333333% !important;
}
#Onama{
    height:100vh;
    width:auto;
}
.Apartments{
    height:"70vh";
}

</style>
