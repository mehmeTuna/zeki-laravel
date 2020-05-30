<template>
  <div id="app">
  <Header/>
  <Sidebar/>
  <router-view></router-view>
  </div>
</template>

<script>
import Sidebar from './components/Sidebar'
import Header from './components/Header'


export default {
  name: 'app',
  components: {
    Sidebar,
    Header

  }
}
</script>

<style>

</style>
