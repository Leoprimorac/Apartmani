<template>
    <b-container class="self-center">
        <!--<b-row class="justify-content-center my-4 py-4">-->
        <!--</b-row>-->
        <b-row class="justify-content-center">
            <b-col cols="12" md="6">
                <form v-on:submit.prevent="login" class="swat-form">

                    <div class="form-group d-flex flex-column">
                        <label for="email" class="text-center">Email:</label>
                        <input id="email" type="email" class="form-control" name="email" required autofocus>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="password" class="text-center">Lozinka:</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <b-btn type="submit" variant="gold" class="mt-3 align-self-center w-50">
                        Prijava
                    </b-btn>
                </form>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        name: 'login',
        methods: {
            login: function (e) {
                const formData = new FormData(e.target);
                swatApi.post(api.login, formData).
                then( response => {
                    if (response.status === 200) {
                        this.$cookie.set('api_token', response.data.api_token);
                        this.$router.push('/app')
                    }
                });
            }
        }
    }
</script>
