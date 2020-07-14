<template>
  <div>
    <!-- div v-for="set in memSetProduct" :key="set">
       <h1>{{set.setName}}</h1>
    </div> -->
     <div id="buy_app3">
                <div class="buy_setdo_containter scroll">
      
                    <div class="buy_card3" v-for="item in orderSetdo" :key="item">
                        <div v-if="item.setStatus==1 && item.setClass ==0">
                          <img :id="'setdoimg'+item.setId"  :data-id="item.setId" v-bind:src="item.setImage" atl="" width="200" height="200">
                          <div class="buy_name">{{item.setName}}&nbsp;&nbsp;<span>$</span>{{item.setPrice}}</div>
                          <div><button class="orderbutton" :id ="'setdocountminus'+item.setId" :data-num="item.setId">-</button><span class="ordercount" :id="'setdocount'+item.setId">0</span><button class="orderbutton" :id ="'setdocountplus'+item.setId" :data-num="item.setId">+</button>
                                <button  :id="'setdocart'+item.setId" :data-id="item.setId" class="cart">加入購物車</button>
                          </div>
                        </div>



                        <div class="buy_single_lightbox box3">
                            <div class="orderrelitive">
                                <h3 id="setdolightTitle"></h3>  
                                <img src="" alt="" width="200" height="200" id="setdolightImg">
                                <p id="setdolightText"></p>
                                <img src="../images/order/close.svg" class="closelightbox3" width="15" height="15">
                            </div>
                        </div>
                    </div>

                    <div class="buy_card3" v-for="item in orderSetdo" :key="item">
                        <div v-if="item.setStatus==1 && item.setClass ==1">
                          <img :id="'setdoimg'+item.setId"  :data-id="item.setId" v-bind:src="item.setImage" atl="" width="200" height="200">
                          <div class="buy_name">{{item.setName}}&nbsp;&nbsp;<span>$</span>{{item.setPrice}}</div>
                          <div><button class="orderbutton" :id ="'setdocountminus'+item.setId" :data-num="item.setId">-</button><span class="ordercount" :id="'setdocount'+item.setId">0</span><button class="orderbutton" :id ="'setdocountplus'+item.setId" :data-num="item.setId">+</button>
                                <button  :id="'setdocart'+item.setId" :data-id="item.setId" class="cart">加入購物車</button>
                          </div>
                        </div>



                        <div class="buy_single_lightbox box3">
                            <div class="orderrelitive">
                                <h3 id="setdolightTitle"></h3>  
                                <img src="" alt="" width="200" height="200" id="setdolightImg">
                                <p id="setdolightText"></p>
                                <img src="../images/order/close.svg" class="closelightbox3" width="15" height="15">
                            </div>
                        </div>
                    </div>
           
                   


                   </div>
                 
                </div>
      
      
            </div> 
  </div>
</template>

<script>

    
   
        let setdocount=[];
        var setdoMany = 0;
        var setdoId = 0;
        var setdoName = 0;
        var setdoPrice = 0;
        var setdoImg = 0;
        let orderSetdo = [];
        var setdoNum = 0;
        let setdoMenu=[];
      
for(var j=0; j < orderSetdo.length;j++){    //套餐的+- 購物車   click事件
    if(orderSetdo[j].setStatus==1){
    setdocount[orderSetdo[j].setId]=0;
    document.getElementById(`setdocountplus${orderSetdo[j].setId}`).addEventListener('click',setdoplus)
    document.getElementById(`setdocountminus${orderSetdo[j].setId}`).addEventListener('click',setdominus)
    document.getElementById(`setdocart${orderSetdo[j].setId}`).addEventListener('click',setdoCart)
    // document.getElementById(`setdoimg${orderSetdo[j].setId}`).addEventListener('click',setdolightBox)
    }
}     
// document.getElementsByClassName('closelightbox3')[0].addEventListener('click',closelightbox3);



// function setdolightBox(){
//     document.getElementsByClassName('box3')[0].style.display='block';
//     document.getElementsByClassName('box3')[1].style.display='block';
//     let A = this.dataset.id;
//     console.log(A);
//     for(let i = 0;i<orderSetdo.length;i++){
//         if(orderSetdo[i].setId == Number(A)){
//             document.getElementById('setdolightTitle').innerText = orderSetdo[i].setName;
//             document.getElementById('setdolightImg').src = orderSetdo[i].setImage;
//             document.getElementById('setdolightText').innerText = orderSetdo[i].setInfo;
//         }
//     }
// }

// document.getElementsByClassName('closelightbox3')[0].addEventListener('click',closelightbox3);
// function closelightbox3(){ 
//     document.getElementsByClassName('box3')[0].style.display='none';
//     document.getElementsByClassName('box3')[1].style.display='none';
// }



// document.getElementsByClassName('closelightbox1')[0].addEventListener('click',closelightBox1)



// document.getElementsByClassName('closelightbox0')[0].addEventListener('click',closelightBox0)



// document.getElementsByClassName('closelightbox2')[0].addEventListener('click',closelightBox2)











//購物車








function setdoplus(){     //套餐數量++
    let num = this.dataset.num
    setdocount[num]++;
    console.log(setdocount[num]);
    document.getElementById(`setdocount${num}`).innerText = setdocount[num];
}
   
function setdominus(){    //套餐數量--
    let num = this.dataset.num
    if(setdocount[num]>0){
    setdocount[num]--;
    console.log(setdocount[num]);
    document.getElementById(`setdocount${num}`).innerText = setdocount[num];
    }

}


function setdoCart(){      //套餐的加入購物車
    let A = this.dataset.id;
    console.log(A);
    for(let i = 0;i<orderSetdo.length;i++){
        if(orderSetdo[i].setId == Number(A)){
            setdoMany =  document.getElementById(`setdocount${A}`).innerText;
            setdoId = orderSetdo[i].setId;
            setdoName = orderSetdo[i].setName;
            setdoPrice = orderSetdo[i].setPrice;
            setdoImg = orderSetdo[i].setImage;
            if(setdoMany>0){

              var  setdoList=
                {
                    setdoNum:`${setdoNum}`,
                    setdoMany:`${setdoMany}`,
                    setdoId:`${setdoId}`,
                    setdoName:`${setdoName}`,
                    setdoPrice:`${setdoPrice}`,
                    setdoImg:`${setdoImg}`,
                }

                var samename = 0;
                if(setdoMenu.length>0){
                     for(var c =0  ;c < setdoMenu.length; c++){
                            if(setdoMenu[c].setdoName == setdoList.setdoName){
                                samename=1;
                            setdoMenu[c].setdoMany = parseInt(setdoMenu[c].setdoMany)+parseInt(setdoList.setdoMany);
                            } 
                     }
                    if(samename!=1){
                        setdoMenu.push(setdoList);
                
                    }
                }
                else
                {
                   
                    setdoMenu.push(setdoList);
                  
                }
               
                var setdoMenuList =JSON.stringify(setdoMenu);
                localStorage.setItem('setdoMenuList',setdoMenuList);

               
              //  setsetdocart();
               alert('已加入購物車');
            }else{
                alert("還沒選數量喔");
            }
        }
    }
}


// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
// import HelloCool from '@/components/HelloCool.vue'
// import Vue from 'vue';
// import $ from 'jquery';
// import axios from 'axios';
export default {
  data(){
    return {
      orderSetdo:[],
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
      this.orderSetdo = res[0];
      orderSetdo = res[0];
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

