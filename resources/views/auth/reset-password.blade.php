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

    #email{
        border-radius:5px;
    }

</style>
<div class="container main">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10" id="wwidth">
            <div class="wrap d-md-flex">
                <div class="login-wrap p-4 p-lg-5">

                    <form method="POST" action="{{ route('password.update') }}" class="signin-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="mb-3">
                            @foreach($errors->all() as $message)
                               <p class="text-danger">{{$message}}</p>
                            @endforeach
                        </div>

                        <div class="form-group mb-3">
                            <label class="label" for="name">Email</label>
                            <input type="text" name="email" id="email" value="{{$request->email}}"  class="input" required>
                        </div>
                                                <div class="form-group mb-3">
                            <label class="label" for="name">Nouveau mot de passe :</label>
                            <input type="password" name="password" id="email" class="input" required>
                        </div>
                                                <div class="form-group mb-3">
                            <label class="label" for="name">Confirmer le mot de passe :</label>
                            <input type="password" id="email" name="password_confirmation" class="input" required>
                        </div>
                        <button type="submit" id="btn-dark">Réinitialisation de mot de passe</button>
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