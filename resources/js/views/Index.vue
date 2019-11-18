<template>
    <div>
        <b-container fluid id="main">
            <b-container id="pocetna">
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
        <b-container fluid id="promajna">
            <b-row id="Onama">
                <b-col sm  offset-sm="1" >
                    <div class="resize-center" >
                        <blockquote class="blockquote">
                            <h2>PROMAJNA</h2>
                            <footer class="blockquote-footer">Mjesto odmora i relaksacije</footer>
                        </blockquote>
                            Promajna je mjesto u općini Baška Voda, u Splitsko-dalmatinskoj županiji,
                            smješteno između mjesta Bratuš na istoku i Baška Voda na zapadu.
                            Mjesto u cijelosti leži ispod Jadranske magistrale.
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
        </b-container>
        
        <b-container fluid id="apartmani">   
        <b-container id="apartmani2">    
            <b-row>
                <b-col>
                    <div class="text-gray">
                       <b-card-group columns >
                        <b-card v-for="apartment in apartments" :key="apartment.id"
                        :title= 'apartment.name'
                        :img-src="'/uploads/' + apartment.name + '/' + apartment.images[0].path"
                        img-alt="Image"
                        img-top
                        tag="article"
                        style=" height: 25rem; background-color: #e6e6e6;  border-color: #d9d9d9;"
                        class=" shadow p-3 mb-5 bg-white rounded"
                        >
                            <b-card-text>

                            </b-card-text>
                            <router-link :to="'/app/EditApartment/' +apartment.id"  v-slot="{href, route, navigate}">
                            <b-button class="button" :href="href" variant="primary" @click="navigate">Uredi apartman</b-button> </router-link>
                            </b-card>
                            </b-card-group>
                            
                    </div>
                    </b-col>
                </b-row>
        </b-container>
        </b-container>
        <b-container fluid class="Kontakt">
            <b-row>
                <b-col>
                    <div class="ime">
                        <h3> Villa Promajna</h3>
                    </div>
                        <div class="tekst">
                        Vila Promajna smještena je tik uz more i plažu u Promajni na Makarskoj Rivieri!
                        Uživajte u pogledu na kristalno čisto more i otoke te iskusite jedinstveni 
                        doživljaj pgleda na najljepše zalaske sunca na Makarskoj rivijeri.
                        </div>
                   
                    
                </b-col>
                <b-col>
                </b-col>
                <b-col>
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
@import url('https://fonts.googleapis.com/css?family=Dancing+Script:400,700&display=swap');
    .ime{
          font-family: 'Dancing Script', cursive;
          text-align: center;
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

    .info-bg {
    background-color: rgba(255, 255, 255, 0.35)!important;
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
        padding: 5% 0% 5% 0;
    }
    .offset-sm-1 {
    margin-left: 3.333333% !important;
    .card-columns{
        height: 100vh;
        width: 100%;
    }
    .title{
        background-color: gray;
    }
}
#Onama{
    height:100vh;
    width:auto;
}
.Apartments{
    height:"70vh";
}
#apartmani{
  background-color: #e6e6e6;
}
#apartmani2{
  
    padding-top:30px;
   // padding-left: 30px;
   // padding-right:30px;
    padding-bottom:30px;
}


.button {
  color: white !important; 
  background-color: #666666 !important; 
  border-color: #666666 !important;
}
.Kontakt{
    background-color: #262626;
    color:white;      
    height:50vh;
    width:auto;  
    padding: 30px;

}

</style>
