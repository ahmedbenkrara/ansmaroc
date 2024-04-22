@extends('layouts.master')
@section('title')
Les rapports d'annonce | {{\App\Http\Controllers\HomeController::title()->title}}
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

    #thead{
        background:black;
        color:white;
    }

    #thead th{
        padding-top:20px;
        padding-bottom:20px;
        text-align:center;
    }

    table tr{
        cursor:pointer;
    }

    tbody tr:hover{
        background:#0000001f;
    }

</style>

<div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h6>Bonjour, {{Auth::user()->fname}} {{Auth::user()->sname}}</h6>
            <h2>Les rapports d'annonce</h2>
            <h2>Consulter, et supprimer les annonces</h2>
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
            <h2>toute les rapports d'annonce</h2>
            <h6>Vérifie-les Maintenant</h6>
          </div>
        </div>

        <div class="item">
              <div class="row">
                  <!----start---->
                  <div class="col-lg-12">  
                    <div class="table-responsive">
                      <table class="table">
                          <thead id="thead">
                            <tr>
                              <th >#</th>
                              <th >Titre</th>
                              <th >Description</th>
                              <th >Lien</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                              @php 
                              $i = 1
                              @endphp
                              @foreach($signale as $item)
                              <tr>
                                <th >{{$i++}}</th>
                                <td>{{$item->annonce->titre}}</td>
                                <td>{{$item->description}}</td>
                                <td><a href="{{url('/details/'.$item->annonce_id)}}" class="btn btn-dark">voir</a></td>
                                <td><a href="{{url('/reportD/'.$item->id)}}" class="btn btn-danger">Supprimer</a></td>
                              </tr>
                              @endforeach
                          </tbody>
                    </table>
                    {{$signale->links()}}
                    </div>
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
      //$('#demande').addClass('active')
    })
  </script>
@endsection