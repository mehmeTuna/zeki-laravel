<template>
  <div>
    <div class="home-container">
      <div class="slider-container">
        <keep-alive>
          <SectionSlider />
        </keep-alive>

        <FoodSlider />
      </div>
      <div class="hemen-siparis-container">
        <div id="hemen-siparis" class="bg-dark">
          <div class="feature-icon icon icon-primary" style="font-size:23px">
            <i class="ti ti-shopping-cart"></i>
          </div>
          <div id="hemen-siparis-text" @click="$router.push('/urunler')">Hemen Sipariş Ver</div>
        </div>
      </div>
      <home-services />
    </div>
    <!-- <Offers /> -->
    <Steps />

    <Topfooter />
  </div>
</template>

<script>
import SectionSlider from "./../components/SectionSlider";
import About from "./../components/aboutSection";
import FoodSlider from "./../components/FoodSlider.vue";
import Steps from "./../components/Steps.vue";
import Topfooter from "./../components/Topfooter.vue";
import Offers from "./../components/Offers.vue";
import SectionYoutube from "./../components/SectionYoutube.vue";
import HomeServices from "../components/HomeServices.vue";

export default {
  name: "Home",
  components: {
    SectionSlider,
    About,
    Steps,
    Topfooter,
    FoodSlider,
    Offers,
    SectionYoutube,
    HomeServices
  }
};
</script>
<style>
.home-container {
  background-image: url(https://i.imgyukle.com/2019/10/01/oAbQV0.jpg);
  background-repeat: repeat-y;
  background-position: center 90px;
}
.slider-container {
  width: 80%;
  margin: 0 auto;
}
.hemen-siparis-container {
  display: flex;
  justify-content: center;
  width: 100%;
}
#hemen-siparis {
  color: #fff;
  margin: 40px 0;
  padding: 18px 13px;
  border-radius: 3px;
  /* background:#eee; */
  display: inline-flex;
  align-items: center;
  cursor: pointer;
}
#hemen-siparis #hemen-siparis-text {
  font-size: 18px;
  font-weight: 500;
  padding-right: 10px;
}
</style>