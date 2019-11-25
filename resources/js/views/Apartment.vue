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
                                {{apartment.description}}
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

                        <div class="ml-3">
                            <h6 class="pt-3">Dodatci:</h6>

                            {{apartment.amenities}}

                        </div>

                </b-col>

                <b-col class="mt-md-5">
                    <div class="mt-md-5">
                        <table class="table table-striped">
                            <thead class="thread-color" >
                                <tr>
                                    <th scope="col"><h3>Cjenovnik</h3></th>
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
                                <tr v-for="item in apartment.prices">
                                    <td>{{ item.date_start | moment("DD.MM.YYYY.")}}</td>
                                    <td>{{ item.date_end | moment("DD.MM.YYYY.")}}</td>
                                    <td>{{ item.price}}</td>
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
                                                    :rows="$screens({ default: 1, lg: 2 })">
                                        </v-calendar>

                                    </b-col>

                                    <b-col>
                                        <div class="formBorder p-2 pb-4">
                                            <h5 class="pb-3 pt-1">Odaberite željene datume za vaš upit:</h5>
                                            <v-date-picker
                                                mode='range'
                                                v-model='range'
                                                :input-props='{
                                                    placeholder: "Odaberite datume rezervacije",
                                                    readonly: true
                                                }'
                                                @submitDate.prevent="createDate"
                                        />

                                        </div>

                                        <div class="formBorder p-2 mt-3">
                                            <div>
                                            <b-spinner type="grow" small variant="danger" label="rezervirano"></b-spinner>
                                            Rezervirano - Apartman nije slobodan za odabrane datume
                                            </div>
                                            <div>
                                            <b-spinner type="grow" small variant="primary" label="dogovor"></b-spinner>
                                            Dogovor - U tijeku je dogovor za odabrane datume
                                            </div>

                                        </div>
                                    </b-col>

                                    <b-col>
                                        <form v-on:submit.prevent=""  >
                                            <div class="formBorder p-2">
                                                <h5 class="pb-3 pt-1">Pošaljite upit o rezervaciji:</h5>
                                                <div class="form-group mb-1 d-flex flex-column">
                                                    <label for="name" class="text-start mb-1">Ime:</label>
                                                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                                                </div>

                                                <div class="form-group mb-1 d-flex flex-column">
                                                    <label for="description" class="text-start mb-1">Prezime:</label>
                                                    <input id="surname" type="text" class="form-control" name="surname" required autofocus>
                                                </div>

                                                <div class="form-group mb-1 d-flex flex-column">
                                                    <label for="details" class="text-start mb-1">Email:</label>
                                                    <input id="email" type="text" class="form-control" name="email" required autofocus>
                                                </div>

                                                <div class="form-group mb-1 d-flex flex-column">
                                                    <label for="amenities" class="text-start mb-1">Poruka:</label>
                                                    <textarea id="message" class="form-control" name="message" required autofocus></textarea>
                                                </div>

                                                <b-btn type="submit" color="#31708e" class="mt-1 align-self-center w-50" style="background-color: #31708e;">
                                                    Potvrdi
                                                </b-btn>
                                            </div>
                                        </form>
                                    </b-col>

                                </b-row>
        </b-container>

    </b-container>
     <footers></footers>
</div>
</template>

<script>
import Footer from './../components/Footer'
import VueGallery from 'vue-gallery';
export default {
    components:{
        'gallery': VueGallery,
        'footers': Footer
    },
    data() {
        return {
            apartment: null,
            index:null,
            range:{
                start: null,
                end: null,
            }
        }
    },
    created() {
        this.getApartment();
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

    methods: {
        getApartment() {
            swatApi.get(api.apartments + this.$route.params.id)
                .then(resp => {this.apartment = resp.data})
        },
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Nunito&display=swap');


.font {
 font-family: 'Nunito', serif;

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
