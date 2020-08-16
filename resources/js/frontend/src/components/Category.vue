<template>
  <div>
    <!-- Page Content -->
    <div class="page-content">
      <div class="menu-categories">
        <div class="menu-categories--container">
          <div
            @click="currentTabProduct = catIndex"
            class="menu-categories--item"
            :class="[catIndex === currentTabProduct ? 'active' : '']"
            v-for="(product, catIndex) in allProducts"
            :key="product.id"
          >
            <div class="menu-categories--item-img">
              <img :src="product.categoryImage" alt />
            </div>
            <div class="menu-categories--item-text">{{ product.name }}</div>
          </div>
        </div>
      </div>
      <div class="product-cards">
        <div class="product-cards--container">
          <div class="product-cards--col">
            <div class="product-cards--grid">
              <transition-group name="fade">
                <div
                  class="product-card"
                  v-for="menuItem in allProducts[currentTabProduct].menuItems"
                  :key="menuItem.id"
                >
                  <div
                    class="product-card--img"
                    :style="{ backgroundImage: `url(${menuItem.img})` }"
                  ></div>
                  <div class="product-card--body">
                    <div class="product-card--title">{{ menuItem.name }}</div>
                    <!-- <div class="product-card--desc">
                                        {{menuItem.description}}
                    </div>-->
                    <div class="product-card--bottom">
                      <div class="product-card--price">{{ menuItem.price }} TL</div>
                      <div
                        class="btn-add-card"
                        @click="addProduct(menuItem)"
                        data-target="#productModal"
                        data-toggle="modal"
                      >Sepete Ekle</div>
                    </div>
                  </div>
                </div>
              </transition-group>
            </div>
          </div>
          <div class="product-sepet--col">
            <div class="product-sepet--container">
              <div class="sepet-title">
                <div>Sepetim</div>
                <div class="sepet-title--icon">
                  <img src="/assets/img/icons/shopping-cart.png" alt />
                </div>
              </div>
              <div class="sepet-products">
                <template
                  v-if="
                    userInfos.cardTotal !== undefined ||
                      userInfos.cardTotal === 0
                  "
                >
                  <div class="sepet-product" v-for="cartItem in allCartItems" :key="cartItem.id">
                    <div class="title">
                      <div class="name">{{ cartItem.name }}</div>
                      <div class="caption text-muted">x{{ cartItem.count }}</div>
                    </div>
                    <div class="price">{{ cartItem.price }} ₺</div>
                    <div class="actions">
                      <!-- <a href="#productModal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>-->
                      <div
                        style="cursor:pointer;"
                        @click="deleteCartItem(cartItem.id)"
                        class="action-icon"
                      >
                        <i class="ti ti-close"></i>
                      </div>
                    </div>
                  </div>
                  <div
                    @click="$router.push('/alisverisitamamla')"
                    class="panel-cart-action btn btn-secondary btn-block btn-lg"
                  >
                    &gt;
                    <span>Alışverişi Tamamla</span>
                  </div>
                </template>

                <div class="sepet-product" v-else>
                  <div
                    class="title"
                    style="width:100%;padding-top:10px;padding-bottom:10px;"
                  >Sepetinizde herhangi bir ürün bulunmamaktatır.</div>
                </div>
              </div>
            </div>
            <div class="product-sepet--banner">
              <img src="https://i.hizliresim.com/o1vJSC.png" alt />
            </div>
          </div>
        </div>
      </div>

      <!-- Modal / Product -->
      <div class="modal fade" id="productModal" style="margin-right:0 !important" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border--primary">
            <div class="modal-header">
              <!-- <div class="bg-image"><img src="assets/img/photos/modal-add.jpg" alt=""></div> -->
              <h3 class="mb-0" style="color:222;font-weight:500;font-size:28px;">{{ product.name }}</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="ti-close"></i>
              </button>
            </div>
            <div class="modal-product-details">
              <div class="modal-product--details-col">
                <div class="modal-product--img">
                  <img :src="product.img" alt />
                </div>
              </div>
              <div class="modal-product--details-col">
                <div class="text-dark">{{ product.description }}</div>
                <div
                  class="modal-product--price"
                >{{ parseFloat(product.price) * parseInt(product.quantity) }} ₺</div>
              </div>
              <!-- <div class="d-flex align-items-center">
                                <div class="col-6">
                                    <div class="modal-product--img">
                                        <img :src="product.img" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                   
                                    <span class="text-dark">{{product.description}}</span>
                                    <div class="modal-product--price">
                                        {{parseFloat(product.price)*parseInt(product.quantity)}} ₺
                                    </div>
                                </div>
                            product.price*product.quantity Sepete bu şekilde gönderilecek
                                <div class="col-2 text-lg text-danger text-right">{{parseFloat(product.price)*parseInt(product.quantity)}}₺</div>
              </div>-->
            </div>
            <div class="modal-body panel-details-container">
              <!-- Panel Details / Size -->
              <div class="panel-details" style="border:none;">
                <h5 class="panel-details-title">Adet</h5>
                <div id="panelDetailsSize" class="collapse show">
                  <div class="panel-details-content" style="border:none;">
                    <div class="form-group">
                      <div class="custom-control-description">
                        <div class="minusplusnumber">
                          <div class="mpbtn minus none-select" @click="product.quantity--">-</div>
                          <div id="field_container">
                            <span class="text-lg mr-4 ml-4 text-center none-select">
                              <span class="text-muted text-lg"></span>
                              {{ product.quantity }}
                            </span>
                          </div>
                          <div class="mpbtn plus none-select" @click="product.quantity++">+</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Panel Details / Additions -->
              <div class="panel-details">
                <h5 class="panel-details-title">Opsiyonlar</h5>
                <div id="panelDetailsAdditions" class="collapse show" aria-expanded="true">
                  <div class="panel-details-content" style="border-top:none">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group options">
                          <div
                            class="custom-control custom-checkbox option-checkboxes"
                            v-for="(option, i) in product.options"
                            :key="i"
                            @click="clickOption(option.id)"
                          >
                            <!-- <input type="checkbox" class="custom-control-input"> -->
                            <!-- <span class="custom-control-indicator"></span> -->
                            <input
                              id="cbx"
                              type="checkbox"
                              :checked="
                                pickedOptions.findIndex(
                                  item => item === option.id
                                ) != -1
                                  ? true
                                  : false
                              "
                            />
                            <label class="cbx">
                              <div class="flip">
                                <div class="front"></div>
                                <div class="back">
                                  <svg width="16" height="14" viewBox="0 0 16 14">
                                    <path d="M2 8.5L6 12.5L14 1.5" />
                                  </svg>
                                </div>
                              </div>
                            </label>
                            <span
                              class="custom-control-description none-select"
                            >{{ option.content }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Panel Details / Other -->
              <!--
                            <div class="panel-details">
                                <h5 class="panel-details-title">
                                    <label class="custom-control custom-radio">
                                        <input name="radio_title_other" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                    <a href="#panelDetailsOther" data-toggle="collapse">Diğer</a>
                                </h5>
                                <div id="panelDetailsOther" class="collapse">
                                    <textarea cols="30" rows="4" class="form-control" placeholder="Put this any other informations..."></textarea>
                                </div>
                            </div>
              -->
            </div>
            <button
              type="button"
              class="modal-btn btn btn-secondary btn-block btn-lg"
              @click="addProductToCart(product)"
              data-dismiss="modal"
            >
              <span>Sepete Ekle</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Body Overlay -->
    <div id="body-overlay"></div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import swal from "sweetalert";
import VueSticky from "vue-sticky";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      deneme: false,
      pickedOptions: [],
      product: {
        name: "",
        id: "",
        price: "",
        count: "",
        description: "",
        options: []
      },
      currentTabProduct: 0
    };
  },
  directives: {
    sticky: VueSticky
  },
  computed: {
    ...mapGetters(["allProducts", "userInfos", "allCartItems"])
    // product(){
    //     this.count=this.$store.getters.productDetailedOnSepet.count
    //     return this.$store.getters.productDetailedOnSepet
    // },
  },
  methods: {
    ...mapActions(["fetchProducts"]),
    //...mapActions('cart',['addProductToCart']),

    //  addProductToCart(menuItem){
    //  }
    deleteCartItem(productId) {
      console.log("silinecek id", productId);
      this.$store.dispatch("deleteCartItem", productId).then(() => {
        location.reload();
      });
    },
    addProduct(product) {
      this.pickedOptions = [];

      this.product = { ...product };
    },
    increment(index1, index2) {
      this.$store.dispatch("increment", { index1, index2 });
    },
    decrement(index1, index2) {
      this.$store.dispatch("decrement", { index1, index2 });
    },
    addProductToCart(product) {
      let menuItem = { ...product };
      menuItem.count = parseInt(menuItem.quantity);
      menuItem.price = parseFloat(menuItem.price) * parseInt(menuItem.quantity);
      menuItem.options = this.pickedOptions;
      this.$store.dispatch("addCartItem", menuItem);
      if (this.userInfos.firstname != undefined) {
        swal({
          title: "Sepete Eklendi!",
          text: menuItem.name,
          icon: "success",
          button: "Devam Et!",
          timer: 1000
        });
      } else {
        Swal.fire({
          title: "<strong>Dikkat ! </strong>",
          html:
            "Sipariş verebilmek için, " +
            '<a class="text-warning" href="/giris">Giriş</a>' +
            " yapmalısınız.<br>" +
            'Üye değilseniz  <a class="text-success" href="/uyeol">Kayıt ol</a> butonuna tıklayarak üye olabilirsiniz.',
          showCloseButton: true,
          showCancelButton: false,
          showConfirmButton: false,
          focusConfirm: false
        });
      }
    },
    updateCartItem(menuItem, index) {},
    clickOption(id) {
      const index = this.pickedOptions.findIndex(item => item === id);
      console.log(index, "index");
      if (index == -1) {
        this.pickedOptions.push(id);
      } else {
        this.pickedOptions.splice(index, 1);
      }
    },
    updateCartProduct(product) {
      this.$store.commit("updateCart", product);
      this.extraPrice = 0;
      this.pickedOptions = [];
    },
    deleteExtra() {
      this.extraPrice = 0;
      this.pickedOptions = [];
    }
  },
  created() {
    this.fetchProducts();
    //this.fetchCartItems();
    const tabIndex = this.$route.fullPath.split("?")[1];
    if (tabIndex !== undefined) {
      this.currentTabProduct = Number(tabIndex);
    }
  }
};
</script>
<style>
.swal2-popup {
  border: 4px solid #ddae71 !important;
}
.none-select {
  user-select: none;
}
.modal-header {
  padding: 18px 20px;
}
.modal-product-details {
  padding: 10px 0;
  display: flex;
  align-items: center;
}
.modal-product--details-col {
  padding: 10px 15px;
}
.modal-product--img {
  width: 100%;
  display: flex;
  justify-content: center;
}
.modal-product--img img {
  width: 90%;
  height: 90%;
  border-radius: 6px;
}
.modal-product--price {
  font-size: 20px;
  font-weight: 700;
}
.fade-enter {
  opacity: 0;
}
.fade-enter-active {
  transition: all 400ms;
}
.fade-leave {
}
.fade-leave-active {
  transition: all 400ms;
  opacity: 0;
}
.panel-details-title {
  padding: 7px 0 !important;
}
.options {
  /* display: flex; */
  align-items: center;
  justify-content: space-between;
}
.option-checkboxes {
  display: inline-flex;
  align-items: center;
  padding-left: 0 !important;
  margin-right: 0 !important;
}
.option-checkboxes label {
  margin-bottom: 0 !important;
}
.option-checkboxes span {
  margin: 5px;
}
.cbx {
  -webkit-perspective: 20;
  perspective: 20;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #e8e8eb;
  background: #e8e8eb;
  border-radius: 4px;
  transform: translate3d(0, 0, 0);
  cursor: pointer;
  transition: all 0.3s ease;
}
.cbx:hover {
  border-color: #0b76ef;
}
.flip {
  display: block;
  transition: all 0.4s ease;
  transform-style: preserve-3d;
  position: relative;
  width: 20px;
  height: 20px;
}
#cbx {
  display: none;
}
#cbx:checked + .cbx {
  border-color: #0b76ef;
}
#cbx:checked + .cbx .flip {
  transform: rotateY(180deg);
}
.front,
.back {
  backface-visibility: hidden;
  position: absolute;
  top: 0;
  left: 0;
  width: 20px;
  height: 20px;
  border-radius: 2px;
}
.front {
  background: #fff;
  z-index: 1;
}
.back {
  transform: rotateY(180deg);
  background: #0b76ef;
  text-align: center;
  color: #fff;
  line-height: 20px;
  box-shadow: 0 0 0 1px #0b76ef;
}
.back svg {
  margin-top: 3px;
  fill: none;
}
.back svg path {
  stroke: #fff;
  stroke-width: 2.5;
  stroke-linecap: round;
  stroke-linejoin: round;
}
body {
  -webkit-font-smoothing: antialiased;
}

.menu-categories {
  box-shadow: 3px 4px 25px -3px #ccccccc9;
  margin: 20px auto;
  padding-top: 10px;
  width: 82%;
  border-radius: 8px;
}
.menu-categories--container {
  display: flex;
  align-items: center;
  justify-content: center;
}
.menu-categories--item {
  width: 100%;
  height: 100%;
  /* height:80px; */
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  font-size: 18px;
  font-weight: 500;
  cursor: pointer;
  min-width: 113px !important;
}
.menu-categories--item-img {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50%;
  min-width: 61px;
  min-height: 61px;
}
.menu-categories--item-img img {
  width: 100%;
  height: 100%;
  min-height: 61px;
  min-width: 61px;
}
.menu-categories--item-text {
  padding-bottom: 10px;
}
.menu-categories--item.active {
  border-bottom: 3px solid #000;
  color: #000;
}
.product-cards--container {
  display: flex;
  align-items: flex-start;
  width: 90%;
  margin: 0 auto;
  padding: 50px 0;
}

.product-cards--col {
  width: 77%;
  padding: 0 15px;
}
.product-sepet--col {
  width: 23%;
}
.product-sepet--container {
  box-shadow: 4px 2px 25px -3px #ccccccc9;
}
.sepet-products {
}
.sepet-product {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 15px;
  border-bottom: 0.4px solid rgba(0, 0, 0, 0.3);
}
.sepet-product:last-child {
  border-bottom: none;
}
.product-sepet--banner {
  margin-top: 15px;
}
.product-sepet--banner img {
  width: 100%;
}
.sepet-title {
  padding: 15px;
  padding-right: 20px;
  background-color: #f0f0f0;
  font-size: 17px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.sepet-title--icon {
  width: 25px;
  height: 25px;
}
.sepet-title--icon img {
  width: 100%;
  height: 100%;
}
.sepet-product .title,
.sepet-product .price {
  font-size: 15px;
  font-weight: 500;
}

.sepet-product .title {
  width: 200px;
}
.sepet-product .caption {
  margin-top: -5px;
}
.product-cards--grid > span {
  width: 90%;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-gap: 15px 30px;
}
.product-card {
  border-radius: 8px;
  /* background-color: #f0f0f0; */
}
.product-card:hover {
}
.product-card--img {
  width: 100%;
  height: 330px;
  display: flex;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  background-position: center;
  /* background-size: cover; */
  background-repeat: no-repeat;
}
.product-card--title {
  padding-top: 0px !important;
  text-overflow: ellipsis;
  overflow: hidden;
  height: 64px;
  max-height: 64px;
}
.product-card--title,
.product-card--desc,
.product-card--bottom {
  padding-top: 15px;
}
.product-card--body {
  padding: 25px;
}
.product-card--title {
  font-size: 20px;
  font-weight: 600;
}
.product-card--desc {
  font-size: 16px;
}
.product-card--bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-bottom: 15px;
}
.product-card--price {
  font-size: 19px;
  font-weight: 500;
}
.btn-add-card {
  text-align: center;
  padding: 4px 8px;
  border: 1px solid #000;
  border-radius: 1.5rem;
  color: #000;
  font-size: 14px;
  font-weight: 400;
  cursor: pointer;
  transition: all 300ms;
}
.btn-add-card:hover {
  background-color: #333;
  color: #fff;
}
@media only screen and (max-width: 720px) {
  .product-card--title {
    font-size: 15px;
    font-weight: 600;
  }
}
@media only screen and (max-width: 1024px) {
  .product-cards--grid > span {
    width: 100%;
  }
}
@media only screen and (max-width: 991px) {
  .product-sepet--col {
    display: none;
  }
  .product-cards--col {
    width: 100%;
  }
}
@media only screen and (max-width: 960px) {
  .menu-categories {
    width: 100%;
  }
}
@media only screen and (max-width: 880px) {
  .menu-categories {
    overflow-x: scroll;
  }
  .menu-categories--container {
    width: 105%;
  }
}
@media only screen and (max-width: 825px) {
  .menu-categories {
    overflow-x: scroll;
  }

  .menu-categories::-webkit-scrollbar {
    -webkit-appearance: none;
  }

  .menu-categories-webkit-scrollbar:vertical {
    width: 11px;
  }

  .menu-categories-webkit-scrollbar:horizontal {
    height: 11px;
  }

  .menu-categories::-webkit-scrollbar-thumb {
    border-radius: 8px;
    border: 2px solid white; /* should match background, can't be transparent */
    background-color: rgba(0, 0, 0, 0.2);
  }
  .menu-categories--container {
    width: 125%;
  }
}
@media only screen and (max-width: 800px) {
  .product-cards--grid > span {
    width: 85%;
    grid-template-columns: 1fr 1fr;
    grid-gap: 25px 35px;
  }
}
@media only screen and (max-width: 620px) {
  .product-cards--grid > span {
    width: 85%;
    grid-template-columns: 1fr;
    grid-row-gap: 25px;
  }
  .menu-categories {
    margin: 0 auto;
  }
  .section.dark {
    padding-bottom: 18px;
  }
  .menu-categories--container {
    width: 150%;
  }
  .menu-categories--item {
    font-size: 17px;
    font-weight: 500;
  }
}
@media only screen and (max-width: 520px) {
  .menu-categories--container {
    width: 180%;
  }
}
@media only screen and (max-width: 420px) {
  .menu-categories--container {
    width: 220%;
  }
}
@media only screen and (max-width: 375px) {
  .menu-categories--container {
    width: 280%;
  }
}

.bg-resim {
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
.minusnumber {
  border: 1px solid silver;
  border-radius: 5px;
  background-color: #17a2b8;
  margin: 0 5px 0 5px;
  display: inline-block;
  user-select: none;
}
.lusnumber {
  border: 1px solid silver;
  border-radius: 5px;
  background-color: #17a2b8;
  margin: 0 5px 0 5px;
  display: inline-block;
  user-select: none;
}
.minusplusnumber div {
  display: inline-block;
  background-color: white;
}
.minusplusnumber #field_container input {
  width: 50px;
  text-align: center;
  font-size: 15px;
  padding: 3px;
  border: none;
}
.minusplusnumber .mpbtn {
  padding: 3px 10px 3px 10px;
  cursor: pointer;
  border-radius: 5px;
}
.minusplusnumber .mpbtn:hover {
  background-color: #0b76ef;
  color: #fff;
}
.minusplusnumber .mpbtn:active {
  color: #fff;

  background-color: #0b76ef;
}
.quantity {
  max-width: 150px;
  width: 100%;
}

.quantity input {
  text-align: center;
}
#panelDetailsSize .form-group {
  display: flex;
  align-items: center;
}
.active-checkbox {
  color: red;
}
</style>
