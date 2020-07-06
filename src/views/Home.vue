<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
    <HelloCool msg="Welcome to Your Cool.js"/>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
import HelloCool from '@/components/HelloCool.vue'

export default {
  name: 'Home',
  components: {
    HelloCool,
    HelloWorld,
  },
  mounted(){
    fetch("./api/bkSetFind.php")
    .then(res => res.json())
    .then(rs => {
        const bandowns = rs;
        console.log(bandowns);
    })
  }
}
</script>
