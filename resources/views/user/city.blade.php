@extends('layouts.master')
@section('title')
@if(!empty($city))
Les annonces de {{$city}} | {{\App\Http\Controllers\HomeController::title()->title}}
@else
Les annonces de toutes les villes | {{\App\Http\Controllers\HomeController::title()->title}}
@endif
@endsection

@section('content')

<style>
    .recent-listing{
        padding-top: 120px;
        margin-bottom: 120px;
        border:none;
        margin:0;
    }

    form#search-form {
        background-color: #fff;
        width: 100%;
        padding:14px;
        border-radius: 7px;
        display: inline-block;
        text-align: center;
    }

    .a {
        width: 66%;
        margin: auto;
    }

    @media screen and (min-width: 993px) {
        form#search-form .ville{
            border:none;
        }
        
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

        .a{
            width:100%;
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

    .col-lg-10 {
        flex: 0 0 auto;
        width: 100%;
    }

    .col-lg-5{
        width:100%;
    }

</style>

<div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="top-text header-text">
            <h6>Votre meilleur site d'annonces</h6>
            <h2>Trouver des lieux et des objets à proximité</h2>
          </div>
        </div>
        <div class="col-lg-12 a">
        <form id="search-form" name="gs" method="get" role="search" action="">
            <div class="row">
              <div class="col-lg-5 align-self-center">
                  <fieldset>
                      <select name="ville" class="form-select ville" aria-label="Area" id="chooseCategory">
                          <option selected disabled>Sélectionnez une ville</option>
                      </select>
                  </fieldset>
              </div>
            </div>
          </form>
          <div class="searchf">
            <button class="send"><i class="fa fa-search"></i>Rechercher</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="recent-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>tout ce que vous cherchez est ici</h2>
            <h6>Vérifie-les Maintenant</h6>
          </div>
        </div>
            <div class="item">
              <div class="row">
                  <!----start---->
                <div class="col-lg-12">
                  @if(count($dataA) > 0)
                  @foreach($dataA as $item)
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
                  @endforeach
                  {{$dataA->links()}}
                  @else
                  <div class="noresults">
                    <img src="/images/posts/notfound.png" alt="">
                    <h3>Aucun résultat trouvé</h3>
                  </div>
                  @endif
                </div>
                <!----end---->
              </div>
            </div>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="/js/countrydata.js"></script>
  <script>
    $(document).ready(function(){
      $("#search").addClass('active')
      
      $('.send').click(function(){
          var par = "";
        if($('.ville').val() != null){
            location.href = '/annonces/'+$('.ville').val()
        }else{
            alert('Sélectionner une ville !')
        }
        
      })

    })
  </script>
@endsection