<template>
    <div class="row justify-content-between">
        <div class="card shadow mb-4 col-md-12 col-lg-12">
            <div class="card-header py-3 row justify-content-between">
                <p class="m-0 font-weight-bold text-primary">Rezervasyonlar </p>
                <p class="m-0 font-weight-bold text-primary">Son Guncelleme: {{this.updatedTime}}</p>
            </div>
            <div class="mt-4" >
        <div class="table-responsive">
            <div class="table table-bordered dataTable">
                <table class="table table-bordered dataTable" >
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" >Onay</th>
                        <th class="sorting" >Ad Soyad	</th>
                        <th class="sorting" >Telefon</th>
                        <th class="sorting" >Kişi Sayısı</th>
                        <th class="sorting" >Email</th>
                        <th class="sorting" >Açıklama</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr role="row">
                        <th class="sorting_asc">Onay</th>
                        <th class="sorting">Ad Soyad</th>
                        <th class="sorting">Telefon</th>
                        <th class="sorting">Kişi Sayısı</th>
                        <th class="sorting">Email</th>
                        <th class="sorting">Açıklama</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr role="row" class="odd" v-for="rezer in rezerData" :key="rezer.id">
                        <td class="text-center text-primary">
                            <i v-on:click="editRezer(rezer)" class="fas fa-pencil-alt" style="cursor: pointer"></i>
                        </td>
                        <td>{{rezer.name}}</td>
                        <td>{{rezer.phone}}</td>
                        <td>{{rezer.kisi_sayisi}}</td>
                        <td>{{rezer.e_mail}}</td>
                        <td>{{rezer.message}}</td>
                    </tr></tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
</template>

<script>
    import swal from "sweetalert";
    import Axios from "axios";

    export default {
        name: "RezervasyonList",
        props: {
            rezerData: {
                required: true
            },
            updatedTime:{
                required: true,
            },
            statusType :{
                required: false,
                default: 'gelen'
            }
        },
        mounted() {

        },
        methods: {
            editRezer: function(val){
                swal({
                    title: `${val.id} nolu Rezervasyonu onaylamak istiyormusunuz ?`,
                    buttons: {
                        iptal: {
                            text: "Iptal Et",
                            value: "iptal",
                            className: "btn-danger"
                        },
                        onayla:{
                            text: 'Onayla',
                            value: 'onay',
                            className: 'btn-success'
                        },
                        vazgec: {
                            text: "vazgec",
                            value: "vazgec"
                        }
                    }
                }).then(value => {
                    switch (value) {
                        case "iptal":
                            Axios.post("/rezervasyon/update", {
                                id: val.id,
                                status: "iptal"
                            }).then(res => {
                                swal({
                                    title: "Rezervasyon Iptal Edildi"
                                });
                            });
                            break;
                            case 'onay':
                                Axios.post("/rezervasyon/update", {
                                    id: val.id,
                                    status: "onay"
                                }).then(res => {
                                    swal({
                                        title: "Rezervasyon Onaylandi"
                                    });
                                });
                                break;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
