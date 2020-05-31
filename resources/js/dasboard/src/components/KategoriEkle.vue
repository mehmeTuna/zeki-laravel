<template>
  <div class="main-panel">
    <div class="row" style="margin-top:75px;margin-left:30px">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Kategori Ekle</h5>
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
                    <label>Kategori Adı</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Kategori Adı"
                      v-model="category.name"
                    />
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="col-md-12 pl-md-5">
                    <div class="form-group">
                      <img
                        height="128"
                        class="img-responsive text-center mb-3"
                        :src="
                          fileUrl == null
                            ? './admin/assets/default.png'
                            : fileUrl
                        "
                      />
                      <input
                        class="form-control"
                        ref="file"
                        type="file"
                        style="display:none"
                        @change="onChange($event)"
                      />
                      <button
                        class="btn btn-outline-secondary"
                        type="button"
                        @click="$refs.file.click()"
                      >Resim Seç</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text">
            <button @click="addCategory" type="submit" class="btn btn-fill btn-primary">Kaydet</button>
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
              <table class="table tablesorter" id>
                <thead class="text-primary">
                  <tr>
                    <th>Kategori Adı</th>
                    <th>Dosya Yolu</th>
                    <th>Dosya Resmi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="category in categoryList" :key="category.id">
                    <td>{{ category.name }}</td>
                    <td>
                      <a :href="category.img" target="_blank">
                        {{
                        category.img
                        }}
                      </a>
                    </td>
                    <td>
                      <img
                        height="80"
                        class="img-responsive text-center mb-3"
                        :src="category.img"
                        alt
                      />
                    </td>
                    <td class="text-center">
                      <button
                        data-toggle="modal"
                        data-target="#exampleModal"
                        @click="changeCategory(category)"
                        class="btn btn-fill btn-info"
                      >Düzenle</button>
                    </td>
                    <td class="text-center">
                      <button
                        @click="deleteCategory(category.id)"
                        class="btn btn-fill btn-danger"
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
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-9 ml-4">
        <h3>-> Tüm ürünleri sıraladıktan sonra sıralaya basınız.</h3>
        <el-transfer
          v-model="value"
          :data="this.categoryList"
          :props="{ key: 'id', label: 'name' }"
        ></el-transfer>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-9 ml-4">
        <button @click="sortCategory" class="btn btn-fill btn-info">Sırala</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Ürünü Düzenle</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="form-group col-md-12 mt-4">
            <div class="col-12">
              <label style="color:black">Kategori İsmi</label>
              <input
                placeholder="Yeni Kategori İsmi"
                class="form-control text-center"
                style="color:#606266"
                type="text"
                v-model="updateNewCategory.name"
              />
            </div>

            <div class="col-12 mt-4">
              <label style="color:black">Resim</label>
              <img
                height="128"
                class="img-responsive text-center mb-3"
                :src="updateFileUrl == null ? './admin/assets/default.png' : updateFileUrl "
              />
              <input
                class="form-control"
                ref="file2"
                type="file"
                style="display:none"
                @change="onChangeUpdate($event)"
              />
              <button
                class="btn btn-outline-secondary"
                type="button"
                @click="$refs.file2.click()"
              >Resim Seç</button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            <button type="button" class="btn btn-info" @click="updateCategory">Değişikleri Kaydet</button>
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
      value: [],
      categoryList: [],
      updateNewCategory: {
        name: ""
      },
      file: null,
      fileUrl: null,
      updateFile: null,
      updateFileUrl: null,
      category: {
        name: ""
      }
    };
  },
  methods: {
    sortCategory() {
      if (this.value != "") {
        const url = "category/list";
        axios.post(url, { data: this.value }).then(res => {
          console.log(res);
        });
      }
    },
    changeCategory(category) {
      this.updateNewCategory = { ...category };
      console.log(category);
    },
    onChange(e) {
      this.file = e.target.files[0];
      this.fileUrl = URL.createObjectURL(this.file);
    },
    onChangeUpdate(e) {
      this.updateFile = e.target.files[0];
      this.updateFileUrl = URL.createObjectURL(this.updateFile);
    },
    updateCategory() {
      console.log(this.updateNewCategory);
      const url = "admin/api/category/update";
      const fd = new FormData();
      fd.append("image", this.updateFile, this.updateFile.name);
      fd.append("name", this.updateNewCategory.name);
      fd.append("id", this.updateNewCategory.id);

      //  console.log(this.updateFile)
      //  this.updateFile = null;
      //  this.updateFileUrl = null;

      if (this.updateNewCategory.name != "" && this.updateFile != null) {
        axios
          .post(url, fd, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then(res => {
            console.log(res);

            if (res.data.status == "ok") {
              swal("Kategori Başarıyla Güncellendi!", "", "success", {
                button: "Devam Et!",
                timer: 1500
              }).then(() => {
                location.reload();
              });
            }
          });
      } else {
        swal("Kategori Güncellenmedi!", "", "warning", {
          button: "Devam Et!",
          timer: 1500
        });
      }
    },

    addCategory() {
      const fd = new FormData();
      fd.append("image", this.file);
      fd.append("category", JSON.stringify(this.category));
      const url = "/admin/api/newCategory";
      if (this.category.name != "") {
        axios.post(url, fd).then(res => {
          console.log(res);

          if (res.data.status == "ok") {
            swal("Kategori Başarıyla Eklendi!", "", "success", {
              button: "Devam Et!",
              timer: 1500
            }).then(() => {
              location.reload();
            });
          }
        });
      } else {
        swal("Ürün Eklenemedi!", "", "warning", {
          button: "Devam Et!",
          timer: 1500
        });
      }
    },
    deleteCategory(id) {
      const url = "/admin/api/delCategory/" + id;

      axios.get(url).then(res => {
        console.log(res);

        if (res.data.status == "ok") {
          swal("Kategori Başarıyla Silindi!", "", "success", {
            button: "Devam Et!",
            timer: 1500
          }).then(() => {
            location.reload();
          });
        } else {
          swal("Kategori Silinemedi!", "", "warning", {
            button: "Devam Et!",
            timer: 1500
          });
        }
      });
    }
  },
  created() {
    const url = "/admin/api/allCategory";
    const url2 = "https://next.json-generator.com/api/json/get/EJNFXxsPO";
    axios.get(url).then(response => {
      this.categoryList = response.data;
      console.log(this.categoryList);
    });
  }
};
</script>

<style></style>
