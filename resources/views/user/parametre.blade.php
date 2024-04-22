@extends('layouts.master')
@section('title')
{{Auth::user()->fname}} {{Auth::user()->sname}} | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')

<style>
    .main{
        margin-top:120px;
        margin-bottom:20px;
    }

    .topnav{
        width: 60%;
        background: white;
        margin-left: auto;
        margin-right: auto;
        border-radius: 6px;
        /*box-shadow: 3px 3px 5px #00000070;*/
    }

    .topnav a{
        color:black;
    }

    .topnav a:hover{
        color:#8d99af;
    }

    #active{
        color:white;
        background:black;
    }

    #filter{
        margin-top:40px;
        padding:8px 10px;
        cursor:pointer;
        background:black;
        color:white;
        outline:none;
        border:none;
        width:20%;
    }

    .t2{
        width:80%;
    }

    
    .noresults{
        width:fit-content;
        height:fit-content;
        margin:auto;
        margin-bottom: 40px;
    }
    
    .noresults img{
        width:200px;
        display:block;
        margin:auto;
    }
    
    .noresults h3{
        color:#8d99af;
    }
    
    .pagination{
        justify-content:center;
        font-family: monospace;
        font-weight: bold;
        margin-bottom:40px;
    }
    
    .page-item.active .page-link {
      z-index: 3;
      color: #fff;
      background-color:#8d99af;
      border-color:#8d99af;
    }
    
    .page-link,.page-link:hover,.page-link:active,.page-link:visited{
        color:#8d99af;
        outline:none;
        box-shadow:none;
    }
    
    .par{
        margin-top:90px;
        background:white;
        width:80%;
        padding:10px;
        margin-left:auto;
        margin-right:auto;
    }
    
    .grpinpt{
        width:60%;
    }
    
    .grpinpt input{
        display: block;
        width: 100%;
        outline: none;
        border-radius: 3px;
        padding: 12px 14px;
        border: none;
        background: rgba(0,0,0,.05);
        font-size: 15px;
        font-family: monospace;
    }
    
    .grpinpt p{
        margin-bottom: 5px;
        font-family: revert;
        font-weight: 300;
        font-size:17px;
    }
    
    .fw-bolder{
        color:#8d99af;
    }
    @media screen and (max-width: 992px) {
        #filter{
            margin-top:40px;
            padding:8px 10px;
            cursor:pointer;
            background:black;
            color:white;
            outline:none;
            border:none;
            width:30%;
        }
    
        .grpinpt{
            width:100%;
        }
    }
    
    @media screen and (max-width: 565px) {
        #filter{
            margin-top:40px;
            padding:8px 10px;
            cursor:pointer;
            background:black;
            color:white;
            outline:none;
            border:none;
            width:80%;
        }
    
        .grpinpt{
            width:100%;
        }
    
        /*.t1{
            display:none;
        }*/
    }
    
</style>

<section class="main">
    <div class="par">
        <div class="grpinpt mb-3">
            <p>Prénom :</p>
            <input type="text" name="fname" class="fname" value="{{Auth::user()->fname}}">
        </div>
        <div class="grpinpt mb-3">
            <p>Nom :</p>
            <input type="text" name="sname" class="sname" value="{{Auth::user()->sname}}">
        </div>
        <div class="grpinpt mb-4">
            <p>Email :</p>
            <input type="text" disabled style="cursor: not-allowed;" name="email" value="{{Auth::user()->email}}">
        </div>
        <p class="fw-bolder mb-4">Si tu veux changer ton mot de passe</p>
        <div class="grpinpt mb-3">
            <p>Mot de passe actuel :</p>
            <input type="password" name="old" class="old">
        </div>
        <div class="grpinpt mb-3">
            <p>Nouveau mot de passe :</p>
            <input type="password" name="password" class="new">
        </div>
        <div class="grpinpt mb-4">
            <p>Confirmer le mot de passe :</p>
            <input type="password" name="cpassword" class="cnew">
        </div>
        <button type="button" class="btn btn-dark">Modifier</button>
    </div>
</section>


<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("header").addClass("background-header");
    $(window).scroll(function() {
        var header = $('header').height();
        $("header").addClass("background-header");
    });

    var form = new FormData()

    function validp(){
        if($('.old').val() != ''){
            if($('.new').val() == '' || $('.new').val().length < 8){
                alert('Le nouveau mot de passe doit comporter plus de 8 lettres !')
                return false
            }

            if($('.new').val() != $('.cnew').val()){
                alert('Les mots de passe ne sont pas les mêmes !')
                return false
            }

            return true

        }else{
            return true
        }
    }

    function validN(){
            if($('.fname').val().length < 3 || $('.sname').val().length < 3){
               alert('Le nom doit comporter plus de 3 lettres !')
               return false
            }else{
               return true
            }

            return true
    }

    $('.btn-dark').click(function(){
        
        if(validp() && validN()){
            form.append('fname',$('.fname').val())
            form.append('sname',$('.sname').val())
            if($('.password').val() != ''){
                form.append('old',$('.old').val())
                form.append('new',$('.new').val())
            }
            form.append('_token', $("meta[name='csrf-token']").attr('content') )
            $.ajax({
                header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"/updateuser",
                dataType:'JSON',
                type:'POST',
                data:form,
                processData: false,
                contentType: false,
                success:function(res){
                   alert(res.toString())
                }
            })
        }
    })
})
</script>
@endsection