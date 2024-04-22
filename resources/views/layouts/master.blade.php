
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{\App\Http\Controllers\HomeController::title()->description}}">
    <meta name="author" content="{{\App\Http\Controllers\HomeController::title()->author}}">
    <meta name="keywords" content="{{\App\Http\Controllers\HomeController::category()}},{{\App\Http\Controllers\HomeController::title()->keywords}}">
    <meta name="category" content="{{\App\Http\Controllers\HomeController::category()}}">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <base href="/public">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{url('assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/templatemo-plot-listing.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/animated.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/owl.css')}}">
    <link rel="shortcut icon" href="{{url('assets/images/black-logo.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/vue@next"></script>
    <style>
      .width1{
        width:max-content;
      }

      .chide .dropdown-item{
        cursor:pointer;
        color:#8d99af;
      }

      .chide .dropdown-item:active{
        background:#8d99af30;
      }
      
      /*body::-webkit-scrollbar-track {
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      }*/
       
      body::-webkit-scrollbar-thumb {
        background-color: #8d99af;
      }

      body::-webkit-scrollbar {
        width: 3px;
      }
 
    </style>

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="{{route('home')}}" class="logo">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="{{route('home')}}" id="home">Accueil</a></li>
              <li><a href="{{route('search')}}" id="search">Rechercher</a></li>
              <li><a href="{{route('contact')}}" id="contact">contact</a></li> 
              @if(Auth::check() && Auth::user()->hasRole('admin'))
              <li><a href="/demande" class="chide" id="demande">Les demandes</a></li> 
              @endif
              @if (Route::has('login'))
                @auth 
                <li class="chide">
                   <a class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->fname}}</a>
                   <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                   @if(Auth::user()->hasRole('user'))
                   <li class="dropdown-item" onclick="location.href ='/dashboard'">Mes annonces</li>
                   <li class="dropdown-item" onclick="location.href = '/favorite'">Mes favoris</li>
                   <li class="dropdown-item" onclick="location.href = '/parametre'">Parametre</li>
                   <li><hr class="dropdown-divider"></li>
                   <li class="dropdown-item" type="submit" onclick="$('.out').submit()" id="lasti" >Se déconnecter</li>
                   @elseif(Auth::user()->hasRole('admin'))
                   <li class="dropdown-item" onclick="location.href ='/dashboard'">Les demandes</li>
                   <li class="dropdown-item" onclick="location.href ='/reports'">Les rapports</li>
                   <li class="dropdown-item" onclick="location.href ='/admin'">créer un administrateur</li>
                   <li class="dropdown-item" onclick="location.href ='/cats'">Les catégories</li>
                   <li class="dropdown-item" onclick="location.href ='/categories'">Les sous catégories</li>
                   <li class="dropdown-item" onclick="location.href ='/parametre'">Parametre</li>
                   <li class="dropdown-item" onclick="location.href ='/seo'">Parametre SEO</li>
                   <li><hr class="dropdown-divider"></li>
                   <li class="dropdown-item" type="submit" onclick="$('.out').submit()" id="lasti" >Se déconnecter</li>
                   @endif
                   </ul>
                </li>
                @auth
                @if(Auth::user()->hasRole('user'))
                <li class="cshow"><a href="{{url('/dashboard')}}" id="mesannonces">Mes annonces</a></li>
                <li class="cshow"><a href="{{url('/favorite')}}" id="mesfavoris">Mes favoris</a></li>
                <li class="cshow"><a href="{{url('/parametre')}}" id="Parametre">Parametre</a></li> 
                @elseif(Auth::user()->hasRole('admin'))
                <!-- if admin -->
                <li class="cshow"><a href="{{url('/dashboard')}}">Les demandes</a></li>
                <li class="cshow"><a href="{{url('/reports')}}">Les rapports</a></li>
                <li class="cshow"><a href="{{url('/admin')}}">créer un administrateur</a></li> 
                <li class="cshow"><a href="{{url('/cats')}}">Les catégories</a></li> 
                <li class="cshow"><a href="{{url('/categories')}}">Les sous catégories</a></li> 
                <li class="cshow"><a href="{{url('/parametre')}}" id="Parametre">Parametre</a></li>
                <li class="cshow"><a href="{{url('/seo')}}" id="seo">Parametre SEO</a></li>
                @endif
                <li class="cshow" onclick="$('.out').submit()"><a id="logout">Se déconnecter</a></li> 
                @endauth
                <form action="{{route('logout')}}" class="out" method="post">
                  @csrf
                </form>
                @else
                 <li><a href="{{route('login')}}" id="login">se connecter</a></li>
                @endauth
              @endif
              @if(Auth::check())
                  @if(Auth::user()->hasRole('user'))
                  <li id="resizedel" style="display:none;"><a href="{{route('announce.create')}}">poster</a></li> 
                  <li><div class="main-white-button"><a href="{{route('announce.create')}}"><i class="fa fa-plus"></i>déposer une annonce</a></div></li>      
                  @endif
              @else 
              <li id="resizedel" style="display:none;"><a href="{{route('announce.create')}}">poster</a></li> 
              <li><div class="main-white-button"><a href="{{route('announce.create')}}"><i class="fa fa-plus"></i>déposer une annonce</a></div></li> 
              @endif
            </ul>    
                
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  @yield('content')
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="about">
            <div class="logo">
              <img src="assets/images/black-logo.png" alt="Plot Listing">
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="helpful-links">
            <h4>Liens utiles</h4>
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <ul>
                  <li><a href="/">Categories</a></li>
                  <li><a href="{{url('/contact')}}">Contact</a></li>
                  <li><a href="{{url('/search')}}">Rechercher</a></li>
                  <li><a href="{{url('/annonces')}}">Annonce par ville</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><a href="{{\App\Http\Controllers\HomeController::title()->whatsapp}}">Whatsapp</a></li>
                  <li><a href="{{\App\Http\Controllers\HomeController::title()->facebook}}">Facebook</a></li>
                  <li><a href="{{\App\Http\Controllers\HomeController::title()->instagram}}">Instagram</a></li>
                  <li><a href="{{\App\Http\Controllers\HomeController::title()->twitter}}">Twitter</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="contact-us">
            <h4>Nous contacter</h4>
            <p>{{\App\Http\Controllers\HomeController::title()->address}}</p>
            <div class="row">
              <div class="col-lg-6">
                @if(!empty(\App\Http\Controllers\HomeController::title()->phone))
                <a href="{{\App\Http\Controllers\HomeController::title()->whatsapp}}">{{\App\Http\Controllers\HomeController::title()->phone}}</a>
                @endif
              </div>
              
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="sub-footer">
            <p>Copyright © {{now()->year}} <mark style="background:#8d99af; font-weight:bold; color:white;">{{\App\Http\Controllers\HomeController::title()->title}}</mark> All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <script src="{{url('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('assets/js/owl-carousel.js')}}"></script>
  <script src="{{url('assets/js/animation.js')}}"></script>
  <script src="{{url('assets/js/imagesloaded.js')}}"></script>
  <script src="{{url('assets/js/custom.js')}}"></script>
  <script>
    $(document).ready(function(){
      var deposer = $('#resizedel');
      var width = $(window).outerWidth();
      if(width <= 992){
          deposer.css('display','block')
          $('#lasti').css('display','block')
      }else{
          deposer.css('display','none')
      }

      if(width <= 767){
          $('.header-area .main-nav').removeClass('width1')
          $('.cshow').show()
          $('.chide').hide()
      }else{
          $('.header-area .main-nav').addClass('width1')
          $('.chide').show()
          $('.cshow').hide()
      }

      $(window).resize(function(){
        width = $(this).outerWidth();
        if(width <= 992){
          deposer.css('display','block')
          $('#lasti').css('display','block')
        }else{
          deposer.css('display','none')
        }

        if(width <= 767){
          $('.header-area .main-nav').removeClass('width1')
          $('.cshow').show()
          $('.chide').hide()
        }else{
          $('.header-area .main-nav').addClass('width1')
          $('.chide').show()
          $('.cshow').hide()
      }
      })

      $('.header-area .main-nav .nav li:last-child').css({'padding-left':'auto','padding-right':'auto'})

    })
///////////////////////////refresh
    window.addEventListener( "pageshow", function ( event ) {
      var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
      if ( historyTraversal ) {
        window.location.reload();
      }
    });
  </script>
</body>

</html>
