<template>

<b-container fluid>
                        <b-row>
                            <b-col>
                                <form @submit.prevent="saveApartment" class="swat-form" >

                                    <div class="form-group d-flex flex-column">
                                    <b-form-select @submitDate.prevent="createDate" v-model="lang" id="availability" class="mb-3" name="availability">
                                            <template v-slot:first>
                                                <option :value="null" disabled>-- Odaberite opciju --</option>
                                            </template>
                                            <option value="hrv">Hrvatski</option>
                                            <option value="eng">Engleski</option>
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
                                        <vue-editor id="details" name="details" v-model="apartment.translation.details" @input="emitChange" required autofocus rows="5"></vue-editor>
                                    </div>




                                    <b-form-group
                                        class="d-flex flex-column"
                                        label="Fotografije:"
                                        label-for="cover_image"
                                        label-class="text-center">
                                        <b-form-file id="cover_image" name="images[]" accept=".jpg, .png, .gif" multiple placeholder="Odaberi datoteke..."></b-form-file>
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
                    </b-container>

</template>
<script>
import Vuex from 'vuex';
import { VueEditor } from "vue2-editor";

export default {
components: {
    VueEditor
},
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
                formData.append('id', this.apartment.translation.id)
                formData.append('details', this.apartment.translation.details)
                formData.append('description', this.apartment.translation.description)
                swatApi.post(api.apartments + this.apartment.id, formData).
                then(response => {
                    if (response.status === 200) {
                        this.emitChange();
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


  }
}
</script>
