<template>
    <b-container fluid class="Kontakt bottom-row p-4" id="Footer">
        <b-container>
            <b-row sm align-h="center">
                <b-col>
                    <div>
                        <h3 class="text-center"> Villa Lara</h3>
                    </div>
                        <div class="text-justify">
                        {{ $t('textFooterPromajna') }}
                        </div>
                </b-col>
                <b-col class="text-center">
                <div >
                    <h3> {{ $t('navContact') }}</h3>
                </div>

                <div class="text-justify centrirano">

                    <img src="./../../img/ikone/contact.png" style="width:15px; height:15px;">
                        {{ $t('footerContactOwner') }}<br>
                    <img src="./../../img/ikone/telefon.png" style="width:15px; height:15px;">
                        {{ $t('footerContactNumber') }}<br>
                        <img src="./../../img/ikone/telefon.png" style="width:15px; height:15px;">
                        {{ $t('footerContactNumber3') }}<br>
                    <img src="./../../img/ikone/at.png" style="width:15px; height:15px;">
                        Email: mladen1101@gmail.com<br>
                </div>
                </b-col>
                <b-col>
                    <div class="tekst">
                        <h3 class="text-center ">{{ $t('navLocation') }}</h3>
                        <div class="mapouter">
                            <div class="gmap_canvas">

                                <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=apartmani%20mili%C4%8Devi%C4%87%20promajna&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                </iframe>
                                <a href="https://www.whatismyip-address.com"></a>
                            </div>
                        </div>
                        </div>
                </b-col>
            </b-row>
        </b-container>
    </b-container>
</template>

<script>

export default {
    name: 'footers'


}

</script>

<style>

.Kontakt{
    background-color: #5D5C61;
    -webkit-background-size: cover; /* For WebKit*/
    -moz-background-size: cover;    /* Mozilla*/
    -o-background-size: cover;      /* Opera*/
    background-size: cover;
    color:white;
    font-family: 'Lora', cursive;

}

.centrirano{
    margin: 0 auto;
    width: 80%;
}

.mapouter{
position:relative;
text-align:right;
height:auto;
width:100%;
}
.gmap_canvas {
overflow:hidden;
background:none!important;
height:100%;
width:85%;
margin: 0 auto;
}

</style>

