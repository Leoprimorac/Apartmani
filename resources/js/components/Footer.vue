<template>

    <b-container fluid class="Kontakt bottom-row p-4">
        <b-container>
            <b-row sm align-h="center">
                <b-col>
                    <div class="tekst">
                        <h3 class="text-center"> Villa Promajna</h3>
                    </div>
                        <div class="tekst text-justify">
                        Vila Promajna smještena je tik uz more i plažu u Promajni na Makarskoj Rivieri!
                        Uživajte u pogledu na kristalno čisto more i otoke te iskusite jedinstveni
                        doživljaj pgleda na najljepše zalaske sunca na Makarskoj rivijeri.
                        </div>
                </b-col>
                <b-col class="text-center">
                <div class="tekst">
                    <h3> Kontakt</h3>
                </div>
                <div class="tekst text-center">
                    <img src="./../../img/ikone/contact.png" style="width:15px; height:15px;">
                        Vlasnik: Mladen Miličeivč <br>
                    <img src="./../../img/ikone/telefon.png" style="width:15px; height:15px;">
                        Br.tel: +389 91 888 06 85<br>
                    <img src="./../../img/ikone/at.png" style="width:15px; height:15px;">
                        Mail: mladen1101@gmail.com<br>
                </div>
                </b-col>
                <b-col>
                    <div class="tekst">
                        <h3 class="text-center">Lokacija</h3>
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
    name: 'footers',


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
width:100%;
}

</style>

