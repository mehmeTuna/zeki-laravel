<template>
  <div class="main-panel">
    <div class="row" style="margin-top:70px;margin-left:30px">
      <div class="col-md-2"></div>
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Ürün Takip</h5>
            <button type="button">
              <a
                target="_blank"
                class="btn btn-info btn-sm"
                rel="noopener noreferrer"
                href="admin/api/write/order/data"
              >PDF ÇIKTISI AL</a>
            </button>
              <button type="button">
                  <a
                      target="_blank"
                      class="btn btn-info btn-sm"
                      rel="noopener noreferrer"
                      href="admin/api/write/order/data/excel"
                  >EXCEl ÇIKTISI AL</a>
              </button>
          </div>
          <div class="card-body">
            <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
          </div>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { ClientTable } from "vue-tables-2";
export default {
  data() {
    return {
      columns: ["name", "count"],
      tableData: [{}],

      options: {
        headings: {
          name: "Ürün Adı",
          count: "Satış Sayısı"
        },
        texts: {
          filterPlaceholder: "Aranacak Kelimeyi Giriniz",
          filter: "Ürün Arama :",
          noResults: "Aramanızla ilgili eşleşme bulunamadı!",
          count:
            " {from} ile {to} arası -->  {count} Kayıt Bulunmaktadır.|{count} Kayıt| Tek Kayıt",
          limit: "Kayıtlar"
        },

        sortable: ["count", "name"],
        filterable: ["count", "name"],
        sortIcon: {
          base: "fa",
          is: "fa-sort",
          up: "fa-sort-asc",
          down: "fa-sort-desc"
        }
      }
    };
  },

  methods: {},
  created() {
    const url = "admin/api/orderDetay/year";
    axios.get(url).then(res => {
      console.log(res.data);
      this.tableData = res.data;
    });
  }
};
</script>

<style  >
</style>

