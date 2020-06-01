<template>
  <div>
    <!-- Page Title -->
    <div class="page-title bg-dark dark">
      <!-- BG Image -->
      <div class="bg-image bg-parallax">
        <img src="assets/img/photos/bg-croissant.jpg" alt />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 push-lg-4">
            <h1 class="mb-0">Ödeme Yap</h1>
            <!-- <h4 class="text-muted mb-0">Kebapçı Zeki Usta</h4> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Section -->
    <section class="section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 push-xl-8 col-lg-5 push-lg-7">
            <div class="shadow bg-white stick-to-content mb-4">
              <div class="bg-dark dark p-4">
                <h5 class="mb-0">Siparişiniz</h5>
              </div>
              <table class="table-cart">
                <tr v-for="cartItem in allCartItems" :key="cartItem.id">
                  <td class="title">
                    <span class="name">
                      <a href="#productModal" data-toggle="modal">{{ cartItem.name }}</a>
                    </span>
                    <span class="caption text-muted"></span>
                  </td>
                  <td class="price">{{ cartItem.price }}₺</td>
                  <td class="actions">
                    <!--     <a href="#productModal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>
                    -->
                    <a href="#" class="action-icon" @click="deleteCartItem(cartItem.id)">
                      <i class="ti ti-close"></i>
                    </a>
                  </td>
                </tr>
              </table>

              <div>
                <div class="cart-summary" v-if="userInfos.cardTotal !== undefined">
                  <div class="row">
                    <div class="col-7 text-right text-muted">Ara Toplam:</div>
                    <div class="col-5">
                      <strong>
                        {{ parseFloat(userInfos.cardTotal / 1.18).toFixed(2) }}
                        ₺
                      </strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-7 text-right text-muted">KDV:</div>
                    <div class="col-5">
                      <strong>
                        {{
                        parseFloat(
                        userInfos.cardTotal - userInfos.cardTotal / 1.18
                        ).toFixed(2)
                        }}
                        ₺
                      </strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-7 text-right text-muted">İndirimsiz Toplam:</div>
                    <div class="col-5">
                      <strong>{{ userInfos.cardTotal }}</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-7 text-right text-muted">İndirim Oranı:</div>
                    <div class="col-5">
                      <strong>%{{cupon}}</strong>
                    </div>
                  </div>
                  <hr class="hr-sm" />
                  <div class="row text-lg">
                    <div class="col-7 text-right text-muted">Toplam:</div>
                    <div class="col-5">
                      <strong>{{ (userInfos.cardTotal - userInfos.cardTotal * (cupon/100)).toFixed(2) }}₺</strong>
                    </div>
                  </div>

                  <div
                    @click="$router.push('/urunler')"
                    class="panel-cart-action btn btn-secondary btn-block btn-lg"
                  >
                    &gt;
                    <span>Alışverişe Devam Et!</span>
                  </div>
                </div>
                <div class="cart-summary" v-else>
                  <div class="row">
                    <div class="col-7 text-right text-muted">Ara Toplam:</div>
                    <div class="col-5">
                      <strong>0 ₺</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-7 text-right text-muted">KDV:</div>
                    <div class="col-5">
                      <strong>0 ₺</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-7 text-right text-muted">İndirimsiz Toplam:</div>
                    <div class="col-5">
                      <strong>0 ₺</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-7 text-right text-muted">İndirim Oranı:</div>
                    <div class="col-5">
                      <strong>%10</strong>
                    </div>
                  </div>

                  <hr class="hr-sm" />
                  <div class="row text-lg">
                    <div class="col-7 text-right text-muted">Toplam:</div>
                    <div class="col-5">
                      <strong>0₺</strong>
                    </div>
                  </div>

                  <div
                    @click="$router.push('/urunler')"
                    class="panel-cart-action btn btn-secondary btn-block btn-lg"
                  >
                    &gt;
                    <span>Alışverişe Devam Et!</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 pull-xl-4 col-lg-7 pull-lg-5">
            <div class="bg-white p-4 p-md-5 mb-4">
              <h4 class="border-bottom pb-4">
                <i class="ti ti-user mr-3 text-dark"></i>Kişisel Bilgiler
              </h4>
              <div class="row mb-5">
                <!-- Paragraph -->

                <!-- Modal / Demo -->
                <div class="modal fade" id="demoModal" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Adres Değiştir</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <i class="ti-close"></i>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h4 class="border-bottom pb-4">
                          <i class="ti ti-location-pin mr-3 text-dark"></i>
                          <span class="text-primary">{{ userInfos.adress }}</span>
                        </h4>

                        <div>
                          <h4
                            class="modal-title text-danger pb-4"
                            id="myModalLabel"
                          >Açık Adres Giriniz</h4>

                          <input
                            class="form-control"
                            placeholder="Adres Giriniz"
                            type="text"
                            v-model="secondAdress"
                          />
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-outline-danger"
                          data-dismiss="modal"
                        >Kapat</button>
                        <button
                          type="button"
                          @click="sendNewAdress"
                          class="btn btn-outline-info"
                        >Kaydet</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div>
                  <div class="col-md-12" v-show="userInfos.cardTotal !== undefined">
                    <div class="bg-dark dark example-box-title" style="color: white;">
                      Adres Bilgileri
                      <!-- <a href="#" data-target="#demoModal" data-toggle="modal"  style="float:right"   class="action-icon text-primary"><i class="text-lg ti ti-pencil"></i></a>
                      -->
                    </div>
                    <div class="example-box-content">
                      <h4 class="border-bottom pb-4">
                        <i class="ti ti-user mr-3 text-dark"></i>
                        <span class="text-dark">
                          {{ userInfos.firstname }}
                          {{ userInfos.lastname }}
                        </span>
                      </h4>
                      <h4 class="border-bottom pb-4">
                        <i class="ti ti-mobile mr-3 text-dark"></i>
                        <span class="text-dark">{{ userInfos.phone }}</span>
                      </h4>
                      <h4 class="pb-4">
                        <i class="ti ti-location-arrow mr-3 text-dark"></i>
                        <span class="text-dark">Teslimat Adresini Seçiniz</span>
                      </h4>

                      <div class="form-group">
                        <!-- <label class="custom-control custom-radio">
                                        <input type="radio" id="four" name="adress_type" class="custom-control-input" v-model="order.adress" value="adress" >
                                        <span class="custom-control-indicator"></span>
                                         <span class="custom-control-description">{{userInfos.adress}}</span>
                                  <h4 class=" pb-4"><i class="ti ti-location-pin mr-3 text-dark"></i><span class="text-dark">{{userInfos.adress}}</span><h2></h2></h4>

                        </label>-->
                        <div class="col-md-12 form-group text-lg" v-if="userInfos.adress != null">
                          <label class="custom-radio custom-control">
                            <input
                              type="radio"
                              name="adress_type"
                              class="span-indikator"
                              v-model="order.adress"
                              value="adress"
                            />

                            <h4 class="pb-4">
                              <i class="ti ti-location-pin mr-3 text-dark"></i>
                              <span class="text-dark">{{ userInfos.adress.content }}</span>
                              <h2></h2>
                            </h4>
                          </label>
                        </div>
                        <div class="col-md-12 form-group text-lg" v-if="userInfos.adress_2 != null">
                          <label class="custom-radio custom-control">
                            <input
                              type="radio"
                              id="adressTwo"
                              name="adress_type"
                              class="span-indikator"
                              v-model="order.adress"
                              value="adress_2"
                            />

                            <h4 class="pb-4">
                              <i class="ti ti-location-pin mr-3 text-dark"></i>
                              <span class="text-dark">{{ userInfos.adress_2.content }}</span>
                              <h2></h2>
                            </h4>
                          </label>
                        </div>
                        <div class="col-md-12 form-group text-lg" v-if="userInfos.adress_3 != null">
                          <label class="custom-radio custom-control">
                            <input
                              type="radio"
                              id="adressThree"
                              name="adress_type"
                              class="span-indikator"
                              v-model="order.adress"
                              value="adress_3"
                            />

                            <h4 class="pb-4">
                              <i class="ti ti-location-pin mr-3 text-dark"></i>
                              <span class="text-dark">{{ userInfos.adress_3.content }}</span>
                              <h2></h2>
                            </h4>
                          </label>
                        </div>

                        <!-- <div  v-if="userInfos.adress_2 != null " >

                                        <label  class="custom-control custom-radio">
                                        <input type="radio" id="five" name="adress_type"  class="custom-control-input" v-model="order.adress" value="adress_2" >
                                        <span class="custom-control-indicator">{{userInfos.adress_2}}</span>
                                         <h4 class=" pb-4"><i class="ti ti-location-pin mr-3 text-dark"></i><span class="text-dark">{{userInfos.adress_2}}</span><h2></h2></h4>

                                    </label>
                        </div>-->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" v-show="userInfos.cardTotal == undefined">
                    <div class="example-box-content">
                      <h4 class="pb-4">
                        <span class="text-dark">Lütfen Giriş Yapınız!</span>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>

              <h4 class="border-bottom pb-4">
                <i class="ti ti-package mr-3 text-primary"></i>Teslim
              </h4>
              <div class="row mb-5">
                <div class="form-group col-sm-6">
                  <label>Teslim zamanı:</label>
                  <div class="select-container">
                    <select class="form-control" v-model="order.selected">
                      <option disabled value>Lütfen seçiniz</option>
                      <option value="0">Hemen (20-30 dakika)</option>
                      <option value="1">1 Saat içinde</option>
                      <option value="2">2 Saat içinde</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-sm-6">
                  <label>Açık Adres Tarifi / Müşteri Yemek Notu :</label>
                  <textarea
                    class="form-control"
                    name
                    id
                    cols="30"
                    rows="5"
                    maxlength="225"
                    v-model="order.content"
                  ></textarea>
                </div>
              </div>

              <h4 class="border-bottom pb-4">
                <i class="ti ti-wallet mr-3 text-primary"></i>Ödeme
              </h4>
              <div class="row text-lg">
                <div class="col-md-4 col-sm-6 form-group">
                  <label class="custom-control custom-radio">
                    <input
                      type="radio"
                      id="one"
                      name="payment_type"
                      class="span-indikator"
                      v-model="order.picked"
                      value="0"
                    />

                    <span class="n"></span>
                    <p class="text-md" style="font-weight: 400;">Kapıda Kart İle</p>
                  </label>
                </div>
                <!-- <div class="col-md-4 col-sm-6 form-group">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" id="two" name="payment_type" class="span-indikator" v-model="order.picked" value="2">

                                        <span class="custom-control-description">Kredi Kartı </span>
                                    </label>
                </div>-->
                <div class="col-md-4 col-sm-6 form-group">
                  <label class="custom-control custom-radio">
                    <input
                      type="radio"
                      id="three"
                      name="payment_type"
                      class="span-indikator"
                      v-model="order.picked"
                      value="1"
                    />
                    <span class="custom-control-description">Nakit</span>
                  </label>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button
                data-toggle="modal"
                :data-target="'#modal' + order.picked"
                class="btn btn-primary btn-lg"
                @click="sendOrderDetail"
              >
                <span>Sipariş Et!</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal2"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Kart Bilgilerini Giriniz</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <article class="card">
              <div class="card-body p-5">
                <!--<p class="alert alert-success">Some text success or error  {{order}}
               </p>
                -->
                <form role="form">
                  <div class="form-group">
                    <label for="username">Kartın Üzerindeki Tam Ad</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="m-2 fa fa-3x fa-user"></i>
                        </span>
                      </div>
                      <input
                        v-model="order.name"
                        class="form-control"
                        type="text"
                        name="username"
                        placeholder
                        required
                      />
                    </div>
                    <!-- input-group.// -->
                  </div>
                  <!-- form-group.// -->

                  <div class="form-group">
                    <label for="cardNumber">Kart Numarası</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="m-2 fa fa-2x fa-credit-card"></i>
                        </span>
                      </div>
                      <input
                        v-model="order.cardNumber"
                        class="form-control"
                        type="text"
                        name="cardNumber"
                        placeholder
                      />
                    </div>
                    <!-- input-group.// -->
                  </div>
                  <!-- form-group.// -->

                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label>
                          <span class="hidden-xs">Tarih</span>
                        </label>
                        <div class="form-inline">
                          <select v-model="order.month" class="form-control" style="width: 45%;">
                            <option v-for="month in months" :key="month">{{ month }}</option>
                          </select>
                          <span style="width: 10%; text-align: center;">/</span>

                          <select v-model="order.year" class="form-control" style="width: 45%;">
                            <option v-for="year in years" :key="year">{{ year }}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label
                          data-toggle="tooltip"
                          title
                          data-original-title="3 digits code on back side of the card"
                        >
                          CVV
                          <i class="fa fa-question-circle"></i>
                        </label>
                        <input v-model="order.cvv" class="form-control" required type="text" />
                      </div>
                      <!-- form-group.// -->
                    </div>
                  </div>
                  <!-- row.// -->
                  <button
                    class="subscribe btn btn-primary btn-block"
                    type="button"
                    @click="sendCardDetail"
                  >Tamamla</button>
                </form>
              </div>
              <!-- card-body.// -->
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapActions, mapGetters, mapState } from "vuex";

import swal from "sweetalert";
export default {
  data() {
    return {
      cupon: 0,
      months: [],
      years: [],
      secondAdress: "",
      modalActive: false,
      newAdressAvaible: true,
      order: {
        picked: "",
        selected: "",
        month: null,
        year: null,
        cvv: null,
        cardNumber: null,
        name: null,
        content: "",
        adress: ""
      }
    };
  },

  computed: mapGetters(["allCartItems", "userInfos"]),
  methods: {
    getYears() {
      for (let m = 1; m <= 12; m++) {
        this.months.push(m);
      }
      let yearsToShow = 20;
      let thisYear = new Date().getFullYear();

      for (let y = thisYear; y < thisYear + yearsToShow; y++) {
        this.years.push(y.toString().substr(-2));
      }
      console.log(thisYear);
      console.log(this.months);
    },

    ...mapActions(["fetchCartItems"]),

    sendNewAdress() {
      const url = "user/newAdress";
      if (this.secondAdress != "") {
        axios
          .post(url, { adress: this.secondAdress })
          // this.$store.dispatch('sendSecondAdress',this.secondAdress)
          .then(() => {
            swal({
              title: "Teslimat Adresiniz Kayıt Edildi!",

              icon: "success",
              button: "Devam Et!",
              timer: 1500
            }).then(() => {
              location.reload();
            });
          });
      }
    },

    async sendCardDetail() {
      const order = await this.$store.dispatch("setOrderDetail", this.order);
      console.log("order", order);

      if (order.message.status == true && this.order.picked == 2) {
        location.href = "kullanici/odeme";
      } else {
        swal({
          title: "Kart Bilgileri Hatalı!",
          text: "",
          icon: "warning",
          button: "Devam Et!",
          timer: 1500
        });
      }
    },

    async sendOrderDetail() {
      try {
        if (this.order.adress != "") {
          const order = await this.$store.dispatch(
            "setOrderDetail",
            this.order
          );
          if (
            !order.message.error &&
            (this.order.picked == 0 || this.order.picked == 1)
          ) {
            swal({
              title: "Siparişiniz Verildi!",
              text: "",
              icon: "success",
              button: "Devam Et!",
              timer: 2500
            }).then(() => {
              console.log("çalıştı", order);
              this.$router.push("alisverisbitis");
            });
          }
        } else {
          swal({
            title:
              "Lütfen Adresinizi Seçiniz Yada Profil Kısmından Adres Ekleyiniz !",
            text: "",
            icon: "warning",
            button: "Devam Et!",
            timer: 1500
          });
        }
      } catch (error) {
        console.log("istek atılamadı");
        console.log(card);
      }
    },
    deleteCartItem(productId) {
      console.log("silinecek id", productId);
      this.$store.dispatch("deleteCartItem", productId).then(() => {
        location.reload();
      });
    },
    getCupon() {
      const url = "/cart/cupon";
      axios.get(url).then(res => {
        this.cupon = res.data.cartCupon;
      });
    }
  },

  created() {
    this.getCupon();
    this.getYears();
    this.fetchCartItems();
  }
};
</script>

<style>
.span-indikator {
  top: 0.1em;
  font-weight: 400;
  font-family: Oswald, sans-serif;
  width: 1.3em;
  height: 1.3em;
  margin-right: 0.5rem;
  background-color: rgb(255, 255, 255);
  border-radius: 50%;
  border-width: 2px;
  border-style: solid;
  border-color: rgb(224, 224, 224);
  border-image: initial;
}
</style>
