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
                  {{companyName}}
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
                    <th>Kategori Adı</th>
                    <th>İşlemler</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="shop in shopList" :key="shop.id">
                    <td>{{ shop.name }}</td>

                    <td>
                      <button
                        data-toggle="modal"
                        data-target="#exampleModal"
                        @click="changeShop(shop)"
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
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  data() {
    return {
      companyName: "",
      shopList: [
        { id: 1, name: "Türkmen Başı Şubesi" },
        { id: 2, name: "Kenan Evren Şubesi" },
        { id: 3, name: "Mersin  Şubesi" }
      ]
    };
  },
  methods: {
    sendCompanyInfos() {
      console.log(this.companyName);
      let url = "";
      axios.post(url, this.companyName).then(res => {
        console.log(res);
      });
      Swal.fire({
        text: "Şube başarıyla Eklendi",
        type: "success",
        timer: 2000
      });
    },
    changeShop(shop) {
      console.log(shop);
    },
    deleteShop(id) {
      console.log(id);
    }
  }
};
</script>

<style>
</style>