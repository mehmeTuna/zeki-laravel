<template>
  <div id="app">
    <div class="header-sticky">
      <Header />
      <Sepetim />
    </div>
    <div class="body-content">
      <keep-alive>
        <router-view></router-view>
      </keep-alive>
      <Footer />
    </div>
  </div>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import Sepetim from "./components/Sepetim.vue";

export default {
  name: "app",
  components: {
    Header: Header,
    Footer: Footer,
    Sepetim: Sepetim
  }
};
</script>
<style lang="scss">
$height: 104px;
*,
*::after,
*::before {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}

html {
  box-sizing: border-box;
}
.header-sticky {
  // /* --header-height:104px; */
  height: $height;
}
.body-content {
  /* height:calc(100vh - var(--header-height)); */
}
.header-sticky #content {
  margin-top: 0 !important;
}
#header {
  position: fixed;
  width: 100%;
  height: $height;
  display: block;
}
.header-container {
  width: 80%;
  margin: 0 auto;
  height: 100%;
  display: flex;
  align-items: center;
}
.header-grid {
  width: 100%;
  display: grid;
  grid-template-columns: auto 1fr auto;
  align-items: center;
}
.header-item.logo {
  font-size: 22px;
  font-weight: 600;
}
.header-items {
  display: flex;
  align-items: center;
}
.header-item {
}
.header-item--link {
  display: flex;
  align-items: center;
  justify-content: center;
}
.header-item--link > div {
  font-size: 16px;
  font-weight: 500;
}
.header-sepet-icon {
  display: flex;
  align-items: Center;
}
.header-sepet-icon .header-item {
  display: flex;
  align-items: center;
}
.header-cart--icon {
  position: relative;
}
#mobile-button {
  display: none !important;
}
.active {
  $height: 275px !global;
}

@media only screen and (max-width: 991px) {
  #mobile-button {
    display: flex !important;
  }
  .header-grid {
    grid-template-columns: auto auto;
  }
  #header-items--content.disable {
    display: none;
  }

  #header-items--content {
    grid-row: 2/3;
    grid-column: 1/3;
    padding-bottom: 20px;
  }
  .header-items {
    flex-direction: column;
    align-items: flex-start;
    padding-left: 55px !important;
    position: absolute;
    top: 85px;
    left: 0;
    background: #fff;
    z-index: 99;
    width: 100%;
  }
  .header-item {
    padding-top: 10px;
  }
  .header-left {
    justify-self: flex-start;
  }
  .header-sepet-icon {
    justify-self: flex-end;
  }
}
#nav-icon1 {
  width: 33px;
  height: 25px;
  position: relative;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: 0.5s ease-in-out;
  -moz-transition: 0.5s ease-in-out;
  -o-transition: 0.5s ease-in-out;
  transition: 0.5s ease-in-out;
  cursor: pointer;
}
#nav-icon1 span {
  display: block;
  position: absolute;
  height: 4px;
  width: 100%;
  background: #444;
  border-radius: 9px;
  opacity: 1;
  left: 0;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: 0.25s ease-in-out;
  -moz-transition: 0.25s ease-in-out;
  -o-transition: 0.25s ease-in-out;
  transition: 0.25s ease-in-out;
}

#nav-icon1 span:nth-child(1) {
  top: 0px;
}

#nav-icon1 span:nth-child(2) {
  top: 8px;
}

#nav-icon1 span:nth-child(3) {
  top: 16px;
}

#nav-icon1.open span:nth-child(1) {
  top: 8px;
  -webkit-transform: rotate(135deg);
  -moz-transform: rotate(135deg);
  -o-transform: rotate(135deg);
  transform: rotate(135deg);
}

#nav-icon1.open span:nth-child(2) {
  opacity: 0;
  left: -60px;
}

#nav-icon1.open span:nth-child(3) {
  top: 8px;
  -webkit-transform: rotate(-135deg);
  -moz-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  transform: rotate(-135deg);
}
.border--primary {
  border: 4px solid #ddae71;
}
.border-bottom--primary {
  border-bottom: 4px solid #ddae71;
}
.border-top--primary {
  border-top: 4px solid #ddae71;
}
</style>



