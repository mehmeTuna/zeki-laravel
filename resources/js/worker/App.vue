<template>
    <div id="wrapper">
        <Sidebar v-bind:BtnType="BtnType" :updateBtn="updateBtn"/>
        <ContentWrapper v-bind:BtnType="BtnType" />
    </div>
</template>

<script>
import Sidebar from "./Sidebar";
import ContentWrapper from "./ContentWrapper";

    export default {
        name: "App",
        data : function(){
            return {
                BtnType: 'order'
            }
        },
        components: {
            Sidebar: Sidebar,
            ContentWrapper: ContentWrapper
        },
        methods: {
            updateBtn: function (val) {
                this.BtnType = val
            }
        }
    }
</script>

<style scoped>

</style>
