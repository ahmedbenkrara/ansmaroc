@extends('layouts.master')
@section('title')
{{\App\Http\Controllers\HomeController::title()->title}}
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

</style>
<div class="container main">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10" id="wwidth">
            <div class="wrap d-md-flex">
                <div class="login-wrap p-4 p-lg-5">

                    <form method="POST" action="{{ route('verification.send') }}" class="signin-form">
                        @csrf
                        <p class="mb-3">
                        Merci pour votre inscription! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous nous ferons un plaisir de vous en envoyer un autre.
                        </p>
                            <button type="submit" id="btn-dark">Renvoyer</button>
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