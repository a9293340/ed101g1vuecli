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
                          <div><button  class="orderbutton" :id ="'setdocountminus'+item.setId" :data-num="item.setId" @click="setdominus">-</button><span class="ordercount" :id="'setdocount'+item.setId">0</span><button class="orderbutton" :id ="'setdocountplus'+item.setId" :data-num="item.setId" @click="setdoplus">+</button>
                                <button  :id="'setdocart'+item.setId" :data-id="item.setId" class="cart" @click="setdoCart">加入購物車</button>
                          </div>
                        </div>



                    
                    </div>

                    <div  v-for="item in orderSetdo" :key="item">
                        <div v-if="item.setStatus==1 && item.setClass ==1" class="buy_card3">
                          <img :id="'setdoimg'+item.setId"  :data-id="item.setId" v-bind:src="item.setImage" atl="" width="200" height="200">
                          <div class="buy_name">{{item.setName}}&nbsp;&nbsp;<span>$</span>{{item.setPrice}}</div>
                          <div><button class="orderbutton" :id ="'setdocountminus'+item.setId" :data-num="item.setId" @click="setdominus">-</button><span class="ordercount" :id="'setdocount'+item.setId">0</span><button class="orderbutton" :id ="'setdocountplus'+item.setId" :data-num="item.setId"  @click="setdoplus">+</button>
                                <button  :id="'setdocart'+item.setId" :data-id="item.setId" class="cart" @click="setdoCart">加入購物車</button>
                          </div>
                        </div>



            
                    </div>
           
                   


                 
                </div>
      
      
            </div> 
  </div>
</template>

<script>
// let orderSetdo=[];
let setdocount=[];
let setdoMany = 0;
let setdoId = 0;
let setdoName = 0;
let setdoPrice = 0;
let setdoImg = 0;
let setdoNum = 0;
let setdoMenu=[];




export default {
  data(){
    return {
      orderSetdo:[],
      memOtherProduct:[],
    }
  },
  mounted(){
 
    fetch("./php/memajax3.php")
    .then(res => res.json())
    .then((res)=>{
      console.log(res)
      this.orderSetdo = res[0];
      console.log(this.orderSetdo);
        this.first();
    })

 

  },
  methods:{

    first(){
      if(localStorage.getItem('setdoMenuList')){
        setdoMenu = JSON.parse(localStorage.getItem('setdoMenuList'));
      }


      for(var j=0; j < this.orderSetdo.length;j++){    
        if(this.orderSetdo[j].setStatus==1){
          setdocount[this.orderSetdo[j].setId]=0;
          console.log(setdocount[this.orderSetdo[j].setId]);
        }
      }
    },
      setdoplus(e){
          let num = e.target.dataset.num
          setdocount[num]++;
          console.log(setdocount[num]);
          document.getElementById(`setdocount${num}`).innerText = setdocount[num];
      },
      setdominus(e){
          let num = e.target.dataset.num
          if(setdocount[num]>0){
          setdocount[num]--;
          console.log(setdocount[num]);
          document.getElementById(`setdocount${num}`).innerText = setdocount[num];
          }
      },
      setdoCart(e){
        let A = e.target.dataset.id;

        console.log(A);
        for(let i = 0;i<this.orderSetdo.length;i++){
          if(this.orderSetdo[i].setId == Number(A)){
                setdoMany =  document.getElementById(`setdocount${A}`).innerText;
                setdoId = this.orderSetdo[i].setId;
                setdoName = this.orderSetdo[i].setName;
                setdoPrice = this.orderSetdo[i].setPrice;
                setdoImg = this.orderSetdo[i].setImage;
                if(setdoMany>0){

                  var  setdoList={
                        setdoNum:`${setdoNum}`,
                        setdoMany:`${setdoMany}`,
                        setdoId:`${setdoId}`,
                        setdoName:`${setdoName}`,
                        setdoPrice:`${setdoPrice}`,
                        setdoImg:`${setdoImg}`,
                        }

                var samename = 0;
                if(setdoMenu.length>0){
                     for(let j=0  ;j < setdoMenu.length; j++){
                            if(setdoMenu[j].setdoName == setdoList.setdoName){
                                samename=1;
                            setdoMenu[j].setdoMany = parseInt(setdoMenu[j].setdoMany)+parseInt(setdoList.setdoMany);
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
  }
}

 
</script>

<style lang="scss">
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

