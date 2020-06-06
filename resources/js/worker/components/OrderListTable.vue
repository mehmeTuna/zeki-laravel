<template>
    <div class="row justify-content-between">
        <div v-bind:class="isShowOrder ? 'card shadow mb-4 col-md-8 col-lg-8' : 'card shadow mb-4 col-md-12 col-lg-12'">
            <div class="card-header py-3 row justify-content-between">
                <p class="m-0 font-weight-bold text-primary">Siparişler </p>
                <div class="row align-items-center">
                    <p class="mx-2 my-0 font-weight-bold text-primary">Son Guncelleme: {{updatedTime}}</p>
                    <button v-if="isShowOrder && statusType !== 'kurye'" class="btn btn-danger" v-on:click="orderIptal">Iptal Et</button>
                </div>
            </div>
            <div class="mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" >Onay</th>
                            <th class="sorting" >Ad Soyad</th>
                            <th class="sorting" >Tutar</th>
                            <th class="sorting" >İletişim</th>
                            <th class="sorting" >Tarih</th>
                            <th class="sorting" >Adres</th>
                            <th class="sorting" >Sipariş Numarası</th>
                            <th class="sorting" >İlk Sipariş</th>
                            <th class="sorting" >Kurye</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr role="row" >
                            <th class="sorting_asc">Onay</th>
                            <th class="sorting">Ad Soyad</th>
                            <th class="sorting">Tutar</th>
                            <th class="sorting">İletişim</th>
                            <th class="sorting">Tarih</th>
                            <th class="sorting">Adres</th>
                            <th class="sorting">Sipariş Numarası</th>
                            <th class="sorting">İlk Sipariş </th>
                            <th class="sorting">Kurye</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr role="row" v-if="orderData.length > 0" v-for="order in orderData" :key="order.order_id" v-bind:class="isShowOrder && order.order_id === showOrderData.order_id ? 'odd text-white bg-primary' : 'odd'">
                            <td v-bind:class="isShowOrder && order.order_id === showOrderData.order_id ? 'text-center' : 'text-center text-primary'"><i v-on:click="editOrder(order)" class="fas fa-pencil-alt" style="cursor: pointer"></i></td>
                            <td class="sorting">{{`${order.user.firstname} ${order.user.lastname}`}}</td>
                            <td class="sorting">{{order.order_amount}}</td>
                            <td class="sorting">{{order.user.phone}}</td>
                            <td class="sorting">{{order.m_date}}</td>
                            <td class="sorting">{{order.address !== null ? order.address.content : ''}}</td>
                            <td class="sorting">{{order.order_id}}</td>
                            <td class="sorting">
                                <i v-if="order.user.first_order == 1" class="fas fa-times fa-2x text-danger"> </i>
                                <i v-if="order.user.first_order == 0" class="fas fa-check fa-2x text-info"> </i>
                            </td>
                            <td>
                                {{order.kurye !== null ? `${order.kurye.firstname} ${order.kurye.lastname}` : 'Kuryeye Verilmedi'}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div v-if="isShowOrder" class="card col-md-4 col-lg-4 shadow mb-4 row justify-content-between">
                <div class="card-header py-3 row justify-content-between align-items-center">
                    <p class="m-0 font-weight-bold text-primary d-inline">
                        {{showOrderData.order_id}} Siparis Detaylari
                    </p>
                    <button v-if="statusType !== 'kurye'" type="button" class="btn btn-primary" @click="show">Kurye Sec</button>
                    <button type="button" class="btn btn-success" v-on:click="showFis">Fis Al</button>
                </div>
                <div class="card-body">
                    <p class="text-dark">
                        Odeme Tipi: {{showOrderData.order_status}}
                    </p>
                    <p class="text-dark">
                        Musteri Notu: {{showOrderData.content !== null ? showOrderData.content : 'Not Birakmadi'}}
                    </p>
                    <hr>
                    <div v-for="orderItem in showOrderData.orders">
                        {{`${orderItem.count}x ${orderItem.name}`}}
                    </div>
                </div>
        </div>
        <modal name="hello-world">
            hello, world!
        </modal>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    import Axios from 'axios';

    export default {
        name: "OrderListTable",
        props: {
            orderData: {
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
        data: function(){
          return {
              isShowOrder: false,
              showOrderData: {},
              kuryeId: '',

          }
        },
        mounted() {
        },
        methods: {
            show(){
                this.$modal.show("Hello");
            },
            editOrder: function (order) {
                this.isShowOrder = true;
                this.showOrderData = order ;
                console.log(order)
            },
            showFis: function() {
                var iframe = document.createElement('iframe');
                document.body.appendChild(iframe);
                iframe.style.display = 'none';
                iframe.onload = function() {
                    setTimeout(function() {
                        iframe.focus();
                        iframe.contentWindow.print();
                    }, 0);
                };
                iframe.src = `/order/fis/${this.showOrderData.order_id}`;
            },
            orderIptal: function () {
                swal( {
                    title: `${this.showOrderData.order_id} nolu siparis iptal edilecek onayliyormusunuz ?`,
                    buttons: {
                        iptal: {
                            text: "Iptal Et",
                            value: "iptal",
                            className: 'btn-danger'
                        },
                        vazgec: {
                            text: "vazgec",
                            value: "vazgec",
                        }
                    },
                })
                    .then((value) => {
                        switch (value) {
                            case "iptal":
                                Axios.post('/order/update', {
                                    id: this.showOrderData.order_id,
                                    status: 'iptal'
                                }).then((res) => {
                                    swal({
                                        title: 'Siparis Iptal Edildi'
                                    });
                                })
                                break;
                        }
                    });
            },
            kuryeSelect: function () {
                Axios.get('/kurye/list').then((res)=>{
                    console.log(res.data)

                    Swal.fire({
                        title: 'Select Outage Tier',
                        html: `<select class="form-control form-control-lg" v-model="kuryeId">
                                   <option v-for="kurye in res.data" :value="kurye.id">{{kurye.firstname}} {{kurye.lastname}}</option>
                                </select>`,
                    }).then(function (result) {
                        this.kuryeId
                        if (result.value) {
                            swal({
                                icon: 'success',
                                html: 'You selected: ' + result.value
                            });
                        }
                    });
                })
            }
        }
    }
</script>

<style scoped>

</style>
