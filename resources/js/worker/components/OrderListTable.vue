<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" v-if="BtnType === 'order'">Siparişler </h6>
            <h6 class="m-0 font-weight-bold text-primary" v-if="BtnType === 'rezer'">Rezervasyonlar </h6>
        </div>
        <div class="card-body" v-if="BtnType === 'order'">
            <div class="table-responsive">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row m-0 p-0">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" >
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" >Onay</th>
                                    <th class="sorting" >Ad Soyad	</th>
                                    <th class="sorting" >Tutar</th>
                                    <th class="sorting" >İletişim</th>
                                    <th class="sorting" >Tarih</th>
                                    <th class="sorting" >Adres</th>
                                    <th class="sorting" >Sipariş Numarası	</th>
                                    <th class="sorting" >İlk Sipariş </th>
                                    <th class="sorting" >Kurye</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr role="row">
                                    <th class="sorting_asc" >Onay</th>
                                    <th class="sorting" >Ad Soyad	</th>
                                    <th class="sorting" >Tutar</th>
                                    <th class="sorting" >İletişim</th>
                                    <th class="sorting" >Tarih</th>
                                    <th class="sorting" >Adres</th>
                                    <th class="sorting" >Sipariş Numarası	</th>
                                    <th class="sorting" >İlk Sipariş </th>
                                    <th class="sorting" >Kurye</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" v-if="BtnType === 'rezer'">
            <div class="table-responsive">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row m-0 p-0">
                        <div class="col-sm-12">
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
                                    <th class="sorting_asc" >Onay</th>
                                    <th class="sorting" >Ad Soyad	</th>
                                    <th class="sorting" >Telefon</th>
                                    <th class="sorting" >Kişi Sayısı</th>
                                    <th class="sorting" >Email</th>
                                    <th class="sorting" >Açıklama</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderListTable",
        props: {
            BtnType: {
                type: String,
                required: false,
                default: 'rezer'
            }
        }
    }
</script>

<style scoped>

</style>
