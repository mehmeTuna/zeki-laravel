<template>
    <div class="modal fade show" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display: block;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkış Yap </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Çıkış Yapmak istediğine eminmisin ? </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Vazgeç</button>
                    <a class="btn btn-primary" href="calisan/cikis-yap">Çıkış Yap</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LogoutModal"
    }
</script>

<style scoped>

</style>
