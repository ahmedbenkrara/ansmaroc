@extends('layouts.master')
@section('title')
Créer un administrateur | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')

@include('design')

<style>
    #wwidth{
        width: 90%;
    }

    #newbk{
        background:url('assets/images/admin.jfif');
        background-size:cover;
        background-repeat:no-repeat;
        background-position: unset;
    }
</style>

<div class="container main">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10" id="wwidth">
            <div class="wrap d-md-flex">
                <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last" id="newbk">

                </div>
                <div class="login-wrap p-4 p-lg-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4 htitle">S'inscrire</h3>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.store') }}" class="signin-form">
                        @csrf
                        <div class="mb-3">
                            @if(Session::has('status'))
                               <p class="text-info">{{Session::get('status')}}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            @foreach($errors->all() as $message)
                               <p class="text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="fname">Prénom</label>
                            <input type="text" name="fname" value="{{old('fname')}}" class="input" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="sname">Nom</label>
                            <input type="text" name="sname" value="{{old('sname')}}" class="input" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" class="input" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="password">Mot de passe</label>
                            <input type="password" name="password" class="input" required>
                        </div>
                        <div class="form-group mb-5">
                            <label class="label" for="password_confirmation">Confirmez le mot de passe</label>
                            <input type="password" name="password_confirmation" class="input" required>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="submitbtn">S'inscrire</button>
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