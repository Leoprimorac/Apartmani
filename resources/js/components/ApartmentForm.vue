<template>

<b-container fluid>
                        <b-row>
                            <b-col>
                                <form v-on:submit.prevent="createApartment" class="swat-form">
                                    <div class="form-group d-flex flex-column">
                                        <label for="name" class="text-center">Ime:</label>
                                        <input id="name" type="text" class="form-control" name="name" :value="apartment.name" @input="updateName" required autofocus>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="description" class="text-center">Opis:</label>
                                        <textarea  id="description" class="form-control" name="description" :value="apartment.description" @input="updateDescription" required autofocus></textarea>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="description" class="text-center">Detalji:</label>
                                        <textarea id="details" class="form-control" name="details" :value="apartment.details" @input="updateDetails" required autofocus rows="8"></textarea>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="amenities" class="text-center">Dodatci sobi:</label>
                                        <textarea id="amenities" class="form-control" name="amenities" :value="apartment.amenities" @input="updateAmenities" required autofocus rows="8"></textarea>
                                    </div>


                                    <b-btn type="submit" variant="gold" class="mt-3 align-self-center w-50">
                                        Potvrdi
                                    </b-btn>
                                </form>

                            </b-col>
                        </b-row>
                    </b-container>

</template>
<script>
import Vuex from 'vuex';

export default {


computed: Vuex.mapState(['apartment']),
  methods: {

    updateName(e) {
      this.$store.commit('SET_APARTMENT', { name: e.target.value })
    },
    updateDescription(e) {
      this.$store.commit('SET_APARTMENT', { description: e.target.value })
    },
    updateDetails(e) {
      this.$store.commit('SET_APARTMENT', { details: e.target.value })
    },
    updateAmenities(e) {
      this.$store.commit('SET_APARTMENT', { amenities: e.target.value })
    }
  }
}
</script>
