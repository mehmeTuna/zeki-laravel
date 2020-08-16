<template>
  <!-- 
    <div class="food-slider--container inner-controls carousel carousel-items " data-slick='{
        "slidesToShow": 6, 
        "slidesToScroll": 2,
        "dots": false,
        "arrows": true,
        "responsive": [
            {
                "breakpoint": 991,
                "settings": {
                    "slidesToShow": 3
                }
            },
            {
                "breakpoint": 575,
                "settings": {
                    "slidesToShow": 3

                }
            }
        ]
        }'
    >    
        <div class="carousel-item " v-for="(item,index) in allProducts" :key="index">
            <router-link tag='a' :to='`/product?${index}`' >
                <img :src="item.categoryImage" alt="" class="kare">
                <h3 class="title  text-secondary text-center ">
                    {{item.name}}
                </h3>
            </router-link>
        </div>
  </div>-->
  <div class="menu-categories" style="width:100%;background:#fff;">
    <div class="menu-categories--container frame">
      <div
        @click="$router.push(`/urunler?${catIndex}`)"
        class="menu-categories--item"
        v-for="(product,catIndex) in allProducts"
        :key="product.id"
      >
        <div class="menu-categories--item-img">
          <img :src="product.categoryImage" alt />
        </div>
        <div class="menu-categories--item-text">{{product.name}}</div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["allProducts"])
  },
  created() {
    this.$store.dispatch("fetchProducts");
  }
};
</script>

<style>
.food-slider--container {
}

.kare {
  border-radius: 5px 20px 5px;
}
</style>