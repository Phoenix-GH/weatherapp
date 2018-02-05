<template>
  <div class="navbar navbar-fixed-top">
    <header>
        <a class="navbar-brand" href="">
            <div class="logo-wc"></div>
        </a>
        <div class="header__sign-in">
          <a title="Home" href="/" style="line-height: 88px;">Home</a>
          <a title="About" href="https://weathercheck.co/about/" style="line-height: 88px;">About</a>
          <a title="FAQ" href="https://weathercheck.co/faq/" style="line-height: 88px;">FAQ</a>
          <a title="Contact" href="https://weathercheck.co/contact/" style="line-height: 88px;">Contact</a>
          <a href="/register" class="btn btn-green">Register</a>
          <a href="/login" class="btn sign-in">Sign In</a>
        </div>
    </header>
</div>
</template>

<script>

export default {
  name: 'Header'
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

header {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: stretch;
      -ms-flex-align: stretch;
          align-items: stretch;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  height: 56px;
  background-color: white;
  /*            line-height: 56px;*/
  padding: 0 20px;
  color: white;
  border-bottom: 2px solid #d1d1d4;
  font-size: 13px;
  font-family: 'Roboto', serif;
}

header a {
  text-decoration: none;
  display: inline-block;
  letter-spacing: .025em;
  -webkit-transition: all 500ms ease-in-out;
  transition: all 500ms ease-in-out;
  margin-right: 2em;
}

header a:link,
header a:visited {
  color: #6a6a6a;
}

header a:hover,
header a:active {
  color: #adb2b5;
}

#footer {
  background-color: #171717;
}

.header__sign-in {
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -ms-flex-item-align: center;
      align-self: center;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  text-align: right;

}

  .btn:link, .btn:visited, .btn:hover, .btn:active {
    color: white; }
</style>
