<template>
    <div style="overflow-x:hidden">
        
        <!-- Section - Menu -->
        <section class="section  protrude ">

            <div class="menu-sample-carousel carousel inner-controls" data-slick='{
                "dots": true,
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "infinite": true,
                "responsive": [
                    {
                        "breakpoint": 991,
                        "settings": {
                            "slidesToShow": 2,
                            "slidesToScroll": 1
                        }
                    },
                    {
                        "breakpoint": 690,
                        "settings": {
                            "slidesToShow": 1,
                            "slidesToScroll": 1
                        }
                    }
                ]
            }'>
                <!-- Menu Sample -->
                <div class="menu-sample">
                   <router-link tag='a' to='/product'> 
                   <img src="assets/img/photos/kebabcat.jpg" alt="" class="image">
                        <h3 class="title">Kebaplar</h3>
                        </router-link>
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                  
                        <router-link tag='a' to='/product'>
                        
                        <img src="assets/img/photos/izgaracat.jpg" alt="" class="image">
                        <h3 class="title">Izgaralar</h3>>
                        </router-link>
                  
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                   
                        <router-link tag='a' to='/product'>
                        <img src="assets/img/photos/köftecat.jpg" alt="" class="image">
                        <h3 class="title">Çiğköfte</h3>        
                     </router-link>
                   
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                    
                       <router-link tag='a' to='/product' >
                            <img src="assets/img/photos/dürümcat.jpg" alt="" class="image">
                        <h3 class="title">Dürümler</h3>
                       </router-link>
                   
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                   
                        <router-link tag='a' to='/product' >
                            <img src="assets/img/photos/menu-sample-dessert.jpg" alt="" class="image">
                        <h3 class="title">Tatlılar</h3>
                        </router-link>
                    
                </div>
                <!-- Menu Sample -->
                <div class="menu-sample">
                   
                       <router-link tag='a' to='/product' >
                            <img src="assets/img/photos/menu-sample-drinks.jpg" alt="" class="image">
                        <h3 class="title">İçecekler</h3>
                       </router-link>
                    
                </div>
            </div>

        </section>
    </div>
</template>
       