<template>
    <div>
          <!-- Section - Main -->
        <section class="section section-main section-main-2 bg-dark dark">

            <!-- Video BG -->
            <div class="bg-video" data-property="{videoURL:'https://youtu.be/_M-nsAt_qS8', showControls: false, containment:'self',startAt:48,stopAt:68,mute:true,autoPlay:true,loop:true,opacity:0.3,quality:'hd1080'}"></div>
            <div class="bg-image bg-video-placeholder zooming"><img src="assets/img/photos/bg-restaurant.jpg" alt=""></div>

            <div class="container v-center text-center">
               
                <h1 class="display-2 mb-2">Adana'nın En İyi Kebapçısı</h1>
                <h4 class="text-muted mb-5">Şipariş etmeye ne dersiniz ?</h4>
                
                <router-link class="btn btn-outline-primary btn-lg" tag="a" to="/product"> <span>Online Sipariş Et!</span></router-link>
            </div>

        </section>
    </div>
</template>
<script>
export default {
    //https://youtu.be/_M-nsAt_qS8
}
</script>