<template>
    <div>
          <!-- Page Title -->
        <!-- <div class="page-title bg-dark dark">
             <div class="bg-image bg-parallax skrollable skrollable-between" data-top-bottom="background-position-y: 30%" data-bottom-top="background-position-y: 70%" style="background-image: url(&quot;assets/img/photos/bg-croissant.jpg&quot;); background-position-y: 54.0884%;"><img src="assets/img/photos/bg-croissant.jpg" alt="" style="display: none;"></div>
            <div class="container">
                
                <div class="row">
                    
                    <div class="col-lg-8 push-lg-4">
                       
                        <h1 class="mb-0 ">Menü Listesi</h1>
                        <h4 class=" mb-0">Ürünlerimizi burdan görebilirsiniz</h4>
                    </div>
                </div>
            </div>
        </div> -->
        <Category />
    </div>
</template>
<script>

import Category from './../components/Category'



export default {
    name:'Product',
    components:{
       
       Category,

    }
}
</script>