<template>
<div>
    <b-container fluid class="pt-5">
            <b-row id="Veliki">
                <b-col sm id="lijevi">
                    <b-container fluid>
                    <b-row>
                        <b-col id="MaliLijevi">
                            <h1>{{names}}</h1>
                                <b-card
                                    img-src="https://picsum.photos/600/400/?image=25"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 40rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                    {{ description }}
                                    </b-card-text>
                                    <b-button v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >Otvorite cijelu galeriju</b-button>
                                </b-card>
                        </b-col>
                        <b-col id="Malidesni">

                            <div>
                            {{details}}
                            </div>

                            <div>
                            {{amenities}}
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
                    <b-container fluid>
                        <b-row>
                            <b-col>
                                <form v-on:submit.prevent="createApartment" class="swat-form">
                                    <div class="form-group d-flex flex-column">
                                        <label for="name" class="text-center">Ime:</label>
                                        <input  v-model="names" id="name" type="text" class="form-control" name="name" required autofocus>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="description" class="text-center">Opis:</label>
                                        <textarea v-model="description" id="description" class="form-control" name="description" required autofocus></textarea>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="details" class="text-center">Detalji:</label>
                                        <textarea v-model="details" id="details" class="form-control" name="details" required autofocus></textarea>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="amenities" class="text-center">Dodatci sobi:</label>
                                        <textarea v-model="amenities" id="amenities" class="form-control" name="amenities" required autofocus></textarea>
                                    </div>


                                    <b-btn type="submit" variant="gold" class="mt-3 align-self-center w-50">
                                        Potvrdi
                                    </b-btn>
                                </form>

                            </b-col>
                        </b-row>
                    </b-container>




                </b-col>
            </b-row>
    </b-container>
</div>
</template>


<script>

import VueGallery from 'vue-gallery';
export default {
    name:'apartments',

  components: {
    'gallery': VueGallery
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
        apartment: '',
        index: null,
        description: '',
        details: '',
        amenities: ''
      };

  },
  mounted() {
  this.names = this.apartment.name;
},
  computed: {

      names: function(){
      return this.apartment.name;
  }

  },
  watch: {
  name(value) {
    this.names = value;
  }
},
  created: function() {
    this.getApartment();
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
