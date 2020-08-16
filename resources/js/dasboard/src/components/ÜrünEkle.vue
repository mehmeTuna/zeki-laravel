<template>
  <div class="main-panel">
    <div class="row" style="margin-top:75px;margin-left:30px">
      <div class="col-md-2"></div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Ürün Ekle</h5>
          </div>
          <div class="card-body">
            <div>
              <div class="row">
                <div class="col-md-5 pr-md-1">
                  <div class="form-group">
                    <label>Şirket</label>
                    <input type="text" class="form-control" disabled placeholder="Zeki Usta" />
                  </div>
                </div>
                <div class="col-md-3 px-md-1">
                  <div class="form-group">
                    <label>Ürün Adı</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Ürün Adı"
                      v-model="product.name"
                    />
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Fiyat</label>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Fiyat"
                      v-model="product.price"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 pr-md-1">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" v-model="product.categoryId">
                      <option disabled value>Seçiniz</option>
                      <option
                        :value="category.id"
                        v-for="category in categoryList"
                        :key="category.id"
                      >
                        {{ category.id }} :
                        {{ category.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3 pl-md-5">
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
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label>Açıklama</label>
                    <textarea
                      type="text"
                      class="form-control"
                      placeholder="Açıklama"
                      v-model="product.card_text"
                    ></textarea>
                  </div>
                </div>
                <div class="col-md-12 pl-md-2">
                  <div class="form-group">
                    <label>Opsiyon Ekleme-Silme</label>
                    <ul class="nav nav-main">
                      <li
                        v-for="(option,
                                                index) in product.options"
                        :key="option.id"
                      >
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Opsiyon"
                          v-model="option.option"
                        />

                        <button
                          @click="deleteRow(index)"
                          class="btn btn-fill btn-danger"
                        >Opsiyon Sil</button>
                      </li>
                    </ul>
                    <button @click="addRow" class="btn btn-fill btn-info">Opsiyon Ekle</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button @click="addProduct" class="btn btn-fill btn-primary">Kaydet</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-9" style="margin-left:20px">
        <div class="card card-user">
          <div class="card-body">
            <div class="table-responsive" style="overflow:auto">
              <table class="table tablesorter" id>
                <thead class="text-primary">
                  <tr>
                    <th>Ürün Adı</th>
                    <th>Fiyatı</th>
                    <th>Kategori</th>
                    <th class="text-center">Açıklama</th>
                    <th class="text-center">Resim</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="product in productList.slice(
                                            (page - 1) * displayAmount,
                                            displayAmount * page
                                        )"
                    :key="product.id"
                  >
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.categoryName }}</td>
                    <td class="text-center">{{ product.cardText }}</td>

                    <td></td>
                    <td class="text-center">
                      <button
                        @click="
                                                    deleteProduct(product.id)
                                                "
                        class="btn btn-fill btn-danger"
                      >Sil</button>
                    </td>
                    <td class="text-center">
                      <button
                        data-toggle="modal"
                        @click="changeProduct(product)"
                        data-target="#exampleModal"
                        class="btn btn-fill btn-info"
                      >Düzenle</button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <el-pagination
                @current-change="handleCurrentChange"
                background
                :current-page="page"
                layout="pager"
                :page-count="
                                    Math.ceil(
                                        productList.length / displayAmount
                                    )
                                "
              ></el-pagination>SA
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-9" style="margin-left:20px">
        <div class="card card-user">
          <div class="card-body">
            <div>
              <button
                @click="sortCategory(category)"
                v-for="category in categoryList"
                :key="category.id"
                type="button"
                class="btn btn-fill btn-info btn-sm m-1"
              >{{ category.name }}</button>
            </div>
            <div class="mt-4">
              <el-transfer
                :titles="['Eski Liste', 'Yeni Liste']"
                :button-texts="['Sola', 'Sağa']"
                filterable
                filter-placeholder="Ürün Arayınız!"
                v-model="value"
                :props="{ key: 'id', label: 'name' }"
                :data="data"
              ></el-transfer>
              {{ value }}
              <div>
                <button
                  type="button"
                  class="btn btn-fill btn-info"
                  @click="updateCategoryProductQueue"
                >SIRALA</button>
              </div>
            </div>
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
            <h5 class="modal-title" id="exampleModalLabel">Ürünü Düzenle</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="form-group col-md-12 mt-4">
            <div class="col-12">
              <label style="color:black">Fiyat</label>
              <input
                placeholder="Yeni Fiyat"
                class="form-control text-center"
                style="color:#606266"
                type="number"
                v-model="editProduct.price"
              />
            </div>
            <div class="col-12">
              <label style="color:black">İsim</label>
              <input
                placeholder="Yeni İsim"
                class="form-control text-center"
                style="color:#606266"
                type="text"
                v-model="editProduct.name"
              />
            </div>
            <div class="col-12">
              <label style="color:black">Açıklama</label>
              <input
                placeholder="Yeni Açıklama"
                class="form-control text-center"
                style="color:#606266"
                type="text"
                v-model="editProduct.cardText"
              />
            </div>
            <div class="col-12">
              <label style="color:black">Ürünü pasife Al</label>
              <toggle-button
                v-model="editProduct.live"
                :value="
                                    editProduct.live == 1
                                        ? editProduct.live == true
                                        : editProduct.live == false
                                "
                color="#82C7EB"
                :sync="true"
                :labels="{
                                    checked: 'Açık',
                                    unchecked: 'Kapalı'
                                }"
              />
              {{ editProduct.live }}
            </div>

            <!-- <div class="col-12">
                            <div class="col-12">
                                <label style="color:black">Resim</label>
                                <img
                                    height="128"
                                    class="img-responsive text-center mb-3"
                                    :src="
                                        updateFileUrl == null
                                            ? './admin/assets/default.png'
                                            : updateFileUrl
                                    "
                                />
                                <input
                                    class="form-control"
                                    ref="file"
                                    type="file"
                                    style="display:none"
                                    @change="onChangeUpdate($event)"
                                />
                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    @click="$refs.file.click()"
                                >
                                    Resim Seç
                                </button>
                            </div>
            </div>-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            <button
              type="button"
              class="btn btn-info"
              @click="updateProduct(editProduct.id)"
            >Değişikleri Kaydet</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import swal from "sweetalert";
import axios from "axios";
import Swal from "sweetalert2";
export default {
  data() {
    return {
      value: [],
      data: [],
      page: 1,
      displayAmount: 10,
      categoryList: [],
      productList: [],
      kuryeList: [],
      newArray: [],
      file: null,
      fileUrl: null,
      updateFile: null,
      updateFileUrl: null,
      editProduct: {
        id: "",
        name: "",
        price: "",
        cardText: "",
        selectedImage: null,
        live: false
      },

      product: {
        live: "1",
        name: "",
        price: "",
        card_text: "",
        numberProduct: 0,
        categoryId: 0,

        options: [],
        features: [],
        selectedImage: null
      }
    };
  },
  methods: {
    updateCategoryProductQueue() {
      const url = "/product/list";
      axios.post(url, { data: this.value }).then(res => {
        if (this.value !== [] && res.data.status === "ok") {
          Swal.fire({
            text: "Ürünler başarıyla Sıralandı",
            type: "success",
            timer: 2000
          }).then(() => {
            location.reload();
          });
        }
      });
    },
    sortCategory(category) {
      console.log(category);
      const result = this.productList.filter(
        product => product.categoryName == category.name
      );
      console.log(result);
      this.data = result;
    },
    filterCategory() {},
    handleCurrentChange(value) {
      this.page = value;
    },
    test(e) {
      console.log(e);
      console.log(this.row);
    },
    changeProduct(product) {
      console.log(product);
      if (product.live === 0) {
        product.live = false;
        this.editProduct = { ...product };
      } else {
        product.live = true;
        this.editProduct = { ...product };
      }
    },

    onChange(e) {
      this.file = e.target.files[0];
      console.log(this.file);
      this.fileUrl = URL.createObjectURL(this.file);
    },
    onChangeUpdate(e) {
      this.updateFile = e.target.files[0];
      this.updateFileUrl = URL.createObjectURL(this.updateFile);
    },
    addRow() {
      this.product.options.push({
        option: ""
      });

      // this.product.options.map((e) =>{
      //     if(e.option != '' ){
      //       this.newArray.push(e.option);
      //     }

      // });
    },

    deleteRow(index) {
      this.product.options.splice(index, 1);
      this.newArray.shift(index, 1);
    },

    deleteProduct(id) {
      const url = "/admin/api/product/del/" + id;

      axios.get(url);
    },
    updateProduct(id) {
      const url = "/product/update";
      this.editProduct.id = id;
      console.log(id);
      // const fd = new FormData();
      // fd.append("image", this.updateFile, this.updateFile.name);
      // fd.append("product", JSON.stringify(this.editProduct));
      if (this.editProduct.live == false) {
        this.editProduct.live = 0;
      } else {
        this.editProduct.live = 1;
      }
      axios.post(url, { id: id, product: this.editProduct }).then(res => {
        if (res.data.status === "ok") {
          Swal.fire({
            text: "Ürünler başarıyla Güncellendi",
            type: "success",
            timer: 2000
          }).then(() => {
            location.reload();
          });
        }
      });
      // this.updateFile = null;
      // this.updateFileUrl = null;
    },
    addProduct() {
      this.product.options.map(e => {
        if (e.option != "") this.newArray.push(e.option);
      });

      this.product.features = this.newArray;
      console.log(this.product.features);

      const fd = new FormData();
      fd.append("image", this.file);
      fd.append("product", JSON.stringify(this.product));
      console.log(this.product);

      const url = "/admin/api/newProduct";
      if (
        this.product.name != "" &&
        this.product.price != "" &&
        this.product.categoryId != null
      ) {
        axios
          .post(url, fd, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then(res => {
            console.log(res);

            if (res.data.status == "ok") {
              swal("Ürün Başarıyla Eklendi!", "", "success", {
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
    deleteProduct(id) {
      const url = "/admin/api/product/del/" + id;

      axios.get(url).then(res => {
        console.log(res);

        if (res.data.status == "ok") {
          swal("Ürün Başarıyla Silindi!", "", "success", {
            button: "Devam Et!",
            timer: 1500
          }).then(() => {
            location.reload();
          });
        } else {
          swal("Ürün Silinemedi!", "", "warning", {
            button: "Devam Et!",
            timer: 1500
          });
        }
      });
    }
  },
  created() {
    const url = "/admin/api/allCategory";
    axios.get(url).then(response => {
      this.categoryList = response.data;
    });

    const url2 = "/admin/api/allproduct";
    axios.get(url2).then(res => {
      this.productList = res.data;
      this.tableData = res.data;
    });
  }
};
</script>

<style></style>
