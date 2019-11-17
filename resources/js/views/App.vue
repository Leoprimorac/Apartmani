<template>
    <b-container fluid>
        <div class="pt-5">
            <router-link to="/app/NewApartment" class="nav-link">Novi apartman</router-link>
        </div>

            <b-row>
                <b-col>

                <div>
                <b-card-group columns>
                    <b-card v-for="apartment in apartments" :key="apartment.id"
                        :title= 'apartment.name'
                        :img-src="'/uploads/' + apartment.id + '/' + apartment.images[0].path"
                        img-alt="Image"
                        img-top
                        tag="article"
                        style="max-width: 20rem;"
                        class="mb-2"

                    >
                        <b-card-text>

                        </b-card-text>
                            <router-link :to="'/app/EditApartment/' +apartment.id"  v-slot="{href, route, navigate}">
                        <b-button :href="href" variant="primary" @click="navigate">Uredi apartman</b-button> </router-link>
                    </b-card>
                </b-card-group>
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
