<template>
<b-container fluid id="main">


    <b-container class="mt-5 font">
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
                                <th scope="col"></th>
                                <th scope="col"><h5>Cjenovnik</h5></th>
                                <th></th>
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
     <b-container class="mt-3">
                            <b-row>
                                <b-col  sm>
                                    <v-calendar is-expanded
                                                :attributes="attrs">
                                    </v-calendar>

                                </b-col>

                                <b-col>

                                </b-col>
                            </b-row>
     </b-container>
</b-container>

</template>

<script>
import VueGallery from 'vue-gallery';
export default {
    components:{
        'gallery': VueGallery,
    },
    data() {
        return {
            apartment: null,
            index:null,
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
@import url('https://fonts.googleapis.com/css?family=Lora&display=swap');


.font {
 font-family: 'Lora', serif;

}


.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
    background-color: #8fc1d3 ;
    color: white;
}

.Gallerybutton {
  color: white !important;
  background-color: #31708e !important;
  border-color: #666666 !important;
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
.thread-color{
    background-color: #f7f9fb !important;
}
.footer{
    width: 100%;
    height: 2.5rem;
    padding: 0 0 0 0 !important;
}
</style>
