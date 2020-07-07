<template>
  <div id="app">
    <router-view id="routerView"/>
    <div id="nav">
      <router-link to="/">訂餐</router-link> |
      <router-link to="/shoppingcart">購物車</router-link> |
      <router-link to="/member">會員專區</router-link>
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
}
#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
