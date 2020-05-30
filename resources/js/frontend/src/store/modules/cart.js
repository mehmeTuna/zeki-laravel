/*
const state = {
  menuItem:[],
}

const getters = {
  cartProducts: (state, getters, rootState) => {
    return state.items.map(({ id}) => {
      const menuItem = rootState.menuItems.all.find(menuItem => menuItem.id === id)
      return {
        name: menuItem.name,
        price: menuItem.price,
       
      }
    })
  },

}

const actions = {
  addProductToCart ({ state, commit }, menuItem) {
    
      const cartItem = state.menuItems.find(item => item.id === menuItem.id)
        if (!cartItem) {
        commit('pushProductToCart', { id: menuItem.id })
     
        
      } 
     
    
    }
  }



const mutations ={
  pushProductToCart (state, { id }) {
    state.menuItems.push({
      id,
      
    })
  },

  setCartItems (state, { menuItems }) {
    state.menuItems = menuItems
  },

}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
*/