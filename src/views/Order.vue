<template>
  <div>
    <div v-for="set in memSetProduct" :key="set">
      <h1>{{set.setName}}</h1>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
// import HelloCool from '@/components/HelloCool.vue'
// import Vue from 'vue';
// import $ from 'jquery';
// import axios from 'axios';
export default {
  data(){
    return {
      memSetProduct:[],
      memOtherProduct:[],
    }
  },
  mounted(){
    // $.ajax({
    //       type: "GET",
    //       url: "./php/memajax3.php",
    //       success: function (response) {
    //           this.memSetProduct = JSON.parse(response)[0];
    //           this.memOtherProduct = JSON.parse(response)[1];
    //           console.log(this.memOtherProduct);
    //       }
    //   });
    fetch("./php/memajax3.php")
    .then(res => res.json())
    .then((res)=>{
      console.log(res)
      this.memSetProduct = res[0];
      this.memOtherProduct = res[1];
      console.log(this.memOtherProduct);
    })
  // this.$nextTick(function () {
  //     axios.get('./php/memajax3.php').then(function(res){
  //     Vue.$data.memSetProduct = res.data[0];
  //   })
  //   })
  }
}
</script>

<style lang="scss">

</style>

