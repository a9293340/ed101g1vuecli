<template>
  <div id="app">
    <header>
      <img src="./images/header/user.png" id="memHead">
    </header>
    <router-view id="routerView"/>
    <div id="nav">
      <router-link class="navContent" to="/">訂餐</router-link> 
      <router-link class="navContent" to="/shoppingcart">購物車</router-link> 
      <router-link class="navContent" to="/member">會員專區</router-link> 
      <router-link class="navContent" to="/siginin">登入</router-link>
    </div>
  </div>
</template>

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
  header{
    max-width: 576px;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    margin: 20px 0;
    #memHead{
      // margin-left: 30px;
      width: 50px;
      border-radius: 50%;
      border: 1px solid #000;
    } 
  }
}
#nav {
  // padding: 30px;
  width: 100%;
  margin: 20px;
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-items: center;
  .navContent{
    width: 22%;
  }
  a {
    font-weight: bold;
    font-size: 1.5rem;
    color: #2c3e50;
    text-align: center;
    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
