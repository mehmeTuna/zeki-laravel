<template>
    <div class="container">
        <div class="row m-y-2">
            <div class="col-lg-8 push-lg-2">
                <!-- Nav Pills -->
                <ul class="nav nav-pills nav-fill mb-3" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#profile" aria-controls="home" role="tab"
                            data-toggle="tab">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kargotakip" aria-controls="profile" role="tab"
                            data-toggle="tab">Sipariş Takip</a></li>
                    <li class="nav-item"><a class="nav-link" href="#edit" aria-controls="profile" role="tab"
                            data-toggle="tab">Profil Düzenleme</a></li>
                    <li class="nav-item"><a class="nav-link" href="#adressEdit" aria-controls="profile" role="tab"
                            data-toggle="tab">Adres Düzenleme</a></li>
                    <li class="nav-item"><a class="nav-link" href="#passwordEdit" aria-controls="profile" role="tab"
                            data-toggle="tab">Şifre Düzenleme</a></li>
                    <!--  <li class="nav-item"><a class="nav-link" href="#edit" aria-controls="messages" role="tab" data-toggle="tab">Düzenleme</a></li> -->
                </ul>

                <div class="tab-content p-b-3">
                    <div class="tab-pane active" id="profile">

                        <div class="row">
                            <div class="col-12 ">
                                <div class="card ">
                                    <div class="card-body border--primary">
                                        <div class="row">
                                            <div class="col-lg-8 ">
                                                <h3 class="mt-3 text-truncated"
                                                    style="color:222;font-weight:500;font-size:23px;"><i
                                                        class="ti ti-user icon icon-primary"></i>{{userInfos.firstname}}
                                                    {{userInfos.lastname}}</h3>
                                                <p class="name" style="color:222;font-weight:500;font-size:23px;"> <i
                                                        class="ti ti-mobile icon icon-primary"> </i>{{userInfos.phone}}
                                                </p>
                                                <p v-if="userInfos.adress != null" class="text-truncated "
                                                    style="color:222;font-weight:500;font-size:23px;">
                                                    <i class="ti ti-location-pin icon icon-primary"> </i>
                                                    {{userInfos.adress.content}} 
                                                </p>
                                                <p class="lead" style="color:222;font-weight:500;font-size:23px;"> <i
                                                        class="ti ti-bookmark icon icon-primary">
                                                    </i>{{userInfos.email}}</p>
                                            </div>
                                            <div class="col-12 col-lg-4 col-md-6 text-center">
                                                <img :src="'https://ui-avatars.com/api/?size=200&name='+userInfos.firstname+'+'+userInfos.lastname"
                                                    alt="" class="mx-auto rounded-circle img-fluid mt-5">

                                                <br>

                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <h3 class="mb-0">20</h3>
                                                <small class="text-primary">Sipariş Sayısı</small>

                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <h3 class="mb-0">0</h3>
                                                <small class="text-primary">İptal Olan Siparişler</small>

                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <h3 class="mb-0">1</h3>
                                                <small class="text-primary">Devam Etmekte Olan Siparişler</small>

                                            </div>


                                        </div>
                                        <!--/row-->
                                    </div>
                                    <!--/card-block-->
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="tab-pane border--primary" id="kargotakip">
                        <h4 class="m-y-2">Sipariş Takip</h4>

                        <table class="table ">
                            <thead>
                                <tr>

                                    <th scope="col">#</th>
                                    <th></th>
                                    <th scope="col">Sipariş No</th>
                                    <th scope="col">İçerik</th>
                                    <th scope="col">Tutar</th>
                                    <th scope="col">Durumu</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(infos,index) in (userOrderInfos)" :key="infos.id">

                                    <td>{{index}}
                                    <td>
                                    <td>{{infos.order_id}}</td>
                                    <td>
                                        <label v-for="order in infos.orders" :key="order.id"> {{order.count}}x -
                                            {{order.name}} </label>
                                    </td>

                                    <td>{{infos.order_amount}}</td>
                                    <td>{{infos.m_status}}</td>


                                </tr>
                            </tbody>
                        </table>


                    </div>
                    <div class="tab-pane" id="edit">

                        <div class="bg-white col-8">
                            <h4 class=" pb-4"><i class="ti ti-user mr-3 text-primary"></i>Kişisel Bilgiler</h4>
                            <div class="row mb-5">
                                <div class="form-group col-sm-8">
                                    <label>Ad</label>
                                    <input type="text" @change="changeFirstName" class="form-control"
                                        v-model="userInfos.firstname">
                                </div>
                                <div class="form-group col-sm-8">
                                    <label>Soyad</label>
                                    <input type="text" class="form-control" @change="changeLastName"
                                        v-model="userInfos.lastname">
                                </div>


                                <div class="form-group col-sm-8">
                                    <label>Telefon</label>
                                    <input type="number" class="form-control" @change="changePhone"
                                        v-model="userInfos.phone">
                                </div>
                                <div class="form-group col-sm-8">
                                    <label>E-posta </label>
                                    <input type="email" class="form-control" @change="changeMail"
                                        v-model="userInfos.email">
                                </div>
                                <div class="form-group col-md-8">

                                    <button class="btn btn-primary " @click="sendNewInfo">Değişiklikleri Kaydet</button>
                                </div>
                            </div>




                        </div>



                    </div>

                    <div class="tab-pane" id="passwordEdit">

                        <div class="bg-white col-8">
                            <h4 class=" pb-4"><i class="ti ti-user mr-3 text-primary"></i>Kişisel Bilgiler</h4>
                            <div class="row mb-5">
                                <div class="form-group col-sm-8">
                                    <label>Eski Şifreniz</label>
                                    <input type="password" class="form-control" v-model="oldPassword">
                                </div>
                                <div class="form-group col-sm-8">
                                    <label>Yeni Şifreniz</label>
                                    <input type="password" class="form-control" v-model="newPassword">
                                </div>
                                <div class="form-group col-sm-8">
                                    <label>Yeni Şifreniz Tekrar</label>
                                    <input type="password" class="form-control" v-model="newPassword2">
                                </div>



                                <div class="form-group col-md-8">

                                    <button class="btn btn-primary " @click="sendNewPassword">Değişiklikleri
                                        Kaydet</button>
                                </div>
                            </div>




                        </div>



                    </div>
                    <div class="tab-pane" id="adressEdit">

                        <div class="container col-md-12">
                            <div class="bg-white ">
                                <h4 class=" pb-4"><i class="ti ti-location-pin mr-3 text-primary"></i>Adres Bilgileri
                                </h4>
                                <div class="row mb-5">
                                    <div v-if="userInfos.adress_3 == null" class=" col-md-4" style="width: 18rem;">
                                        <div class="border--primary">
                                            <div class=" mt-5" data-toggle="modal" data-target="#addAdress"><a
                                                    style="pointer-events: none;"> <i class="ti ti-pencil-alt"
                                                        style="font-size:50px;margin:40%"></i></a></div>
                                            <span class="text-center" style="font-weight: 700;
    color: #484848;">Yeni Teslimat Adresi Ekle</span>


                                        </div>
                                    </div>

                                    <div  v-if="userInfos.adress != null" class="col-md-4 " style="width: 18rem;">
                                        <div class="border--primary" style="height:10.9rem">
                                            <span class="text-center" style="font-weight: 700;
                                color: #484848;font-size:20px">Evim</span> <br>
                                            <span class="text-center" style="font-weight: 700;
                                color: #484848;">{{userInfos.adress.content}}</span>
                                <br>
                        <div data-toggle="modal" data-target="#addAdress">
                                     <a   style="pointer-events: none;font-weight: 700;
                                color: #444;">Düzenle</a>
                                </div>

                                        </div>
                                    </div>
                                     <div v-if="userInfos.adress_2 != null" class="col-md-4 " style="width: 18rem;">
                                        <div class="border--primary" style="height:10.9rem">
                                            <span class="text-center" style="font-weight: 700;
                                color: #484848;font-size:20px">{{userInfos.adress_2.title}}</span>
                                <br>
                                            <span class="text-center" style="font-weight: 700;
                                color: #484848;">{{userInfos.adress_2.content}}</span>
                                <br>

                                <div data-toggle="modal" data-target="#addAdress">
                                     <a   style="pointer-events: none;font-weight: 700;
                                color: #444;">Düzenle</a>
                                </div>


                                        </div>
                                    </div>

 <div class="col-md-4 " style="width: 18rem;">
                                        <div v-if="userInfos.adress_3 != null" class="border--primary" style="height:10.9rem">
                                            <span class="text-center" style="font-weight: 700;
                                color: #484848;font-size:20px">{{userInfos.adress_3.title}}</span>
                                <br>
                                            <span class="text-center" style="font-weight: 700;
                                color: #484848;">{{userInfos.adress_3.content}}</span>
                                <br>


                                        </div>
                                    </div>


                                     
                                </div>
                            </div>
                        </div>




                    </div>



                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addAdress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Adres Ekle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Adres İsmi </label>
                                    <input type="email" class="form-control" v-model="adressTitle" placeholder="(Evim,İş Yerim)">
                                </div>


                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Açık Adres</label>
                                    <textarea class="form-control" v-model="adress" rows="3" placeholder="Mahalle, sokak, cadde ve diğer bilgilerinizi giriniz"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                            <button type="button" class="btn btn-primary" @click="sendAdress">Değişiklikleri Kaydet</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</template>
<script>
    import {
        mapGetters,
        mapActions
    } from 'vuex';
    import axios from 'axios'
    import swal from 'sweetalert';



    export default {
        data() {
            return {
               
                adressTitle:'',
                adress:'',
                oldPassword: null,
                newPassword: null,
                newPassword2: null,
                firstname: "",
                lastname: "",
                phone: "",
                email: "",



                url: "https://ui-avatars.com/api/?name=`{userInfos.firstname +userInfos.lastname}`"
            }
        },

        methods: {

            ...mapActions(['fetchUserInfo', 'fetchUserOrder']),

            sendNewPassword() {
                const url = "user/update";
                if (this.newPassword === this.newPassword2 && this.oldPassword != "") {
                    axios.post(url, {
                        newPassword: this.newPassword,
                        oldPassword: this.oldPassword
                    }).then((obj) => {
                        swal("Şifre Başarıyla Değiştirildi !", "", "success", {
                            button: "Devam Et!",
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    })
                }

            },

                sendAdress(){

                    const url  = '/user/update';
                   if(this.adressTitle != '' && this.adress !=''){
                        axios.post(url,{adress:{id:0,title:this.adressTitle,content:this.adress}}).then((res) =>{
                                location.reload();
                                
                        })
                   }
                },

            sendNewInfo() {

                const url = "user/update";

                axios.post(url, {
                    firstname: this.firstname,
                    lastname: this.lastname,
                    phone: this.phone,
                    email: this.email
                }).then((obj) => {

                    swal("Bilgiler Başarıyla Değiştirildi !", "", "success", {
                        button: "Devam Et!",
                        timer: 1500
                    }).then((res) => {
                      if(res.status == "basarili"){
                            location.reload();
                      }
                    });

                })



            },
            changeFirstName(e) {
                console.log(e.target.value);
                this.firstname = e.target.value

            },
            changeLastName(e) {
                console.log(e.target.value);
                this.lastname = e.target.value

            },
            changePhone(e) {
                console.log(e.target.value);
                this.phone = e.target.value

            },
            changeMail(e) {
                console.log(e.target.value);
                this.email = e.target.value

            }


        },
        computed: mapGetters(['userInfos', 'userOrderInfos']),
        created() {

                
                
            this.fetchUserInfo();



            this.fetchUserOrder();

        }


    }
</script>