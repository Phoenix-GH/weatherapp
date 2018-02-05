<template>
    <div class="container-fluid">
        <div class="row">
            <div class="alert alert-danger alert-dismissable">
                <ul>
                    <li>{{msg}}</li>
                </ul>
            </div>
            <section class="side-wrapper two-col">
                <div class="side-wrapper__left">
                    <img src="../../assets/images/laptop-book-pro-dash.png" class="image-hero">
                </div>
                <div class="side-wrapper__right">
                    <div class="form-wrapper">
                        <div class="logo-wc form"></div>
                        <p>
                            See WeatherCheck in action.<br/>
                            Check a Single property.
                        </p>
                        <form role="form">
                            <vue-google-autocomplete
                                :country="['us']"
                                id="map"
                                className="form-control"
                                placeholder="Full Address"
                                name="address"
                            ></vue-google-autocomplete>
                            <input class="btn" type="submit" name="submit" value="Check" @click="submit">
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import VueGoogleAutocomplete from 'vue-google-autocomplete'

export default {
  name: 'Search',
  components: { VueGoogleAutocomplete },
  data () {
    return {
      msg: '',
      address: ''
    }
  },
  methods: {
    submit () {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.side-wrapper {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-flow: column nowrap;
          flex-flow: column nowrap;
  -ms-flex-pack: distribute;
      justify-content: space-around;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  height: calc(100vh - 56px);
  width: 100vw;
}

.side-wrapper.two-col {
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-flow: row nowrap;
          flex-flow: row nowrap;
}

.image-hero {
  display: inline-block;
  width: 100%;
  height: auto;
}

.side-wrapper__left {
  -webkit-box-flex: 1;
      -ms-flex: 1 75%;
          flex: 1 75%;
}

.side-wrapper__right {
  -webkit-box-flex: 1;
      -ms-flex: 1 60%;
          flex: 1 60%;
  background: url("../../assets/images/clouds.png") no-repeat center;
  background-size: contain;
  height: 80%;
  -webkit-transform: translate(-50px, -60px);
          transform: translate(-50px, -60px);
  position: relative;
  z-index: 2;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
}

</style>
