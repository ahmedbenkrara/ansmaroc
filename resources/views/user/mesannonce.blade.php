@extends('layouts.master')
@section('title')
Mes Annonces | {{\App\Http\Controllers\HomeController::title()->title}}
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

        /*.t1{
            display:none;
        }*/
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

<section class="main">
    <div class="topnav t1">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
              <a class="nav-link" id="active" href="{{url('/dashboard')}}">Mes Annonces</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/favorite')}}">Mes Favories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/parametre')}}">Parametre</a>
            </li>
        </ul>
    </div>
    <div class="topnav t2">
        <form action="{{route('filterauth')}}" method="get">
            <select name="filter" id="filter">
                <option value="1">Actives</option>
                <option value="-1">Rejetées</option>
                <option value="0">Demandé</option>
            </select>
        </form>
    </div>
    <div class="recent-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
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
                      @if($item->status == -1)
                      <div class="main-white-button">
                        <a href="{{url('/details/'.$item->ville.'/'.Str::slug($item->titre).'/'.$item->id)}}"><i class="fa fa-eye"></i>Voir les détails</a>
                      </div>
                      @else
                      <div class="main-white-button">
                        <a href="{{url('/editan/'.$item->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier l'annonce</a>
                      </div>
                      @endif
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
</section>


<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("header").addClass("background-header");
    $(window).scroll(function() {
        var header = $('header').height();
        $("header").addClass("background-header");
    });

    $('#filter').change(function(){
        $('form').submit()
    })

    var a = location.href;
    if(a.lastIndexOf('filter') != -1){
        a = a.slice(a.lastIndexOf('filter')+7)
        $('#filter option[value='+a+']').attr('selected','true')
    }
})
</script>
@endsection