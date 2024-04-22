@extends('layouts.master')
@section('title')
{{$dataA->titre}} | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')

<style>

    .small-img-group{
        display:flex;
        overflow-x:auto;
        overflow-y:hidden;
        position:relative;
    }

    .small-img-group::-webkit-scrollbar{
        width:0;
    }

    .small-img-col{
        min-width:25%;
        cursor:pointer;
        margin-left:5px;
    }
    .n{
        margin-left:0;
    }
    .carousel-item{
        height:100%;
        width:100%;
    }

    .carousel-item img{
        width:100% !important;
        height:100% !important;
    }

    .carousel-inner {
        position: relative;
        width: 100%;
        height: 340px;
        overflow: hidden;
    }

    .titre{
        font-weight: 600;
        color: black;
        margin-bottom:10px;
        text-shadow: 0 0 2px black;
    }

    .project-info-box {
        margin: 15px 0;
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 5px;
        word-wrap:break-word;
    }
      
    .project-info-box p {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #d5dadb;
        font-family: monospace;
        font-size: 17px;
    }
      
    .project-info-box p:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .mtop{
        margin-top:0;
    }

    .title{
        font-size: 17px;
        font-family:monospace;
        font-weight:bold;
    }

    .btn-danger{
        display:block;
        margin-top:5px;
    }

</style>

<style>
    .recent-listing{
        padding-top: 120px;
        margin-bottom: 120px;
        border:none;
        margin:0;
    }

    form#search-form {
        background-color: #fff;
        padding: 14px;
        width: 100%;
        border-radius: 7px;
        display: inline-block;
        text-align: center;
    }

    @media screen and (min-width: 993px) {
        form#search-form .ville{
            border:none;
        }
        
        .searchf button{
            width: 50%;
            display: block;
            margin: auto;
            margin-top: 12px;
            background-color: #8d99af;
            border: none;
            padding: 11px;
            color: #fff;
            font-size: 20px;
            border-radius: 7px;
            text-align: revert;
        }
    }

    @media screen and (max-width: 992px) {
        .searchf button{
            width: 100%;
            display: block;
            margin: auto;
            margin-top: 12px;
            background-color: #8d99af;
            border: none;
            padding: 11px;
            color: #fff;
            font-size: 20px;
            border-radius: 7px;
            text-align: revert;
        }
    }    

    .searchf{
        width:100%;
        height:fit-content;
    }

    .searchf button i{
        width: 40px;
        height: 40px;
        background-color: #fff;
        border-radius: 50%;
        color: #8d99af;
        display: inline-block;
        text-align: center;
        line-height: 38px;
        margin-right: 10px;
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

</style>

<div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h6>Bonjour, {{Auth::user()->fname}} {{Auth::user()->sname}}</h6>
            <h2>Les demandes d'annonces</h2>
            <h2>Voir, accepter ou refuser les demandes d'annonces</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
<section class="container sproduct my-5 pt-5">
  <div class="row mt-5">
        <div class="col-lg-6 mb-3">
            <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                @if(count($dataA->images) > 0)
                @foreach($dataA->images as $item)
                  <div class="carousel-item">
                    <img src="{{url($item->path)}}" class="d-block w-100" alt="...">
                  </div>
                @endforeach
                @else
                  <div class="carousel-item active">
                    <img src="{{url('/images/posts/default.jpeg')}}" class="d-block w-100" alt="...">
                  </div>
                @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
          </div>
          <div class="project-info-box">
              <p><b>Categorie : </b> {{$dataA->souscat->name}} </p>
              @if($dataA->type == 0)
              <p><b>Type :</b> Demande</p>
              @else
              <p><b>Type :</b> Vente</p>
              @endif
          </div>
          <div class="project-info-box">
              <p><b>Créé par : </b> {{$dataA->user->fname}} {{$dataA->user->sname}}</p>
              <p><b>Téléphone :</b> {{$dataA->phone}} </p>
              <p><b>Email :</b> {{$dataA->user->email}}</p>
          </div>
          <div class="project-info-box">
            <form action="{{route('demande')}}" method="post">
            @csrf
                <input type="text" name="id" hidden value="{{$dataA->id}}">
                <input type="text" name="status" hidden value="1">
                <button type="submit" class="btn btn-dark">Accepter</button>
            </form>

            <form action="{{route('demande')}}" method="post">
            @csrf
                <input type="text" name="id" hidden value="{{$dataA->id}}">
                <input type="text" name="status" hidden value="-1">
                <button type="submit" class="btn btn-danger">Refuser</button>
            </form>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <div class="project-info-box mtop">
                <h3 class="titre">{{$dataA->titre}}</h3>
                <div class="mb-3"><span class="title">Description :</span></div>
                <p>
                    {{$dataA->description}}
                </p>
            </div>

            <div class="project-info-box">
              <p><b>Prix : </b> {{$dataA->prix}} Dhs</p>
              <p><b>Ville :</b> {{$dataA->ville}} </p>
              <p><b>Adresse :</b> {{$dataA->adresse}}</p>
              <p><b>Date :</b> {{$dataA->created_at}}</p>
            </div>
        </div>
        
    </div>
</section>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="/js/countrydata.js"></script>
  <script>
    $(document).ready(function(){
        $('.carousel-item').first().addClass('active')
    })
  </script>
@endsection