<template>
<div class="mt-5">
    <b-container fluid id="main">


        <b-container class="mt-2 font">
            <b-row>
                <b-col>
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
                                <div v-html="apartment.translation.description">{{apartment}}</div>
                            </b-card-text>
                            <b-card-footer footer-class="footer">

                                <b-button v-b-toggle.collapse-1 block variant="outline-dark" align-self="center" class="Gallerybutton" >Otvorite cijelu galeriju</b-button>

                            </b-card-footer>

                        </b-card>

                        <div>
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
                        </div>


                </b-col>

                <b-col class="mt-md-5">
                    <div class="mt-md-5">
                        <table class="table table-striped">
                            <thead class="thread-color" >
                                <tr>
                                    <th scope="col"><h3>Cjene</h3></th>
                                    <th scope="col"></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="tdColoration"><h5>SEZONA:</h5></td>
                                    <td class="tdColoration"><h5>{{ new Date().getFullYear() }}</h5></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in orderedApartmentPrices" v-bind:key="item.date_start">
                                    <td>{{ item.date_start | moment("DD.MM.YYYY.")}}</td>
                                    <td>{{ item.date_end | moment("DD.MM.YYYY.")}}</td>
                                    <td>{{ item.price}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div >
                        <h5 class="labels pb-2">Detalji:</h5>
                        <div v-html="apartment.translation.details">{{apartment}}</div>
                    </div>

                </b-col>
            </b-row>
        </b-container>
        <b-container class="mt-3 pb-4">
                                <b-row class="pt-3 pb-4">
                                    <b-col>
                                        <h4 class="borderbttm pb-2 pl-lg-4">REZERVIRAJTE:</h4>
                                    </b-col>
                                </b-row>
                                <b-row>

                                    <b-col  sm>
                                        <v-calendar is-expanded
                                                    :attributes="attrs"

                                                    :columns="$screens({ default: 1, lg: 2 })"
                                                    :rows="$screens({ default: 1, lg: 2 })"
                                                    >

                                        </v-calendar>

                                    </b-col>

                                    <b-col>
                                        <div class="formBorder p-2 pb-4">
                                            <h5 class="pb-3 pt-1">Odaberite željene datume za vaš upit:</h5>
                                            <v-date-picker
                                                mode='range'
                                                v-model="range"
                                                :input-props='{
                                                    placeholder: "Odaberite datume rezervacije",
                                                    readonly: true
                                                }'
                                        />

                                        </div>

                                        <div class="formBorder p-2 mt-3">
                                            <div>
                                            <b-spinner type="grow" small variant="danger" label="rezervirano"></b-spinner>
                                            Rezervirano - Apartman nije slobodan za odabrane datume
                                            </div>

                                        </div>
                                    </b-col>

                                    <b-col>
                                        <b-form @submit.prevent="sendForm">
                                            <div class="formBorder p-2">
                                                <h5 class="pb-3 pt-1">Pošaljite upit o rezervaciji:</h5>

                                                <b-form-group id="input-group-1" label="Ime:" label-for="input-1" class="text-start mb-1">
                                                    <b-form-input id="input-1" v-model="form.name" type="text" required placeholder="Unesite ime"></b-form-input>
                                                </b-form-group>

                                                <b-form-group id="input-group-2" label="Prezime:" label-for="input-2" class="text-start mb-1">
                                                    <b-form-input id="input-2" v-model="form.surname" type="text" required placeholder="Unesite prezime"></b-form-input>
                                                </b-form-group>

                                                <b-form-group id="input-group-3" label="Email:" label-for="input-3" class="text-start mb-1">
                                                    <b-form-input id="input-3" v-model="form.email" type="email" required placeholder="Unesite email"></b-form-input>
                                                </b-form-group>

                                                <b-form-group id="text-aria-group-4" label="Poruka:" label-for="text-aria-1" class="text-start mb-1">
                                                <b-form-textarea
                                                    id="text-aria-1"
                                                    v-model="form.message"
                                                    placeholder="Upišite poruku..."
                                                    rows="3"
                                                    max-rows="6"
                                                    ></b-form-textarea>
                                                </b-form-group>

                                                <b-btn type="submit" color="#31708e" class="mt-1 align-self-center w-50" style="background-color: #31708e;" :disabled="this.hidden">
                                                    Pošaljite upit
                                                </b-btn>

                                                 <b-alert class="mt-2" variant="success" :show="succesAlert">Mail uspješno poslan</b-alert>
                                                 <b-alert class="mt-2" variant="danger" :show="errorAlert">Mail nije poslan!</b-alert>
                                            </div>
                                        </b-form>
                                    </b-col>

                                </b-row>
        </b-container>

    </b-container>
     <footers></footers>
</div>
</template>

<script>
import Vue from 'vue';
import * as moment from 'moment';
import Footer from './../components/Footer'
import VueGallery from 'vue-gallery';
export default {
    components:{
        'gallery': VueGallery,
        'footers': Footer,

    },
    data() {
        return {
            hidden: false,
            apartment: null,
            index:null,
            range:{
                start: '',
                end: '',
            },
            form: {
                apartmentName:'',
                name: '',
                surname:  '',
                email:  '',
                message: '',
                start:'',
                end: '',


            },
            succesAlert: false,
            errorAlert: false,
            lang: 'hrv',
        }
    },
    created() {
        this.getApartment();
    },
    watch:{
        range: function(val){
            this.form.start = moment(val.start).format('DD.MM.YYYY');
            this.form.end = moment(val.end).format('DD.MM.YYYY');
        },
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
        },
        orderedApartmentPrices: function () {
            return _.orderBy(this.apartment.prices, 'date_start')
        },
        translationsFilter: function() {
                this.apartment.translation= this.apartment.translation.find(({language})=> language == this.lang);
        },

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
        sendForm(){
            this.form.apartmentName = this.apartment.name;
            let formData = this.form;
            this.hidden = true;
            swatApi.post(api.apartmentEmail, formData)
            .then(response => {
                    if (response.status == 200) {
                        this.succesAlert = true;
                        this.hidden=false;
                        this.clearForm();
                    }
                })
            .catch(error =>{
                this.errorAlert = true;
                this.succesAlert = false;
                this.hidden=false;

            });

        },
        clearForm(){
            this.form.apartmentName = '';
            this.form.name = '';
            this.form.surname = '';
            this.form.email = '';
            this.form.message = '';
            this.form.start = '';
            this.form.end = '';
            this.range = '';
            this.errorAlert = false;
        },
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Nunito&display=swap');


.font {
font-family: 'Lora', cursive;

}


.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
    background-color: #8fc1d3 ;
    /*color: white;*/
}

.Gallerybutton {
  color: white !important;
  background-color: #31708e !important;
  border-color: #31708e!important;
  width: 100%;
  height: 100%;
}
#main{
        background: url(../../img/pozadina.jpg) center;

}
h1{
    text-align: center;
    color:#31708e;



}
.labels{
     color: #31708e !important;
    /*border-bottom: 1px solid #31708e;*/
    border-top: 0;
}
.thread-color tr th{
    color: #31708e !important;
    border-bottom: 2px solid #31708e;
    border-top: 0;
}
.tdColoration{
    background-color: #31708e !important;
    color: white
}
.footer{
    width: 100%;
    height: 2.5rem;
    padding: 0 0 0 0 !important;
}

.borderbttm{
    border-bottom: 1px solid #31708e;
    color:#31708e;
}
.formBorder{
    background-color: white;
    border: 1px solid #31708e ;
    border-radius: 7px;

}

.vc-border-gray-400 {
    border-color: #31708e;
}
</style>
