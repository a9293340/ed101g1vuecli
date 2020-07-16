<template>
  <div>
  <div>
  <div id="list">
  <div class="ordercart" id="ordercart">
  
  <h3>自選便當</h3>
    <div class="selfbenton" v-for="item in finalsinglelist" :key="item">
      <!-- <span :id="'b'+item.sNum" :data-num="item.sNum" width="15" height="15"> -->
      <img class="orderclose" src="../images/showbenton/close.png" alt="" :id="'b'+item.sNum" :data-num="item.sNum"  @click='singledelete'/>
      <!-- </span> -->
      <div class="selfbento_box">
        <div class="selimg">
          <img :src="item.soImg" width="102" height="102" />
        </div>
        <table>
          <tr>
            <td>{{item.rice}}</td>
            <td>x1</td>
            <td></td>
            <!-- <td>NT${{item.riceprice}}</td> -->
          </tr>
          <tr>
            <td>{{item.meat}}</td>
            <td>x1</td>
            <td></td>
            <!-- <td>NT${{item.meatprice}}</td> -->
          </tr>
          <tr>
            <td>{{item.single1}}</td>
            <td>x1</td>
            <td></td>
            <!-- <td>NT${{item.single1price}}</td> -->
          </tr>
          <tr>
            <td>{{item.single2}}</td>
            <td>x1</td>
            <td></td>
            <!-- <td>NT${{item.single2price}}</td> -->
          </tr>
          <tr>
            <td>{{item.single3}}</td>
            <td>x1</td>
            <td></td>
            <!-- <td>NT${{item.single3price}}</td>   -->
          </tr>
          <!-- <tr>
          <td>卡路里:</td>
          <td>123</td>
        </tr> -->
          <tr>
            <td>價格:</td>
            <td>NT$ {{item.soPrice}}</td>
          </tr>
        </table>
      </div>
    </div>







     <h3>經典便當</h3>
    <div class="classicalbento" v-for="item in finalsetdolist" :key="item">
      <!-- <span :id="'setdodelete'+ item.setdoId" :data-num="item.setdoId" width="15" height="15"> -->
      <img class="orderclose" src="../images/showbenton/close.png" alt="" :id="'setdodelete'+ item.setdoId"
        :data-num="item.setdoId" @click='xx' />
      <!-- </span> -->
      <div class="other_box">
        <div class="selimg">
          <img :src="item.setdoImg" width="102" height="102" />
        </div>
        <table>
          <tr>
            <td>{{item.setdoName}}</td>
            <td>NT${{item.setdoPrice}}</td>
            <td></td>
            <td>x{{item.setdoMany}}</td>
          </tr>
        </table>
      </div>
    </div>
    <h3>其他商品</h3>
    <div class="otherproduct" v-for="item in finalorderlist" :key="item">
      <!-- <span :id="'orderdelete'+item.otherId" :data-num="item.otherId" width="15" height="15"> -->
      <img class="orderclose" src="../images/showbenton/close.png" alt="" :id="'orderdelete'+item.otherId"
        :data-num="item.otherId" @click='otherdelete' />
      <!-- </span> -->
      <div class="other_box">
        <div class="selimg">
          <img :src="item.otherImg" width="102" height="102" />
        </div>
        <table>
          <tr>
            <td>{{item.otherName}}</td>
            <td>NT${{item.otherPrice}}</td>
            <td></td>
            <td>x{{item.otherMany}}</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="orderTextarea">
          <p>餐點備註:</p>
          <textarea name="orderListText" id="orderListText" cols="40" rows="6" placeholder="特殊需求可備註在此..."></textarea>
    </div>  
    <div class="finaltotal">
      <div id="OrTotal">總價:</div>
      <div class="" id='orderScore'></div>
      
      <div><span>使用積分 : </span><input @keyup='orederScoreAndPrice' onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" id="orderUseScore" name="orderUseScore" value=""></div>
      
      <div id="orderYourSorce">獲得積分:</div>
      <div><p id='orderAddress'>外帶</p></div>
      <!-- <div class="price">123元</div> -->
    </div>
    
    <button class="buy" id="orderBuy" @click='orderBuy'>立即結帳</button>




  </div>
  </div>  
  </div>  
  </div>
</template>

<script>


export default {
  data() {
    return {
      finalsetdolist:[],
      finalsinglelist:[],
      finalorderlist:[],
      finalprice:0,
      OrYourScore:0,
      MemScore:0,
      finalOrTotalPrice:0
      }
  },
  mounted(){
         this.aaa();
          this.OrderTotalPrice();

  },
  methods: {

    aaa(){
        



          var finalsetdolist1 = JSON.parse(localStorage.getItem('setdoMenuList'));
          var finalsinglelist = JSON.parse(localStorage.getItem('singleOrder'));
          var finalorderlist = JSON.parse(localStorage.getItem('otherOrder'));

          this.finalsetdolist = finalsetdolist1;
          this.finalsinglelist = finalsinglelist;
          this.finalorderlist = finalorderlist;
          let setdoMenu = finalsetdolist1;
          console.log(setdoMenu);


          if(sessionStorage.getItem('memId')=='good'){
          let MemScore = sessionStorage.getItem('orderMemScore');
          this.MemScore = MemScore;
          document.getElementById('orderScore').innerText = `我的積分：`+ MemScore + `點`;
}
    },
   xx(e){
           let A = e.target.dataset.num;
          console.log(A);
          var finalsetdolist1 = JSON.parse(localStorage.getItem('setdoMenuList'));
          // let setdoMenu = finalsetdolist1;
          for (let i = 0; i < finalsetdolist1.length; i++) {

              if (finalsetdolist1[i].setdoId == Number(A)) {
                 finalsetdolist1.splice(i, 1);
                  // setdoMenu.splice(i, 1);
                  localStorage.setItem('setdoMenuList', JSON.stringify(finalsetdolist1));
                  this.aaa();
                   this.OrderTotalPrice();
                  
              }
          }
          
          
    
    },
  singledelete(e){
     let A =  e.target.dataset.num;
    console.log(A);
    var finalsinglelist = JSON.parse(localStorage.getItem('singleOrder'));
    for (let i = 0; i < finalsinglelist.length; i++) {

        if (finalsinglelist[i].sNum == Number(A)) {
            finalsinglelist.splice(i, 1);
            // orderCart.splice(i, 1);
            localStorage.setItem('singleOrder', JSON.stringify(finalsinglelist));
            this.aaa();
             this.OrderTotalPrice();

        }
        
    }
  },
  otherdelete(e){
     let A = e.target.dataset.num;;
    console.log(A);
    var finalorderlist = JSON.parse(localStorage.getItem('otherOrder'));
    for (let i = 0; i < finalorderlist.length; i++) {

        if (finalorderlist[i].otherId == Number(A)) {
            finalorderlist.splice(i, 1);
            // otherMenu.splice(i, 1);
             localStorage.setItem('otherOrder', JSON.stringify(finalorderlist));
               this.aaa();
               this.OrderTotalPrice();
        }
    }
  },
    OrderTotalPrice(){
    let SinglePrice = 0 ;
      if(localStorage.getItem('singleOrder')){
          var finalsinglelist = JSON.parse(localStorage.getItem('singleOrder'));
          for(let i = 0 ; i < finalsinglelist.length; i++){
            SinglePrice = parseInt(SinglePrice) + parseInt(finalsinglelist[i].soPrice);
          }
      }
    let SetdoPrice = 0;
      if(localStorage.getItem('setdoMenuList')){
        var finalsetdolist1 = JSON.parse(localStorage.getItem('setdoMenuList'));
        for(let i = 0; i<finalsetdolist1.length;i++){
          SetdoPrice = parseInt(SetdoPrice)+parseInt(finalsetdolist1[i].setdoPrice)*parseInt(finalsetdolist1[i].setdoMany);
        }
      }

    let  OtherPrice = 0;
      if(localStorage.getItem('otherOrder')){
       var finalorderlist = JSON.parse(localStorage.getItem('otherOrder'));
       for(let i=0; i<finalorderlist.length;i++){
         OtherPrice = parseInt(OtherPrice) + parseInt(finalorderlist[i].otherPrice)* parseInt(finalorderlist[i].otherMany);
       }
      }   

    let OrTotalPrice = 0;
    OrTotalPrice = parseInt(SinglePrice)+parseInt(SetdoPrice)+parseInt(OtherPrice);
    document.getElementById('OrTotal').innerText=`總價: ${OrTotalPrice}元`;
    let OrYourScore = parseInt(OrTotalPrice/100);
    document.getElementById('orderYourSorce').innerText=`獲得積分: ${OrYourScore}點`;
      this.OrYourScore = OrYourScore;
      this.finalprice = OrTotalPrice;
    },
    orederScoreAndPrice(){
      let  MemScore = sessionStorage.getItem('orderMemScore');

      let finalOrTotalPrice = this.finalprice;


      if(parseInt(document.getElementById('orderUseScore').value) <= parseInt(MemScore) && parseInt(document.getElementById('orderUseScore').value) <= parseInt(finalOrTotalPrice) && document.getElementById('orderUseScore').value !== ""){
    
    MemScore = MemScore - document.getElementById('orderUseScore').value;
    document.getElementById('orderScore').innerText = `我的積分：`+ MemScore + `點`;
    finalOrTotalPrice = finalOrTotalPrice - document.getElementById('orderUseScore').value;
    this.finalOrTotalPrice = finalOrTotalPrice;
        document.getElementById('OrTotal').innerText=`總價:`+ finalOrTotalPrice + `元`;
    console.log(MemScore);
    }else if(document.getElementById('orderUseScore').value ==""){
        // document.getElementById('orderUseScore').value='0';
        MemScore = MemScore - 0;
    document.getElementById('orderScore').innerText = `我的積分：`+ MemScore + `點`;
    finalOrTotalPrice = finalOrTotalPrice - 0;
    this.finalOrTotalPrice = finalOrTotalPrice;
        document.getElementById('OrTotal').innerText=`總價:`+ finalOrTotalPrice + `元`;
    }else{
        alert('便當沒有那麼貴 請重新輸入');
        MemScore = MemScore - 0;
    document.getElementById('orderScore').innerText = `我的積分：`+ MemScore + `點`;
    finalOrTotalPrice = finalOrTotalPrice - 0;
    this.finalOrTotalPrice = finalOrTotalPrice;
        document.getElementById('OrTotal').innerText=`總價:`+ finalOrTotalPrice + `元`;
        document.getElementById('orderUseScore').value ="";
    }  
    },
     orderBuy(){
    var orderSin = [];
    var orderSet = [];
    var orderOth = [];
    // var orderAdr = '';
    var orderListTextPost = '';
    var orderCla = '';
    var now = new Date();
    var orderTime =`${now.getFullYear()}-${now.getMonth()+1}-${now.getDate()} ${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}`;
    console.log(orderTime);
    let memId = sessionStorage.getItem('mEmmEmId');
    let memLogin = sessionStorage.getItem('memId');
    orderSin = JSON.parse(localStorage.getItem('singleOrder'));
    orderSet =  JSON.parse(localStorage.getItem('setdoMenuList'));
    orderOth =  JSON.parse(localStorage.getItem('otherOrder'));
    let orderAdr = '';
    orderCla = 1;
    orderListTextPost = document.getElementById('orderListText').value;

    

    let totalOrder=[orderSin,orderSet,orderOth,memId,orderAdr,orderListTextPost,orderCla,this.finalOrTotalPrice,orderTime,parseInt(this.MemScore)+parseInt(this.OrYourScore)];
    // console.log(totalOrder);
    // console.log(totalOrder);
    // console.log(MemScore);
    // console.log(OrYourScore);
    
    if(orderSin.length==0 && orderSet.length==0 && orderSet.length==0){
        var orderEmpty = 0;
    }else{
        orderEmpty = 1;
    }
    if(orderEmpty==0 || memLogin=='bad' || orderCla==-1){
        alert('請登入 選擇品項 選擇外送外帶');
    }else{
       
    var totalOrderPost = new XMLHttpRequest();
    totalOrderPost.open('POST','./php/shopping.php',true);
    totalOrderPost.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    totalOrderPost.send("totalOrder=" + JSON.stringify(totalOrder));
    totalOrderPost.onload = function(){
        // var posttest = JSON.parse(totalOrderPost.responseText);
        // var posttest = totalOrderPost.responseText;
        // console.log(posttest);
        // if(totalOrderPost.responseText == "error"){
        //     alert("Error");
        //   }else{
        //     alert('Succesfully uploaded');  
    
        //   }
       
        }
        // sessionStorage.setItem('orderMemScore',parseInt(MemScore)+parseInt(OrYourScore));

        // finalsinglelist = [];
        // singleorderlist.$data.finalsinglelist = finalsinglelist;
        // orderCart=finalsinglelist;
        // localStorage.setItem('singleOrder', JSON.stringify(finalsinglelist));
    
        // finalsetdolist = [];
        // singleorderlist.$data.finalsetdolist = finalsetdolist;
        // setdoMenu = finalsetdolist;;
        // localStorage.setItem('setdoMenuList', JSON.stringify(finalsetdolist));
    
        // finalorderlist = [];
        // singleorderlist.$data.finalorderlist = finalorderlist;
        // otherMenu=finalorderlist;
        // localStorage.setItem('otherOrder', JSON.stringify(finalorderlist));
        
        // 
     
        // OrderTotalPrice();
        document.getElementById('orderListText').value="";
        alert('已新增訂單 可至會員專區查看');
        
        

        
    }
     }
    
      
}
}
</script>

<style lang="scss">
    // @import '../mixins/mixin';
    @import '@/sass/_shoppingCart.scss';

// #orderAdress{
//   display: none;
//   margin: 10px 0;
//   button{
//     font-family: 'Noto Sans TC','Noto Sans', '微軟正黑體', "Times New Roman", sans-serif;
//     font-size: 13.3333px; 
//     padding: 0;
//     width: 76px;
//     border: none;
//     cursor: pointer;
//   }
//   input{
//     border-radius: 5px;
//     border: none;
//   }
  
  
// }

// .ordercart { 
  
//   position: fixed;
//   right: -380px; 
//   top: 0;
//   width: 350px;
//   height: 100%;
//   // background-color: rgb(225, 226, 138);
//   // background-color:rgb(114, 156, 114);
//   // background-color:rgb(149, 194, 149);
//   background-color:#f0edc3;
//   opacity: 0.95;
//   overflow-y: scroll;
//   padding: 10px;
//   z-index: 1000;
//   transition-duration: .5s;
//   transition-property: all;
//   #orderListText{ 
//     margin-left: 15px;
//     margin-top: 15px;
//     resize : none;
//   }
//   .orderTextarea{
//     p{
//       margin-top: 15px;
//       margin-left: 10px;
//     }
//     textarea{
//       border-radius: 5px;
//     }
//   }
//   .selfbenton,
//   .classicalbento,
//   .otherproduct {
//     position: relative;
//     display: flex;
//     flex-direction: column;
//     align-items: flex-end;
//     justify-content: center;
//     margin: 5px 5px;
//     // // margin-right: 5%;
//     // margin-top: 5%;
//     // border: 1px solid #000;
//     border-radius: 10px;
//     background-color: #fff;
//     transition: .5s;

//     &:hover {
//       box-shadow: 3px 3px 10px #000;
//       cursor: pointer;
//  }
//     .selfbento_box{
//       width: 100%;
//       display: flex;
//       align-items: center;
//       justify-content: space-evenly;
//       .selimg{ 
//         width: 100px;
//         height: 100px;
//         // border: 1px solid #000;

//       }}  
//       .other_box{
//         width: 100%;
//         display: flex;
//         align-items: center;
//         justify-content: space-evenly;
        
//         .selimg{
//           width: 100px;
//           height: 100px;
//           // border: 1px solid #000;
//           margin-bottom: 25px;
//         }
//       }
    
   

//     // &::before {
//     //   content: "";
//     //   width: 100px;
//     //   height: 100px;
//     //   border: 1px solid #000;
//     //   position: absolute;
//     //   left: 10px;
//     // }
//   }

//   h3 {
//     margin-top: 15px;
//     margin-left: 5px;
//   }


//   .selfbenton {
//     // display: flex;
//     // flex-direction: column;
//     // align-items: flex-end;
//     // margin-right: 5%;
//     height: 200px;

//     table {
//       tr {
//         td:nth-child(1) {
//           width: 101px;

//         }
//       }
//     }
//   }

//   // span {
//   //   color: burlywood;
//   //   cursor: pointer;
//   //   // margin: 15px;
//   //   margin-right: 5%;
//   //   height: 50px;
//   // }
//     #orderUseScore{
//       width: 60px;
//     }
//   table {
//     // width: 300px;
//     // border: 1px solid #000;
//     width: 180px;
//     // margin-right: 3%; 
//   }

//   .classicalbento,
//   .otherproduct {
//     height: 150px;
//     margin-top: 5%;

//     span {
//       margin-bottom: -5%;
//     }

//     table {
//       margin-bottom: 10%;


//     }
//   }

//   .finaltotal {
//     // display: flex;
//     // justify-content: space-evenly; 
//     text-align: left;
//     margin: 10px 20px;
//       #OrTotal{
//         color:red;
//       }
//       #orderYourSorce{
//         // color: $grey;
//       }

//       div{
//         margin-top: 5px;
//       }

//     // .total {
//     //   font-size: $fzMd;
//     // }
//   }

//   .buy {
//     width: 200px;
//     height: 50px;
//     border-radius: 50px;
//     // background-color: rgb(255, 174, 82);
//     background-color: rgb(218, 148, 68);
//     margin-top: 20px;
//     margin-left: 20%;
//     text-align: center;
//     line-height: 45px;
//     margin-bottom: 10%;
//     color: white;
//     cursor: pointer;
//     transition: .5s;
//     font-family: 'Noto Sans TC','Noto Sans', '微軟正黑體', "Times New Roman", sans-serif;
//     &:hover {
//       background-color: rgb(196, 125, 44);
//     }
//   }
//   .orderbuy{
//     font-family: 'Noto Sans TC','Noto Sans', '微軟正黑體', "Times New Roman", sans-serif;
//     width: 160px;
//     cursor: pointer;
//     background-color: #FFD23F;
//     border: none;
//     border-radius: 5px;
//   }
 
// }

// .orderclose { 
//   margin-top: 12px;
//   margin-right: 15px; 
//   width: 15px; 
//   height: 15px;
//   transition: .5s;

//   &:hover {
//     transform: rotate(360deg);
//     content: url(../images/homepage/close_red.png);
//   }
// }

// .ordercartOpen{
//   right: 0;
// }

// #orderCartClose{  
//   margin-left: 300px;
//   margin-top: 5px;
//   cursor: pointer;
// }



</style>