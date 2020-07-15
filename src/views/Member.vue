<template>
    <div>
        <div id="memApp">
            <div class="memContent" id="memContentOrder">
                <div v-for="item in memOrderPageArr" :key="item" >
                    <div v-if="memOrderPageArr.length >= 1" class="memOrderBox">
                        <div class="memOrderInfo">
                            <p class="memOrderNum">訂單編號：{{item.orderId}}</p>
                            <div class="memOrderSta">
                                <img src="../images/member/shoppingIcon.png" alt="">
                                <p v-if="item.orderStatus == 0">確認中</p>
                                <p v-if="item.orderStatus == 1">製作中</p>
                                <p v-if="item.orderStatus == 2">運送中</p>
                                <p v-if="item.orderStatus == 3">已送達</p>
                                <p v-if="item.orderStatus == 4">完成訂單</p>
                                <p v-if="item.orderStatus == 5" style="color: brown;">已取消</p>
                                <p v-if="item.orderStatus == 6">已歸檔</p>
                            </div>
                        </div>
                        <div class="memOrderListBox">
                            <div v-for='(single,index) in memSingleOrder' :key="index" >
                                <div v-if='single.soBelongOrder == item.orderId' class="memOrderList">
                                    <div class="memFlexRight">
                                        <img :src="single.soImg" alt="">
                                        <div class="memOrderSomethingBox">
                                            <p>自選便當</p>
                                            <p class="memFontSmall">規格:{{single.soRice}}/{{single.sideDishes1}}/{{single.sideDishes2}}/{{single.sideDishes3}}/{{single.mainfood}}</p>
                                            <p class="memFontSmall">數量： {{single.soAmount}}</p>
                                        </div>
                                    </div>
                                    <p class="memOrderPirceShow">${{single.soPrice}}</p>
                                </div>
                            </div>
                            <div v-for='set in memSetOrder' :key="set">
                                <div v-if='set.setoBelongOrder == item.orderId' class="memOrderList">
                                    <div class="memFlexRight">
                                        <img :src="set.setImage" alt="">
                                        <div class="memOrderSomethingBox">
                                            <p v-if='set.setClass == 0'>經典便當-{{set.setName}}</p>
                                            <p v-if='set.setClass == 1'>季節便當-{{set.setName}}</p>
                                            <p class="memFontSmall">數量： {{set.setoAmount}}</p>
                                        </div>
                                    </div>
                                    <p class="memOrderPirceShow">${{set.setoPrice}}</p>
                                </div>
                            </div>
                            <div v-for='other in memOtherOrder' :key="other">
                                <div v-if='other.ooBelongOrder == item.orderId' class="memOrderList" >
                                    <div class="memFlexRight">
                                        <img :src="other.opImage" alt="">
                                        <div class="memOrderSomethingBox">
                                            <p>{{other.opName}}</p>
                                            <p class="memFontSmall">數量： {{other.ooAmount}}</p>
                                        </div>
                                    </div>
                                    <p class="memOrderPirceShow">${{other.ooPrice}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="memOrderTotalPriceBox">
                            <p>訂單金額：<span>${{item.orderTotalPrice}}</span></p>
                            <div class="memOrderGoToListBtn" :data-order='item.orderId' @click='showOrderList'>查看訂單</div>
                            <div class="memOrderGoToListBtn" :data-order='item.orderId' v-if='item.orderStatus == 0' @click='cansolOrder'>取消訂單</div>
                        </div>
                    </div>
                </div>
                <!-- 分頁 -->
                <div class="memContentOrderPagesBox">
                    <div v-for='(order,index) in memOrder' :key="index">
                        <div 
                        v-if='index < memOrderPages'
                        class="memContentOrderPages"
                        :data-index="index"
                        @click='memGoNextPage'>
                            {{index+1}}
                        </div>
                    </div>
                </div>
                <div class="memOrderBox memGoToOrderX" v-if='memOrderPageArr.length == 0'>您尚未有任何訂單喔，</div>
            </div>

            <div class="memContentOrderList memContentNone" id="memContentOrderList">
                <div class="memContentOrderListHeader">
                    <p class="memOrderListGoBackBtn" @click='GoBackToOrderContent'><span>&lt;</span>回上一頁</p>
                    <p>訂單編號：<span>{{nowDataSetNumber}}</span></p>
                </div>
                <div class="memContentOrderListStatus" v-for='order in nowOrder' :key="order">
                    <div class="memContentOrderListCircleBox">
                        <div :class="memChooseCirleColor1">
                            <img src="../images/member/ulIconGreen.png" alt="" v-if='order.orderStatus == 1'>
                            <img src="../images/member/ulIcon.png" alt="" v-else>
                        </div>
                        <p :class='memChooseCircleFontColor1'>訂單已成立</p>
                    </div>
                    <div class="memContentOrderListLine"></div>
                    <div class="memContentOrderListCircleBox">
                        <div :class="memChooseCirleColor2">
                            <img src="../images/member/orderIconGreen.png" alt="" v-if='order.orderStatus == 2'>
                            <img src="../images/member/orderIcon.png" alt="" v-else>
                        </div>
                        <p :class='memChooseCircleFontColor2'>店家已出餐</p>
                    </div>
                    <div class="memContentOrderListLine"></div>
                    <div class="memContentOrderListCircleBox">
                        <div :class="memChooseCirleColor3" v-if='order.orderClass == 0'>
                            <img src="../images/member/shippingIconGreen.png" alt="" v-if='order.orderStatus == 3'>
                            <img src="../images/member/shippingIcon.png" alt="" v-else>
                        </div>
                        <p :class='memChooseCircleFontColor3' v-if='order.orderClass == 0'>餐點已送達</p>
                    </div>
                    <div class="memContentOrderListLine" v-if='order.orderClass == 0'></div>
                    <div class="memContentOrderListCircleBox">
                        <div :class="memChooseCirleColor4">
                            <img src="../images/member/checkIconGreen.png" alt="" v-if='order.orderStatus == 4'>
                            <img src="../images/member/close_green.png" alt="" v-if='order.orderStatus == 5'>
                            <img src="../images/member/checkIcon.png" alt="" v-if='order.orderStatus != 5 && order.orderStatus != 4'>
                        </div>
                        <p :class='memChooseCircleFontColor4' v-if='order.orderStatus != 5'>訂單已完成</p>
                        <p :class='memChooseCircleFontColor4' v-else>訂單已取消</p>
                    </div>
                </div>
                <div class="memContentOrderListQRCodeAndBuyAgainBox">
                    <div class="memContentOrderListQRCodeBox">
                        <h3>本訂單之QR-Code
                            <span>(店內取貨請出示)</span>
                        </h3>
                        <div id="memContentOrderListQRCode"></div>
                    </div>
                    <div class="memContentOrderListBuyAgainBox" v-for='order in nowOrder' :key='order' >
                        <h3 v-if='order.orderStatus == 4 || order.orderStatus == 6'>訂單已完成，再次選購請點選下面按鈕</h3>
                        <h3 v-if='order.orderStatus == 5'>訂單已取消，再次選購請點選下面按鈕</h3>
                        <h3 v-if='order.orderStatus == 1'>訂單尚未完成，待完成後即可再次選購</h3>
                        <h3 v-if='order.orderStatus == 3'>訂單尚未完成，待完成後即可再次選購</h3>
                        <h3 v-if='order.orderStatus == 2'>訂單尚未完成，待完成後即可再次選購</h3>
                        <div class="memContentOrderListBuyAgainBtn" v-if='order.orderStatus == 4 || order.orderStatus == 5 || order.orderStatus == 6' @click='memBuyAgain'>
                            再買一次
                        </div>
                    </div>
                </div>
                <div class="memContentOrderListMailBox" v-for='order in nowOrder' :key='order'>
                    <div class="memMailLine"></div>
                    <h3>收件地址</h3>
                    <p>{{memData.memName}}</p>
                    <p>{{memData.memPhone}}</p>
                    <p>{{order.deliveryAddr}}</p>
                    <p style="color:#37AB64;">訂單備註：{{order.orderRemark}}</p>
                    <div class="memMailLine"></div>
                </div>
                <div class="memContentOrderListBox">
                    <h3>◆訂購明細</h3>
                    <div v-for='single in memSingleOrder' :key="single">
                        <div  v-if='single.soBelongOrder == nowDataSetNumber' class="memContentOrderListReal">
                            <div class="memContentOrderListRealRight">
                                <img :src="single.soImg" class="memContentOrderListRealRightImg">
                                <div class="memOrderListRealSomething">
                                    <p>自選便當</p>
                                    <p class="memFontSmall">規格:{{single.soRice}}/{{single.sideDishes1}}/{{single.sideDishes2}}/{{single.sideDishes3}}/{{single.mainfood}}</p>
                                    <p class="memFontSmall">數量： {{single.soAmount}}</p>
                                </div>
                            </div>
                            <p class="memOrderPirceShow">${{single.soPrice}}</p>
                        </div>
                    </div>
                    <div v-for='set in memSetOrder' :key="set">
                        <div  v-if='set.setoBelongOrder == nowDataSetNumber' class="memContentOrderListReal">
                            <div class="memContentOrderListRealRight">
                                <img :src="set.setImage">
                                <div class="memOrderListRealSomething">
                                    <p v-if='set.setClass == 0'>經典便當-{{set.setName}}</p>
                                    <p v-if='set.setClass == 1'>季節便當-{{set.setName}}</p>
                                    <p class="memFontSmall">數量： {{set.setoAmount}}</p>
                                </div>
                            </div>
                            <p class="memOrderPirceShow">${{set.setoPrice}}</p>
                        </div>
                    </div>
                    <div v-for='other in memOtherOrder' :key="other">
                        <div  v-if='other.ooBelongOrder == nowDataSetNumber' class="memContentOrderListReal">
                            <div class="memContentOrderListRealRight">
                                <img :src="other.opImage">
                                <div class="memOrderListRealSomething">
                                    <p>{{other.opName}}</p>
                                    <p class="memFontSmall">數量： {{other.ooAmount}}</p>
                                </div>
                            </div>
                            <p class="memOrderPirceShow">${{other.ooPrice}}</p>
                        </div>
                    </div>
                    <div class="memOrderListTotalPriceBox">
                        <p v-for='order in nowOrder' :key='order'>
                            訂單金額：
                            <span>${{order.orderTotalPrice}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
// import $ from 'jquery';
let memContent = document.getElementsByClassName('memContent');

export default {
    data() {
        return {
            memData:{},
            memOrder:[],
            memOrderPageArr:[],
            nowDataSetNumber:0,
            nowOrder:[],
            memSetOrder:[],
            memOtherOrder:[],
            memSingleOrder:[],
            memSetProduct:[],
            memOtherProduct:[],
            memOrderPages:0,
            memPage:2
        }
    },
    methods: {
        showOrderList(e){
            $('html, body').animate({
                scrollTop: 0
            }, 200);
            let orderId = e.target.dataset.order;
            let box = []
            // 現在的訂單4
            this.nowDataSetNumber = Number(orderId);
            for(let i = 0 ; i < this.memOrder.length ; i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    box.push(this.memOrder[i])
                }
            }
            this.nowOrder = box;
            console.log(this.nowDataSetNumber);
            console.log(this.memSetOrder)
            //生成QRCode(要換成php網址)
            $('#memContentOrderListQRCode').html('');
            $('#memContentOrderListQRCode').qrcode({
                width: 120,
                height: 120,
                text: `./php/memOrderList.php?orderId=${this.nowDataSetNumber}`
            });
            // 跳轉至orderList的content
            document.getElementById('memContentOrderList').classList.remove('memContentNone');
            for(let j = 0; j<memContent.length;j++){
                memContent[j].classList.add('memContentNone');
            }
        },
        GoBackToOrderContent(){
            document.getElementById('memContentOrderList').classList.add('memContentNone');
            document.getElementById('memContentOrder').classList.remove('memContentNone');
        },
        memBuyAgain(){
            // single
            let single = [];
            let setA = [];
            let other = [];
            let count = 0;
            if(localStorage['singleNum']){
                count = Number(localStorage['singleNum'])
            }else{
                localStorage['singleNum'] = 0;
                count = localStorage['singleNum']
            }
            if(localStorage['singleOrder']){
                single = JSON.parse(localStorage['singleOrder']);
                for(let i = 0; i < this.memSingleOrder.length; i++){
                    if(this.memSingleOrder[i].soBelongOrder == this.nowDataSetNumber){
                        single.push({
                            "meat":this.memSingleOrder[i].mainfood,
                            "meatId":this.memSingleOrder[i].mainfoodId,
                            "rice":this.memSingleOrder[i].soRice,
                            "riceId":this.memSingleOrder[i].soRiceId,
                            "single1":this.memSingleOrder[i].sideDishes1,
                            "singleId1":this.memSingleOrder[i].sideDishes1Id,
                            "single2":this.memSingleOrder[i].sideDishes2,
                            "singleId2":this.memSingleOrder[i].sideDishes2Id,
                            "single3":this.memSingleOrder[i].sideDishes3,
                            "singleId3":this.memSingleOrder[i].sideDishes3Id,
                            "soPrice":this.memSingleOrder[i].soPrice,
                            "soImg":this.memSingleOrder[i].soImg,
                            "sNum":count
                        })
                        count++
                    }
                }
                localStorage['singleNum'] = count;
                localStorage['singleOrder'] = JSON.stringify(single);
            }else{
                for(let i = 0; i < this.memSingleOrder.length; i++){
                    if(this.memSingleOrder[i].soBelongOrder == this.nowDataSetNumber){
                        single.push({
                            "meat":this.memSingleOrder[i].mainfood,
                            "meatId":this.memSingleOrder[i].mainfoodId,
                            "rice":this.memSingleOrder[i].soRice,
                            "riceId":this.memSingleOrder[i].soRiceId,
                            "single1":this.memSingleOrder[i].sideDishes1,
                            "singleId1":this.memSingleOrder[i].sideDishes1Id,
                            "single2":this.memSingleOrder[i].sideDishes2,
                            "singleId2":this.memSingleOrder[i].sideDishes2Id,
                            "single3":this.memSingleOrder[i].sideDishes3,
                            "singleId3":this.memSingleOrder[i].sideDishes3Id,
                            "soPrice":this.memSingleOrder[i].soPrice,
                            "soImg":this.memSingleOrder[i].soImg,
                            "sNum":count
                        })
                        count++
                    }
                }
                localStorage['singleNum'] = count;
                localStorage['singleOrder'] = JSON.stringify(single);
            }

            // set
            if(localStorage['setdoMenuList']){
                setA = JSON.parse(localStorage['setdoMenuList']);
                for(let i = 0; i < this.memSetOrder.length; i++){
                    if(this.memSetOrder[i].setoBelongOrder == this.nowDataSetNumber){
                        let check = 0;
                        for(let j = 0;j < setA.length;j++){
                            if(setA[j].setdoName == this.memSetOrder[i].setName){
                                check ++;
                            }
                        }
                        if(check > 0){
                            for(let j = 0;j < setA.length;j++){
                                if(setA[j].setdoName == this.memSetOrder[i].setName){
                                    setA[j].setdoMany = Number(this.memSetOrder[i].setoAmount) + Number(setA[j].setdoMany)
                                }
                            }
                        }else{
                            setA.push({
                                "setdoMany":this.memSetOrder[i].setoAmount,
                                "setdoId":this.memSetOrder[i].setId,
                                "setdoImg":this.memSetOrder[i].setImage,
                                "setdoName":this.memSetOrder[i].setName,
                                "setdoPrice":this.memSetOrder[i].setoPrice / this.memSetOrder[i].setoAmount
                            })
                        }
                    }
                }
                localStorage['setdoMenuList'] = JSON.stringify(setA);
            }else{
                for(let i = 0; i < this.memSetOrder.length; i++){
                    if(this.memSetOrder[i].setoBelongOrder == this.nowDataSetNumber){
                        setA.push({
                            "setdoMany":this.memSetOrder[i].setoAmount,
                            "setdoId":this.memSetOrder[i].setId,
                            "setdoImg":this.memSetOrder[i].setImage,
                            "setdoName":this.memSetOrder[i].setName,
                            "setdoPrice":this.memSetOrder[i].setoPrice / this.memSetOrder[i].setoAmount
                        })
                    }
                }
                localStorage['setdoMenuList'] = JSON.stringify(setA);
            }

            //other
            if(localStorage['otherOrder']){
                other = JSON.parse(localStorage['otherOrder']);
                for(let i = 0; i < this.memOtherOrder.length; i++){
                    if(this.memOtherOrder[i].ooBelongOrder == this.nowDataSetNumber){
                        let check = 0;
                        for(let j = 0;j < other.length;j++){
                            if(other[j].otherName == this.memOtherOrder[i].opName){
                                check ++;
                            }
                        }
                        if(check > 0){
                            for(let j = 0;j < other.length;j++){
                                if(other[j].otherName == this.memOtherOrder[i].opName){
                                    other[j].otherMany = Number(this.memOtherOrder[i].ooAmount) + Number(other[j].otherMany)
                                }
                            }
                        }else{
                            other.push({
                                "otherMany":this.memOtherOrder[i].ooAmount,
                                "otherId":this.memOtherOrder[i].opId,
                                "otherImg":this.memOtherOrder[i].opImage,
                                "otherName":this.memOtherOrder[i].opName,
                                "otherPrice":this.memOtherOrder[i].ooPrice / this.memOtherOrder[i].ooAmount
                            })
                        }
                    }
                }
                localStorage['otherOrder'] = JSON.stringify(other);
            }else{
                for(let i = 0; i < this.memOtherOrder.length; i++){
                    if(this.memOtherOrder[i].ooBelongOrder == this.nowDataSetNumber){
                        other.push({
                            "otherMany":this.memOtherOrder[i].ooAmount,
                            "otherId":this.memOtherOrder[i].opId,
                            "otherImg":this.memOtherOrder[i].opImage,
                            "otherName":this.memOtherOrder[i].opName,
                            "otherPrice":this.memOtherOrder[i].ooPrice / this.memOtherOrder[i].ooAmount
                        })
                    }
                }
                localStorage['otherOrder'] = JSON.stringify(other);
            }
            alert('已加入購物車');
        },
        //分頁 
        memGoNextPage(e){
            let index = Number(e.target.dataset.index);
            for(let i = 0; i<document.getElementsByClassName('memContentOrderPages').length;i++){
                document.getElementsByClassName('memContentOrderPages')[i].classList.remove('memContentOrderPagesDark');
            }
            document.getElementsByClassName('memContentOrderPages')[index].classList.toggle('memContentOrderPagesDark');
            this.memOrderPageArr = [];
            // console.log('aaa',index);
            for(let i = 0; i < this.memOrder.length; i++){
                if( i >= (index*this.memPage) && i <((index+1)*this.memPage)){
                    // console.log('aaa',i);
                    this.memOrderPageArr.push(this.memOrder[i]);
                }
            }
            console.log(this.memOrderPageArr);
        },
        cansolOrder(e){
            let check = confirm('確定要取消訂單？');
            if(check){
                let id = Number(e.target.dataset.order);
                fetch(`./php/cansolOrder.php?orderId=${id}`, {})
                .then((response) => {
                    return response.text(); 
                }).then((Data) => {
                    // console.log(Data);
                    if(Data == 'good'){
                        location.reload();
                    }
                }).catch((err) => {
                    console.log('錯誤:', err);
                });
            }
        }
    },
    computed: {
        memChooseCirleColor1(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 1){
                        return 'memContentOrderListCircle memContentOrderListCircleGreen';
                    }else if(this.memOrder[i].orderStatus > 1){
                        return 'memContentOrderListCircle memContentOrderListCircleGrey';
                    }else{
                        return 'memContentOrderListCircle';
                    }
                }
            }
        },
        memChooseCirleColor2(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 2){
                        return 'memContentOrderListCircle memContentOrderListCircleGreen';
                    }else if(this.memOrder[i].orderStatus > 2){
                        return 'memContentOrderListCircle memContentOrderListCircleGrey';
                    }else{
                        return 'memContentOrderListCircle';
                    }
                }
            }
        },
        memChooseCirleColor3(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 3){
                        return 'memContentOrderListCircle memContentOrderListCircleGreen';
                    }else if(this.memOrder[i].orderStatus > 3){
                        return 'memContentOrderListCircle memContentOrderListCircleGrey';
                    }else{
                        return 'memContentOrderListCircle';
                    }
                }
            }
        },
        memChooseCirleColor4(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 4 || this.memOrder[i].orderStatus == 5){
                        return 'memContentOrderListCircle memContentOrderListCircleGreen';
                    }else{
                        return 'memContentOrderListCircle';
                    }
                }
            }
        },
        memChooseCircleFontColor1(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 1){
                        return 'memContentOrderListCircleFont memContentOrderListCircleFontGreen';
                    }else if(this.memOrder[i].orderStatus > 1){
                        return 'memContentOrderListCircleFont memContentOrderListCircleFontGrey';
                    }else{
                        return 'memContentOrderListCircleFont';
                    }
                }
            }
        },
        memChooseCircleFontColor2(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 2){
                        return 'memContentOrderListCircleFont memContentOrderListCircleFontGreen';
                    }else if(this.memOrder[i].orderStatus > 2){
                        return 'memContentOrderListCircleFont memContentOrderListCircleFontGrey';
                    }else{
                        return 'memContentOrderListCircleFont';
                    }
                }
            }
        },
        memChooseCircleFontColor3(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 3){
                        return 'memContentOrderListCircleFont memContentOrderListCircleFontGreen';
                    }else if(this.memOrder[i].orderStatus > 3){
                        return 'memContentOrderListCircleFont memContentOrderListCircleFontGrey';
                    }else{
                        return 'memContentOrderListCircleFont';
                    }
                }
            }
        },
        memChooseCircleFontColor4(){
            for(let i = 0; i< this.memOrder.length;i++){
                if(this.memOrder[i].orderId == this.nowDataSetNumber){
                    if(this.memOrder[i].orderStatus == 4 || this.memOrder[i].orderStatus == 5){
                        return 'memContentOrderListCircleFont memContentOrderListCircleFontGreen';
                    }else{
                        return 'memContentOrderListCircleFont';
                    }
                }
            }
        },
    },
    mounted() {
        this.$nextTick(function () {
            fetch("./php/memajax1.php").
            then(res => res.json()).
            then((response)=>{
                this.memData = response[0][0];
                this.memOrder = response[1];
                for(let i = 0; i < this.memOrder.length; i++){
                    if(i <(this.memPage)){
                        // console.log('aaa',i);
                        this.memOrderPageArr.push(this.memOrder[i]);
                    }
                }
                this.memOrderPages = Math.ceil(this.memOrder.length / this.memPage);
                console.log(this.memOrderPages)
                console.log(this.memOrderPageArr)
                fetch('./php/memajax2.php').
                then(res=>res.json()).
                then((response)=>{
                    this.memSingleOrder = response[0];
                    this.memSetOrder = response[1];
                    this.memOtherOrder = response[2];
                    console.log(response);
                    console.log(this.memSingleOrder);
                    fetch('./php/memajax3.php').
                    then(res=>res.json()).
                    then((response)=>{
                        this.memSetProduct = response[0];
                        this.memOtherProduct = response[1];
                        console.log(this.memOtherProduct);
                        document.getElementsByClassName('memContentOrderPages')[0].classList.toggle('memContentOrderPagesDark');
                    })
                })
            })
            
        })

    },
}
</script>

<style lang="scss">
@import '@/sass/_member.scss';
#memApp{
    @include flexStyle(flex-start,flex-start,column);
    width: 1200px;
    // border: 1px solid red;
    margin: 20px auto;
    padding: 15px;
    .memContent{
        @include flexStyle(space-around,flex-start);
        width: 100%;
        // @include border(1px,red);
        padding: 20px;
        box-sizing: border-box;
    }
    #memContentOrder{
        justify-self: center;
        align-items: center;
        flex-direction: column;
        .memOrderBox{
            @include flexStyle(center,center,column);
            // flex-wrap: wrap;
            width: 90%;
            border-radius: 20px;
            // border: 1px solid $memgrey;
            padding: 20px 40px;
            margin: 30px 0;
            box-shadow: 3px 3px 30px rgba(0, 0, 0, .3);
            background-color: #f8f7ea;
            .memGoToOrder{
                text-decoration: none;
                color: $orange;
                font-size: 1.6rem;
                cursor: pointer;
            }
            .memOrderInfo{
                // border: 1px solid red;
                @include flexStyle(space-between,center);
                width: 90%;
                .memOrderNum{
                    @include fontStyle($grey,1.2rem);
                }
                .memOrderSta{
                    @include flexStyle(space-between,center);
                    img{
                        margin-right: 10px;
                        width: 18px;
                    }
                    p{
                        @include fontStyle($green,1.4rem);
                    }
                }
            }
            .memOrderListBox{
                width: 90%;
                height: 290px;
                // border: 1px solid green;
                overflow: hidden;
                .memOrderList{
                    // border: 1px solid red;
                    width: 100%;
                    height: 130px;
                    margin-top: 10px;
                    @include flexStyle(space-between,flex-start);
                    img{
                        margin-right: 30px;
                    }
                    .memFlexRight{
                        // border: 1px solid red;
                        @include flexStyle(flex-start,flex-start);
                        overflow: hidden;
                        height: 130px;
                        width: 90%;
                        img{
                            width: 15%;
                        }
                        .memOrderSomethingBox{
                            @include flexStyle(flex-start,flex-start,column);
                            p{
                                @include fontStyle($black,1.4rem);
                                margin: 5px 0;
                            }
                            .memFontSmall{
                                @include fontStyle($memgrey,1rem);
                            }
                        }
                    }
                    .memOrderPirceShow{
                        // border: 1px solid red;
                        margin-top: 40px;
                        @include fontStyle($black,1.4rem);
                    }
                }
            }
            .memOrderTotalPriceBox{
                @include flexStyle(flex-end,center);
                width: 100%;
                p{
                    @include fontStyle($black,.9rem);
                    span{
                        @include fontStyle($black,1.6rem);
                    }
                    margin-right: 30px;
                }
                .memOrderGoToListBtn{
                    @include btn(100px,40px);
                    margin: 0 5px;
                }
            }
        }
        .memOrderBoxGrey{
            background-color: #faeaea;
            color: $white;
        }
        .memGoToOrderX{
            color: $black;
            font-size: 1.4rem;
        }
        .memContentOrderPagesBox{
            @include flexStyle(center,center);
            padding: 10px;
            // border: 1px solid red;
            width: 80%;
            // height: 50px;
            .memContentOrderPages{
                @include btn(30px,20px);
                margin: 0 10px;
            }
            .memContentOrderPagesDark{
                background-color: $green;
            }
        }
    }
    .memContentOrderList{
        @include flexStyle(center,center,column);
        width: 100%;
        // @include border(1px,red);
        padding: 20px;
        box-sizing: border-box;
        // border: 1px solid red;
        // display: none;
        .memContentOrderListHeader{
            width: 100%;
            // border: 1px solid red;
            @include flexStyle(space-between,center);
            padding: 0 60px;
            p{
                @include fontStyle($memgrey,1.2rem);
                span{
                    @include fontStyle($black,1.4rem);
                }
            }
            .memOrderListGoBackBtn{
                @include fontStyle($green,1.4rem,700);
                cursor: pointer;
                @include transitionSet(.3s);
                span{
                    @include fontStyle($green,1.4rem,700);
                    margin-right: 3px;
                }
                &:hover{
                    color: $orange;
                    transform: scale(1.1);
                    span{
                        color: $orange;
                        transform: scale(1.1);
                    }
                }
            }
        }
        .memContentOrderListStatus{
            @include flexStyle(center,center);
            // border: 1px solid red;
            margin-top: 30px;
            .memContentOrderListCircleBox{
                @include flexStyle(center,center,column);
                position: relative;
                .memContentOrderListCircle{
                    @include flexStyle(center,center);
                    border: 1px solid $black;
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    img{
                        width: 25px;
                    }
                }
                .memContentOrderListCircleFont{
                    position: absolute;
                    @include fontStyle($black);
                    bottom: -45px;
                }
                .memContentOrderListCircleGreen{
                    border-color: $green;
                    background-color: $green;
                }
                .memContentOrderListCircleGrey{
                    border-color: $memgrey;
                    background-color: $memgrey;
                }
                .memContentOrderListCircleFontGrey{
                    color: $memgrey;
                }
                .memContentOrderListCircleFontGreen{
                    color: $green;
                }
            }
            .memContentOrderListLine{
                border-top: 1px solid $black;
                width: 50px;
            }
        }
        .memContentOrderListQRCodeAndBuyAgainBox{
            margin-top: 90px;
            padding: 30px 10px;
            @include flexStyle(space-between,center);
            width: 90%;
            // border: 1px solid red;
            background-color: rgb(253, 242, 218);
            .memContentOrderListBuyAgainBox,.memContentOrderListQRCodeBox{
                // width: 50%;
                @include flexStyle(flex-start,center,column);
                height: 180px;
                // border: 1px solid red;
                width: 40%;
                h3{
                    @include fontStyle($black,1rem);
                    margin-bottom: 30px;
                    span{
                        @include fontStyle($memgrey,.7rem);
                    }
                }
                .memContentOrderListBuyAgainBtn{
                    margin-top: 10px;
                    @include btn(120px,50px,20px);
                    font-size: 1rem;
                    
                }
            }
            .memContentOrderListBuyAgainBox{
                justify-content: center;
            }
        }
        .memContentOrderListMailBox{
            @include flexStyle(center,flex-start,column);
            margin-top: 30px;
            width: 90%;
            .memMailLine{
                height: .1875rem;
                width: 100%;
                background-position-x: -1.875rem;
                background-size: 7.25rem .1875rem;
                background-image: repeating-linear-gradient(45deg,#6fa6d6,#6fa6d6 33px,transparent 0,transparent 41px,#f18d9b 0,#f18d9b 74px,transparent 0,transparent 82px);
                margin: 10px 0;
            }
            h3,p{
                margin-left: 30px;
            }
            h3{
                @include fontStyle($black,1.6rem);
                margin-bottom: 20px;
            }
            p{
                @include fontStyle($memgrey,1.2rem);
                margin: 10px 0;
                margin-left: 30px;
            }
        }
        .memContentOrderListBox{
            @include flexStyle(center,flex-start,column);
            box-shadow: 2px 2px 10px rgba($color: #000000, $alpha: .2);
            margin-top: 30px;
            padding: 20px 60px;
            width: 90%;
            h3{
                @include fontStyle($black,2rem);
                margin-bottom: 20px;
            }
            .memContentOrderListReal{
                border-bottom: 1px solid $memgrey;
                @include flexStyle(space-between,center);
                padding: 15px 10px;
                width: 90%;
                .memContentOrderListRealRight{
                    width: 95%;
                    // border: 1px solid red;
                    @include flexStyle(flex-start,center);
                    height: 200px;
                    overflow: hidden;
                    img{
                        width: 20%;
                        margin-right: 30px;
                    }
                    .memOrderListRealSomething{
                        @include flexStyle(flex-start,flex-start,column);
                        p{
                            @include fontStyle($black,1.4rem);
                            margin: 5px 0;
                        }
                        .memFontSmall{
                            @include fontStyle($memgrey,1rem);
                        }
                    }
                }
                .memOrderPirceShow{
                    @include fontStyle($black,1.2rem);
                }
            }
            .memOrderListTotalPriceBox{
                @include flexStyle(flex-end,center);
                width: 100%;
                margin-top: 20px;
                margin-right: 60px;
                p{
                    @include fontStyle($black,.9rem);
                    span{
                        @include fontStyle($black,1.6rem);
                    }
                    margin-right: 30px;
                }
            }
        }
    }
    .memContentNone{
        display: none;
    }
}
@media screen and ( max-width: 576px ) and ( min-width: 375px ){
    #memApp{
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
        .memContent{
            padding: 10px;
        }
        #memContentOrder{
            .memOrderBox{
                width: 95%;
                box-sizing: border-box;
                padding: 15px 15px;
                .memOrderInfo{
                    p{
                        font-size: 1rem;
                    }
                    .memOrderSta{
                        p{
                            font-size: 1rem;
                        }
                    }
                }
                .memOrderListBox{
                    width: 100%;
                    margin: 10px 0;
                    height: 140px;
                    .memOrderList{
                        .memFlexRight{
                            width: 80%;
                            img{
                                margin-right: 10px;
                                width: 30%;
                            }
                            .memOrderSomethingBox{
                                width: 70%;
                                p{
                                    font-size: 1.2rem;
                                }
                                .memFontSmall{
                                    font-size: .8rem;
                                }
                            }
                        }
                    }
                }
            }

        }
        .memContentOrderList{
            .memContentOrderListStatus{
                width: 95%;
                .memContentOrderListCircleBox{
                    .memContentOrderListCircle{
                        width: 50px;
                        height: 50px;
                        img{
                            width: 15px;
                        }
                    }
                    .memContentOrderListCircleFont{
                        font-size: .8rem;
                        white-space: nowrap;
                        bottom: -35px;
                    }
                }
            }
            .memContentOrderListQRCodeAndBuyAgainBox{
                width: 95%;
                // border: 1px solid red;
                background-color: rgb(253, 242, 218);
                .memContentOrderListBuyAgainBox,.memContentOrderListQRCodeBox{
                    width: 45%;
                    h3{
                        @include fontStyle($black,.9rem);
                        span{
                            @include fontStyle($memgrey,.7rem);
                            // margin-bottom: 10px;
                        }
                    }
                    .memContentOrderListBuyAgainBtn{
                        transform: scale(.8);
                        font-size: .9rem;
                        &:hover{
                            transform: scale(.9);
                        }
                        
                    }
                }
                .memContentOrderListQRCodeBox{
                    h3{
                        margin-bottom: 10px;
                    }
                }
                .memContentOrderListBuyAgainBox{
                    justify-content: center;
                }
            }
            .memContentOrderListMailBox{
                margin-top: 15px;
                width: 95%;
                h3,p{
                    margin-left: 10px;
                }
                h3{
                    font-size: 1.2rem;
                    margin-bottom: 10px;
                }
                p{
                    font-size: 1rem;
                    margin: 10px 0;
                    margin-left: 30px;
                }
            }
            .memContentOrderListBox{
                padding: 10px 5px;
                width: 98%;
                box-sizing: border-box;
                h3{
                    font-size: 1.4rem;
                    margin-bottom: 10px;
                }
                .memContentOrderListReal{
                    padding: 10px 0px;
                    width: 98%;
                    .memContentOrderListRealRight{
                        width: 80%;
                        // border: 1px solid red;
                        height: 150px;
                        
                        img{
                            margin-right: 10px;
                            width: 30%;
                        }
                        .memOrderListRealSomething{
                            width: 65%;
                            p{
                                font-size: 1rem;
                            }
                            .memFontSmall{
                                font-size: .8rem;
                            }
                        }
                    }
                    .memOrderPirceShow{
                        font-size: 1rem;
                    }
                }
                .memOrderListTotalPriceBox{
                    @include flexStyle(flex-end,center);
                    width: 100%;
                    margin-top: 20px;
                    margin-right: 60px;
                    p{
                        @include fontStyle($black,.9rem);
                        span{
                            @include fontStyle($black,1.6rem);
                        }
                        margin-right: 30px;
                    }
                }
            }
        }
    }
}

</style>