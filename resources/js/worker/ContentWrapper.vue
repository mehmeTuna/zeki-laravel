<template>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <Topbar  />
            <div class="container-fluid">
                <ContainerFluid v-bind:BtnType="BtnType" v-bind:statusType="statusType" :updateStatus="updateStatus"/>
                <OrderListTable v-bind:BtnType="BtnType" v-bind:statusType="statusType"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Topbar from './components/Topbar'
    import ContainerFluid from "./components/ContainerFluid";
    import OrderListTable from "./components/OrderListTable";
    export default {
        name: "ContentWrapper",
        props: {
            BtnType: {
                type: String,
                required: false ,
                default: 'order'
            }
        },
        data: function(){
          return {
              statusType: 'gelen'
          }
        },
        components: {
            Topbar: Topbar,
            ContainerFluid: ContainerFluid,
            OrderListTable: OrderListTable
        },
        methods: {
            updateStatus: function (val) {
                this.statusType = val
            }
        }
    }
</script>

<style scoped>

</style>
