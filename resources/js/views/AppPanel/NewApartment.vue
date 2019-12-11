<template>
    <b-container class="self-center">
        <b-row class="justify-content-center">
            <b-col cols="12" class="mb-4">
                <h2 class="text-center">Novi apartman</h2>
            </b-col>
            <b-col cols="12" md="6">
                <form v-on:submit.prevent="createApartment" class="swat-form">
                    <div class="form-group d-flex flex-column">
                        <label for="name" class="text-center">Ime:</label>
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="description" class="text-center">Opis:</label>
                        <textarea id="description" class="form-control" name="description" required autofocus></textarea>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="details" class="text-center">Detalji:</label>
                        <textarea id="details" class="form-control" name="details" required autofocus></textarea>
                    </div>



                    <b-form-group
                                        class="d-flex flex-column"
                                        label="Fotografije:"
                                        label-for="cover_image"
                                        label-class="text-center">
                                        <b-form-file id="cover_image" name="images[]" accept=".jpg, .png, .gif" multiple placeholder="Odaberi datoteke..." required></b-form-file>
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
    export default {
        name: 'apartments-create',
        methods: {
            createApartment: function (e) {
                const formData = new FormData(e.target);
                swatApi.post(api.apartments, formData).
                then(response => {
                    if (response.status === 201) {
                        this.$router.push('/app')
                    }
                });
            }
        }
    }
</script>



