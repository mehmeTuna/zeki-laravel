<template>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <Topbar :workerData="workerData" />
            <div class="container-fluid">
                <ContainerFluid
                    :BtnType="BtnType"
                    :orderTabData="orderTabData"
                    :rezerTabData="rezerTabData"
                    :statusType="statusType"
                    :updateStatus="updateStatus"
                />
                <div v-if="BtnType === 'order'">
                    <OrderListTable
                        :updatedTime="updatedTime"
                        :orderData="orderData"
                        :statusType="statusType"
                    />
                </div>
                <div v-if="BtnType === 'rezer'">
                    <RezervasyonList
                        :rezerData="rezerData"
                        :updatedTime="updatedTime"
                        :statusType="statusType"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
import Topbar from "./components/Topbar";
import ContainerFluid from "./components/ContainerFluid";
import RezervasyonList from "./components/RezervasyonList";
import OrderListTable from "./components/OrderListTable";
export default {
    name: "ContentWrapper",
    props: {
        workerData: {
            required: true
        },
        BtnType: {
            type: String,
            required: false,
            default: "order"
        },
        statusType: {
            required: true,
            default: "gelen"
        },
        orderTabData: {
            required: false,
            default: {
                wait: 0,
                success: 0,
                cancel: 0,
                kurye: 0
            }
        },
        rezerTabData: {
            required: true
        },
        orderData: {
            required: false,
            default: []
        },
        rezerData: {
            required: false,
            default: []
        },
        updatedTime: {
            required: true
        },
        updateStatus: {
            required: true
        }
    },
    data: function() {
        return {};
    },
    components: {
        Topbar: Topbar,
        ContainerFluid: ContainerFluid,
        OrderListTable: OrderListTable,
        RezervasyonList: RezervasyonList
    },
    methods: {}
};
</script>

<style scoped></style>
