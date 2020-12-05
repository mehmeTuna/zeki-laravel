<template>
<div style="width:100%;display:block;height:100%;">
    <header id="header" class="light" >
        <div class="header-container">
            <div class="header-grid">
                <div class="header-left">
                    <div class="header-item logo">
                        <router-link to="/" class="header-item--link">
                            <img  width="75%" height="100%" src="https://i.hizliresim.com/VQnBmr.png" alt="">
                        </router-link>
                    </div>
                </div>
                <div id="header-items--content" :class="[(isActiveMenu) ? 'active' : 'disable']" style="padding-left:15px;" class="header-items">
                    <div class="hover header-item">
                        <div  @click="closeMenu('/')"  class="header-item--link">
                            <div class="feature-icon icon icon-primary" style="font-size:23px">
                                <i class="ti ti-home"></i>
                            </div>
                            <div>Ana sayfa</div>
                        </div>
                    </div>
                    <div class="hover header-item">
                        <div  @click="closeMenu('/urunler')"  class="header-item--link">
                            <div class="feature-icon icon icon-primary" style="font-size:23px">
                                <i class="ti ti-shopping-cart"></i>
                            </div>
                            <div>Menü</div>
                        </div>
                    </div>
                   
                      <div class="hover header-item">
                        <div @click="closeMenu('/rezervasyon')" class="header-item--link">
                            <div class="feature-icon icon icon-primary" style="font-size:23px">
                                <i class="ti ti-bookmark-alt"></i>
                            </div>
                            <div>Rezervasyon</div>
                        </div>
                    </div>

                    <template  v-if="userInfos.cardTotal !== undefined ">
                        <div class="hover header-item">
                            <router-link  to="/profil" class="header-item--link">
                                <div class="feature-icon icon icon-primary" style="font-size:23px">
                                    <i class="ti ti-user"></i>
                                </div>
                                <div>Profil</div>
                            </router-link>
                        </div>
                        <div class="hover header-item">
                            <a href="kullanici/cikis" class="header-item--link">
                                <div class="feature-icon icon icon-primary" style="font-size:23px">
                                    <i class="ti ti-export"></i>
                                </div>
                                <div>Çıkış Yap</div>
                            </a>
                        </div>
                    </template>
                    <div class="hover header-item" v-else-if="userInfos.cardTotal === undefined">
                        <div @click="closeMenu('/giris')" class="header-item--link">
                            <div class="feature-icon icon icon-primary" style="font-size:22px">
                                <i class="ti ti-user"></i>
                            </div>
                            <div>Giriş yap</div>
                        </div>
                    </div>
                          
                </div>
                <div class="header-sepet-icon">
                    <div class="header-item">
                        <div v-if="userInfos.cardTotal !== undefined">
                            <div @click="showPanel()" href="#" class="module module-cart right" data-toggle="panel-cart">
                                <span class="cart-icon">
                                    <i class="ti ti-shopping-cart"></i>
                                    <span class="notification">{{userInfos.orderCount}}</span>
                                </span>
                                <span class="cart-value">{{userInfos.cardTotal}} ₺</span>
                            </div>
                        </div>
                        <div  v-else>
                            <a @click="showPanel()" href="#" class="module module-cart right" data-toggle="panel-cart">
                                <span class="cart-icon">
                                    <i class="ti ti-shopping-cart"></i>
                                    <span class="notification">0</span>
                                </span>
                                <span class="cart-value">0 ₺</span>
                            </a>
                        </div>
                    </div>
                    <div id="mobile-button" class="header-item" style="padding-left:20px;">
                        <div class="mobile-btn" @click="isActiveMenu=!isActiveMenu">
                            <div id="nav-icon1" :class="[isActiveMenu==true ? 'open' : '']">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header / End -->
    <!-- Content -->
    <div id="content">
       <div id="body-overlay"></div>
    </div>
</div>
</template>
<script>

import {EventBus} from './../main.js'
import { mapGetters, mapActions } from 'vuex';
import Sticky from 'vue-sticky-directive'
export default {
   
  directives: {Sticky},
   data () {
      return {
           menuShow :false,
           showMobileMenu:false,
           isActiveMenu:false
      }
         
       
   },
   methods :{
       showPanel(){
           
           this.menuShow = !this.menuShow;
           EventBus.$emit('showPanel',this.menuShow)
           
       },
      closeMenu(to){
          this.isActiveMenu = false;
          this.$router.push(to);

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
<style lang="scss">
.logo {
    .header-item--link {
        color: #ddae71;
    }
}
.hover {
  color: inherit;
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  cursor: pointer;
}

.hover:hover, .hover:focus {
  text-decoration: none;
  color: #ddae71;
  cursor: pointer;
}

</style>
