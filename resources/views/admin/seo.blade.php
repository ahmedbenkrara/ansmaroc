@extends('layouts.master')
@section('title')
Paramètres SEO | {{\App\Http\Controllers\HomeController::title()->title}}
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
    
    .grpinpt input,textarea{
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
    
    }

    textarea{
        min-height:140px;
        max-height:140px;
    }

    textarea::-webkit-scrollbar{
        width:0px;
    }
    
</style>

<section class="main">

    <div class="par">
        
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
        @endif
        <form action="{{route('settings.update')}}" method="get">
            <div class="grpinpt mb-3">
                <p>Titre du site :</p>
                <input type="text" name="title" value="{{$data->title}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Auteur :</p>
                <input type="text" name="author" value="{{$data->author}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Mots clés :</p>
                <input type="text" name="keywords" value="{{$data->keywords}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Whatsapp :</p>
                <input type="text" name="whatsapp" value="{{$data->whatsapp}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Facebook :</p>
                <input type="text" name="facebook" value="{{$data->facebook}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Twitter :</p>
                <input type="text" name="twitter" value="{{$data->twitter}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Instagram :</p>
                <input type="text" name="instagram" value="{{$data->instagram}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Adresse :</p>
                <input type="text" name="address" value="{{$data->address}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Numéro de téléphone :</p>
                <input type="text" name="phone" value="{{$data->phone}}">
            </div>
            <div class="grpinpt mb-3">
                <p>Map lien :</p>
                <input type="text" name="map" value="{{$data->map}}">
            </div>
            <div class="grpinpt mb-4">
                <p>Description : (120 lettres maximum)</p>
                <textarea name="description" oninput="if (this.value.length > 120) this.value = this.value.slice(0, 120)">{{$data->description}}</textarea>
            </div>
    
            <button type="submit" class="btn btn-dark">Modifier</button>
        </form>
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

})
</script>
@endsection