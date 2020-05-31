<template>
  <div class="sidebar">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
    <div class="sidebar-wrapper">
      <div class="logo">
        <a href="javascript:void(0)" class="simple-text logo-mini">ZU</a>
        <a href="javascript:void(0)" class="simple-text logo-normal">Zeki Usta</a>
      </div>
      <ul class="nav" style="margin-bottom:100px">
        <li>
          <router-link tag="a" to="/admin">
            <i class="tim-icons icon-chart-bar-32"></i>

            <p>Dashboard</p>
          </router-link>
        </li>
        <!--
          <li>
            <a href="./icons.html">
              <i class="tim-icons icon-atom"></i>
              <p>Yetkilendirme</p>
            </a>
          </li>
        -->
        <li>
          <router-link tag="a" to="/admin/adduser">
            <i class="tim-icons icon-single-02"></i>
            <p>Kullanıcı Ayarları</p>
          </router-link>
        </li>

        <li>
          <router-link tag="a" to="/admin/kurye">
            <i class="tim-icons icon-simple-add"></i>
            <p>Kurye Ekleme</p>
          </router-link>
        </li>
        <li>
          <router-link tag="a" to="/admin/addproduct">
            <i class="tim-icons icon-simple-add"></i>
            <p>Ürün Ekleme</p>
          </router-link>
        </li>
        <li>
          <router-link tag="a" to="/admin/addcategory">
            <i class="tim-icons icon-simple-add"></i>
            <p>Kategori Ekleme</p>
          </router-link>
        </li>

        <li>
          <router-link tag="a" to="/admin/rezervasyon">
            <i class="tim-icons icon-align-center"></i>
            <p>Rezervasyon</p>
          </router-link>
        </li>
        <li>
          <router-link tag="a" to="/admin/satistakip">
            <i class="tim-icons icon-basket-simple"></i>
            <p>Satış Takip</p>
          </router-link>
        </li>
        <li>
          <router-link tag="a" to="/admin/kuryetakip">
            <i class="tim-icons icon-basket-simple"></i>
            <p>Kurye Takip</p>
          </router-link>
        </li>
        <li>
          <router-link tag="a" to="/admin/uyetakip">
            <i class="tim-icons icon-notes"></i>
            <p>Üye Takip</p>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },

  methods: {}
};
</script>

<style>
</style>
