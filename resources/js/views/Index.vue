<template>
        <div>
            <section >

                <div class="row ">
                        <div class="col-lg-12">
                            <div class="viewpoint">
                            <div class="info-bg">
                            Villa Promajna

                        </div>
                            </div>

                        </div>

                </div>




            </section>


        </div>



</template>


<script>
import Navbar from '../components/Navbar.vue'

export default {
  name: 'app',
  components: {
    Navbar
  },
  computed: {
            user: function () {
                return this.$store.getters.loggedUser;
            },
            isAdmin: function () {
                return this.$store.getters.isAdmin;
            }
        },

}
</script>


<style lang="scss">
    .viewpoint{
        background-image: url('../../img/promajna.jpg');
        height: 100vh;
        background-size: cover;
    }

    .info-bg {
    background-color: #ffffffb4 !important;
};
</style>
