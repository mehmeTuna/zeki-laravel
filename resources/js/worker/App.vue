<template>
    <div id="wrapper">
        <Sidebar v-bind:BtnType="BtnType" :updateBtn="updateBtn" />
        <ContentWrapper
            v-bind:BtnType="BtnType"
            :rezerData="rezerData"
            :updatedTime="updatedTime"
            :statusType="statusType"
            :orderData="orderData"
            :orderTabData="orderTabData"
            :rezerTabData="rezerTabData"
            :updateStatus="updateStatus"
            :workerData="workerData"
        />
        <audio preload="none">
            <source type="audio/mp3" :src="audioUrl" />
        </audio>
    </div>
</template>

<script>
import Sidebar from "./Sidebar";
import ContentWrapper from "./ContentWrapper";
import Axios from "axios";

export default {
    name: "App",
    data: function() {
        return {
            audioUrl: "/public/alert.wav",
            audio: "",
            BtnType: "order",
            statusType: "gelen",
            orderTabData: {
                wait: 0,
                success: 0,
                cancel: 0,
                kurye: 0
            },
            rezerTabData: {
                wait: 0,
                success: 0,
                cancel: 0
            },
            orderData: [],
            rezerData: [],
            updatedTime: "",
            workerData: {
                store: {
                    name: ""
                }
            }
        };
    },
    mounted() {
        axios.get("/worker/me").then(e => (this.workerData = e.data.data));
        this.audio = this.$el.querySelectorAll("audio")[0];
        this.updateDataControl();
        setInterval(() => {
            this.updateDataControl();
        }, 10000);
    },
    components: {
        Sidebar: Sidebar,
        ContentWrapper: ContentWrapper
    },
    methods: {
        playToSong() {
            this.audio.pause();
            this.audio.play();
        },
        updateBtn: function(val) {
            this.BtnType = val;
            if (this.BtnType === "order") {
                this.getOrderData();
            } else if (this.BtnType === "rezer") {
                this.getRezerData();
            }
        },
        updateStatus: function(val) {
            this.statusType = val;
            if (this.BtnType === "order") {
                this.getOrderData();
            } else if (this.BtnType === "rezer") {
                this.getRezerData();
            }
        },
        getOrderData: async function() {
            const { data } = await Axios.get("/order/list");
            if (typeof data.status !== "undefined" && data.status) {
                this.orderTabData.wait = data.data["wait"];
                this.orderTabData.success = data.data["success"];
                this.orderTabData.cancel = data.data["cancel"];
                this.orderTabData.kurye = data.data["kurye"];
                switch (this.statusType) {
                    case "gelen":
                        let control = false;
                        data.data["waitList"].map(newData => {
                            if (
                                this.orderData.filter(
                                    e => e.order_id === newData.order_id
                                ).length === 0
                            ) {
                                control = true;
                            }
                        });
                        if (control) {
                            console.log("yeni siparis var");
                            this.playToSong();
                        }
                        this.orderData = data.data["waitList"];
                        break;
                    case "onay":
                        this.orderData = data.data["successList"];
                        break;
                    case "iptal":
                        this.orderData = data.data["cancelList"];
                        break;
                    case "kurye":
                        this.orderData = data.data["kuryeList"];
                        break;
                }
            }
        },
        getRezerData: async function() {
            const { data } = await Axios.get("/rezervasyon/list");
            if (typeof data.status !== "undefined" && data.status) {
                this.rezerTabData.wait = data.data["wait"];
                this.rezerTabData.success = data.data["success"];
                this.rezerTabData.cancel = data.data["cancel"];
                switch (this.statusType) {
                    case "gelen":
                        this.rezerData = data.data["waitList"];
                        break;
                    case "onay":
                        this.rezerData = data.data["successList"];
                        break;
                    case "iptal":
                        this.rezerData = data.data["cancelList"];
                        break;
                }
            }
        },
        updateTime() {
            let hour = new Date().getHours();
            let minute = new Date().getMinutes();
            this.updatedTime = `${hour}:${minute}`;
        },
        controlOrderData() {
            console.log(this.orderData);
        },
        updateDataControl() {
            console.log("calisiyor");
            this.updateTime();
            this.getOrderData();
            this.controlOrderData();
        }
    }
};
</script>

<style scoped></style>
