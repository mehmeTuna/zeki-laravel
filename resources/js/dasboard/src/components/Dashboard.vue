<template>
  <div class="main-panel">
    <div
      class="modal modal-search fade"
      id="searchModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="searchModal"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH" />
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="tim-icons icon-simple-remove"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Navbar -->
    <div class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-chart">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-9 text-center">
                  <h2 class="card-title">İş Zekası ve Karar Destek</h2>

                  <h5 class="card-category">Toplam Siparişler</h5>
                </div>
                <div class="col-sm-3">
                  <div class="container">
                    <div class="row">
                      <div class="col"></div>
                      <div class="col">
                        <div class="form-group">
                          <div class="row">
                            <select class="form-control" v-model="store.id">
                              <option disabled value>Seçiniz</option>
                              <option
                                :value="store.id"
                                v-for="store in storeList"
                                :key="store.id"
                              >{{ store.name }}</option>
                            </select>
                            {{store.id}}
                            <button
                              class="btn btn-info"
                              type="button"
                              @click="getStoreData"
                            >Değiştir</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart-area">
                <!-- <canvas id="chartBig1"></canvas> -->
                <Chart
                  v-if="loaded"
                  style="height:100%"
                  :chartdata="chartdata2"
                  :options="options"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-content">
              <div class="row" style="padding-top:10px">
                <div class="col-5">
                  <div class="icon-big text-center icon-warning">
                    <i class="tim-icons icon-chat-33"></i>
                  </div>
                </div>
                <div class="col-7">
                  <div style="float:right">
                    <p class="cart-category">Aylık Sipariş Tutarı</p>
                    <h3 class="card-title">{{ aylikToplamSatis.toFixed(2) }} TL</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr />
              <div class="card-stats">
                <i class="tim-icons icon-refresh-01"></i> Aylık
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-content">
              <div class="row" style="padding-top:10px">
                <div class="col-5">
                  <div class="icon-big icon-success text-center">
                    <i class="tim-icons icon-molecule-40"></i>
                  </div>
                </div>
                <div class="col-7">
                  <div style="float:right">
                    <p class="cart-category">Günlük Sipariş Tutarı</p>
                    <h3 class="card-title">
                      {{
                      günlükToplamSatis.toFixed(2)
                      }}
                      TL
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr />
              <div class="card-stats">
                <i class="tim-icons icon-sound-wave"></i> Bugün
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-content">
              <div class="row" style="padding-top:10px">
                <div class="col-5">
                  <div class="icon-big icon-danger text-center">
                    <i class="tim-icons icon-shape-star"></i>
                  </div>
                </div>
                <div class="col-7">
                  <div style="float:right">
                    <p class="cart-category">İptal Olan Siparişler</p>
                    <h3 class="card-title">{{ iptalSiparisData }}</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr />
              <div class="card-stats">
                <i class="tim-icons icon-trophy"></i> Son Bir
                Kaç Saat İçerisinde
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-content">
              <div class="row" style="padding-top:10px">
                <div class="col-5">
                  <div class="icon-big icon-danger text-center">
                    <i class="tim-icons icon-single-02"></i>
                  </div>
                </div>
                <div class="col-7">
                  <div style="float:right">
                    <p class="cart-category">Kayıtlı Kullanıcı Sayısı</p>
                    <h3 class="card-title">{{ userCount.count }}</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr />
              <div class="card-stats">
                <i class="tim-icons icon-trophy"></i> Son Bir
                Kaç Saat İçerisinde
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header">
              <h5 class="card-category">Kuryelerin Aylık Sipariş Teslim Sayısı</h5>
              <h3 class="card-title">
                <i class="tim-icons icon-bell-55 text-primary"></i>
                {{ kuryeToplamSiparis }} Adet
              </h3>
            </div>
            <div class="card-body">
              <div class="chart-area">
                <AylikChart
                  v-if="aylikLoaded"
                  style="height:100%"
                  :chartdata="chartdata1"
                  :options="Aylikoptions"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-chart">
            <div class="card-header">
              <h5 class="card-category">Aylık Sipariş Sayısı</h5>
              <h3 class="card-title">
                <i class="tim-icons icon-delivery-fast text-info"></i>
                {{ aylikSiparisSayisi }} Adet
              </h3>
            </div>
            <div class="card-body">
              <div class="chart-area">
                <!-- <canvas id="CountryChart"></canvas> -->
                <AylikChart
                  v-if="aylikLoaded"
                  style="height:100%"
                  :chartdata="chartdataAylik"
                  :options="Aylikoptions"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-chart">
            <div class="card-header">
              <h5 class="card-category">Günlük Tamamlanan Sipariş Sayısı</h5>
              <h3 class="card-title">
                <i class="tim-icons icon-send text-success"></i>
                {{ günlükSiparisSayisi }} Adet
              </h3>
            </div>

            <div class="card-body">
              <div class="chart-area">
                <Chart v-if="loaded" style="height:100%" :chartdata="chartdata" :options="options" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-content">
              <div class="row" style="padding-top:10px">
                <div class="col-5">
                  <div class="icon-big text-center icon-warning">
                    <i class="tim-icons icon-chat-33"></i>
                  </div>
                </div>
                <div class="col-7">
                  <div style="float:right">
                    <p class="cart-category">Site Durumunu Güncelle</p>
                    <h3 class="card-title">
                      <td class="text-center">
                        <toggle-button
                          v-model="siteOnlineValue"
                          :value="siteOnlineValue"
                          color="#82C7EB"
                          :sync="true"
                          :labels="{
                                                        checked: 'Açık',
                                                        unchecked: 'Kapalı'
                                                    }"
                        />
                      </td>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <hr />
              <div class="card-stats">
                <button type="button" class="btn btn-primary" @click="updateSiteDurum">Güncelle</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import Chart from "./Chart.vue";
import AylikChart from "./AylikChart.vue";

export default {
  components: {
    Chart,
    AylikChart
  },
  data() {
    return {
      store: {
        id: ""
      },
      loaded: false,
      aylikLoaded: false,
      chartdata: null,
      chartdata1: null,
      chartdata2: null,
      chartdataAylik: null,
      options: null,
      Aylikoptions: null,
      nakitData: 0,
      krediData: 0,
      kapidaData: 0,
      günlükToplamSatis: 0,
      aylikNakitData: 0,
      aylikKrediData: 0,
      aylikKapidaData: 0,
      aylikToplamSatis: 0,
      iptalSiparisData: 0,
      günlükSiparisSayisi: 0,
      aylikSiparisSayisi: 0,
      userCount: 0,
      kuryeToplamSiparis: 0,
      kuryeİsim: [],
      kuryeSiparis: [],
      updateKureSiparis: [],
      siteOnlineValue: null,
      storeList: [],
      storeStatics: {}
    };
  },
  computed: {
    ...mapGetters(["allDatas"]),
    kuryeChartData() {
      return this.kuryeSiparis;
    }
  },

  methods: {
    getStoreData() {
      if (this.store.id != "") {
        const url = `/data/get/store?store=${this.store.id}`;
        axios.get(url).then(res => {
          this.storeStatics = res.data.data;
          this.aylikToplamSatis = res.data.data.month.totalPrice;
          this.günlükToplamSatis = res.data.data.day.totalPrice;
          this.iptalSiparisData = res.data.data.month.cancel;
          console.log(this.kuryeSiparis);
          this.kuryeSiparis = [];
          this.kuryeİsim = [];
          res.data.data.month.kuryeData.forEach(element => {
            this.kuryeİsim.push(
              `${element.firstname + " " + element.lastname}`
            );
            this.kuryeSiparis.push(element.orderCount);
          });
          this.chartdata1.datasets[0].data = this.kuryeSiparis;
          this.chartdata1.labels = this.kuryeİsim;
        });
      }
    },
    updateSiteDurum() {
      const url = "/site/update";

      const result = this.siteOnlineValue == false ? 0 : 1;
      console.log(true);
      axios.post(url, { online: result }).then(res => {
        console.log(res);
      });
    },
    getStoreInfo() {
      let url = "/store/list";
      axios.get(url).then(res => {
        this.storeList = res.data;
        console.log(res);
      });
    }
  },

  async mounted() {
    await axios.get("admin/api/iptalorder").then(response => {
      this.iptalSiparisData = response.data.iptalCount;
    });
    await axios.get("admin/api/allKurye").then(res => {
      for (let i = 0; i < res.data.length; i++) {
        this.kuryeİsim.push(res.data[i].firstname + " " + res.data[i].lastname);
      }

      for (let i = 0; i < res.data.length; i++) {
        this.kuryeSiparis.push(res.data[i].siparis);
      }

      console.log(this.kuryeSiparis);
      let stringArray = this.kuryeSiparis;

      let newArray = stringArray.map(item => {
        return parseInt(item, 10);
      });

      function getSum(total, num) {
        return total + num;
      }

      this.kuryeToplamSiparis = newArray.reduce(getSum);
    });
    await axios.get("admin/api/thisdayorder").then(response => {
      this.nakitData = response.data.status[0];
      this.krediData = response.data.status[1];
      this.kapidaData = response.data.status[2];
      this.günlükToplamSatis = response.data.orderAmount;

      console.log(numbers);
      var numbers = response.data.status;

      function getSum(total, num) {
        return total + num;
      }
      this.günlükSiparisSayisi = numbers.reduce(getSum);

      this.chartdata = {
        labels: ["Nakit", "Kredi Kartı", "Kapıda Ödeme"],

        datasets: [
          {
            backgroundColor: ["rgba(66,134,121,0.15)"],
            borderColor: "#1f8ef1",
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: "#00d6b4",
            pointBorderColor: "rgba(255,255,255,0)",
            pointHoverBackgroundColor: "#00d6b4",
            pointBorderWidth: 10,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,

            label: "Ödeme Tipleri",
            data: [this.nakitData, this.kapidaData, this.krediData]
          }
        ]
      };

      this.chartdata2 = {
        labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran"],

        datasets: [
          {
            backgroundColor: ["rgba(66,134,121,0.15)"],
            borderColor: "#1f8ef1",
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: "#00d6b4",
            pointBorderColor: "rgba(255,255,255,0)",
            pointHoverBackgroundColor: "#00d6b4",
            pointBorderWidth: 10,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,

            label: "Ödeme Tipleri",
            data: [10, 60, 30, 0, 100, 200]
          }
        ]
      };
      this.chartdata1 = {
        labels: this.kuryeİsim,

        datasets: [
          {
            backgroundColor: ["rgba(66,134,121,0.15)"],
            borderColor: "#1f8ef1",
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: "#00d6b4",
            pointBorderColor: "rgba(255,255,255,0)",
            pointHoverBackgroundColor: "#00d6b4",
            pointBorderWidth: 10,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,

            label: "Götürülen Sipariş Sayısı",
            data: this.kuryeChartData
          }
        ]
      };

      this.options = {
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        responsive: true,

        tooltips: {
          backgroundColor: "#f5f5f5",
          titleFontColor: "#333",
          bodyFontColor: "#666",
          bodySpacing: 4,
          xPadding: 12,
          mode: "nearest",
          intersect: 0,
          position: "nearest"
        },

        scales: {
          yAxes: [
            {
              gridLines: {
                drawBorder: false,
                color: "rgba(29,140,248,0.1)",
                zeroLineColor: "transparent"
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 5,

                fontColor: "#9e9e9e"
              }
            }
          ],

          xAxes: [
            {
              gridLines: {
                drawBorder: false,
                color: "rgba(29,140,248,0.1)",
                zeroLineColor: "transparent"
              },

              ticks: {
                padding: 20,

                fontColor: "#9e9e9e"
              }
            }
          ]
        }
      };
      this.loaded = true;
    }),
      await axios.get("admin/api/thismonthorder").then(response => {
        this.aylikLoaded = false;

        this.aylikNakitData = response.data.status[0];
        this.aylikKrediData = response.data.status[1];
        this.aylikKapidaData = response.data.status[2];
        this.aylikToplamSatis = response.data.orderAmount;

        var numbers2 = response.data.status;

        function getSum(total, num) {
          return total + num;
        }
        this.aylikSiparisSayisi = numbers2.reduce(getSum);
        this.chartdataAylik = {
          labels: ["Nakit", "Kapıda Ödeme", "Kredi Kartı"],

          datasets: [
            {
              backgroundColor: ["rgba(66,134,121,0.15)"],
              borderColor: "#1f8ef1",

              borderWidth: 2,
              borderDash: [],
              borderDashOffset: 0.0,

              label: "Aylık Ödeme Tipleri",
              data: [
                this.aylikNakitData,
                this.aylikKrediData,
                this.aylikKapidaData
              ]
            }
          ]
        };
        this.Aylikoptions = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          responsive: true,

          tooltips: {
            backgroundColor: "#f5f5f5",
            titleFontColor: "#333",
            bodyFontColor: "#666",
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
          },

          scales: {
            yAxes: [
              {
                gridLines: {
                  drawBorder: false,
                  color: "rgba(29,140,248,0.1)",
                  zeroLineColor: "transparent"
                },
                ticks: {
                  suggestedMin: 0,
                  suggestedMax: 5,

                  fontColor: "#9e9e9e"
                }
              }
            ],

            xAxes: [
              {
                gridLines: {
                  drawBorder: false,
                  color: "rgba(29,140,248,0.1)",
                  zeroLineColor: "transparent"
                },

                ticks: {
                  padding: 20,

                  fontColor: "#9e9e9e"
                }
              }
            ]
          }
        };
        this.aylikLoaded = true;
      });
  },
  created() {
    this.getStoreInfo();
    const url = "admin/api/alluser";
    axios.get("/site/durum").then(res => {
      if (res.data.site_online === 0) {
        this.siteOnlineValue = false;
      } else {
        this.siteOnlineValue = true;
      }
    });
    axios.get(url).then(response => {
      this.userCount = response.data;
    });
  }
};
</script>

<style></style>
