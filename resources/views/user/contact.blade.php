@extends('layouts.master')
@section('title')
Nous contacter | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')
<div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="top-text header-text">
            <h6>RESTEZ EN CONTACT AVEC NOUS</h6>
            <h2>N'hésitez pas à nous envoyer un message sur les besoins de votre entreprise</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-lg-6">
                <div id="map">
                     <iframe src="{{\App\Http\Controllers\HomeController::title()->map}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
              </div>
              <div class="col-lg-6 align-self-center">
                <form id="contact" action="{{Route('send')}}" method="post">
                    @csrf
                  @if(Session::has('fail'))
                    <div class="alert alert-danger" role="alert">{{Session::get('fail')}}</div>
                  @elseif(Session::has('success'))
                    <div class="alert alert-info" role="alert">{{Session::get('success')}}</div>
                  @endif
                  <div class="row">
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="text" name="fname" id="fname" placeholder="Prénom" autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="text" name="sname" id="sname" placeholder="Nom" autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <input type="text" name="subject" id="subject" placeholder="Sujet" autocomplete="on" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Email" required="">
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>  
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="form-submit" class="main-button "><i class="fa fa-paper-plane"></i>Envoyer un message</button>
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#contact").addClass('active')
})
</script>
@endsection