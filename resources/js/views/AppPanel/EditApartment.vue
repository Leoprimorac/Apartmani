<template>
<div>
    <b-container fluid class="pt-5">
            <b-row id="Veliki">
                <b-col sm id="lijevi">
                    <b-container fluid>
                    <b-row>
                        <b-col id="MaliLijevi">
                            <h1>{{apartment.name}}</h1>
                                <b-card
                                    img-src="https://picsum.photos/600/400/?image=25"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 40rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                        {{apartment.description}}
                                    </b-card-text>
                                    <b-button v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >Otvorite cijelu galeriju</b-button>
                                </b-card>
                        </b-col>
                        <b-col id="Malidesni">

                            <div>
                                {{apartment.details}}
                            </div>

                            <div>
                                    {{apartment.amenities}}
                            </div>


                        </b-col>

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
                    </b-row>
                </b-container>
                </b-col>
                <b-col id="desni" >

                    <apartment-form></apartment-form>



                </b-col>
            </b-row>
    </b-container>
</div>
</template>


<script>

import VueGallery from 'vue-gallery';
import store from './../../store.js';
import Apartmentform from './../../components/Apartmentform'
import Vuex from 'vuex';
export default {

    store,

  components: {
    'gallery': VueGallery,
    'apartment-form': Apartmentform
  },
  data: function () {

      return {
        images: [
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://images.unsplash.com/photo-1527555197883-98e27ca0c1ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
          'https://picsum.photos/1024/480/?image=10',
          'resources\img\logo.png'
        ],

        index: null,
      };

  },
    computed: Vuex.mapState(['apartment']),
    created() {
        this.$store.dispatch('GET_APARTMENT', this.$route.params.id)
    },


    methods: {
        getApartment() {
                swatApi.get(api.apartments + this.$route.params.id).
                then(response => {
                    if (response.status === 200) {
                        this.apartment = response.data;
                    }
                });
            },

    },



}
</script>
