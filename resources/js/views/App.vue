<template>
    <b-container fluid>
        <div class="pt-5">
            <router-link to="/app/NewApartment" class="nav-link">Novi apartman</router-link>
        </div>

            <b-row>
                 <b-col lg="4" md="6" sm="2" class="mb-3" v-for="apartment in apartments" :key="apartment.id">
                <div class="card-group deck" >
                    <router-link  :to="'app/EditApartment/' +apartment.id"  v-slot="{href, route, navigate}">
                    <b-card  no-body v-if="apartment.images[0]"
                        class="shadow-lg p-10 mb-6 bg-white"
                        style="margin-top:15%; margin-bottom:5%; background-color: #e6e6e6;"
                        :img-src="'/uploads/' + apartment.id + '/' + apartment.images[0].path"
                        img-height="300rem"
                        @click="navigate"
                        >


                    <b-card-footer footer-class="footer"
                    style="background-color:white">

                        <b-button bottom class="button"
                            style="font-size:30px; padding:0"
                            :href="href" variant="primary"
                            @click="navigate"> {{apartment.name}}


                        </b-button>

                    </b-card-footer>
                    </b-card>

                     <b-card  no-body v-else
                        class="shadow-lg p-10 mb-6 bg-white"
                        style="margin-top:15%; margin-bottom:5%; background-color: #e6e6e6;"
                        img-src="./images/Borova-šuma-NajOdmor-3.jpg"
                        img-height="300rem"
                        @click="navigate"
                        >


                    <b-card-footer footer-class="footer"
                    style="background-color:white">

                        <b-button bottom class="button"
                            style="font-size:30px; padding:0"
                            :href="href" variant="primary"
                            @click="navigate"> {{apartment.name}}


                        </b-button>

                    </b-card-footer>
                    </b-card>
                    </router-link>
                </div>
            </b-col>
            </b-row>
    </b-container>
</template>

<script>
    export default {
        data(){
            return{
                apartments: [],
            };


        },
        created: function() {
    this.getApartments();
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
        }
    }
</script>

<style>
.footer{
    height:3rem;
    width:100%;
    background-color: white;
    padding: 0 !important
}
.button {
  color: #31708e !important;
  background-color: white !important;
  border-color: white!important;
  width: 100%;
  height: 100%;
  font-family: 'Lora', cursive;
  font-size: 20px;
  align: center;


}
.card-img{
    object-fit: cover;
}
</style>
