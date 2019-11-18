<template>

<b-container fluid>
                        <b-row>
                            <b-col>
                                <form @submit.prevent="saveApartment" class="swat-form">

                                        <input id="name" type="text" class="form-control" name="id" v-model="apartment.id" @input="emitChange" required autofocus hidden>

                                    <div class="form-group d-flex flex-column">
                                        <label for="name" class="text-center">Ime:</label>
                                        <input id="name" type="text" class="form-control" name="name" v-model="apartment.name" @input="emitChange" required autofocus>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="description" class="text-center">Opis:</label>
                                        <textarea  id="description" class="form-control" name="description" v-model="apartment.description" @input="emitChange" required autofocus></textarea>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="description" class="text-center">Detalji:</label>
                                        <textarea id="details" class="form-control" name="details" v-model="apartment.details" @input="emitChange" required autofocus rows="5"></textarea>
                                    </div>

                                    <div class="form-group d-flex flex-column">
                                        <label for="amenities" class="text-center">Dodatci sobi:</label>
                                        <textarea id="amenities" class="form-control" name="amenities" v-model="apartment.amenities" @input="emitChange" required autofocus rows="5"></textarea>
                                    </div>


                                    <b-form-group
                                        class="d-flex flex-column"
                                        label="Fotografije:"
                                        label-for="cover_image"
                                        label-class="text-center">
                                        <b-form-file id="cover_image" name="images[]" accept=".jpg, .png, .gif" multiple placeholder="Odaberi datoteke..."></b-form-file>
                                    </b-form-group>


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

props: {

    'apartment': {
        type: Object,
        default: null
    }
},
  methods: {
      emitChange() {
          this.$emit('apartmentChanged', this.apartment);
      },
    saveApartment: function (e) {
                const formData = new FormData(e.target);
                swatApi.post(api.apartments + this.apartment.id, formData).
                then(response => {
                    if (response.status === 200) {
                        this.apartment = response.data;
                        this.emitChange();
                    }
                });
            },
  }
}
</script>
