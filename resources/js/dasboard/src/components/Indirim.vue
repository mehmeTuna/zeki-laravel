<template>
    <div class="row" style="margin-top:75px;margin-left:30px">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">İndirim Uygula</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-5 pr-md-1">
                                <div class="form-group">
                                    <label>Şirket</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        disabled
                                        placeholder="Zeki Usta"
                                    />
                                </div>
                            </div>
                            <div class="col-md-3 px-md-1">
                                <div class="form-group">
                                    <label>İndirim Tutarı</label>
                                    <input
                                        v-model="discount"
                                        type="number"
                                        class="form-control"
                                        placeholder="Kategori Adı"
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text">
                    <button
                        @click="updateCupon"
                        type="submit"
                        class="btn btn-fill btn-primary"
                    >
                        Kaydet
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            discount: 0
        };
    },
    methods: {
        getCuponInfo() {
            const url = "/cart/cupon";
            axios.get(url).then(res => {
                this.discount = res.data.cupon;
            });
        },
        updateCupon() {
            const url = "/site/update";
            axios.post(url, { cupon: Number(this.discount) }).then(res => {
                console.log(res);
            });
        }
    },
    created() {
        this.getCuponInfo();
    }
};
</script>
