<template>
  <div>
    <!-- div v-for="set in memSetProduct" :key="set">
       <h1>{{set.setName}}</h1>
    </div> -->
     <div id="buy_app3">
                <div class="buy_setdo_containter scroll">
      
                    <div  v-for="item in orderSetdo" :key="item">
                        <div v-if="item.setStatus==1 && item.setClass ==0" class="buy_card3">
                          <img :id="'setdoimg'+item.setId"  :data-id="item.setId" v-bind:src="item.setImage" atl="" width="200" height="200">
                          <div class="buy_name">{{item.setName}}&nbsp;&nbsp;<span>$</span>{{item.setPrice}}</div>
                          <div><button class="orderbutton" :id ="'setdocountminus'+item.setId" :data-num="item.setId">-</button><span class="ordercount" :id="'setdocount'+item.setId">0</span><button class="orderbutton" :id ="'setdocountplus'+item.setId" :data-num="item.setId">+</button>
                                <button  :id="'setdocart'+item.setId" :data-id="item.setId" class="cart">加入購物車</button>
                          </div>
                        </div>



                    
                    </div>

                    <div  v-for="item in orderSetdo" :key="item">
                        <div v-if="item.setStatus==1 && item.setClass ==1" class="buy_card3">
                          <img :id="'setdoimg'+item.setId"  :data-id="item.setId" v-bind:src="item.setImage" atl="" width="200" height="200">
                          <div class="buy_name">{{item.setName}}&nbsp;&nbsp;<span>$</span>{{item.setPrice}}</div>
                          <div><button class="orderbutton" :id ="'setdocountminus'+item.setId" :data-num="item.setId">-</button><span class="ordercount" :id="'setdocount'+item.setId">0</span><button class="orderbutton" :id ="'setdocountplus'+item.setId" :data-num="item.setId">+</button>
                                <button  :id="'setdocart'+item.setId" :data-id="item.setId" class="cart">加入購物車</button>
                          </div>
                        </div>



            
                    </div>
           
                   


                 
                </div>
      
      
            </div> 
  </div>
</template>

<script>
let orderSetdo=[];



// fetch("./php/memajax3.php")
//     .then(res => res.json())
//     .then((res)=>{
//       console.log(res)
//       // this.orderSetdo = res[0];
//       orderSetdo = res[0];
//       console.log(orderSetdo);
//       // this.memOtherProduct = res[1];
//       // console.log(this.memOtherProduct);
//     })

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
      console.log(orderSetdo);
      this.memOtherProduct = res[1];
      console.log(this.memOtherProduct);
       console.log(orderSetdo);
        let setdocount=[];
        var setdoMany = 0;
        var setdoId = 0;
        var setdoName = 0;
        var setdoPrice = 0;
        var setdoImg = 0;
        var setdoNum = 0;
        let setdoMenu=[];
  
var finalsetdolist1 = JSON.parse(localStorage.getItem('setdoMenuList'));
setdoMenu = finalsetdolist1;


      setTimeout(function() {
for(var j=0; j < orderSetdo.length;j++){    //套餐的+- 購物車   click事件
    if(orderSetdo[j].setStatus==1){
    setdocount[orderSetdo[j].setId]=0;
    document.getElementById(`setdocountplus${orderSetdo[j].setId}`).addEventListener('click',setdoplus)
    document.getElementById(`setdocountminus${orderSetdo[j].setId}`).addEventListener('click',setdominus)
    document.getElementById(`setdocart${orderSetdo[j].setId}`).addEventListener('click',setdoCart)
   
    }
}    



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
 }, 500);
    })

    
  // this.$nextTick(function () {
  //     axios.get('./php/memajax3.php').then(function(res){
  //     Vue.$data.memSetProduct = res.data[0];
  //   })
  //   })
  }
}

 
</script>


<<<<<<< HEAD
=======
    #buy_app3 {
  height: 650px;
  font-family: 'Noto Sans TC','Noto Sans', '微軟正黑體', "Times New Roman", sans-serif;
  // overflow-y: auto;


.buy_setdo_containter {
  flex-wrap: wrap;
  width: 1050px;
  margin: 0 auto;
  height: 350px;
  display: flex;
  // justify-content: space-between;
}

.buy_card3 {
  width: 250px;
  height: 308px;
  margin: 10px 50px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
  position: relative;

  // &:hover {
    // box-shadow: 2px 2px 10px $orange;
  // }
 
  .cart {
    // @include btn(auto, auto);
    transition-duration: 0.2s;
    transition-property: all;
    transform-origin: 50% 50%;
    color: white;
    background-color: #EA6227;
    font-family: "Noto Sans TC";
    font-size: 14px;
    width:180px;
    font-weight: 700;
    letter-spacing: 2px;
    padding: 5px 10px;
    border-radius: 5px;
    
  }

  img {
    margin-top: 5px;
    cursor: pointer;
  }

  p {
    margin: 0;
    // color: $grey;
  }

  .orderbutton {
    cursor: pointer;
    border-radius: 5px;
    margin: 5px 5px;
    width: 23px;
    height: 23px;
    font-size: 20px;
  
    background-color: #37AB64;

    border: none;
    color: #fff;

    &:hover {
      background-color: #40dd7c;
    }
  }
  .ordercount{
    font-size: 18px;
  }
}

}

</style>
>>>>>>> 3d5fd0617bb0000e24c93d857eda21ef17649bea

