@extends('layouts.master')
@section('title')
Réinitialiser le mot de passe | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')
@include('design')
<style>
    #wwidth{
        width: 60%;
    }
    
    #btn-dark{
        color: #fff;
        background-color: #8d99af;
        border-color: #8d99af;
        border: none;
        outline: none;
        padding: 8px 14px;
        border-radius: 5px;
        font-size: 14px;
    }

    #email{
        border-radius:5px;
    }

</style>
<div class="container main">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10" id="wwidth">
            <div class="wrap d-md-flex">
                <div class="login-wrap p-4 p-lg-5">

                    <form method="POST" action="{{ route('password.email') }}" class="signin-form">
                        @csrf
                        <p class="mb-3">
                        Mot de passe oublié ? Aucun problème. Communiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
                        </p>
                        <div class="mb-3">
                            @foreach($errors->all() as $message)
                               <p class="text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            @if(session('status') == "We have emailed your password reset link!")
                               <p class="text-success">Nous avons envoyé votre lien de réinitialisation de mot de passe par e-mail !</p>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">Email</label>
                            <input type="text" name="email" id="email" value="{{old('email')}}" class="input" required>
                        </div>
                        <button type="submit" id="btn-dark">Lien de réinitialisation de mot de passe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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