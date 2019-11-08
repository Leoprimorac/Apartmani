<template>
        <div>
            <b-container fluid id="main">
                <b-row>
                    <b-col cols="12">
                        <div class="viewpoint">
                            <div class="info-bg mx-auto">
                                <img class=" image-size mx-auto d-block" src="../../img/logo.png" alt="logo">
                            </div>
                        </div>
                    </b-col>
                </b-row>
                <b-row >
                    <b-col sm  offset-md="1">
                        <blockquote class="blockquote">
                            <h1>VILLA PROMAJNA</h1>
                            <footer class="blockquote-footer">Mjesto odmora i relaksacije</footer>
                        </blockquote>
                        <div class="resize-center" >
                                    Promajna je selo u općini Baška Voda, u Splitsko-dalmatinskoj županiji,
                                    smješteno između naselja Bratuš na istoku i Baška Voda na zapadu.
                                    Naselje u cijelosti leži ispod Jadranske magistrale.
                                    Prema popisu stanovništva iz 2011. godine, u Promajni živi 372 stanovnika.
                        </div>
                    </b-col >
                        <b-col sm>
                        <div class="resize-center" >
                            <b-carousel
                                id="carousel-1"
                                style="text-shadow: 0px 0px 2px #000"
                                fade
                                indicators
                                img-width="100vh"
                                img-height="auto"
                            >
                                <b-carousel-slide
                                caption="First slide"
                                img-src="https://picsum.photos/1024/480/?image=10"
                                ></b-carousel-slide>
                                <b-carousel-slide
                                caption="Second Slide"
                                img-src="https://picsum.photos/1024/480/?image=12"
                                ></b-carousel-slide>
                                <b-carousel-slide
                                caption="Third Slide"
                                img-src="https://picsum.photos/1024/480/?image=22"
                                ></b-carousel-slide>
                            </b-carousel>
                        </div>
                        </b-col>


                </b-row>
            </b-container>
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
padding-top:56px;
    background: url(../../img/promajna.jpg) no-repeat center;
    height:100vh;
    -webkit-background-size: cover; /* For WebKit*/
    -moz-background-size: cover;    /* Mozilla*/
    -o-background-size: cover;      /* Opera*/
    background-size: cover;
    }

    .info-bg {
    background-color: #ffffffb4 !important;
};
    .image-size{
    max-width: 20%;
    height: auto;
    }
    .image-size50{
    max-width: 100vh;
    height: auto;
    }
    .resize-center{
        //height: 30%;
        //width: 30%;
    }
</style>
