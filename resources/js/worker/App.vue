<template>
    <div id="wrapper">
        <Sidebar v-bind:BtnType="BtnType" :updateBtn="updateBtn"/>
        <ContentWrapper
            v-bind:BtnType="BtnType"
            :rezerData="rezerData"
            :updatedTime="updatedTime"
            :statusType="statusType"
            :orderData="orderData"
            :orderTabData="orderTabData"
            :rezerTabData="rezerTabData"
            :updateStatus="updateStatus"
        />
    </div>
</template>

<script>
import Sidebar from "./Sidebar";
import ContentWrapper from "./ContentWrapper";
import Axios from "axios";

    export default {
        name: "App",
        data : function(){
            return {
                BtnType: 'order',
                statusType: 'gelen',
                orderTabData: {
                    wait: 0,
                    success:0,
                    cancel:0,
                    kurye:0,
                },
                rezerTabData : {
                    wait: 0,
                    success: 0,
                    cancel: 0
                },
                orderData: [],
                rezerData: [],
                updatedTime : ''
            }
        },
        mounted() {
            this.updateTime()
            this.getOrderData()
        },
        components: {
            Sidebar: Sidebar,
            ContentWrapper: ContentWrapper
        },
        methods: {
            updateBtn: function (val) {
                this.BtnType = val
                if(this.BtnType === 'order'){
                    this.getOrderData()
                }else if(this.BtnType === 'rezer'){
                    this.getRezerData();
                }
            },
            updateStatus: function (val) {
                this.statusType = val
               if(this.BtnType === 'order'){
                   this.getOrderData()
               }else if(this.BtnType === 'rezer'){
                   this.getRezerData()
               }
            },
            getOrderData: async function () {
                const {data} = await Axios.get('/order/list')
                if(typeof data.status !== "undefined" && data.status){
                        this.orderTabData.wait = data.data['wait']
                        this.orderTabData.success = data.data['success']
                        this.orderTabData.cancel = data.data['cancel']
                        this.orderTabData.kurye = data.data['kurye']
                    switch (this.statusType) {
                        case 'gelen':
                            this.orderData = data.data['waitList'];
                            break;
                        case 'onay':
                            this.orderData = data.data['successList'];
                            break;
                        case 'iptal':
                            this.orderData = data.data['cancelList'];
                            break;
                        case 'kurye':
                            this.orderData = data.data['kuryeList'];
                            break;
                    }
                }
            },
            getRezerData: async function(){
                const {data} = await Axios.get('/rezervasyon/list')
                if(typeof data.status !== "undefined" && data.status){
                    this.rezerTabData.wait = data.data['wait']
                    this.rezerTabData.success = data.data['success']
                    this.rezerTabData.cancel = data.data['cancel']
                    switch (this.statusType) {
                        case 'gelen':
                            this.rezerData = data.data['waitList'];
                            break;
                        case 'onay':
                            this.rezerData = data.data['successList'];
                            break;
                        case 'iptal':
                            this.rezerData = data.data['cancelList'];
                            break;
                    }
                }
            },
            updateTime : function () {
                let hour = new Date().getHours() ;
                let minute = new Date().getMinutes() ;
                this.updatedTime = `${hour}:${minute}`
            }
        }
    }
</script>

<style scoped>

</style>
