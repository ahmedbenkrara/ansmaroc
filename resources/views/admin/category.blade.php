@extends('layouts.master')
@section('title')
Les sous catégories | {{\App\Http\Controllers\HomeController::title()->title}}
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
        text-align:left;
    }

    table tr{
        cursor:pointer;
    }

    tbody tr:hover{
        background:#0000001f;
    }

    #filter{
        padding:8px 10px;
        cursor:pointer;
        background:black;
        color:white;
        outline:none;
        border:none;
        width:25%;
        margin-bottom:20px;
    }


    @media screen and (max-width: 992px) {
        #filter{
            padding:8px 10px;
            cursor:pointer;
            background:black;
            color:white;
            outline:none;
            border:none;
            width:80%;
            margin-bottom:20px;
        }
    }
    
    @media screen and (max-width: 565px) {
        #filter{
            margin-bottom:20px;
            padding:8px 10px;
            cursor:pointer;
            background:black;
            color:white;
            outline:none;
            border:none;
            width:100%;
        }
    }

    .grpinpt{
        width:100%;
    }

    .grpinpt select,input{
        display: block;
        width: 100%;
        outline: none;
        border-radius: 3px;
        padding: 12px 14px;
        border: none;
        background: black;
        color:white;
        font-size: 15px;
        font-family: monospace;
    }

    .grpinpt p,.gr-p{
        margin-bottom: 5px;
        font-family: revert;
        font-weight: bold;
        font-size:17px;
    }

    .create{
        background:black;
    }

    .form-group label {
      margin-bottom: 5px;
      font-family: revert;
      font-weight: 300;
    }
    
    .image {
      display: none;
    }

    .form-group .fa {
      font-size: 24px;
      border: 3px solid black;
      padding: 30px;
      cursor: pointer;
      color: black;
      border-radius: 10px;
    }

    .fa-plus:before {
      content: "\f067";
    }
</style>

<div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h6>Bonjour, {{Auth::user()->fname}} {{Auth::user()->sname}}</h6>
            <h2>Les sous catégories d'annonces</h2>
            <h2>Consulter, Modifier, Ajouter et supprimer les catégories</h2>
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
            <h2>toute les catégories d'annonce</h2>
            <h6>Vérifie-les Maintenant</h6>
          </div>
        </div>

        <div class="item">
              <div class="row">
                  <!----start---->
                  <div class="col-lg-12"> 
                      @if(Session::has('success'))
                      <div class="alert alert-success" role="alert">
                          {{Session::get('success')}}
                      </div>
                      @endif
            
                      @if(Session::has('fail'))
                      <div class="alert alert-danger" role="alert">
                          {{Session::get('fail')}}
                      </div>
                      @endif
                       <div class="mb-3">
                           <button class="btn btn-dark create" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">Créer une sous catégorie</button>
                       </div>
                      <form action="" class="filter" method="get"> 
                        <select id="filter" name="cat">
                          <option selected disabled>Choisir une catégorie</option>
                          @foreach($data as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                          @endforeach
                        </select>
                       </form>
                    <div class="table-responsive">
                      <table class="table">
                          <thead id="thead">
                            <tr>
                              <th >#</th>
                              <th >Nom</th>
                              <th >Categorie</th>
                              <th >Lien</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                              @php 
                              $i = 1;
                              $j = 1;
                              
                              @endphp
                            @foreach($cat->souscats as $item)
                            <tr>
                                <th >{{$i++}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$cat->name}}</td>
                                <td><button value="{{$item->id}}" class="btn btn-dark edit"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Modifier</button></td>
                                <td><button value="{{$item->id}}" class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Supprimer</button></td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>

                    </div>
                </div>
                <!----end---->
              </div>
            </div>

      </div>
    </div>
  </div>

  <!-- update -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modifier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="/updatescat" id="update" method="post">
            @csrf
             <input type="text" class="id" name="id" hidden>
             <div class="grpinpt mb-4">
                 <p>Categorie :</p>
                 <select name="catid">
                    @foreach($data as $c)
                      @if($cat->id == $c->id)
                      <option value="{{$c->id}}" selected >{{$c->name}}</option>
                      @continue
                      @endif
                        <option value="{{$c->id}}" >{{$c->name}}</option>
                    @endforeach
                </select>
             </div>
             <div class="grpinpt mb-4">
                <p>Nom :</p>
                <input type="text" id="name" name="name" class="input">
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-dark modifier">Modifier</button>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------->


  <!-- supprimer -->
  <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Supprimer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('delete.scat')}}" id="supprimer" method="post">
            @csrf
              <input type="text" class="idc" name="id" hidden>
          </form>
          <p>Êtes-vous sûr de vouloir supprimer cette sous catégorie ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-danger supprimer">Supprimer</button>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------->

  <!-- create subcat -->
  <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Créer une sous catégorie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{route('create.scat')}}" id="create" method="post">
            @csrf
             <div class="grpinpt mb-4">
                 <p>Categorie :</p>
                 <select name="catid" id="catide">
                 <option selected disabled>Choisir une catégorie</option>
                    @foreach($data as $c)
                       <option value="{{$c->id}}" >{{$c->name}}</option>
                    @endforeach
                </select>
             </div>
             <div class="grpinpt mb-4">
                <p>Nom :</p>
                <input type="text" id="name1" name="name">
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-dark createsc">Créer</button>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------->


  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="/js/countrydata.js"></script>
  <script>
    $(document).ready(function(){
        $('#filter').change(function(e){
            e.preventDefault()
            location.href = "categories/"+$(this).val()
        })

        $(document).on('click','.edit',function(){
            $('.id').val($(this).val())
            $.ajax({
                url:"/edit"+$(this).val(),
                type:'GET',
                success:function(response){
                    $('#name').val(response.name)
                }
            })
        })

        $(document).on('click','.delete',function(){
            $('.idc').val($(this).val())
        })

        $('.modifier').click(function(){
            $('#update').submit()
        })
        //validate
        $('#name').keyup(function(){
            if($(this).val().length < 3){
                $('.modifier').attr('disabled','true')
            }else{
                $('.modifier').removeAttr('disabled');
            }
        })

        $('.createsc').attr('disabled','true')
        $('#name1').keyup(function(){
            if($(this).val().length < 3 || $('#catide').val() == null){
                $('.createsc').attr('disabled','true')
            }else{
                $('.createsc').removeAttr('disabled');
            }
        })
        

        $('#catide').change(function(){
            if($('#name1').val().length > 3){
                $('.createsc').removeAttr('disabled');
            }
        })
        /////////

        $('.supprimer').click(function(){
            $('#supprimer').submit()
        })

        $('.createsc').click(function(){
            $('#create').submit()
        })
        
    })
  </script>
@endsection