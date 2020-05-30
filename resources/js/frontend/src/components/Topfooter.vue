<template>
    <div>
        
        <!-- Section -->
        <section class="section section-lg dark bg-dark">

            <!-- BG Image -->
           <div  class="bg-resim  "><img  src="assets/img/photos/bg-croissant1.jpg" alt=""></div>
        
            <div class="container text-center">
                <div class="col-lg-8 push-lg-2">
                    <h2 class="mb-3">Bizi ziyaret ettiğinize sevindiniz mi?</h2>
                    <h5 class="text-muted">Rezervasyon yapın yada online sipariş verin!</h5>
                    <div @click="$router.push('/urunler')" class="btn btn-primary"><span>Sipariş Ver</span></div>
                    <div  @click="$router.push('/rezervasyon')" class="btn btn-outline-primary"><span>Rezervasyon Yap</span></div>
                </div>
            </div>

        </section>
        
    </div>
</template>

<style >
.bg-resim{
  position: absolute;
  top: 0;
  left: 0;
  
  width: 100%;
  height: 100%;
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
  z-index: 0;


}


</style>