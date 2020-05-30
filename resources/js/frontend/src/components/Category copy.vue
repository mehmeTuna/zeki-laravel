<template>
    <div>
        <!-- Page Content -->
        <div class="page-content">
            <div class="menu-categories">
                <div class="menu-categories--container">
                    <div class="menu-categories--item active">Kebaplar</div>
                    <div class="menu-categories--item">Izgaralar</div>
                    <div class="menu-categories--item">Dürümler</div>
                    <div class="menu-categories--item">Fırın Ürünleri</div>
                    <div class="menu-categories--item">Çiğ Köfteler</div>
                    <div class="menu-categories--item">Tatlılar</div>
                    <div class="menu-categories--item">İçecekler</div>
                </div>
            </div>
            <div class="product-cards">
                <div class="product-cards--grid">
                    <div class="product-card">
                        <div class="product-card--img">
                            <img src="http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg" alt="">
                        </div>
                        <div class="product-card--title">
                            Çöp Şiş
                        </div>
                        <div class="product-card--desc">
                            Lorem ipsum dolor sit amet.
                        </div>
                        <div class="product-card--bottom">
                            <div class="product-card--price">14 TL</div>
                            <div class="btn-add-card">Sepete Ekle</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-3 d-none d-sm-block" >
                        <!-- Menu Navigation -->
                        <nav id="menu-navigation" v-sticky >
                            <ul class="nav nav-menu bg-dark dark">
                                <li v-for="(product,index) in allProducts" :key="product.id"  ><a :href="'#'+index" v-smooth-scroll>{{product.name}}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-9" >   
                       <!-- Menu Category / Burgers -->
                        <div :id="index" class="menu-category"  v-for="(product,index) in allProducts" :key="product.id"  >
                            
                            <div  class="menu-category-title">
                                <div> <img class="bg-resim" :src="product.categoryImage" ></div>
                                <h2 class="title">{{product.name}} </h2>  
                            </div>
                          
                            <div class="menu-category-content padded ">
                                <div class="row gutters-sm">
                                    <div class="col-lg-4 col-6"  v-for="(menuItem) in product.menuItems" :key="menuItem.id">
                                        <div class="menu-item menu-grid-item">
                                            <img class="mb-4" :src="menuItem.img" alt="" width="300" height="200">
                                            <h6 class="mb-0 text-danger">{{menuItem.name}} </h6>
                                            <span class="text-dark text-sm">{{menuItem.description}}</span>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-sm-6"><span class="text-lg text-danger mr-4"><span class="text-danger">Fiyat </span>{{menuItem.price}} ₺</span></div>
                                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-warning btn-sm" @click="addProduct(menuItem)" data-target="#productModal" data-toggle="modal"><span>Sepete Ekle</span></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <!-- Modal / Product -->
            <div class="modal fade" id="productModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header modal-header-lg dark bg-dark">
                            <div class="bg-image"><img src="assets/img/photos/modal-add.jpg" alt=""></div>
                            <h4 class="modal-title">Ürünü özelleştirin</h4>
                            <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><i class="ti-close"></i></button>
                        </div>
                        <div class="modal-product-details">
                            <div class="row align-items-center">
                                <div class="col-9">
                                   
                                    <h6 class="mb-0 text-danger text-lg">{{product.name}}</h6>
                                    <span class="text-dark">{{product.description}}</span>
                                </div>
                            <!-- product.price*product.quantity Sepete bu şekilde gönderilecek -->
                                <div class="col-3 text-lg text-danger text-right">{{parseFloat(product.price)*parseInt(product.quantity)}}₺</div>
                            </div>
                        </div>
                        <div class="modal-body panel-details-container">
                            <!-- Panel Details / Size -->
                            <div class="panel-details">
                                <h5 class="panel-details-title">
                                    <label class="custom-control custom-radio">
                                        <input name="radio_title_size" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                    <a href="#panelDetailsSize" >Adet</a>
                                </h5>
                                <div id="panelDetailsSize" class="collapse show">
                                    <div class="panel-details-content">
                                        <div class="form-group">
                                            <label class="custom-control custom-radio">
                                                <input name="radio_size" type="radio" class="custom-control-input" checked>
                                                <span class="custom-control-indicator">
                                                </span>
                                            </label>
                                            <div class="custom-control-description">
                                                <div class="minusplusnumber">
                                                    <div class="mpbtn minus" @click="product.quantity--">
                                                        - 
                                                    </div> 
                                                    <div id="field_container">
                                                        <span class="text-lg mr-4 ml-4 text-center "><span class="text-muted text-lg"></span>{{product.quantity}}</span>
                                                    </div>
                                                    <div class="mpbtn plus" @click="product.quantity++">
                                                        +
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Details / Additions -->
                            <div class="panel-details">
                                <h5 class="panel-details-title">
                                    <label class="custom-control custom-radio">
                                        <input name="radio_title_additions" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                    <a href="#panelDetailsAdditions" aria-expanded="true" >Opsiyonlar</a>
                                </h5>
                                <div id="panelDetailsAdditions" class="collapse show" aria-expanded="true" >
                                    <div class="panel-details-content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox " v-for="(option,i) in product.options" :key="i" @click="clickOption(option.id)"  :class="{'active-checkbox':pickedOptions.findIndex(item=>item===option.id)!=-1 ? true : false}">
                                                        <!-- <input type="checkbox" class="custom-control-input"> -->
                                                        <!-- <span class="custom-control-indicator"></span> -->
                                                        <input class="form-check-input" type="checkbox" name="" id="" :checked="pickedOptions.findIndex(item=>item===option.id)!=-1 ? true : false">
                                                        <span class="custom-control-description ">{{option.content}} </span>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel Details / Other -->
                            <!--
                            <div class="panel-details">
                                <h5 class="panel-details-title">
                                    <label class="custom-control custom-radio">
                                        <input name="radio_title_other" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                    <a href="#panelDetailsOther" data-toggle="collapse">Diğer</a>
                                </h5>
                                <div id="panelDetailsOther" class="collapse">
                                    <textarea cols="30" rows="4" class="form-control" placeholder="Put this any other informations..."></textarea>
                                </div>
                            </div>
                            -->
                        </div> 
                        <button type="button" class="modal-btn btn btn-secondary btn-block btn-lg" @click="addProductToCart(product)" data-dismiss="modal"><span>Sepete Ekle</span></button>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Body Overlay -->
        <div id="body-overlay"></div>
    </div>
</template>


<script>

import {mapGetters,mapActions} from 'vuex'
import axios from 'axios'
import swal from 'sweetalert';
import VueSticky from 'vue-sticky' 



export default {
    data(){
        return{
           
            pickedOptions:[],
            product:{
                name:'',
                id:'',
                price:'',
                count:'',
                description:'',
                options:[]
            }
        }
    },
    directives: {
  'sticky': VueSticky,
},
    computed:{
        ...mapGetters(['allProducts','userInfos','allCartItems']),
        // product(){
        //     this.count=this.$store.getters.productDetailedOnSepet.count
        //     return this.$store.getters.productDetailedOnSepet
        // }
        
    },
    methods: {
        ...mapActions(['fetchProducts']),
        //...mapActions('cart',['addProductToCart']),

        //  addProductToCart(menuItem){ 
        //  }
        addProduct(product){
            this.pickedOptions=[]
           
            this.product={...product};
        },
        increment(index1,index2) {
            this.$store.dispatch('increment',{index1,index2})
        },
        decrement(index1,index2) {
            this.$store.dispatch('decrement',{index1,index2})
        },
        addProductToCart(product){
            let menuItem={...product}
            menuItem.count=parseInt(menuItem.quantity);
            menuItem.price=parseFloat(menuItem.price)*parseInt(menuItem.quantity)
            menuItem.options=this.pickedOptions
            this.$store.dispatch("addCartItem",menuItem)
            if(this.userInfos.firstname != undefined) {
                swal({
                        title: "Sepete Eklendi!",
                        text: menuItem.name,
                        icon:'success',
                        button:'Devam Et!',
                        timer:1000, 
                })
            }else{
                swal({
                    title:'Lütfen Giriş Yapın',
                    icon:'error'
                })
            }
        },
        updateCartItem(menuItem,index){

        },
        clickOption(id){
            const index=this.pickedOptions.findIndex(item=>item===id);
            console.log(index,'index')
            if(index==-1){
                this.pickedOptions.push(id);

            }else{
                this.pickedOptions.splice(index,1)
            }
        },
        updateCartProduct(product){
            this.$store.commit('updateCart',product)
            this.extraPrice=0
            this.pickedOptions=[]
        },
        deleteExtra(){
            this.extraPrice=0
            this.pickedOptions=[]
        }
    },
    created(){
        this.fetchProducts();
        //this.fetchCartItems();
    }
}
</script>
<style >
    .menu-categories {
        box-shadow: 3px 4px 25px -3px #ccccccc9;
        margin: 20px auto;
        width:90%;
        border-radius: 8px;
    }
    .menu-categories--container{
        display:flex;
        align-items: center;
        justify-content: center;
    }
    .menu-categories--item{
        height:80px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 600;
        padding: 0 20px;
    }
    .menu-categories--item.active{
        border-bottom:3px solid #000;
        color:#000;
    }
 .bg-resim{
     
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 0;

 };
 .minusnumber {
    border:1px solid silver;
    border-radius:5px;
    background-color: #17a2b8;
    margin:0 5px 0 5px;
    display:inline-block;
    user-select: none;
}
.lusnumber {
    border:1px solid silver;
    border-radius:5px;
    background-color: #17a2b8;
    margin:0 5px 0 5px;
    display:inline-block;
    user-select: none;
}
.minusplusnumber div {
    display:inline-block;
    background-color: white;
}
.minusplusnumber #field_container input {
    width:50px;
    text-align:center;
    font-size:15px;
    padding:3px;
    border:none;
}
.minusplusnumber .mpbtn {
    padding:3px 10px 3px 10px;
    cursor:pointer;
    border-radius:5px;
}
.minusplusnumber .mpbtn:hover {
    background-color:#e15757 ;
}
.minusplusnumber .mpbtn:active {
    background-color:#e15757 ;
}
.quantity {
  max-width: 150px;
  width: 100%;
}

.quantity input {
  text-align: center;
}
#panelDetailsSize .form-group{
    display:flex;
    align-items:center;

}
.active-checkbox{
    color:red;
}
</style>