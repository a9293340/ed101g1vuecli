<template>
    <div class="homeContainer" id="homeContainer">
        <div class="homeTab-wrap">
            <!-- 註冊/登入 按鈕-->
            <input class="homeTab" id="homeTab1" type="radio" name="group1" />
            <label for="homeTab1">註冊</label>
            <input
            class="homeTab"
            id="homeTab2"
            type="radio"
            name="group1"
            checked="checked"
            />
            <label for="homeTab2">登入</label>
            <!-- end 註冊/登入 按鈕-->

            <div class="homeTab-content">
            <!-- 註冊表單-->
            <form
                id="mySignupForm"
                method="post"
                action="./php/signup.php"
                enctype="multipart/form-data"
            >
                <div class="homeTop-row">
                <div class="homeField-wrap">
                    <div class="homeNameBox">
                    <label> 姓名<span class="homeReq">*</span> </label>
                    <input
                        type="text"
                        required
                        autocomplete="off"
                        v-model="homeSignupName"
                        name="memName"
                        @keyup="homeSignupNamecheck"
                    />
                    </div>
                </div>
                </div>
                <p :class="homeSignupNameClass">{{homeSignupNameWarning}}</p>
                <div class="homeField-wrap">
                <label> 信箱<span class="homeReq">*</span> </label>
                <input
                    type="email"
                    required
                    autocomplete="off"
                    v-model="homeSignupMail"
                    id="memSignupEmail"
                    name="memEmail"
                    @keyup="checkEmail"
                />
                </div>
                <!-- <p :class="homeSignupMailClass">{{homeSignupMailWarning}}</p> -->
                <p
                class="homeWarningWords homeWarningWordsOrange"
                style="margin-top: 5px;"
                id="idMsg"
                >
                請輸入正確信箱格式
                </p>
                <div class="homeField-wrap">
                <label> 密碼<span class="homeReq">*</span> </label>
                <input
                    type="password"
                    required
                    autocomplete="off"
                    v-model="homeSignupPsw"
                    name="memPsw"
                    @keyup="homeSignupPswcheck"
                />
                </div>
                <p :class="homeSignupPswClass">{{homeSignupPswWarning}}</p>
                <div class="homeField-wrap">
                <label> 確定密碼<span class="homeReq">*</span> </label>
                <input
                    type="password"
                    required
                    autocomplete="off"
                    v-model="homeSignupPsw2"
                    @keyup="homeSignupPsw2check"
                />
                </div>
                <p :class="homeSignupPsw2Class">{{homeSignupPsw2Warning}}</p>
                <div class="homeField-wrap">
                <label> 電話<span class="homeReq">*</span> </label>
                <input
                    type="phone"
                    required
                    autocomplete="off"
                    v-model="homeSignupPhone"
                    name="memPhone"
                    @keyup="homeSignupPhonecheck"
                />
                </div>
                <p :class="homeSignupPhoneClass">{{homeSignupPhoneWarning}}</p>
                <div class="homeField-wrap">
                <label> 地址<span class="homeReq">*</span> </label>
                <input
                    type="text"
                    required
                    autocomplete="off"
                    v-model="homeSignupAddr"
                    name="memAddr"
                />
                </div>
                <input
                type="submit"
                value="建立帳號"
                id="signUpBtn"
                class="homeButton homeButton-block"
                @click="homeCheckSignupBtn"
                />
                <!-- <button type="submit" id='signUpBtn' class="homeButton homeButton-block" @click='homeCheckSignupBtn'>建立帳號</button> -->
            </form>
            <!-- end 註冊表單-->
            </div>

            <div class="homeTab-content">
            <!-- 登入表單-->
            <form id="myLoginForm">
                <div class="homeField-wrap">
                <label> 信箱<span class="homeReq">*</span> </label>
                <input
                    type="email"
                    required
                    autocomplete="off"
                    v-model="homeLoginMail"
                    name="memEmail"
                    @keyup="homeLoginMailcheck"
                />
                </div>
                <p :class="homeLoginMailClass">{{homeLoginMailWarning}}</p>
                <div class="homeField-wrap">
                <label> 密碼<span class="homeReq">*</span> </label>
                <input
                    type="password"
                    required
                    autocomplete="off"
                    v-model="homeLoginPsw"
                    name="memPsw"
                    @keyup="homeLoginPswcheck"
                />
                </div>
                <p :class="homeLoginPswClass">{{homeLoginPswWarning}}</p>

                <p class="homeForgot"><a href="#">忘記密碼?</a></p>
                <input
                type="button"
                value="登入"
                class="homeButton homeButton-block"
                @click="homeCheckLoginBtn"
                />
                <!-- <button class="homeButton homeButton-block" @click='homeCheckLoginBtn'/>登入</button> -->
            </form>
            <!-- end 登入表單-->
        </div>
    </div>
    </div>
</template>

<script>
import $ from 'jquery';
export default {
    data() {
        return {
            homeLoginMail:'',
            homeLoginMailWarning:'請填寫正確電子信箱格式',
            homeLoginPsw:'',
            homeLoginPswWarning:'須包含數字及大小寫各1且長度為7以上',
            homeSignupName:'',
            homeSignupNameWarning:'請填寫正確姓名格式',
            homeSignupMail:'',
            homeSignupMailWarning:'',
            homeSignupPsw:'',
            homeSignupPswWarning:'須包含數字及大小寫各1且長度為7以上',
            homeSignupPsw2:'',
            homeSignupPsw2Warning:'請與第一次密碼填寫相同',
            check:false,
            doubleCheck:false,
            homeSignupPhone:'',
            homeSignupPhoneWarning:'請正確填寫電話格式',
            homeSignupAddr:'',
        }
    },
    methods: {
        homeCheckSignupBtn(e){
            if(!this.check){
                e.preventDefault();
                alert('請輸入正確內容');
            }else if(!this.doubleCheck){
                let homeCool = confirm('密碼強度醬子不好吧,要再修改嗎？');
                if(homeCool){
                    e.preventDefault();
                }
                // $('#member_aflogin').show(500);
                // $('#homeContainderBgc').hide(500);
                // $('#homeContainer').hide(500);
                // $('#member').hide(500);
            }
        },
        homeCheckLoginBtn(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "./php/login.php",
                data: {
                    memEmail: this.homeLoginMail,
                    memPsw: this.homeLoginPsw
                },
                success: function (response) {
                    if(response == 'sad'){
                        alert('帳號或密碼輸入錯誤！');
                    }else if(response == 'bad'){
                        alert('該帳號已被停權，請來電聯繫詢問～')
                    }else{
                        let member = JSON.parse(response);
                        console.log(member);
                        sessionStorage['memId'] = 'good';
                        sessionStorage['memImage'] = member.memImage;
                        sessionStorage['mEmmEmId'] = member.memId;
                        sessionStorage['orderMemScore'] = member.memScore;
                        sessionStorage['signinOrNot'] = 1;
                        if(sessionStorage['signinOrNot'] == 1){
                            document.getElementById('navMem').style.display = 'block';
                            document.getElementById('navSign').style.display = 'none';
                        }
                        // document.getElementById('memHead').src = sessionStorage['memImage'];
                        location.href = './#/';
                    }
                }
            });
        },
        checkEmail(){
            // alert('aaa')
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
                if(xhr.status == 200){
                    // document.getElementById('idMsg').innerText = xhr.responseText;
                    // if(xhr.responseText == '此帳號可使用'){
                    //     document.getElementById('idMsg').classList.remove('homeWarningWordsOrange');
                    //     document.getElementById('idMsg').classList.add('homeWarningWordsGreen');
                    // }else{
                    //     document.getElementById('idMsg').classList.add('homeWarningWordsOrange');
                    //     document.getElementById('idMsg').classList.remove('homeWarningWordsGreen');
                    // }
                    if(/^([A-Za-z0-9_\-.])+@[A-Za-z]{2,6}\.com(\.[A-Za-z]{2,6})?$/.test(document.getElementById('memSignupEmail').value)){
                        if(xhr.responseText == '此帳號可使用'){
                            document.getElementById('idMsg').innerText = `此信箱格式正確且可以使用`;
                            document.getElementById('idMsg').classList.remove('homeWarningWordsOrange');
                            document.getElementById('idMsg').classList.add('homeWarningWordsGreen');
                        }else{
                            document.getElementById('idMsg').innerText = `此信箱已被使用過`;
                            document.getElementById('idMsg').classList.add('homeWarningWordsOrange');
                            document.getElementById('idMsg').classList.remove('homeWarningWordsGreen');
                        }
                    }else{
                        if(xhr.responseText == '此帳號可使用'){
                            document.getElementById('idMsg').innerText = `請輸入正確信箱格式`;
                            document.getElementById('idMsg').classList.add('homeWarningWordsOrange');
                            document.getElementById('idMsg').classList.remove('homeWarningWordsGreen');
                        }else{
                            document.getElementById('idMsg').innerText = `請輸入正確信箱格式`;
                            document.getElementById('idMsg').classList.add('homeWarningWordsOrange');
                            document.getElementById('idMsg').classList.remove('homeWarningWordsGreen');
                        }
                    }
                }else{
                    alert(xhr.status);
                }
            }
            }
            let url = `./php/checkemail.php?memEmail=${document.getElementById('memSignupEmail').value}`;
            xhr.open("get",url,true);
            xhr.send(null);
        },
        homeSignupPhonecheck(e){
            if(/^([-_－—\s(]?)([(]?)((((0?)|((00)?))(((\s){0,2})|([-_－—\s]?)))|(([)]?)[+]?))(886)?([)]?)([-_－—\s]?)([(]?)[0]?[1-9]{1}([-_－—\s)]?)[1-9]{2}[-_－—]?[0-9]{3}[-_－—]?[0-9]{3}$/.test(e.target.value)){
                this.check = true;
                this.homeSignupPhoneWarning = '電話格式正確';
            }else{
                this.homeSignupPhoneWarning = '請正確填寫電話格式';
                this.check = false;
            }
        },
        homeSignupPswcheck(e){
            let score = e.target.value.length;
            if(/[A-Z].*[A-Z]/.test(e.target.value)) score *= 2;
            if(/[a-z].*[a-z]/.test(e.target.value)) score *= 2;
            if(/\d.*\d/.test(e.target.value)) score *= 2;
            if(/\W+/.test(e.target.value)) score *= 2;
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{7,}$/.test(e.target.value)){
                if(score >= 80){
                    this.homeSignupPswWarning = '密碼強度：強';
                    this.check = true;
                    this.doubleCheck = true;
                }else if(score >= 60){
                    this.homeSignupPswWarning = '密碼強度：中';
                    this.check = true;
                    this.doubleCheck = true;
                }else{
                    this.homeSignupPswWarning = '密碼強度：弱';
                    this.check = true;
                    this.doubleCheck = false;
                }
            }else{
                this.homeSignupPswWarning = '須包含數字及大小寫各1且長度為7以上';
                this.check = false;
            }
        },
        homeSignupPsw2check(e){
            if(this.homeSignupPsw == e.target.value && e.target.value != ''){
                this.check = true;
                this.homeSignupPsw2Warning = '密碼確認正確';
            }else{
                this.homeSignupPsw2Warning = '請與第一次密碼填寫相同';
                this.check = false;
            }
        },
        homeSignupNamecheck(e){
            if(/[^\d]{2,20}/.test(e.target.value)){
                this.homeSignupNameWarning = '姓名格式正確';
                this.check = true;
            }else{
                this.check = false;
                this.homeSignupNameWarning = '請填寫正確姓名格式';
            }
        },
        homeLoginPswcheck(e){
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{7,}$/.test(e.target.value)){
                this.homeLoginPswWarning = '密碼格式正確';
            }else{
                this.homeLoginPswWarning = '須包含數字及大小寫各1且長度為7以上';
            }
        },
        homeLoginMailcheck(e){
            if(/^([A-Za-z0-9_\-.])+@[A-Za-z]{2,6}\.com(\.[A-Za-z]{2,6})?$/.test(e.target.value)){
                this.homeLoginMailWarning = '信箱格式正確';
            }else{
                this.homeLoginMailWarning = '請填寫正確電子信箱格式';
            }
        }
    },
    computed:{
        homeLoginMailClass(){
            if(/^([A-Za-z0-9_\-.])+@[A-Za-z]{2,6}\.com(\.[A-Za-z]{2,6})?$/.test(this.homeLoginMail)){
                // this.homeLoginMailWarning = '信箱格式正確';
                return 'homeWarningWords homeWarningWordsGreen';
            }else{
                // this.homeLoginMailWarning = '請填寫正確電子信箱格式';
                return 'homeWarningWords homeWarningWordsOrange';
            }
        },
        homeLoginPswClass(){
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{7,}$/.test(this.homeLoginPsw)){
                // this.homeLoginPswWarning = '密碼格式正確';
                return 'homeWarningWords homeWarningWordsGreen';
            }else{
                // this.homeLoginPswWarning = '須包含數字及大小寫各1且長度為7以上';
                return 'homeWarningWords homeWarningWordsOrange';
            }
        },
        homeSignupNameClass(){
            if(/[^\d]{2,20}/.test(this.homeSignupName)){
                // this.homeSignupNameWarning = '姓名格式正確';
                // this.check = true;
                return 'homeWarningWords homeWarningWordsGreen';
            }else{
                // this.check = false;
                // this.homeSignupNameWarning = '請填寫正確姓名格式';
                return 'homeWarningWords homeWarningWordsOrange';
            }
        },
        homeSignupPswClass(){
            let score = this.homeSignupPsw.length;
            if(/[A-Z].*[A-Z]/.test(this.homeSignupPsw)) score *= 2;
            if(/[a-z].*[a-z]/.test(this.homeSignupPsw)) score *= 2;
            if(/\d.*\d/.test(this.homeSignupPsw)) score *= 2;
            if(/\W+/.test(this.homeSignupPsw)) score *= 2;
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{7,}$/.test(this.homeSignupPsw)){
                if(score >= 80){
                    // this.homeSignupPswWarning = '密碼強度：強';
                    // this.check = true;
                    // this.doubleCheck = true;
                    return 'homeWarningWords homeWarningWordsGreen';
                }else if(score >= 60){
                    // this.homeSignupPswWarning = '密碼強度：中';
                    // this.check = true;
                    // this.doubleCheck = true;
                    return 'homeWarningWords homeWarningWordsYellow';
                }else{
                    // this.homeSignupPswWarning = '密碼強度：弱';
                    // this.check = true;
                    // this.doubleCheck = false;
                    return 'homeWarningWords homeWarningWordsYellow';
                }
            }else{
                // this.homeSignupPswWarning = '須包含數字及大小寫各1且長度為7以上';
                // this.check = false;
                return 'homeWarningWords homeWarningWordsOrange';
            }
        },
        homeSignupPsw2Class(){
            if(this.homeSignupPsw == this.homeSignupPsw2 && this.homeSignupPsw2 != ''){
                // this.check = true;
                // this.homeSignupPsw2Warning = '密碼確認正確';
                return 'homeWarningWords homeWarningWordsGreen';
            }else{
                // this.homeSignupPsw2Warning = '請與第一次密碼填寫相同';
                // this.check = false;
                return 'homeWarningWords homeWarningWordsOrange';
            }
        },
        homeSignupPhoneClass(){
            if(/^([-_－—\s(]?)([(]?)((((0?)|((00)?))(((\s){0,2})|([-_－—\s]?)))|(([)]?)[+]?))(886)?([)]?)([-_－—\s]?)([(]?)[0]?[1-9]{1}([-_－—\s)]?)[1-9]{2}[-_－—]?[0-9]{3}[-_－—]?[0-9]{3}$/.test(this.homeSignupPhone)){
                // this.check = true;
                // this.homeSignupPhoneWarning = '電話格式正確';
                return 'homeWarningWords homeWarningWordsGreen';
            }else{
                // this.homeSignupPhoneWarning = '請正確填寫電話格式';
                // this.check = false;
                return 'homeWarningWords homeWarningWordsOrange';
            }
        },
    }
}
</script>

<style lang="scss">
    .homeTab-wrap {
        width: 100%;
        min-width: 350px;
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        // background-color:$white;
        // box-shadow:  0 0 1em $lightGrey;

            .homeTab {
            display: none;
            }

            .homeTab:checked + label {
            cursor: default;
            color: #ECEEE7;
            background-color:#37AB64;
            }
            .homeTab + label {
            cursor: pointer;
            display: block;
            text-decoration: none;
            flex-grow: 3;
            text-align: center;
            background-color:#ECEEE7;
            user-select: none;
            text-align: center;
            transition: 0.3s background-color ease;
            padding: 15px;
            }
            .homeTab-content {
            padding: 10px;
            background-color: transparent;
            position: absolute;
            width: 100%;
            z-index: -1;
            opacity: 0;
            left: 0;
            transform: translateY(-3px);
            }
            .homeTab:checked:nth-of-type(1) ~ .homeTab-content:nth-of-type(1) {
            opacity: 1;
            transition: 0.5s opacity ease-in, 0.8s transform ease;
            position: relative;
            top: 0;
            z-index: 1;
            transform: translateY(0px);
            }
            .homeTab:checked:nth-of-type(2) ~ .homeTab-content:nth-of-type(2) {
            opacity: 1;
            transition: 0.5s opacity ease-in, 0.8s transform ease;
            position: relative;
            top: 0;
            z-index: 1;
            transform: translateY(0px);
        }

        //註冊
        .homeTop-row {
        &:after {
            content: "";
            display: table;
            clear: both;

            > div {
            float:left;
            margin-right:4%;
            
            &:last-child { 
                margin:0;
            }
            }
        }
        }

        .homeField-wrap {
        position:relative;
        padding:15px;
        display: flex;
        .homeReq {
            margin:2px;
            color:#EA6227;
        }

        label {
            -webkit-transform: translateY(6px);
            transform: translateY(6px);
            left: 13px;
            color: #595959;
            transition: all 0.25s ease;
            pointer-events: none;
            font-size:1rem;
            float: left;
            width: 80px;
        }
        .homeNameBox{
            display: inline-flex;
            width: 100%;

            .homeName-1{
            width: calc(25% - 10px);
            margin-right: 9%;
            }
    
            .homeName-2{
            width: calc(45% - 10px);
            } 
        }
        }
        .homeWarningWords{
        // background-color: red;
        color: #ECEEE7;
        border-radius: 3px;
        padding: 3px 10px;
        // margin: 2px 0;
        margin-left: 100px;
        width: 330px;
        }
        .homeWarningWordsGreen{
        background-color: #37AB64;
        }
        .homeWarningWordsOrange{
        background-color: #EA6227;
        }
        .homeWarningWordsYellow{
        background-color: #FFD23F;
        }
    .homeField-error{//帳號、密碼錯誤
        width: 100%;
        text-align: center;
        font-size:.8rem;
        color:#8c0606;
        padding-left: 40px;
        }

        input{
        display:block;
        width:calc(80% - 8px);
        padding:10px;
        background:none;
        background-image:none;
        border:1px solid #ccc;
        border-radius:0;
        transition:border-color .25s ease, box-shadow .25s ease;
        border-radius: 5px;
        &:focus {
            outline:0;
            border-color:#37AB64;
        }
        }

        .homeButton {
        border:0;
        outline:none;
        border-radius:0;
        padding:15px 0;
        font-size: 1rem;
        font-weight:900;
        text-transform:uppercase;
        letter-spacing:.1em;
        cursor: pointer;
        background: #37AB64;
        color: #ECEEE7;
        // transition:all.5s ease;
        -webkit-appearance: none;
        margin-top: 10px;

        &:hover, &:focus {
            background: #37AB64;
        }
        }
        
        .homeButton-block {
        display:block;
        width:100%;
        }
    }

    .homeForgot {
        margin-top:-20px;
        margin-top: 10px;
        text-align:right;
        font-size: .9rem;
        padding: 10px;
    }
</style>