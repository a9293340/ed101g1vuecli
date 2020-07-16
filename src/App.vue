<template>
  <div id="app">
    <router-view id="routerView"/>
    <div id="nav">
      <router-link class="navContent" to="/">訂餐</router-link> 
      <router-link class="navContent" to="/shoppingcart">購物車</router-link> 
      <router-link class="navContent" id="navMem" to="/member">會員專區</router-link> 
      <router-link class="navContent" id="navSign" to="/siginin">登入</router-link>
    </div>
  </div>
</template>

<script>
export default {
  mounted(){
    if(sessionStorage['signinOrNot'] == 1){
      document.getElementById('navMem').style.display = 'block';
      document.getElementById('navSign').style.display = 'none';
    }
  }
}
</script>

<style lang="scss">
body{
  display: flex;
  justify-content: center;
  align-items: center;
}
#app{
  max-width: 1200px;
  // border: 1px solid red;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  #routerView{
    width: 100%;
  }
}
#nav {
  // padding: 30px;
  width: 100%;
  min-width: 350px;
  margin: 20px;
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-items: center;
  .navContent{
    width: 34%;
    background-color: rgb(184, 228, 231);
    padding: 20px 0;
  }
  #navMem{
    display: none;
  }
  a {
    font-weight: bold;
    font-size: 1.5rem;
    color: #2c3e50;
    text-align: center;
    &.router-link-exact-active {
      color: #42b983;
      background-color: rgb(230, 193, 146);
    }
  }
}
</style>
