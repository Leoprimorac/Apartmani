<template>
<div>
<div class="container ">
    <div class="row mx-auto">
        <div class="col mx-auto">
            <b-navbar toggleable="sm" type="light" variant="fadded" class="info-bg fixed-top">
    <b-navbar-brand href="/">Početna</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse" ></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav class="padding" style="color: rgb(0, 0, 0) !important;">
        <b-nav-item><router-link to="/#AboutUs" style="color: rgb(0, 0, 0);">O nama</router-link></b-nav-item>
          <b-nav-item ><router-link to="/#Apartments" style="color: rgb(0, 0, 0);">Apartmani</router-link></b-nav-item>
        <b-nav-item class="padding"><router-link to="/#Footer" style="color: rgb(0, 0, 0);"> Lokacija</router-link></b-nav-item>
        <b-nav-item  class="padding"><router-link to="/#Footer" style="color: rgb(0, 0, 0);">Kontakt</router-link></b-nav-item>
      </b-navbar-nav>
    </b-collapse>

    <b-navbar-nav class="ml-auto">
        <b-collapse is-nav id="nav_collapse">
                <b-navbar-nav class="ml-auto text-center text-uppercase">
                    <template v-if="$parent.isGuest">
                        <li class="nav-item">
                            <router-link to="/auth/login" class="nav-link">Prijava</router-link>
                        </li>
                    </template>
                    <li v-else-if="!$parent.isApp" class="nav-item">
                        <router-link to="/app" class="nav-link">Nastavi</router-link>
                    </li>
                    <template v-else-if="$parent.isApp">
                        <li class="nav-item">
                            <router-link to="/app" class="nav-link">Profil</router-link>
                        </li>
                        <b-nav-item class="nav-item" @click="logout">
                            Odjava
                        </b-nav-item>
                    </template>
                </b-navbar-nav>
            </b-collapse>
    </b-navbar-nav>

  </b-navbar>
        </div>
    </div>
</div>

<div class="container-flud">
    <div class="row ">
        <div class="col justify-content-center">

        </div>
    </div>
</div>




</div>

</template>

<script>
    export default {
        name: 'navbar',
        methods: {
            logout() {
                swatApi.post(api.logout).then(response => {
                    if (response.status === 200) {
                        this.$parent.isGuest = true;
                        this.$cookie.delete('api_token');
                        this.$router.push('/auth/login');
                    }
                })
            }
        }
    }
</script>
<style>
    .info-bg {
    background-color: #ffffffb4 !important;
};


    </style>
