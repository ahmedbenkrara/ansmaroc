<style>
    .main{
        margin-top:120px;
        margin-bottom:40px;
    }

    .p-lg-5{
        flex:1;
    }

    .d-md-flex{
        background:white;
        box-shadow: 0 10px 34px -15px rgb(0 0 0 / 24%);
    }

    .text,.text p,.text a{
        color:white;
    }

    .order-md-last{
        background:url('assets/images/login.jpeg');
        background-size:cover;
        background-repeat:no-repeat;
        background-position: unset;
    }

    #newback{
        background:url('assets/images/create.jpg');
        background-size:cover;
        background-repeat:no-repeat;
        background-position: unset;
    }

    .order-md-last img{
        width:100%;
        height:100%;
        display:block;
    }

    .form-group {
        position: relative;
    }

    .mb-3 {
        margin-bottom: 1rem!important;
    }

    .submitbtn{
        outline:none;
        width:100%;
        border:none;
        background:#8d99af;
        color:white;
        border-radius:20px;
        padding:10px 0;
    }

    .submitbtn:hover{
        background:#97a3bbb5;
    }
    
    .htitle{
        font-weight:300;
    }

    .form-group label{
        margin-bottom:5px;
        font-family: revert;
        font-weight: 300;
    }

    .input{
        display: block;
        width: 100%;
        outline: none;
        border-radius: 50px;
        padding: 12px 14px;
        border: none;
        background: rgba(0,0,0,.05);
        font-size: 15px;
        font-family: monospace;
    }

    .checkbox-wrap{
        color:#8d99af;
        position:relative;
        margin-left:24px;
        cursor:pointer;
    }

    #remember{
        appearance:none;
    }

    .checkbox-wrap:before{
        content: '';
        width: 24px;
        height: 24px;
        background-color: #f2f2f2;
        position: absolute;
        left: -30px;
        top: -1px;
        border-radius: 4px;
        border:1px solid #f2f2f2;

    }

    .checkbox-wrap:after{
        content: "\f00c";
        font-family:"FontAwesome";
        width: 24px;
        height: 24px;
        background-color: #8d99af;
        position: absolute;
        left: -30px;
        top: -1px;
        border-radius: 4px;
        color:white;
        border:1px solid #8d99af;
        display:grid;
        place-items:center;
        transform:scale(0) rotate(360deg);
        transition:transform .4s ease-in-out;
    }

    #remember:checked + .checkbox-wrap:after{
        transform:scale(1) rotate(0deg);
    }

    .fflex{
        width:100%;
        display:flex;
        flex-wrap:wrap;
    }

    .fflex div{
        flex:auto;
    }

    .fflex a{
        color:#8d99af;
    }

    #signup{
        border:1px solid white;
        box-shadow: none!important;
        font-size: 15px;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight:400;
    }

    #signup:hover{
        background:#8d99af;
        border:1px solid #8d99af;
    }

</style>