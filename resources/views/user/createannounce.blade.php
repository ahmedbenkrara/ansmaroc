@extends('layouts.master')
@section('title')
Créer une annonce | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')
@include('design')

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
                                <option value="0" disabled selected>Choisir une catégorie</option>
                                @foreach($cat as $item)
                                   <option value="{{$item->id}}" disabled>{{$item->name}}</option>
                                   @foreach($item->souscats as $it)
                                       <option value="{{$it->id}}">{{$it->name}}</option>
                                   @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="">Type transaction :</label>
                            <select name="type" class="input type">
                                <option value="2" disabled selected>Type de transaction</option>
                                <option value="0">Demande</option>
                                <option value="1">Vente</option>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label class="label" for="">Ville :</label>
                            <select name="ville" class="input ville">
                                <option value="0" disabled selected>Choisir une ville</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                             <button class="submitbtn next" @click="change(2)">Suivant</button>
                        </div>  
                        </div>

                        <div v-show="step2">
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Titre de l'annonce :</label>
                            <input type="text" name="titre" class="input titre">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="sname">Prix de l'annonce :(en dhs)</label>
                            <input type="text" name="prix" value="0" class="input prix">
                        </div>
                        <div class="form-group mb-4">
                            <label class="label" for="name">Texte de l'annonce : (au moins 20 lettres)</label>
                            <textarea name="description" class="input description"></textarea>
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
                            <input type="text" name="phone" class="input phone">
                        </div>
                        <div class="form-group mb-4">
                            <label class="label" for="fname">Adresse :</label>
                            <textarea name="phone" value="" class="input adress"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button class="submitbtn next" @click="change(3)">précédent</button>
                        </div>   
                        <div class="form-group mb-3">
                            <button class="submitbtn send">Publier</button>
                        </div> 
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/countrydata.js"></script>
<script>
$(document).ready(function(){
    $("header").addClass("background-header");
    $(window).scroll(function() {
        var header = $('header').height();
        $("header").addClass("background-header");
    });

    function previewFile() {
        var file   = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            $('.images').append(` <li class="col mb-3"><img src="${reader.result}"/></li>`)
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
                            $.ajax({
                                 header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                 url:"{{route('announce.register')}}",
                                 dataType:'JSON',
                                 type:'POST',
                                 data:{
                                     fname:$('.fname').val(),
                                     sname:$('.sname').val(),
                                     email:$('.email').val(),
                                     password:$('.password').val(),
                                     _token : $("meta[name='csrf-token']").attr('content') 
                                    },
                                    success:function(response){
                                        if(response.toString() == '1'){
                                            $.ajax({
                                                header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                url:"{{route('announce.send')}}",
                                                dataType:'JSON',
                                                type:'POST',
                                                data:{
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
                                                     if(res.toString() != '0' && res.toString() != '-1'){
                                                         form.append('count', count)
                                                         form.append('id',res)
                                                         form.append('_token', $("meta[name='csrf-token']").attr('content'))
                                                         $.ajax({
                                                            header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                            url:"{{route('img')}}",
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
                                                         alert("Quelque chose s'est mal passé lors de la création de l'utilisateur !")
                                                        }
                                                    }
                                                })
                                            }else{
                                                alert('Cet email existe déjà avec un autre mot de passe !')
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
    $("input[type='file']").change(function(){
            form.append(count.toString(), document.querySelector('input[type=file]').files[0]);
            count++;
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