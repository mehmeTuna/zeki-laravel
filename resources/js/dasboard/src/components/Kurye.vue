<template>
      <div class="main-panel" >
        <div class="row" style="margin-top:70px">
          <div class="col-md-2"></div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Kurye Ekle</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label>Şirket </label>
                        <input type="text" class="form-control" disabled="" placeholder="Zeki Usta" >
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" class="form-control" placeholder="Kullanıcı Adı" v-model="kurye.username" >
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Şifre </label>
                        <input type="password" class="form-control" placeholder="Şifre" v-model="kurye.password">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-md-1">
                      <div class="form-group">
                        <label>Ad </label>
                        <input type="text" class="form-control" placeholder="Ad"  v-model="kurye.firstname" >
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label>Soyad </label>
                        <input type="text" class="form-control" placeholder="Soyad"  v-model="kurye.lastname">
                      </div>
                    </div>
                  </div>
                 
                 
                 
                </form>
              </div>
              <div class="card-footer">
                <button type="submit" @click="sendDetail" class="btn btn-fill btn-primary">Kaydet</button>
               
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
             <div class="card-body">
                <div class="table-responsive" style="overflow:auto">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Ad
                        </th>
                        <th>
                          Soyad
                        </th>
                        <th>
                          İşe Başlama Tarihi
                        </th>
                        <th class="text-center">
                          Toplam Sipariş
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="kurye in kuryeList" :key="kurye.id">
                        <td>
                         {{kurye.firstname}}
                        </td>
                        <td>
                         {{kurye.lastname}}
                        
                        </td>
                        <td>
                         {{kurye.date}}
                        
                        </td>
                        <td class="text-center">
                         {{kurye.siparis}}
                          
                        </td>
                        <td class="text-center">
                         <button @click="deleteKurye(kurye.id)" class="btn btn-fill btn-info">Sil</button>
                        </td>
                      </tr>
                   
                    </tbody>
                  </table>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
 
</template>

<script>
import swal from 'sweetalert'
import axios from 'axios'
export default {
  data(){
    return{
        kuryeList:[],
      kurye:{
        username:'',
        password:'',
        firstname:'',
        lastname:'',


      }


    }
  },
  methods:{

    sendDetail(){
      const url = 'admin/api/newKurye'
        if(this.kurye.username != '' && this.kurye.password != '' && this.kurye.firstname != '' && this.kurye.lastname != '' ){
                
            axios.post(url,this.kurye)
            .then( (response) =>{
             if(response.data.status == "ok"){
                 swal("Kurye Başarıyla Eklendi!", "", "success", {
                button: "Devam Et!",
                timer:1500
      }).then(() =>{
        location.reload();
      })
              
                
             }
           
            })

        }else{
      swal("Kurye Eklenemedi!", "", "warning", {
        button: "Devam Et!",
        timer:1500
      });

        }
      

    },
    deleteKurye(id){
      const url = 'admin/api/kurye/del/'+id;

      axios.get(url)
      .then((res)=>{

         if(res.data.status == "ok"){
                 swal("Kurye Başarıyla Silindi!", "", "success", {
                button: "Devam Et!",
                timer:1500
      }).then(() =>{
        location.reload();
      })
              
                
             }else{
                swal("Kurye Silinemedi!", "", "warning", {
        button: "Devam Et!",
        timer:1500
      });

             }
        
      })
      

    }

   

  },
  created(){
    const url = 'admin/api/allKurye'
    axios.get(url)
    .then((response) =>{
    
      this.kuryeList = response.data;
      
      

    })

  }


}
</script>

<style>

</style>
