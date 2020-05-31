<template>
  <div class="main-panel">
    <div class="row" style="margin-top:70px;margin-left:30px">
      <div class="col-md-2"></div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Kullanıcı Ekle</h5>
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
                    <label>Mail</label>
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Email "
                      v-model="kullanici.email"
                    />
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Şifre</label>
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Şifre"
                      v-model="kullanici.password"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-md-1">
                  <div class="form-group">
                    <label>Ad-Soyad</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Ad-Soyad"
                      v-model="kullanici.name"
                    />
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label>Mağaza</label>
                    <select class="form-control" v-model="kullanici.store">
                      <option disabled value>Seçiniz</option>
                      <option
                        :value="store.id"
                        v-for="store in stores"
                        :key="store.id"
                      >{{store.name}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label>Yetki</label>
                    <select class="form-control" v-model="kullanici.authority">
                      <option disabled value>Seçiniz</option>
                      <option
                        :value="yetki.number"
                        v-for="yetki in yetkiList"
                        :key="yetki.number"
                      >{{yetki.derece}} - {{yetki.number}}</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <button type="submit" @click="sendUserDetail" class="btn btn-fill btn-primary">Ekle</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-2" style="margin-left:20px"></div>
      <div class="col-md-8">
        <div class="card card-user">
          <div class="card-body">
            <div class="table-responsive" style="overflow:auto">
              <table class="table tablesorter" id>
                <thead class="text-primary">
                  <tr>
                    <th>İd</th>
                    <th>Email</th>
                    <th>Ad-Soyad</th>
                    <th class="text-center">Yetki Alma</th>
                    <th class="text-center">Okuma Yetkisi</th>
                    <th class="text-center">Yazma Yetkisi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in userList" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.name}}</td>
                    <td class="text-center">
                      <toggle-button
                        @change="updateRoles(0 , user.id)"
                        :value="user.authority == 0 ? true : false"
                        color="#82C7EB"
                        :sync="true"
                        :labels="true"
                      />
                    </td>
                    <td class="text-center">
                      <toggle-button
                        @change="updateRoles(1 ,user.id)"
                        :value="(user.authority == 1 || user.authority == 2  ) ? true : false "
                        color="#82C7EB"
                        :sync="true"
                        :labels="true"
                      />
                    </td>
                    <td class="text-center">
                      <toggle-button
                        @change="updateRoles(2 ,user.id )"
                        :value="user.authority == 2 ? true : false "
                        color="#82C7EB"
                        :sync="true"
                        :labels="true"
                      />
                    </td>

                    <td class="text-center">
                      <button @click="deleteKullanici(user.id)" class="btn btn-fill btn-info">Sil</button>
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
import swal from "sweetalert";
import axios from "axios";
export default {
  data() {
    return {
      userList: [],
      yetkiList: [
        { derece: "Okuma", number: 1 },
        { derece: "Okuma-Yazma", number: 2 }
      ],
      stores: "",
      kullanici: {
        email: "",
        password: "",
        name: "",
        authority: ""
      }
    };
  },

  methods: {
    updateRoles(value = null, userId = null) {
      let authority = 0;

      if (value == null || userId == null) {
        console.log("Boş değerler var");
        return;
      }

      this.userList.map(function(userData) {
        if (userData.id == userId) {
          if (value == 0) {
            authority = userData.authority =
              userData.authority == value ? 1 : value;
          } else if (value == 1) {
            authority = userData.authority =
              userData.authority == value || userData.authority == 2
                ? 0
                : value;
          } else if (value == 2) {
            authority = userData.authority =
              userData.authority == value ? 1 : value;
          }
        }
        return value;
      });

      let user = {
        id: userId,
        authority: authority
      };

      this.sendUserUpdate(user);
    },

    sendUserUpdate(userData = null) {
      if (userData == null) return;

      const url = "/admin/api/updatecalisan";

      axios.post(url, userData).then(response => {
        swal("Değiştirildi", {
          button: "Devam Et!",
          timer: 2000
        });
      });
    },

    sendUserDetail() {
      const url = "/admin/api/newCalisan";
      if (
        this.kullanici.mail != "" &&
        this.kullanici.password != "" &&
        this.kullanici.name != "" &&
        this.kullanici.authority != ""
      ) {
        axios.post(url, this.kullanici).then(response => {
          console.log(response.data);

          if (response.data.status == "ok") {
            swal("Kullanıcı Başarıyla Eklendi!", "", "success", {
              button: "Devam Et!",
              timer: 1500
            }).then(() => {
              location.reload();
            });
          }
        });
      } else {
        swal("Kullanıcı Eklenemedi!", "", "warning", {
          button: "Devam Et!",
          timer: 1500
        });
      }
    },
    deleteKullanici(id) {
      const url = "/admin/api/delCalisan/" + id;

      axios.get(url).then(res => {
        if (res.data.status == "ok") {
          swal("Kullanıcı Başarıyla Silindi!", "", "success", {
            button: "Devam Et!",
            timer: 1500
          }).then(() => {
            location.reload();
          });
        } else {
          swal("Kullanıcı Silinemedi!", "", "warning", {
            button: "Devam Et!",
            timer: 1500
          });
        }
      });
    },
    getStores() {
      const url = "/store/list";
      axios.get(url).then(res => {
        this.stores = res.data;
      });
    }
  },
  created() {
    const url = "/admin/api/allWorker";
    axios.get(url).then(response => {
      console.log(response.data);
      this.userList = response.data;
    });
    this.getStores();
  }
};
</script>

<style>
</style>
