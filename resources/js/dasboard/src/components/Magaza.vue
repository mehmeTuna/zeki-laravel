<template>
  <div class="main-panel">
    <div class="row" style="margin-top:75px;margin-left:30px">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Şube Ekle</h5>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-5 pr-md-1">
                  <div class="form-group">
                    <label>Şirket</label>
                    <input type="text" class="form-control" disabled placeholder="Zeki Usta" />
                  </div>
                </div>
                <div class="col-md-3 px-md-1">
                  <div class="form-group">
                    <label>Şube Adı</label>
                    <input
                      v-model="companyName"
                      type="text"
                      class="form-control"
                      placeholder="Kategori Adı"
                    />
                  </div>
                  {{ companyName }}
                </div>
              </div>
              <div class="row">
                <div>
                  <h3>
                    -> Tüm ürünleri sıraladıktan sonra
                    sıralaya basınız.
                  </h3>
                  <el-transfer
                    v-model="value"
                    :data="this.adressList"
                    :props="{ key: 'id', label: 'name' }"
                    :button-texts="['Sola', 'Sağa']"
                    filterable
                  ></el-transfer>
                  {{ value }}
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text">
            <button @click="sendCompanyInfos" type="submit" class="btn btn-fill btn-primary">Kaydet</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8" style="margin-left:20px">
        <div class="card card-user">
          <div class="card-body">
            <div class="table-responsive" style="overflow:auto">
              <table class="table tablesorter">
                <thead class="text-primary">
                  <tr>
                    <th>Magaza Adı</th>
                    <th>Mağaza Detayları</th>
                    <th>İşlemler</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="shop in shopList" :key="shop.id">
                    <td>{{ shop.name }}</td>
                    <td v-for="location in shop" :key="location.id">{{ location }}</td>
                    <td>
                      <button
                        data-toggle="modal"
                        data-target="#exampleModal"
                        @click="updateShop(shop)"
                        class="btn btn-fill btn-sm btn-info"
                      >Düzenle</button>
                      <button
                        @click="deleteShop(shop.id)"
                        class="btn btn-fill btn-sm btn-danger"
                      >Sil</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="height:150%;width:150%">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Mağaza Güncelleme</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form-group col-md-12 mt-4">
              <div class="col-12">
                <label style="color:black">Mağaza İsmi</label>
                <input
                  v-model="updateStore.name"
                  placeholder="Yeni Mağaza İsmi"
                  class="form-control text-center"
                  style="color:#606266"
                  type="text"
                />
                <div class="row">
                  <div>
                    <h3 class="text-primary">
                      -> Tüm ürünleri sıraladıktan sonra
                      sıralaya basınız.
                    </h3>
                    <el-transfer
                      v-model="updateStore.locations[0]"
                      :data="this.adressList"
                      :props="{ key: 'id', label: 'name' }"
                      :button-texts="['Sola', 'Sağa']"
                      filterable
                    ></el-transfer>
                    {{ updateStore }}
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
              <button type="button" class="btn btn-info" @click="updateStoreInfo">Değişikleri Kaydet</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-8 ml-4"></div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  data() {
    return {
      companyName: "",
      shopList: [],
      adressList: [],
      value: [],
      updateStore: {
        id: "",
        name: "",
        locations: [[]]
      }
    };
  },
  methods: {
    sendCompanyInfos() {
      console.log(this.companyName);
      let url = "/store/create";
      axios
        .post(url, { name: this.companyName, address: this.value })
        .then(res => {
          if (res.data.message != "") {
            Swal.fire({
              text: "Şube başarıyla Eklendi",
              type: "success",
              timer: 2000
            });
          } else {
            Swal.fire({
              text: "Şube eklenemedi",
              type: "info",
              timer: 2000
            });
          }
        });
    },
    getCompanyInfos() {
      let url = "/store/list";
      axios.get(url).then(res => {
        this.shopList = res.data;
      });
    },
    getAdressList() {
      const url = "/addressList";
      axios.get(url).then(res => {
        this.adressList = res.data;
        console.log(this.adressList);
      });
    },

    updateShop(shop) {
      console.log(shop);
      shop.locations[0] = [];
      this.updateStore = shop;
    },
    deleteShop(id) {
      const url = "/store/delete/" + id;
      axios.delete(url).then(res => {
        console.log(res.data);
      });
    },
    updateStoreInfo() {
      const url = "/store/update";
      axios
        .post(url, {
          id: this.updateStore.id,
          name: this.updateStore.name,
          address: this.updateStore.locations
        })
        .then(res => {
          console.log(res);
        });
    }
  },
  created() {
    this.getCompanyInfos();
    this.getAdressList();
  }
};
</script>

<style></style>
