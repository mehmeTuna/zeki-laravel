import axios from 'axios'

const state =  {
    datas:[],



}

const getters = {
allDatas:(state) => state.datas
}

const actions = {
  async  testRequest({commit}){
  const response = await  axios.get('http://localhost:81/admin/api/thisdayorder');
  console.log(response.dat)
  commit('setDatas',response.data)
  
  },
  
}


const mutations = {
  setDatas:(state,datas) =>(state.datas = datas)

}

export default {
  state,
  getters,
  actions,
  mutations
}