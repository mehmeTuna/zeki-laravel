<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 v-if="BtnType === 'order'" class="h3 mb-0 text-gray-800" >Sipariş Onay</h1>
            <h1 v-if="BtnType === 'rezer'" class="h3 mb-0 text-gray-800" >Rezervasyon Onay</h1>
        </div>
        <div class="row">
            <div v-bind:class="BtnType === 'order' ? 'col-xl-3 col-md-6 mb-4 custBtn' : 'col-xl-4 col-md-6 mb-4 custBtn'" v-on:click="updateStatus('gelen')">
                <div v-bind:class="statusType === 'gelen' ? 'border-left-primary text-primary card shadow h-100 py-2 bg-primary text-light' : 'card border-left-primary shadow h-100 py-2'">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" v-if="BtnType === 'order'">
                                    Gelen Siparişler</div>
                                <div class="text-xs font-weight-bold text-uppercase mb-1" v-if="BtnType === 'rezer'">
                                    Gelen Rezervasyonlar</div>
                                <div class="h5 mb-0 font-weight-bold " >{{BtnType === 'order' ? orderTabData.wait : rezerTabData.wait}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-4x "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-bind:class="BtnType === 'order' ? 'col-xl-3 col-md-6 mb-4 custBtn' : 'col-xl-4 col-md-6 mb-4 custBtn'" v-on:click="updateStatus('onay')">
                <div v-bind:class="statusType === 'onay' ? 'border-left-success text-success card shadow h-100 py-2 bg-success text-light' : 'card border-left-success shadow h-100 py-2'">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" v-if="BtnType === 'order'">
                                    Onaylanan Siparişler</div>
                                <div class="text-xs font-weight-bold text-uppercase mb-1" v-if="BtnType === 'rezer'">
                                    Onaylanan Rezervasyonlar</div>
                                <div class="h5 mb-0 font-weight-bold " >{{BtnType === 'order' ? orderTabData.success : rezerTabData.success}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-4x "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-bind:class="BtnType === 'order' ? 'col-xl-3 col-md-6 mb-4 custBtn' : 'col-xl-4 col-md-6 mb-4 custBtn'" v-on:click="updateStatus('iptal')">
                <div v-bind:class="statusType === 'iptal' ? 'border-left-danger text-danger card shadow h-100 py-2 bg-danger text-light' : 'card border-left-danger shadow h-100 py-2'">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" v-if="BtnType === 'order'">
                                    İptal Edilen Siparişler</div>
                                <div class="text-xs font-weight-bold text-uppercase mb-1" v-if="BtnType === 'rezer'">
                                    İptal Edilen Rezervasyonlar</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold " >{{BtnType === 'order' ? orderTabData.cancel : rezerTabData.cancel}}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times fa-4x "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 custBtn" v-if="BtnType === 'order'" v-on:click="updateStatus('kurye')">
                <div v-bind:class="statusType === 'kurye' ? 'border-left-success text-success card shadow h-100 py-2 bg-success text-light' : 'card border-left-success shadow h-100 py-2'">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1" >
                                    Kuryeye Verilen Siparişler
                                </div>
                                <div class="h5 mb-0 font-weight-bold">{{orderTabData.kurye}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-motorcycle fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContainerFluid",
        props: {
            BtnType: {
                type: String,
                required: false ,
                default: 'order'
            },
            updateStatus: {
                required: true
            },
            statusType: {
                type: String,
                required: false,
                default: 'gelen'
            },
            orderTabData: {
                required: true
            },
            rezerTabData: {
                required: true
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

    .custBtn {
        cursor: pointer;
    }

</style>
