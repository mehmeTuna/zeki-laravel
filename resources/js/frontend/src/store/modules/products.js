import axios from "axios";
import swal from "sweetalert";

const state = {
    products: [],
    userInfos: [],
    cartItems: [],
    orderInfos: [],
    userOrderInfos: [],
    location: localStorage.getItem("location"),
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
    setCartItem(state, cartItemId) {
        console.log("cart item mutate", cartItemId);
        state.cartItems = state.cartItems.filter(item => {
            if ((item.id !== cartItemId) == false) {
                state.userInfos.cardTotal -= item.price;
                state.userInfos.orderCount -= item.count;
                state.userInfos.product;
            }
            return item.id !== cartItemId;
        });
        // console.log("cart item index", cartItemIndex);
        // if (cartItemIndex != -1) {
        //     throw new Error("Böyle bir kayıt bulunamadı");
        // }
        // let count = state.cartItems[cartItemIndex].count;
        // let price = state.cartItems[cartItemIndex].price;
        // state.userInfos.cardTotal -= price;
        // state.userInfos.orderCount -= count;

        console.log("silinmiş olmalı state.cartItems", state.cartItems);
    },
    setUserOrder: (state, userOrderInfos) =>
        (state.userOrderInfos = userOrderInfos)
};
const actions = {
    async fetchProducts({ commit }) {
        console.log(state.location);
        const response = await axios.get(`api/menu?location=${state.location}`);
        // const response = await axios.get("api/menu");

        commit("setProducts", response.data);
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
                swal({
                    title:
                        "Lütfen Adresinizi Seçiniz Yada Profil Kısmından Adres Ekleyiniz !",
                    text: "",
                    icon: "warning",
                    button: "Devam Et!",
                    timer: 1500
                });
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
        axios
            .get("user/sepetDel/" + cartItemId)
            .then(result => {
                console.log(result);
                if (result.data.status === true) {
                    console.log("action yapıldı", cartItemId);
                    commit("setCartItem", cartItemId);
                }
            })
            .catch(err => {
                console.log(err);
            });
    },

    fetchUserOrder({ commit }) {
        axios.get("user/orders").then(response => {
            console.log({ msg: "order fetch is success", data: response.data });
            commit("setUserOrder", response.data);
        });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
