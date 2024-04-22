@extends('layouts.master')
@section('title')
{{$dataA->titre}} | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')
@include('design')
<!--2 ajax-->
<style>
    #wwidth{
        width: 100%;
    }

    #newb{
        background:url('assets/images/create.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: unset;
    }

    .form-group .fa{
        font-size:24px;
        border:3px solid #8d99af;
        padding: 30px;
        cursor:pointer;   
        color:#8d99af;
        border-radius:10px;
    }

    .image{
        display:none;
        visibility:none;
    }

    .row-cols-auto > *{
        width:90px;
    }

    .input{
        border-radius:5px;
        max-height:142px;
    }
    
    .input:disabled{
        cursor:no-drop;
    }
    .images li{
        position:relative;
    }

    .images li::before{
        content: '\f00d';
        font-family: FontAwesome;
        display: grid;
        place-items: center;
        font-size: 10px;
        color: #262135;
        width: 17px;
        height: 17px;
        left: 3px;
        top: -8px;
        background: #dddddde0;
        position: absolute;
        border-radius: 50%;
        cursor:pointer;
    }

</style>





<div class="container main">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10" id="wwidth">
            <div class="wrap d-md-flex">
                <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last" id="newb">
                    <div class="text w-100">
                        <h2>Bienvenue sur Annonce Maroc</h2>
                    </div>
                </div>
                <div class="login-wrap p-4 p-lg-5" id="app">
                <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4 htitle"></h3>
                        </div>
                    </div>

                        <div v-show="step1">
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Categorie :</label>
                            <select name="souscat" class="input souscat">
                                <option value="0" disabled >Choisir une catégorie</option>
                                @foreach($cat as $item)
                                   <option value="{{$item->id}}" class="ccat" disabled>{{$item->name}}</option>
                                   @foreach($item->souscats as $it)
                                       <option value="{{$it->id}}">{{$it->name}}</option>
                                   @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="">Type transaction :</label>
                            <select name="type" class="input type">
                                <option value="2" disabled>Type de transaction</option>
                                <option value="0">Demande</option>
                                <option value="1">Vente</option>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label class="label" for="">Ville :</label>
                            <select name="ville" class="input ville">
                                <option value="0" disabled>Choisir une ville</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                             <button class="submitbtn next" @click="change(2)">Suivant</button>
                        </div> 
                        <div class="form-group mb-3">
                            <button class="submitbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Supprimer</button>
                        </div>  
                        </div>

                        <div v-show="step2">
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Titre de l'annonce :</label>
                            <input type="text" name="titre" value="{{$dataA->titre}}" class="input titre">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="sname">Prix de l'annonce :(en dhs)</label>
                            <input type="text" name="prix" value="{{$dataA->prix}}" class="input prix">
                        </div>
                        <div class="form-group mb-4">
                            <label class="label" for="name">Texte de l'annonce : (au moins 20 lettres)</label>
                            <textarea name="description" value="{{$dataA->description}}" class="input description"></textarea>
                        </div>  
                        <div class="form-group mb-3">
                            <button class="submitbtn next" @click="change(1)">précédent</button>
                        </div>   
                        <div class="form-group mb-3">
                            <button class="submitbtn next" @click="change(3)">Suivant</button>
                        </div> 
                        </div>

                        <div v-show="step3">
                            
                        <div class="form-group mb-3">
                            <label for="image"><i class="fa fa-plus"></i></label>
                            <input type="file" id="image" name="" class="image" value="" accept="image/*" pattern="/image/*/">
                        </div>  
                        <div class="col-lg-10 offset-lg-1 container mb-4">
                            <ul class="categories row row-cols-auto images">
                                @if(count($dataA->images) > 0)
                                   @foreach($dataA->images as $img)
                                   <li class="col mb-3 animage" id="{{$img->id}}">
                                       <img src="{{$img->path}}" alt="">
                                   </li>
                                   @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="form-group mb-3">
                            <button class="submitbtn next" @click="change(2)">précédent</button>
                        </div>    
                        <div class="form-group mb-3">
                            <button class="submitbtn next" @click="change(4)">Suivant</button>
                        </div> 
                        </div>

                        <div v-show="step4">
                        @auth 
                        
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Prénom :</label>
                            <input type="text" name="fname" value="{{Auth::user()->fname}}" class="input fname" disabled>
                        </div>  
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Nom :</label>
                            <input type="text" name="sname" value="{{Auth::user()->sname}}" class="input sname" disabled>
                        </div>  
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Email :</label>
                            <input type="text" name="email" value="{{Auth::user()->email}}" class="input email" disabled>
                        </div>  
                            <input type="password" name="password" class="input password" hidden value="12345678">
                        @else
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Prénom :</label>
                            <input type="text" name="fname" class="input fname">
                        </div>  
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Nom :</label>
                            <input type="text" name="sname" class="input sname">
                        </div>  
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Email :</label>
                            <input type="text" name="email" class="input email">
                        </div> 
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Mot de passe :</label>
                            <input type="password" name="password" class="input password">
                        </div>  
                        @endauth  
                        <div class="form-group mb-4">
                            <label class="label" for="fname">Téléphone :</label>
                            <input type="text" value="{{$dataA->phone ?? ''}}" name="phone" class="input phone">
                        </div>
                        <div class="form-group mb-4">
                            <label class="label" for="fname">Adresse :</label>
                            <textarea name="adresse" value="{{$dataA->adresse ?? ''}}" class="input adress"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button class="submitbtn next" @click="change(3)">précédent</button>
                        </div>   
                        <div class="form-group mb-3">
                            <button class="submitbtn send">Modifier</button>
                        </div> 
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Supprimer une annonce</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="{{route('signaler')}}" class="sig" method="post">
            @csrf
            <div class="form-floating">
                <p>Êtes-vous sûr de vouloir supprimer ce message ?</p>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
        <a href="/delete/{{$dataA->id}}" type="button" class="btn btn-danger signaler">Supprimer</a>
      </div>
    </div>
  </div>
</div>
<!-------------------------------------------------------------------------->

<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("header").addClass("background-header");
    $(window).scroll(function() {
        var header = $('header').height();
        $("header").addClass("background-header");
    });

    $(document).ready(function(){
        var select = $('.ville');
        $.ajax({
            url:'/json/country.json',
            type:'GET',
            dataType:'JSON',
            success:function(response){
                response.data.forEach(element => {
                    if(element.country === 'Maroc'){
                        element.cities.forEach(e=>{
                            if(e.replace(/\s/g, '') == '{{$dataA->ville}}'){
                                select.append('<option selected value='+e.replace(/\s/g, '')+'>'+e+'</option>')
                            }
                            else{
                                select.append('<option value='+e.replace(/\s/g, '')+'>'+e+'</option>')
                            }
                        })
                    }
                });
            }
        })
    })

    ////////////////////////////////////////////
    $('.souscat option[value="{{$dataA->souscat_id}}"]').not('.ccat').prop('selected','true')
    $('.type option[value="{{$dataA->type}}"]').prop('selected','true')
    
    function previewFile() {
        var file   = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            $('.images').append(` <li class="col mb-3 animage" title="${count++}"><img src="${reader.result}"/></li>`)
        }, false);

     if (file) {
        reader.readAsDataURL(file);
     }
     
    }

   $('input[type=file]').change(previewFile)

    $('.send').click(function(){

        var fname = $('.fname')
            var sname = $('.sname')
            var email = $('.email')
            var password = $('.password')

            var reg = /^[a-zA-Z]{3,}$/
            if(reg.test(fname.val())){
                fname.css('border','none')
                if( reg.test(sname.val()) ){
                    sname.css('border','none')
                    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.val())){
                        email.css('border','none')
                        if(password.val().length >= 8){
                            password.css('border','none')

                            /*delimage.forEach(e => {
                                form.delete(e)
                            })*/

                            $.ajax({
                                header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url:"{{route('annonce.update')}}",
                                dataType:'JSON',
                                type:'POST',
                                data:{
                                    id:{{$dataA->id}},
                                    email:$('.email').val(),
                                    titre:$('.titre').val(),
                                    souscat:$('.souscat').val(),
                                    type:$('.type').val(),
                                    ville:$('.ville').val(),
                                    prix:$('.prix').val(),
                                    description:$('.description').val(),
                                    phone:$('.phone').val(),
                                    adress:$('.adress').val(),
                                    _token : $("meta[name='csrf-token']").attr('content') 
                                },
                                success:function(res){
                                    if(res.toString() == '1'){
                                         form.append('ids',JSON.stringify(delid))
                                         form.append('delimages',JSON.stringify(delimage))
                                         form.append('id', {{$dataA->id}})
                                         form.append('count', count)
                                         form.append('_token', $("meta[name='csrf-token']").attr('content') )
                                         $.ajax({
                                            header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                            url:"{{route('annonce.image')}}",
                                            dataType:'JSON',
                                            type:'POST',
                                            data:form,
                                            processData: false,
                                            contentType: false,
                                            success:function(res){
                                                if(res != null){
                                                    location.href = '/dashboard'
                                                }
                                            }
                                         })
                                    }else{
                                         alert("Quelque chose s'est mal passé !")
                                    }
                                }
                            })
                            
                        }else{
                            password.css('border','1px solid red')
                            alert('le mot de passe doit avoir au moins 8 lettres')
                        }
                    }else{
                        email.css('border','1px solid red')
                        alert('Entrer une adresse email valide !')
                    }
                }else{
                    sname.css('border','1px solid red')
                    alert('le nom doit comporter plus de 3 lettres !')
                }
            }else{
                fname.css('border','1px solid red')
                alert('le prénom doit comporter plus de 3 lettres !')
            }
        
    })

    var form = new FormData();
    var count = 0;
    var delid = []
    var delimage = []
//https://javascript.info/formdata

    $('.images').on('click','.animage',function(){
       // $(this).remove()
       if($(this).prop('id') != ''){
           delid.push($(this).prop('id'))
       }else{
           delimage.push($(this).prop('title'))
           form.delete($(this).prop('title'))
       }
       $(this).remove()
    })


    $("input[type='file']").change(function(){
        form.append(count.toString(), document.querySelector('input[type=file]').files[0]);
        document.querySelector('input[type=file]').value = null
    })

})
</script> 

<script>
$('.htitle').text('Information Générales')
    let app = Vue.createApp({
    data(){
        return{
            step1:true,
            step2:false,
            step3:false,
            step4:false,
        }
    },
    methods:{
        change(n){
            if(n == 1){

                    $('.htitle').text('Information Générales')
                    this.step1 = true
                    this.step2 = false
                    this.step3 = false
                    this.step4 = false
                
            }else if(n == 2){
                var cat = $('.souscat')
                var type = $('.type')
                var ville = $('.ville')
                if(cat.find(':selected').val() != 0){
                    cat.css('border','none')
                    if(type.find(':selected').val() != 2){
                        type.css('border','none')
                        if(ville.find(':selected').val() != 0){
                            ville.css('border','none')
                            $('.htitle').text('Description Du Bien')
                            this.step1 = false
                            this.step2 = true
                            this.step3 = false
                            this.step4 = false
                        }else{
                            ville.css('border','1px solid red')
                        }
                    }else{
                        type.css('border','1px solid red')
                    }
                }else{
                    cat.css('border','1px solid red')
                }
            }else if(n == 3){
                var titre = $('.titre')
                var prix = $('.prix')
                var description = $('.description')
                var reg = /^[0-9]+$/
                if(titre.val().length >= 3){
                    titre.css('border','none')
                    if(reg.test(prix.val())){
                        prix.css('border','none')
                        if(description.val().length >= 20){
                            description.css('border','none')
                            $('.htitle').text('Photos')
                            this.step1 = false
                            this.step2 = false
                            this.step3 = true
                            this.step4 = false
                        }else{
                            description.css('border','1px solid red')
                        }
                    }else{
                        prix.css('border','1px solid red')
                        alert('Le prix doit être un nombre !')
                    }
                }else{
                    titre.css('border','1px solid red')
                    alert('Titre doit avoir plus de 3 lettres !')
                }
            }else{
                $('.htitle').text('Vos Information')
                this.step1 = false
                this.step2 = false
                this.step3 = false
                this.step4 = true
            }
        }
    }
})
app.mount('#app')


</script>

@endsection