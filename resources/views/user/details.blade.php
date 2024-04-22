@extends('layouts.master')
@section('title')
@if(!empty($dataA->meta_title)){{$dataA->meta_title}}@else {{$dataA->titre}} @endif | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')

<style>
    .sproduct{
        margin-top:120px;
        margin-bottom:20px;
        background:white;
    }

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
      
    .project-info-box p,b {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #d5dadb;
        font-family: monospace;
        font-size: 17px;
    }

    b{
      border-bottom:0;
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

    .edit{
      display: block;
      width: 100%;
      outline: none;
      border-radius: 3px;
      padding: 12px 14px;
      border: none;
      background: rgba(0,0,0,.05);
      font-size: 15px;
      font-family: monospace;
      margin-bottom:10px;
    }

</style>


<section class="container sproduct my-5 pt-5">
@if(Session::has('status'))
<div class="alert alert-dark" role="alert">
  {{Session::get('status')}}
</div>
@endif
@if(Session::has('signaler'))
<div class="alert alert-dark" role="alert">
  {{Session::get('signaler')}}
</div>

@endif
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
              @auth
              @if(Auth::user()->hasRole('admin'))
                <p><b>Rapports :</b> {{$w}}</p>
                <b>Meta title :</b>
                <form action="/setTitle" method="post"> @csrf
                   <input type="text" name="id" hidden value="{{$dataA->id}}"> 
                   <input type="text" class="edit" name="meta_title" value="{{$dataA->meta_title}}"> 
                   <button type="submit" class="btn btn-dark">Editer</button>
                </form>
              @endif
              @endauth
          </div>
          <div class="project-info-box">
          @auth
          @if(Auth::user()->hasRole('user'))
            @if(Auth::user()->favorite->where('annonce_id',$dataA->id)->first() == null)
            <form action="{{route('favorite')}}" method="post">
            @csrf
                <input type="text" name="annonce" value="{{$dataA->id}}" hidden id="">
                <button type="submit" class="btn btn-dark ">Ajouter aux favoris</button>
            </form>
            @endif
          @endif
          @endauth
          @if(Auth::check() != null)
             @if(Auth::user()->id != $dataA->user_id && Auth::user()->hasRole('user'))
                 <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-danger">Signaler</button>     
            @endif
            @if(Auth::user()->hasRole('admin'))
            
                <form action="{{route('addelete')}}" class="mb-4" method="post">
                @csrf
                  <input type="text" name="id" hidden value="{{$dataA->id}}">
                  <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                
            @endif
          @else
             <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-danger">Signaler</button>
          @endif
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Signaler une annonce</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('signaler')}}" class="sig" method="post">
            @csrf
            <div class="form-floating">
              <input type="text" name="annonce" value="{{$dataA->id}}" hidden id="">
              <textarea class="form-control description" id="floatingTextarea2" name="description" style="height: 100px"></textarea>
              <label for="floatingTextarea2">Description</label>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-dark signaler">Signaler</button>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------------------------------------->
@if(count($suggest) > 0)
<div class="recent-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h3>Suggestions pour vous</h3>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-carousel owl-listing">
            
            @foreach($suggest as $item)
            <div class="item">
              <div class="row">

                <!----start---->
                <div class="col-lg-12">

                  <div class="listing-item">
                    <div class="left-image">
                      @if(count($item->images) > 0)
                        <img src="{{url($item->images[0]->path)}}" alt="">
                      @else
                        <img src="{{url('/images/posts/default.jpeg')}}" alt="">
                      @endif
                      
                    </div>
                    <div class="right-content align-self-center">
                      <h4>{{Str::limit($item->titre,20)}}</h4>
                      <h6>par: {{$item->user->fname}} {{$item->user->sname}}</h6>
                      <span class="price"><div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>{{$item->prix}} dhs</span>
                      <span class="details">Date d'annonce: <em>{{explode(' ',$item->created_at)[0]}}</em></span>
                      <ul class="info">
                          <li></li>
                        <li><img src="images/categories/all.png" alt="">{{Str::limit($item->souscat->name,10)}}</li>
                      </ul>
                      <div class="main-white-button">
                        <a href="{{url('/details/'.$item->ville.'/'.Str::slug($item->titre).'/'.$item->id)}}"><i class="fa fa-eye"></i>Voir les détails</a>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!----end---->

              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</div>
@endif

</section>




<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#search").addClass('active')
    $("header").addClass("background-header");
    $('.carousel-item').first().addClass('active')
    $(window).scroll(function() {
        var header = $('header').height();
        $("header").addClass("background-header");
    });

    $('.signaler').attr('disabled','true')
    $('#floatingTextarea2').keyup(function(){
        if($('#floatingTextarea2').val().length >= 20){
            $('.signaler').removeAttr('disabled')
        }else{
            $('.signaler').attr('disabled','true')
        }
    })

    $('.signaler').click(function(){
        $('.sig').submit()
    })
})
</script>
@endsection