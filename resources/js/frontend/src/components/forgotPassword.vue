<template>
    <div class="container">
 <div class="row">
     <div class="col-md-3"></div>
  <div class="col-md-6 ">
    <div class="form-group">
     <i class="ti ti-email text-primary mr-2"> </i>

        <label>E-mail</label>
        <input v-model="email" name="email" type="email" class="form-control" id="email" >
    </div>
    
    <div class="form-group ">
        <button  @click="sendEmail"    class="btn btn-success btn-block"><span>Email  Gönder!
          </span></button>
    
    </div>
    
  </div>
 
 </div>
 <div class="row" style="height:350px">
      <div class="col-md-12">
  
  </div>
 </div>

</div>
</template>
  <script>
import Swal from 'sweetalert2'
import axios from 'axios'
export default {
    data(){

        return{
            email: '',
            url: 'sifreyiyenile'
        
        }
        },

    methods:{
        sendEmail(){
     
         if(this.email != ''){
                axios.post(this.url,{email:this.email}).then((res) =>{
                    console.log(res);
                    
            }).then(() =>{
                       Swal.fire(
  'Şifreniz Sisteme Kayıtlı  Mail Adresinize Gönderildi!',
  'Mail adresinizi kontrol ediniz!',
  'success'
)
            })
         }else{
                     Swal.fire(
  'Mail Adresi Giriniz!',
  '',
  'error'
)
         }
        }
    }
}

</script>