<template>
    <b-container fluid>
        <div class="pt-5">
            <router-link to="/app/NewApartment" class="nav-link">Novi apartman</router-link>
        </div>

            <b-row>
                <b-col>

                <ul class="list-unstyled" v-for="apartment in apartments" :key="apartment.id">
                    <li><router-link :to="'/app/EditApartment/' +apartment.id" class="nav-link">{{apartment.name}}</router-link></li>
                </ul>
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
