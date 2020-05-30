<template>
<div >
  <header id="header" class="light">

        <div class="container">
            
            <div class="row">
                <div class="col-md-9  push-md-2 text-center">
                    <!-- Navigation -->
                    <nav class="module module-navigation mr-4">
                        <ul id="nav-main" class="nav nav-main">
                            
             <li class="nav-item" >
                 <router-link to="/home" >
                  <img src="assets/img/logo-zekiusta.png" alt=""  class="mr-5">
                  </router-link>
            
            </li>
             <!-- 
             <li class="nav-item">
              <router-link to="/about" class="has-dropdown">Hakkımızda</router-link>
            </li>
                           
                            <li class="nav-item">
              <router-link to="/product" class="has-dropdown">Menü</router-link>
            </li>
                           <li><a href="page-offers.html">İndİrİmler</a></li>
                           
                            
                            
                            <li class="nav-item">
              <router-link to="/contact" class="has-dropdown">İletİşİm</router-link>
                  </li>
               -->
               <li>
            <router-link to="/product" >
            <div class="feature-icon icon icon-primary" style="font-size:30px"><i class="ti ti-shopping-cart"></i></div>Menü</router-link>
        
            </li>
                                       <li >
              <router-link to="/booking">
           <div class="feature-icon icon icon-primary" style="font-size:25px"><i class="ti ti-bookmark-alt"></i></div>   Rezervasyon</router-link>
            </li> 
             <li  >
              <a v-if="userInfos.cardTotal !== undefined " href="/profile" >
              <div class="feature-icon icon icon-primary" style="font-size:25px"><i class="ti ti-user"></i></div>Profil
             </a>
            </li>
                                           
                           <li v-if="userInfos.cardTotal !== undefined" >
                        <a  href="user/logout" >
                                   
                        <div class="feature-icon icon icon-primary" style="font-size:25px"><i class="ti ti-export"></i></div>
                      Çıkış Yap
                                                          
                       </a>
                    </li>
                      <li v-if="userInfos.cardTotal == undefined" >
                        <a  href="/login" >
                           <div class="feature-icon icon icon-primary" style="font-size:25px"><i class="ti ti-export"></i></div>
                            Giriş yap 
                                                            
                       </a>
                    </li>
                        </ul>
                    </nav>
                    <!--
                    <div class="module ">
                       
                        <router-link to="/product" class="btn btn-outline-primaryn"><span>Sİparİş Ver</span></router-link>
                    </div>
                   -->
                                
                                </div>
      

              
                    <div class="col-md-2 push-md-2"  v-if="userInfos.cardTotal !== undefined">
                 
                        <a @click="showPanel()" href="#" class="module module-cart right" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="notification">{{userInfos.orderCount}}</span>
                        </span>
                        <span class="cart-value">{{userInfos.cardTotal}} ₺</span>
                    </a>

    
                </div>
                 <div  class="col-md-2 push-md-2" v-else >
                 
                        <a @click="showPanel()" href="#" class="module module-cart right" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="notification">0</span>
                        </span>
                        <span class="cart-value">0 ₺</span>
                    </a>

    
                </div>
               
            

               

                
            </div>
        </div>

    </header>
    <!-- Header / End -->

    <!-- Header -->
    <header  id="header-mobile" class="dark" >

        <div class="module module-nav-toggle">
            
            <a @click="showMobileMenu = !showMobileMenu"   href="#"  id="nav-toggle" data-toggle="panel-mobile"><span></span><span></span><span></span><span></span></a>
        </div>    

       
    
        <a v-if="userInfos.cardTotal !== undefined" @click="showPanel()" href="#" class="module module-cart"  data-toggle="panel-cart">
            <i class="ti ti-shopping-cart"></i>
            <span class="notification">{{userInfos.orderCount}}</span>
        </a>
        <a  v-if="userInfos.cardTotal == undefined" @click="showPanel()" href="#" class="module module-cart"  data-toggle="panel-cart">
            <i class="ti ti-shopping-cart"></i>
            <span class="notification">0</span>
        </a>

    </header>
    <!-- Header / End -->
          <!-- Panel Mobile -->
    <nav id="panel-mobile" @click="showMobileMenu = !showMobileMenu" :class="{show:showMobileMenu}" >
        <div class="module module-logo bg-dark dark">
            <a href="#">
                <img src="assets/img/logo-zekiusta.png" alt="" width="88">
            </a>
            <button class="close" data-toggle="panel-mobile"><i class="ti ti-close"></i></button>
        </div>
        <nav class="module module-navigation ">
          
        </nav>
        <div class="module module-social">
            <h6 class="text-sm mb-3">Bizi Takip  Edin!</h6>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-facebook"><i class="fa fa-facebook"></i></a>
           
            <a href="#" class="icon icon-social icon-circle icon-sm icon-instagram"><i class="fa fa-instagram"></i></a>
        </div>
    </nav>

  <!-- Content -->
    <div id="content">


       <div id="body-overlay"></div>

    </div>
   

</div>
</template>
<script>

import {EventBus} from './../main.js'
import { mapGetters, mapActions } from 'vuex';

export default {
   
   data () {
      return {
           menuShow :false,
           showMobileMenu:false,
      }
         
       
   },
   methods :{
       showPanel(){
           
           this.menuShow = !this.menuShow;
           EventBus.$emit('showPanel',this.menuShow)
           
       },
      
       ...mapActions(['fetchUserInfo']),


   },
   computed:mapGetters(['userInfos']),

   created(){
    //    this.fetchUserInfo();
    this.$store.dispatch('fetchUserInfo')
    // console.log(this.userInfos);
   }
        
   
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style >


</style>
