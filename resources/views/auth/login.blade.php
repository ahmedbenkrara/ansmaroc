@extends('layouts.master')
@section('title')
Se connecter | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')

@include('design')

<div class="container main">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
                <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                    <div class="text w-100">
                        <h2>Bienvenue pour vous connecter</h2>
                        <p class="mb-3">Vous n'avez pas de compte ?</p>
                        <a href="{{route('register')}}" id="signup">S'inscrire</a>
                    </div>
                </div>
                <div class="login-wrap p-4 p-lg-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4 htitle">S'identifier</h3>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="signin-form">
                        @csrf
                        <div class="mb-3">
                            @foreach($errors->all() as $message)
                               <p class="text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" class="input" required="">
                        </div>
                        <div class="form-group mb-5">
                            <label class="label" for="password">Mot de passe</label>
                            <input type="password" name="password" class="input" required="">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="submitbtn">Se connecter</button>
                        </div>
                        <div class="form-group fflex">
                            <div class="mt-3">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember" class="checkbox-wrap checkbox-primary mb-0">Enregistrer</label>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#login").addClass('active')
    $("header").addClass("background-header");
    $(window).scroll(function() {
        var header = $('header').height();
        $("header").addClass("background-header");
        
    });
})
</script>
@endsection