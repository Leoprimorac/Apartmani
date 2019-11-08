<template>
    <b-container class="self-center" style="padding-top:56px;">
        <b-row class="justify-content-center">
            <b-col cols="12" md="6" class="auth">
                <form v-on:submit.prevent="register" class="swat-form">
                    <div class="form-group d-flex flex-column">
                        <label for="name" class="text-center">Ime i prezime:</label>
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="email" class="text-center">Email:</label>
                        <input id="email" type="email" class="form-control" name="email" required autofocus>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="password" class="text-center">Lozinka:</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="password-confirmation" class="text-center">Potvrdi lozinku:</label>
                        <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <b-btn type="submit" variant="gold" class="mt-3 align-self-center w-50">
                        Registracija
                    </b-btn>
                </form>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        name: 'register',
        methods: {
            register: function(e) {
                const formData = new FormData(e.target);
                swatApi.post(api.register, formData).
                then(response => {
                    if (response.status === 201) {
                        this.$router.push('/auth/login')
                    }
                });
            },
        }
    }
</script>
