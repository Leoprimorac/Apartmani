<template>
<div>
    <b-container fluid class="pt-5">
        <form v-on:submit.prevent="createApartment" class="swat-form">
            <b-row >
                <b-col sm>

                <h1>Ime apartmana</h1>
                    <b-card
                        img-src="https://picsum.photos/600/400/?image=25"
                        img-alt="Image"
                        img-top
                        tag="article"
                        style="max-width: 40rem;"
                        class="mb-2"
                    >
                        <b-card-text>
                        <div class="form-group d-flex flex-column">
                            <label for="description" class="text-center">Opis:</label>
                            <textarea id="description" class="form-control" name="description" required autofocus></textarea>
                        </div>
                        </b-card-text>
                        <b-button v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >Otvorite cijelu galeriju</b-button>
                    </b-card>
                </b-col>

                <b-col sm class="pt-4">

                    <div class="form-group d-flex flex-column">
                        <label for="description" class="text-center">Opis:</label>
                        <textarea id="description" class="form-control" name="description" required autofocus rows="8"></textarea>
                    </div>

                    <div class="form-group d-flex flex-column">
                                    <label for="amenities" class="text-center">Dodatci sobi:</label>
                                    <textarea id="amenities" class="form-control" name="amenities" required autofocus rows="8"></textarea>
                                </div>

                </b-col>


                </b-col>

            </b-row>
        </form>
    </b-container>

    <b-container fluid>
        <b-row>
            <b-col>
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

            </b-col>
        </b-row>

    </b-container>
</div>
</template>


<script>

import VueGallery from 'vue-gallery';
export default {

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
        index: null
      };
    },


}
</script>
