<template>
<div>
    <b-container id="fitt" class="pt-5" v-if="apartment">
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

                                <div class="ml-3">
                                     <h6 class="pt-3">Dodatci:</h6>
                                        {{apartment.amenities}}
                                </div>

                        </b-col>
                        <b-col id="Malidesni">

                        <div class="pt-5">
                            <b-button v-b-toggle.collapse-2 class="mt-1" variant="primary" v-on:click="isHidden = !isHidden" >Uredi cijenik</b-button>
                            <b-collapse id="collapse-2" class="mt-2">
                                <b-card>
                                    <date-picker v-model="dstart" lang="en" :not-after="dend" valueType="format" class="col-sm-5 pl-0 pr-0" sm></date-picker>
                                    <date-picker v-model="dend" lang="en" :not-before="dstart" valueType="format" class="col-sm-5 pl-0 pr-0"  sm></date-picker>

                                        <b-form @submit.prevent="createPrice" >
                                            <b-input id="price" type="text" class="col-sm-5 float-left mr-1" name="price" placeholder="Cijena"  required ></b-input>
                                            <b-input id="dstart" type="text" class="" name="dstart" :value="dstart" required hidden></b-input>
                                            <b-input id="dend" type="text" class="" name="dend" :value="dend" required hidden></b-input>
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




                        </b-col>
                    </b-row>
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
                             </b-col>
                         </b-row>
                     </b-container>

                     <b-container fluid>
                        <b-row>
                            <b-col cols="10" sm>
                                <v-calendar is-expanded
                                            :attributes="attrs"
                                            @dayclick='dayClicked'
                                            v-b-modal.deleteDate>
                                </v-calendar>
                                <b-modal centered
                                        v-if='selectedDay'
                                        class='selected-day'
                                        id="deleteDate"
                                        title="Potvrda"
                                        @ok="deleteDate(selectedDay.attributes[0].customData)"
                                        ok-title="Da"
                                        ok-variant="danger"
                                        cancel-title="Odustani">
                                        <p class="my-4">Jeste li sigurni da želite izbrisati ovaj datum?</p>
                                    </b-modal>
                            </b-col>

                            <b-col cols="2" sm>
                                <v-date-picker
                                    mode='range'
                                    v-model='range'

                                    @submitDate.prevent="createDate"
                                />
                                <b-form @submit.prevent="createDate">
                                    <b-input type="text" id="date_start" :value="range.start | moment('YYYY-MM-DD')" name="date_start" hidden></b-input>
                                    <b-input type="text" id="date_end" :value="range.end | moment('YYYY-MM-DD')" name="date_end" hidden></b-input>
                                    <b-input type="text" id="apartments_id" :value="this.$route.params.id" name="apartments_id" hidden></b-input>
                                    <b-form-select @submitDate.prevent="createDate" v-model="selected" id="availability" class="mb-3" name="availability">
                                        <template v-slot:first>
                                            <option :value="null" disabled>-- Odaberite opciju --</option>
                                        </template>
                                        <option value="red">Izdato</option> <option value="blue">Pregovor</option>
                                    </b-form-select>

                                    <b-btn type="submit" variant="info" class="mt-3 align-self-center w-50">
                                        Potvrdi
                                    </b-btn>
                                </b-form>
                            </b-col>
                        </b-row>
                    </b-container>



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
import ApartmentForm from './../../components/ApartmentForm.vue'
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';


export default {
components: {
    'gallery': VueGallery,
    'ApartmentForm': ApartmentForm,
    DatePicker,
},
  data: function () {
      return {
        nesto:null,
        selected: null,
        apartment: null,
        dstart: null,
        dend: null,
        isHidden: true,
        index: null,
        priceses: null,
        range:{
            start: null,
            end: null,
        },
        selectedDay: null,

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
        },

        attrs() {
            let attrs = [];
            if(this.apartment == null || this.apartment.calendar == undefined)
                return [];
            this.apartment.calendar.forEach(attr => {
                attrs.push({
                            key: 'today',
                            highlight: {
                            backgroundColor: '#66ff8c',
                            color:''+attr.availability+''
                            // Other properties are available too, like `height` & `borderRadius`
                            },
                                dates: [{start: new Date(attr.date_start), end: new Date(attr.date_end), id_calendar: attr.id}],

                                customData: attr.id,
                            });

            })
            return attrs;
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
        createDate: function (e) {
                const formData = new FormData(e.target);
                swatApi.post(api.calendars, formData).
                then(response => {
                    if (response.status === 201) {
                        this.getApartment();
                    }
                });
            },
            dayClicked(day) {
                    this.selectedDay = day;

	            },
        deleteDate(id){
             swatApi.delete(api.calendars + id).
                then(response => {
                    if (response.status == 200) {
                        window.location.reload();


                    }
                })

        }

    },

}
</script>

<style>

#fitt{
    height: 100vh;
}
</style>
