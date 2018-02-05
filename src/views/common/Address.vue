<template>
    <div class="container-fluid">
        <div class="row">
            <section class="side-wrapper two-col">
                <div class="side-wrapper__left">

                </div>
                <div class="side-wrapper__right">
                    <div class="form-wrapper">
                        <div class="logo-wc form"></div>
                        <p>
                            See WeatherCheck in action.<br/>
                            Check a Single property.
                        </p>
                        <form role="form" action="" method="POST">
                            <input type="text" id="address" placeholder="Full Address" class="form-control" name="address">
                            <input class="btn" type="submit" name="submit" value="Check">
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>

export default {
  name: 'Address',
  data () {
    return {
      msg: 'Welcome to Crypto Info'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
