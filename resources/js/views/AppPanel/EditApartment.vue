<template>
<div>
    <b-container fluid class="pt-5" v-if="apartment">
            <b-row id="Veliki">
                <b-col cols="12" md="8" sm id="lijevi">
                    <b-container fluid>
                    <b-row>
                        <b-col id="MaliLijevi">
                            <h1>{{apartment.name}}</h1>
                                <b-card
                                    :img-src="images[0]"
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

                        <div class="pt-5">
                            <b-button v-b-toggle.collapse-2 class="mt-1" variant="primary" v-on:click="isHidden = !isHidden" >Uredi cijenik</b-button>
                            <b-collapse id="collapse-2" class="mt-2">
                                <b-card>
                                    <date-picker v-model="start" lang="en" :not-after="end" valueType="format" class="col-sm-5 pl-0 pr-0" sm></date-picker>
                                    <date-picker v-model="end" lang="en" :not-before="start" valueType="format" class="col-sm-5 pl-0 pr-0"  sm></date-picker>

                                        <b-form @submit.prevent="createPrice" >
                                            <b-input id="price" type="text" class="col-sm-5 float-left mr-1" name="price" placeholder="Cijena"  required ></b-input>
                                            <b-input id="start" type="text" class="" name="start" :value="start" required hidden></b-input>
                                            <b-input id="end" type="text" class="" name="end" :value="end" required hidden></b-input>
                                            <b-input id="apartments_id" type="text" class="" name="apartments_id" :value="this.$route.params.id"  required hidden>
                                            </b-input>

                                            <b-btn type="submit" variant="primary" class="col-sm-5 ">
                                                Potvrdi
                                            </b-btn>
                                        </b-form>

                                </b-card>
                            </b-collapse>
                        </div>

                             <div >

                                    <table class="table table-light">
                                        <tbody>
                                            <tr v-for="item in apartment.prices">
                                                <td>{{ item.date_start | moment("DD.MM.YYYY.")}}</td>
                                                <td>{{ item.date_end | moment("DD.MM.YYYY.")}}</td>
                                                <td>{{ item.price}}</td>
                                                <td><b-btn v-if="!isHidden" @click="deletePrice(item.id)" >Delete</b-btn></td>
                                            </tr>
                                        </tbody>
                                    </table>

                            </div>


                            <div >
                                <h6>Detalji:</h6>
                                    {{apartment.details}}
                            </div>

                            <div>

                                <h6 class="pt-3">Dodatci:</h6>
                                    {{apartment.amenities}}
                            </div>


                        </b-col>
                    </b-row>

                    <b-row>
                         <b-collapse id="collapse-1" class="mt-2">
                	            <b-card>
                                    <gallery :images="images" :index="index" @close="index = null"></gallery>
                                        <div
                                        class="image"
                                        v-for="(image, imageIndex) in images"
                                        :key="imageIndex"
                                        @click="index = imageIndex"
                                        :style="{
                                                backgroundImage: 'url(' + image + ')',
                                                width: '10vh',
                                                height: '10vh',
                                                float:'left',
                                                backgroundPosition: 'center center',
                                                backgroundRepeat:'no-repeat',
                                                backgroundSize:'cover'
                                                }">
                                        </div>

                                </b-card>
                            </b-collapse>

                    </b-row>
                </b-container>
                </b-col>
                <b-col id="desni" sm >
                    <ApartmentForm :apartment="apartment" @apartmentChanged="updateApartment"></ApartmentForm>
                </b-col>
            </b-row>

            <b-row>

            </b-row>
    </b-container>
</div>
</template>


<script>

import VueGallery from 'vue-gallery';
import ApartmentForm from './../../components/ApartmentForm'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

export default {
components: {
    'gallery': VueGallery,
    'ApartmentForm': ApartmentForm,
    DatePicker
},
  data: function () {
      return {
          apartment: null,
        start: null,
        end: null,
        isHidden: true,
        index: null,
        priceses: null,
      }
    },
    computed: {
        images() {
            let images = [];
            if(this.apartment == null || this.apartment.images == undefined)
                return [];
            this.apartment.images.forEach(image => {
                images.push('/uploads/' + this.apartment.id + '/' + image.path);
            })
            return images;
        }
    },
    created() {
        this.getApartment();
    },
    methods: {
        getApartment() {
            swatApi.get(api.apartments + this.$route.params.id)
                .then(resp => {this.apartment = resp.data})
        },
        updateApartment(novi) {
            this.priceses = this.apartment.prices;
            this.apartment = novi;
            this.apartment.prices = this.priceses;
            //this.getApartment();
        },
            createPrice: function (e) {
                const formData = new FormData(e.target);
                swatApi.post(api.prices, formData).
                then(response => {
                    if (response.status === 201) {
                        this.getApartment();
                    }
                });
            },

            deletePrice(id) {
                swatApi.delete(api.prices + id).
                then(response => {
                    if (response.status === 200) {
                        this.getApartment();
                    }
                });
            },
    },

}
</script>
