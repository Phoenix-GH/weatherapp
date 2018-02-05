<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
  </div>
</template>

<script>
import * as axios from 'axios'

export default {
  name: 'Hello',
  data () {
    return {
      msg: 'Welcome to Crypto Info'
    }
  },
  created () {
    axios.get('http://0.0.0.0:3000/')
      .then(response => {
        // JSON responses are automatically parsed.
        console.log(response.data)
        this.msg = response.data
      })
      .catch(e => {
        this.errors.push(e)
      })
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
