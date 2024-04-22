@extends('layouts.master')
@section('title')
Les catégories | {{\App\Http\Controllers\HomeController::title()->title}}
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
            <h2>Les catégories d'annonces</h2>
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
                           <button class="btn btn-dark create" data-bs-toggle="modal" data-bs-target="#staticBackdrop4">Créer une catégorie</button>
                       </div>

                    <div class="table-responsive">
                      <table class="table">
                          <thead id="thead">
                            <tr>
                              <th >#</th>
                              <th >Nom</th>
                              <th >Éditer</th>
                              <th>Supprimer</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php 
                              $i = 1;
                              @endphp
                            @foreach($data as $item)
                            <tr>
                                <th >{{$i++}}</th>
                                <td>{{$item->name}}</td>
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


  <!-- create cat -->
  <div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Créer une catégorie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="grpinpt mb-4">
                <p>Nom de catégorie :</p>
                <input type="text" id="categoryname">
          </div>
          <div class="form-group mb-3">
              <p class="gr-p">Icon :</p>
              <label for="image"><i class="fa fa-plus"></i></label>
              <input type="file" id="image" class="image" value="" accept="image/*" pattern="/image/*/">
          </div>  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-dark createcat">Créer</button>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------->

  <!-- edit cat -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modifier une catégorie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('update.cat')}}" method="post" id="update" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" class="id" hidden>
              <div class="grpinpt mb-4">
                    <p>Nom de catégorie :</p>
                    <input type="text" name="catname" id="catname">
              </div>
              <div class="form-group mb-3">
                  <p class="gr-p">Icon :</p>
                  <label for="img"><i class="fa fa-plus"></i></label>
                  <input type="file" name="image" id="img" class="image" value="" accept="image/*" pattern="/image/*/">
              </div>  
          </form>
          <div class="col-lg-10 offset-lg-1 container mb-4">
            <ul class="categories row row-cols-auto images"></ul>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-dark editcat">Modifier</button>
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
          <form action="{{ route('deletecat.cat') }}" id="supprimer" method="post">
            @csrf
              <input type="text" class="idc" name="id" hidden>
          </form>
          <p>Êtes-vous sûr de vouloir supprimer cette catégorie ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-danger supprimer">Supprimer</button>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------->

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="/js/countrydata.js"></script>
  <script>
    $(document).ready(function(){

        $('.createcat').attr('disabled','true')

        var form = new FormData();
        $("#image").change(function(){
            form.set('image', document.querySelector('#image').files[0])
            if($('#categoryname').val().length > 3){
              $('.createcat').removeAttr('disabled');
            }else{
              $('.createcat').attr('disabled','true')
            }
        })

        $('#categoryname').keyup(function(){
            if($(this).val().length < 3 || document.querySelector('#image').files[0] == null){
              $('.createcat').attr('disabled','true')
            }else{
              $('.createcat').removeAttr('disabled')
            }
        })

        $('.createcat').click(function(){
          form.set('name', $('#categoryname').val())
          form.append('_token', $("meta[name='csrf-token']").attr('content'))
          $.ajax({
              header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"{{route('create.cat')}}",
              dataType:'JSON',
              type:'POST',
              data:form,
              processData: false,
              contentType: false,
              success:function(res){
                alert(res)
              }
          })
        })

        $('.edit').click(function(){
            $('.id').val($(this).val())
            $.ajax({
                url:"/getcat"+$(this).val(),
                type:'GET',
                success:function(response){
                    $('#catname').val(response.name)
                    $('.images').html(`<li class="col mb-3"><img src="${response.icon}"/></li>`)
                }
            })
        })

        $('.delete').click(function(){
            $('.idc').val($(this).val())
        })

        function previewFile() {
            var file   = document.querySelector('#img').files[0];
            var reader  = new FileReader();
            reader.addEventListener("load", function () {
                $('.images').html(`<li class="col mb-3"><img src="${reader.result}"/></li>`)
            }, false)
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        $("#img").change(function(){
            previewFile()
        })

        $('#catname').keyup(function(){
            if($(this).val().length < 3){
              $('.editcat').attr('disabled','true')
            }else{
              $('.editcat').removeAttr('disabled')
            }
        })

        $('.editcat').click(function(){
            $('#update').submit()
        })

        $('.supprimer').click(function(){
            $('#supprimer').submit()
        })
        
    })
  </script>
@endsection