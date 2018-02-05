<template>
  <div id="spark-app" class="spark-app">
    <Header />
    <router-view></router-view>
  </div>
</template>

<script>
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import Header from './views/common/Header'
import './css/app.css'
import './css/design-app.css'
import './css/sweetalert.css'
import './css/vendor.min.css'

Vue.use(BootstrapVue)

export default {
  name: 'App',
  components: {
    Header
  }
}
</script>

<style>

</style>
