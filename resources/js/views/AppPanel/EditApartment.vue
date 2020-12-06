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
                                        v-if="images[0]"
                                        :img-src="images[0].path"
                                        img-alt="Image"
                                        img-top
                                        tag="article"
                                        style="max-width: 40rem;"
                                        class="mb-2"
                                    >
                                        <b-card-text>
                                              <div v-html="apartment.translation.description">{{apartment}}</div>
                                        </b-card-text>
                                        <b-button v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >Otvorite cijelu galeriju</b-button>
                                    </b-card>
                                    <b-card
                                        v-else
                                        img-src="./images/Borova-šuma-NajOdmor-3.jpg"
                                        img-alt="Image"
                                        img-top
                                        tag="article"
                                        style="max-width: 40rem;"
                                        class="mb-2"
                                    >
                                        <b-card-text>
                                            <div class="ql-editor">
                                              <div v-html="apartment.translation.description">{{apartment}}</div>
                                            </div>
                                        </b-card-text>
                                        <b-button v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" >Otvorite cijelu galeriju</b-button>
                                    </b-card>

                                     <div >
                                        <h6>Detalji:</h6>
                                        <div class="always">
                                            <div v-html="apartment.translation.details"></div>
                                        </div>
                                </div>



                            </b-col>
                            <b-col id="Malidesni">

                            <div class="pt-5">
                                <b-button v-b-toggle.collapse-2 class="mt-1" variant="primary" v-on:click="isHidden = !isHidden" >Uredi cjenik</b-button>
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
                                                <tr v-for="item in orderedApartmentPrices" v-bind:key="item.date_start" >
                                                    <td>{{ item.date_start | moment("DD.MM.")}}</td>
                                                    <td>{{ item.date_end | moment("DD.MM.")}}</td>
                                                    <td>{{ item.price}}</td>
                                                    <td><b-btn v-if="!isHidden" @click="deletePrice(item.id)" >Obriši</b-btn></td>
                                                </tr>
                                            </tbody>
                                        </table>

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
                                                    class="image d-flex"
                                                    v-for="(image, imageIndex) in images"
                                                    :key="imageIndex"
                                                    @click="index = imageIndex"
                                                    :style="{
                                                            backgroundImage: 'url(' + image.path + ')',
                                                            width: '10vh',
                                                            height: '13vh',
                                                            float:'left',
                                                            backgroundPosition: 'center center',
                                                            backgroundRepeat:'no-repeat',
                                                            backgroundSize:'cover'
                                                            }">
                                                    <b-btn class="align-self-end ImgBtn align-content-center " @click="deleteImage(image.id)" >Obriši</b-btn>
                                                    </div>

                                            </b-card>
                                    </b-collapse>
                                </b-col>
                            </b-row>
                        </b-container>

                        <b-container fluid class="mt-3">
                            <b-row>
                                <b-col  sm>
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

                                <b-col sm>
                                    <v-date-picker
                                        mode='range'
                                        v-model='range'
                                        :input-props='{
                                            placeholder: "Odaberite datume rezervacije",
                                            readonly: true
                                        }'


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
                                            <option value="red">Izdato</option>
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
                <b-col id="desni" sm class="mt-5">
                    <b-row>
                            <b-col>
                                <form @submit.prevent="saveApartment" class="swat-form" >

                                    <div class="form-group d-flex flex-column">
                                    <b-form-select @submitDate.prevent="createDate" v-model="lang" id="availability" class="mb-3" name="availability">
                                            <template v-slot:first>
                                                <option :value="null" disabled>-- Odaberite opciju --</option>
                                            </template>
                                            <option value="cro">Hrvatski</option>
                                            <option value="en">Engleski</option>
                                            <option value="de">Njemački</option>
                                        </b-form-select>
                                    </div>

                                        <input id="name" type="text" class="form-control" name="id" v-model="apartment.id" @input="emitChange" required autofocus hidden>

                                    <div class="form-group d-flex flex-column">
                                        <label for="name" class="text-center">Ime:</label>
                                        <input id="name" type="text" name="name" v-model="apartment.name" @input="emitChange" required autofocus>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="description" class="text-center">Opis:</label>
                                        <vue-editor  id="description" name="description" v-model="apartment.translation.description" @input="emitChange" required autofocus></vue-editor>
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="text-center">Detalji:</label>
                                        <vue-editor id="details" name="details" v-model="apartment.translation.details" @input="emitChange" required autofocus rows="5" ></vue-editor>
                                    </div>




                                    <b-form-group
                                        class="d-flex flex-column"
                                        label="Fotografije:"
                                        label-for="cover_image"
                                        label-class="text-center">
                                        <b-form-file id="cover_image" name="images[]" accept=".jpg, .png, .gif" placeholder="Odaberi datoteke..." multiple></b-form-file>
                                    </b-form-group>


                                    <b-btn type="submit" variant="info" >
                                        Potvrdi unos
                                    </b-btn>

                                    <b-btn variant="danger" v-b-modal.deleteModal>
                                        Obriši apartman
                                    </b-btn>

                                    <b-modal centered
                                        id="deleteModal"
                                        title="Potvrda"
                                        @ok="deleteApartment"
                                        ok-title="Da"
                                        ok-variant="danger"
                                        cancel-title="Odustani">
                                        <p class="my-4">Jeste li sigurni da želite izbrisati ovaj oglas?</p>
                                    </b-modal>
                                </form>

                            </b-col>
                        </b-row>

                </b-col>
            </b-row>

            <b-row>

            </b-row>
    </b-container>
</div>
</template>


<script>

import VueGallery from 'vue-gallery';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import { VueEditor } from "vue2-editor";


export default {
components: {
    'gallery': VueGallery,
    DatePicker, VueEditor,
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
            start: new Date(),
            end: new Date,
        },
        selectedDay: null,
        lang: 'cro',
      }
    },
    computed: {
        images() {
            let images = [];
            if(this.apartment == null || this.apartment.images == undefined)
                return [];
            this.apartment.images.forEach(image => {
                images.push({ path: '/uploads/' + this.apartment.id + '/' + image.path,
                                    id: image.id,
                });
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
        },
         orderedApartmentPrices: function () {
            return _.orderBy(this.apartment.prices, 'date_start')
        },
          translationsFilter: function() {
                this.apartment.translation= this.apartment.translation.find(({language})=> language == this.lang);
      }
    },
    watch: {
        lang: function(val){
            this.getApartment();

        }
    },
    created() {
        this.getApartment();
    },
    methods: {
        getApartment() {
            swatApi.get(api.apartments + this.$route.params.id)
                .then(resp => {this.apartment = resp.data
                     if (resp.status === 200) {
                    this.translationsFilter;
                }
                })

        },
        updateApartment(novi) {
            this.priceses = this.apartment.prices;
            this.apartment = novi;
            this.apartment.prices = this.priceses;
            this.getApartment();
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

        },
        deleteImage(id) {
            swatApi.delete(api.images + id).
            then(response => {
                if (response.status === 200) {
                    this.getApartment();
                }
            });
        },
              emitChange() {
          this.$emit('apartmentChanged', this.apartment);
      },
        saveApartment: function (e) {
                const formData = new FormData(e.target);
                formData.append('translations_id', this.apartment.translation.id)
                formData.append('details', this.apartment.translation.details)
                formData.append('description', this.apartment.translation.description)
                swatApi.post(api.apartments + this.apartment.id, formData).
                then(response => {
                    if (response.status === 200) {
                        this.getApartment();
                    }
                });
            },
            deleteApartment() {
                swatApi.delete(api.apartments + this.apartment.id).
                then(response => {
                    if (response.status == 200) {
                        this.$router.push('/app/')
                    }
                })
        },


    },

}
</script>

<style>

#fitt{
    height: 100vh;
}
.ImgBtn{
    height: 3vh;
    width: 100%;
    padding: 0!important ;
}
.always {
        box-sizing: border-box;
    line-height: 1.42;
    height: 100%;
    outline: 0;
    overflow-y: auto;
    padding: 12px 15px;
    tab-size: 4;
    -moz-tab-size: 4;
    text-align: left;
    white-space: pre-wrap;
    word-wrap: break-word;

}
</style>
