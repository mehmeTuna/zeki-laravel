<template>
<div class="container">
 <div class="row">
    <div class="col-md-3">

<p v-if="errors.length">
    <b>Lütfen hatayı düzeltin:</b>
    <ul>
      <li v-for="error in errors" :key="error.id">{{ error }}</li>
    </ul>
  </p>
  </div>
   
  <div class="col-md-6">
     <div class="validate-form">
    <div class="form-group">
     <i class="ti ti-email text-primary mr-2"> </i>

        <label>E-mail</label>
        <input v-model="userData.username" name="email" type="email" class="form-control" id="email" >
    </div>
    <div class="form-group">
     <i class="ti ti-key text-primary mr-2"> </i>

        <label>Şifre</label>
       <input v-model="userData.password" name="Şifre" type="password" id="password" class="form-control" >
    </div>
    <div class="form-group ">
        <button  @click="checkForm"    class="btn btn-success btn-block"><span>Giriş Yap!
          </span></button>
    
    </div>
    </div>
  </div>
  <div class="col-md-3">
    
  </div>

 
   <div class="col-md-3"></div>
   
    <div class="col-md-9">
    <h4> Üyeliğiniz yok mu?  <router-link tag='a' to='/uyeol'> 
       <span class="lead" style="color:blue">  Yeni Üyelik!</span></router-link>
       
       <router-link tag='a' to='/sifreyenile'> 
       <span class="lead" style="color:red">  Şifreni mi unuttun?</span></router-link>  </h4>
     

  </div>

 </div>
 
</div>
</template>

<script>
import axios from 'axios'
import { setInterval } from 'timers';
import swal from 'sweetalert'



export default {
  data(){
  return{
       errors:[],
      userData:{
     
      username:'' ,
      password:''
    },
   

    
 }

  },
  methods:{


  checkForm:function(e) {
      this.errors = [];
      if(!this.userData.password) this.errors.push("Şifre giriniz.");
      if(!this.userData.username) {
        this.errors.push("username giriniz.");
      } else if(!this.validEmail(this.userData.username)) {
        this.errors.push("Yanlış email girdiniz.");        
      }
      else if(this.validEmail(this.userData.username)){
        const url ="user/login"
       
       
       axios.post(url,this.userData)
      .then(response => {
        if(response.data.status === 'false'){
          
                     swal({
                                   title: "Kullanıcı Adı Veya Şifreniz Yanlış!",
                                          
                                          icon:'warning',
                                          button:'Devam Et!',
                                          timer:1500
                              })

        }
        if(response.data.status !== 'false'){
          window.location.href = "anasayfa";
        }
      }) 
      .catch(e => console.log(e));
        
      
      }
      
      if(!this.errors.length) return true;
      e.preventDefault();
      },
     

       validEmail:function(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
 
    },
    
   
  }


/* 
axios.post("https://vue-deneme-1fa03.firebaseio.com/posts.json",this.userData)
      .then(response => {
        console.log(response);
        
      }) 
      .catch(e => console.log(e));
*/
</script>
