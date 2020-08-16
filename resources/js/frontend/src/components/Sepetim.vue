<template>
  <div>
    <!-- Panel Cart -->
    <div id="panel-cart" :class="{ 'show' : menuShow }" @click="menuShow = !menuShow">
      <div class="panel-cart-container">
        <div class="panel-cart-title">
          <h5 class="title">Sepetim</h5>
          <button class="close" data-toggle="panel-cart">
            <i class="ti ti-close"></i>
          </button>
        </div>
        <div class="panel-cart-content" v-if="userInfos.cardTotal !== undefined">
          <table class="table-cart">
            <tr v-for="(cartItem) in allCartItems" :key="cartItem.id">
              <td class="title">
                <span class="name">{{cartItem.name}}</span>
                <span class="caption text-muted">x{{cartItem.count}}</span>
              </td>
              <td class="price">{{cartItem.price}} ₺</td>
              <td class="actions">
                <!-- <a href="#productModal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>-->
                <a href="#" class="action-icon" @click="deleteCartItem(cartItem.id)">
                  <i class="ti ti-close"></i>
                </a>
              </td>
            </tr>
          </table>
          <div></div>
          <div class="cart-summary">
            <div class="row">
              <div class="col-7 text-right text-muted">Ara Toplam:</div>
              <div class="col-5">
                <strong>{{parseFloat(userInfos.cardTotal / 1.18).toFixed(2)}} ₺</strong>
              </div>
            </div>
            <div class="row">
              <div class="col-7 text-right text-muted">KDV:</div>
              <div class="col-5">
                <strong>{{parseFloat(userInfos.cardTotal - (userInfos.cardTotal / 1.18)).toFixed(2)}} ₺</strong>
              </div>
            </div>
            <hr class="hr-sm" />
            <div class="row text-lg">
              <div class="col-7 text-right text-muted">Toplam:</div>
              <div class="col-5">
                <strong>{{userInfos.cardTotal}}₺</strong>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-cart-content mx-auto" v-else>
          <div class="form-row" style="margin-left:33%">
            <div class="col-md-8">
              <h4 class="text-success mt-5">Lütfen Giriş Yapın !</h4>
            </div>

            <div class="col-md-4">
              <router-link to="/giris" class="btn btn-primary">
                >
                <span>Giriş Yap</span>
              </router-link>
            </div>
          </div>
          <div></div>
        </div>
      </div>
      <div
        @click="$router.push('/alisverisitamamla')"
        class="panel-cart-action btn btn-secondary btn-block btn-lg"
      >
        >
        <span>Alışverişi Tamamla</span>
      </div>
    </div>
    <!-- Body Overlay -->
    <div id="body-overlay"></div>
  </div>
</template>

<script>
import { EventBus } from "./../main.js";
import axios from "axios";
import { mapGetters, mapState } from "vuex";

export default {
  components: {},
  data() {
    return {
      menuShow: false
    };
  },
  computed: mapGetters(["allCartItems", "userInfos"]),

  methods: {
    // ...mapActions(['fetchCartItems']),
    deleteCartItem(productId) {
      console.log("silinecek id", productId);
      this.$store.dispatch("deleteCartItem", productId).then(res => {
        console.log(res);
      });
    }
  },
  created() {
    EventBus.$on("showPanel", data => {
      this.menuShow = data;
    });

    // this.fetchCartItems();
    // console.log(this.allCartItems);
  }
};
</script>