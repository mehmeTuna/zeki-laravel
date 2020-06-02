<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://www.ay-soft.com/">
            <div class="sidebar-brand-icon ">
                <img src="http://www.ay-soft.com/images/logo.png" class="img-fluid">
            </div>
            <div class="sidebar-brand-text mx-3">ZEKI USTA</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span v-if="BtnType === 'order'">Siparişler</span>
                <span v-if="BtnType === 'rezer'">Rezervasyonlar</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" style="cursor:pointer;" v-on:click="updateBtn('order')">
                <i style='color:white' class="fas fa-fw fa-cog"></i>
                <span style='color:white'>Siparişler</span>
            </a>

        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" style="cursor:pointer;" v-on:click="updateBtn('rezer')">
                <i style='color:white' class="fas fa-fw fa-cog 0"></i>
                <span style='color:white'>Rezervasyon</span>
            </a>

        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
</template>

<script>
    export default {
        name: "Sidebar",
        props: {
            BtnType: {
                type:String ,
                required: false ,
                default: 'order'
            },
            updateBtn: Function
        },
        data: function () {
            return {
            }
        },
    }
</script>

<style scoped>

</style>
