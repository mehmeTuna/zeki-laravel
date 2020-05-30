import axios from "axios";
import swal from "sweetalert";

const state = {
    products: [],
    userInfos: [],
    cartItems: [],
    orderInfos: [],
    userOrderInfos: [],
    productDetailedOnSepet: {
        name: "",
        price: "",
        count: 1
    }
};

const getters = {
    allProducts: state => state.products,
    userInfos: state => state.userInfos,
    allCartItems: state => state.cartItems,
    // allCartItems:(state) => [{"id":"718604","count":1,"features":[{"count":1,"items":[]}],"price":10,"name":"Künefe"},{"id":"718604","count":1,"features":[{"count":1,"items":[]}],"price":10,"name":"Adana Kebap 1.5 porsiyon"}],
    orderInfos: state => state.orderInfos,
    userOrderInfos: state => state.userOrderInfos,
    productDetailedOnSepet: state => state.productDetailedOnSepet
};

const actions = {
    async fetchProducts({ commit }) {
        const response = await axios.get("api/menu");
        commit("setProducts", response.data);
        // const fakeData = [
        //   {
        //     id:"11",name:"Kebaplar",position:"0",categoryImage:"https://www.tiklagelsin.com/cmsfiles/categories/usta-donerci/menuler-urunler/menuler.png?v=153",
        //     menuItems:[
        //       {id:"577194",name:"Çöp Şiş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //         options:[
        //           {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //         ],
        //         description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //         img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //       },
        //       {id:"577194",name:"Çöp Şiş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //       options:[
        //         {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //       ],
        //       description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //       img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //     },
        //     {id:"577194",name:"Çöp Şiş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //     options:[
        //       {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //     ],
        //     description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //     img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //   }]
        //   },
        //   {id:"12",name:"Izgaralar",position:"1",categoryImage:"https://www.tiklagelsin.com/cmsfiles/categories/usta-donerci/menuler-urunler/tek-urunler.png?v=153",
        //     menuItems:[
        //       {id:"577194",name:"Çöp Şişşşşş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //         options:[
        //           {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //         ],
        //         description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //         img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //       }]
        //   },
        //   {id:"13",name:"Çiğköfte",position:"2",categoryImage:"https://www.tiklagelsin.com/cmsfiles/categories/usta-donerci/menuler-urunler/cocuk-menuleri.png?v=153",
        //     menuItems:[
        //       {id:"577194",name:"Çöp Şişşşşş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //         options:[
        //           {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //         ],
        //         description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //         img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //       }]
        //   },
        //   {id:"14",name:"Dürümler",position:"1",categoryImage:"https://www.tiklagelsin.com/cmsfiles/categories/usta-donerci/menuler-urunler/ek-lezzetler-ve-yan-urunler-product-bg.png?v=153",
        //     menuItems:[
        //       {id:"577194",name:"Çöp Şişşşşş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //         options:[
        //           {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //         ],
        //         description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //         img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //       }]
        //   },
        //   {id:"15",name:"Tatlılar",position:"1",categoryImage:"https://www.tiklagelsin.com/cmsfiles/categories/usta-donerci/menuler-urunler/tatlilar-1.png?v=153",
        //     menuItems:[
        //       {id:"577194",name:"Çöp Şişşşşş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //         options:[
        //           {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //         ],
        //         description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //         img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //       }]
        //   },
        //   {id:"16",name:"İçecekler",position:"1",categoryImage:"https://www.tiklagelsin.com/cmsfiles/categories/usta-donerci/menuler-urunler/icecekler.png?v=153",
        //     menuItems:[
        //       {id:"577194",name:"Çöp Şişşşşş",position:"1",price:"25",category_name:"Kebaplar",quantity:"1",
        //         options:[
        //           {id:929,content:"Acılı"},{id:583,content:"Soğanlı"},{id:557,content:"Bol ekmek"}
        //         ],
        //         description:"Soğan salatası, ezme salata, mevsim salatası, közlenmiş soğan, közlenmiş domates, biber, yeşillik, limon",
        //         img:"http://www.aysoftdemo.site/img/724f9498462e2d43240e861a77a5edff.jpg"
        //       }]
        //   }
        // ]
        // commit('setProducts',fakeData)
    },
    increment({ commit }, id) {
        commit("increment", id);
    },
    decrement({ commit }, id) {
        commit("decrement", id);
    },
    fetchUserInfo({ commit }) {
        axios
            .get("user/me")
            .then(result => {
                console.log({ msg: "fetching is success", data: result.data });
                commit("setUserInfo", result.data);
                commit("setCartItems", result.data.product);
            })
            .catch(err => {
                console.log({ errMsg: err });
            });
    },
    setOrderDetail({ commit }, order) {
        console.log("front", order);
        return axios
            .post("user/payment", order)
            .then(response => {
                console.log("back", response);

                commit("setOrderInfo", response.data);
                if (response.data.status == true) {
                    return { message: { success: "success", status: true } };
                } else {
                    return { message: { success: "success", status: false } };
                }
            })
            .catch(err => {
                //  console.log({errMsg:err});
                return {
                    message: { error: "error" },
                    status: { error: "error" }
                };
            });
    },
    // sendSecondAdress({commit},secondAdress){
    //   this.state.userInfos.push({adress_2:secondAdress})
    // },
    addCartItem({ commit }, payload) {
        console.log(payload, "vuex action payload");
        axios
            .post("user/sepet", {
                id: payload.id,
                count: payload.count,
                options: payload.options
            })
            .then(response => {
                commit("addCartItem", payload);
            })
            .catch(err => {
                console.log({ err });
            });
    },
    deleteCartItem({ commit }, cartItemId) {
        //buraya istek gelecek

        commit("deleteCartItem", cartItemId);
    },

    fetchUserOrder({ commit }) {
        axios.get("user/orders").then(response => {
            console.log({ msg: "order fetch is success", data: response.data });
            commit("setUserOrder", response.data);
        });
    }
};

const mutations = {
    setProducts: (state, products) => (state.products = products),
    setUserInfo: (state, userInfos) => (state.userInfos = userInfos),
    setCartItems: (state, payload) => (state.cartItems = payload),
    setOrderInfo: (state, order) => (state.orderInfos = order),
    addCartItem(state, payloadData) {
        let payload = { ...payloadData };
        const isMatch = state.cartItems.some(item => {
            return item.id === payload.id;
        });
        if (!isMatch) {
            state.userInfos.orderCount++;
            state.cartItems.push(payload);
        } else {
            // console.log("eski product",state.cartItems)
            state.cartItems.map(item => {
                if (item.id == payload.id) {
                    item.count += payload.count;
                    item.price += payload.price;
                }
                return item;
            });
            // console.log("yeni product",state.cartItems)
        }
        // state.userInfos.orderCount +=payload.count
        state.userInfos.cardTotal += payload.price;
    },
    increment(state, payload) {
        state.products[payload.index1].menuItems[payload.index2].quantity++;
    },
    decrement(state, payload) {
        if (
            state.products[payload.index1].menuItems[payload.index2].quantity ==
            1
        ) {
            swal("Daha Fazla Azaltamazsınız");
        } else {
            state.products[payload.index1].menuItems[payload.index2].quantity--;
        }
    },
    setUserOrder: (state, userOrderInfos) =>
        (state.userOrderInfos = userOrderInfos),
    deleteCartItem({ state }, cartItemId) {
        axios
            .get("user/sepetDel/" + cartItemId)
            .then(result => {
                const cartItemIndex = state.cartItems.findIndex(item => {
                    return item.id == cartItemId;
                });
                console.log("cart item index", cartItemIndex);
                if (cartItemIndex != -1) {
                    throw new Error("Böyle bir kayıt bulunamadı");
                }
                let count = state.cartItems[cartItemIndex].count;
                let price = state.cartItems[cartItemIndex].price;
                state.userInfos.cardTotal -= price;
                state.userInfos.orderCount -= count;
                state.cartItems.splice(cartItemIndex, 1);
                console.log("silinmiş olmalı state.cartItems", state.cartItems);
            })
            .catch(err => {
                throw new Error({ err });
            });
    }
};
export default {
    state,
    getters,
    actions,
    mutations
};
