<template>
    <div class="main-panel">
        <div class="row" style="margin-top:70px;margin-left:30px">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Üye Takip</h5>
                        <button type="button">
                            <a
                                target="_blank"
                                class="btn btn-info btn-sm"
                                rel="noopener noreferrer"
                                href="/user/excel"
                                >Exel ÇIKTISI AL</a
                            >
                        </button>
                        <!-- <button type="button">
              <a
                target="_blank"
                class="btn btn-info btn-sm"
                rel="noopener noreferrer"
                href="admin/api/write/kurye/data"
              >PDF ÇIKTISI AL</a>
            </button>-->
                    </div>
                    <div class="card-body">
                        <v-client-table
                            :data="tableData"
                            :columns="columns"
                            :options="options"
                        ></v-client-table>
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
            columns: [
                "firstname",
                "lastname",
                "email",
                "phone",
                "addressContent",
                "ordersPriceTotal"
            ],
            tableData: [{}],

            options: {
                headings: {
                    firstname: "Adı",
                    lastname: "Soyadı",
                    email: "Email",
                    phone: "Telefon",
                    addressContent: "Adres",
                    ordersPriceTotal: "Toplam Harcama"
                },
                texts: {
                    filterPlaceholder: "Aranacak Kelimeyi Giriniz",
                    filter: "Ürün Arama :",
                    noResults: "Aramanızla ilgili eşleşme bulunamadı!",
                    count:
                        " {from} ile {to} arası -->  {count} Kayıt Bulunmaktadır.|{count} Kayıt|0  Kayıt",
                    limit: "Kayıtlar"
                },

                sortable: [
                    "firstname",
                    "lastname",
                    "email",
                    "phone",
                    "addressContent",
                    "ordersPriceTotal"
                ],
                filterable: [
                    "firstname",
                    "lastname",
                    "email",
                    "phone",
                    "addressContent",
                    "ordersPriceTotal"
                ],
                sortIcon: {
                    base: "fa",
                    is: "fa-sort",
                    up: "fa-sort-asc",
                    down: "fa-sort-desc"
                }
            }
        };
    },
    methods: {
        fetchUserInfo() {
            const url = "/admin/api/user/all";
            axios.get(url).then(res => {
                this.tableData = res.data;
            });
        }
    },
    created() {
        this.fetchUserInfo();
    }
};
</script>

<style></style>
