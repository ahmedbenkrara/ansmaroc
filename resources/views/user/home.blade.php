@extends('layouts.master')
@section('title')
Page d'accueil | {{\App\Http\Controllers\HomeController::title()->title}}
@endsection

@section('content')

<div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="top-text header-text">
            <h6>Votre meilleur site d'annonces</h6>
            <h2>Trouver des lieux et des objets à proximité</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <form id="search-form" name="gs" method="get" role="search" action="">
            <div class="row">
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <input type="text" name="titre" class="searchText titre" placeholder="Que recherchez-vous?">
                  </fieldset>
              </div>
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <select name="ville" class="form-select ville" aria-label="Area" id="chooseCategory">
                          <option selected disabled>Sélectionnez une ville</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-lg-3 align-self-center">
                  <fieldset>
                      <select name="price" class="form-select price" aria-label="Default select example" id="chooseCategory">
                          <option selected disabled>Échelle de prix</option>
                          <option value="1-100">moins que 100dhs</option>
                          <option value="250-500">100dhs - 500dhs</option>
                          <option value="500-1000">500dhs - 1000dhs</option>
                          <option value="1000">1000dhs ou plus</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-lg-3">                        
                  <fieldset>
                      <button class="main-button send" ><i class="fa fa-search"></i>Rechercher</button>
                  </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-10 offset-lg-1 container">
          <ul class="categories row row-cols-auto">
            <li class="col"><a href="{{url('/search/category/0')}}"><span class="icon"><img src="/images/categories/all.png" alt=""></span> toutes catégories</a></li>
            @foreach($dataC as $item)
                <li class="col" title="{{$item->name}}"><a href="{{url('/search/category/'.$item->id)}}"><span class="icon"><img src="{{$item->icon}}" alt=""></span>{{$item->name}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>


  <div class="popular-categories">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Catégories populaires</h2>
            <h6>Découvrez-les maintenant</h6>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="naccs">
            <div class="grid">
              <div class="row">
                <div class="col-lg-3">
                  <div class="menu">
                    <div class="first-thumb active">
                      <div title="Informatique et multimedia" class="thumb">
                        <span class="icon"><img src="/images/categories/informatique.png" alt=""></span>
                        Informatique et multimedia
                      </div>
                    </div>
                    <div>
                      <div title="vehicules" class="thumb">                 
                        <span class="icon"><img src="/images/categories/vehicule.png" alt=""></span>
                        Vehicules 
                      </div>
                    </div>
                    <div>
                      <div title="Immobilier" class="thumb">                 
                        <span class="icon"><img src="/images/categories/immobilier.png" alt=""></span>
                        Immobilier
                      </div>
                    </div>
                    <div>
                      <div title="habillement et bien etre" class="thumb">                 
                        <span class="icon"><img src="/images/categories/clothes.png" alt=""></span>
                        Habillement 
                      </div>
                    </div>
                    <div class="last-thumb">
                      <div title="Emploi et services" class="thumb">                 
                        <span class="icon"><img src="/images/categories/job.png" alt=""></span>
                        Emploi
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="col-lg-9 align-self-center">
                  <ul class="nacc">
                    <li class="active">
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Informatique et Multimedia</h4>
                                <p>-Téléphone<br>-Image et son<br>-Ordinateur portable<br>-Jeux vidéo et consoles<br>-Ordinateurs de bureau<br>-Accessoires informatique et gadgets<br>-Appareils photo et caméras<br>-Tablettes<br>-Télévisions</p>
                                <div class="main-white-button"><a href="{{url('/search/category/1')}}"><i class="fa fa-eye"></i>Découvrir plus</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="{{url('assets/images/tabs-image-01.jpg')}}" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Vehicules </h4>
                                <p>-Voitures<br>-Motos-pieces et accessoires pour véhicules<br>-Bateaux<br>-Vélos<br>-Véhicules professionnels</p>
                                <div class="main-white-button"><a href="{{url('/search/category/2')}}"><i class="fa fa-eye"></i>Découvrir plus</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="{{url('assets/images/tabs-image-02.jpg')}}" alt="Foods on the table">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Immobilier</h4>
                                <p>-Appartements<br>-Maisons et villas<br>-Locations de vacances<br>-Bureaux et plateaux<br>-Magasins, commerces et locaux industriels<br>-Terrains et fermes<br>-Colocations<br>-Autre Immobilier</p>
                                <div class="main-white-button"><a href="{{url('/search/category/3')}}"><i class="fa fa-eye"></i>Découvrir plus</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="{{url('assets/images/tabs-image-03.jpg')}}" alt="cars in the city">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Habillement et bien etre</h4>
                                <p>-Vetements pour enfant et bebe-Vetements<br>-Sacs et accessoirs<br>-Produits de beauté<br>-Equipements pour enfant et bebe<br>-Chaussures<br>-Montres et bijoux</p>
                                <div class="main-white-button"><a href="{{url('/search/category/5')}}"><i class="fa fa-eye"></i>Découvrir plus</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="{{url('assets/images/tabs-image-04.jpg')}}" alt="Shopping Girl">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="thumb">
                          <div class="row">
                            <div class="col-lg-5 align-self-center">
                              <div class="left-text">
                                <h4>Emploi et services</h4>
                                <p>-Offres d"emploi<br>-Demandes d'emploi<br>-Services<br>-Cours et formations<br>-Centre d'appeles<br>-Femmes de ménages,nounous et chauffeurs<br>-Travaux de maison<br>-Cadres<br>-Offres de stage<br>-Métiers it</p>
                                <div class="main-white-button"><a rel="nofollow" href="{{url('/search/category/7')}}"><i class="fa fa-eye"></i>Découvrir plus</a></div>
                              </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                              <div class="right-image">
                                <img src="{{url('assets/images/tabs-image-05.jpg')}}" alt="Traveling Beach">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>          
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@if(count($suggest) > 0)
  <div class="recent-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Annonces Récentes</h2>
            <h6>Vérifie-les Maintenant</h6>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-carousel owl-listing">
          @foreach($suggest as $item)
            <div class="item">
              <div class="row">

                <!----start---->
                <div class="col-lg-12">

                  <div class="listing-item">
                    <div class="left-image">
                      @if(count($item->images) > 0)
                        <img src="{{url($item->images[0]->path)}}" alt="">
                      @else
                        <img src="{{url('/images/posts/default.jpeg')}}" alt="">
                      @endif
                      
                    </div>
                    <div class="right-content align-self-center">
                      <h4>{{Str::limit($item->titre,20)}}</h4>
                      <h6>par: {{$item->user->fname}} {{$item->user->sname}}</h6>
                      <span class="price"><div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>{{$item->prix}} dhs</span>
                      <span class="details">Date d'annonce: <em>{{explode(' ',$item->created_at)[0]}}</em></span>
                      <ul class="info">
                          <li></li>
                        <li><img src="images/categories/all.png" alt="">{{Str::limit($item->souscat->name,10)}}</li>
                      </ul>
                      <div class="main-white-button">
                        <a href="{{url('/details/'.$item->ville.'/'.Str::slug($item->titre).'/'.$item->id)}}"><i class="fa fa-eye"></i>Voir les détails</a>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!----end---->

              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endif

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="/js/countrydata.js"></script>
  <script>
    $(document).ready(function(){
      $("#home").addClass('active')

      $('.send').click(function(e){
        e.preventDefault()
        //titre ville prix cat
        var par = '/search'
        if($('.titre').val().length > 0){
          par = par+'/titre/'+$('.titre').val()
        }else{
          par = par+'/titre/%20'
        }

        if($('.ville').val() != null){
          par = par+'/ville/'+$('.ville').val()
        }else{
          par = par+'/ville/%20'
        }

        if($('.price').val() != null){
          par = par+'/price/'+$('.price').val()
        }else{
          par = par+'/price/%20'
        }

        par = par+'/cat/%20'
        
        location.href = par;
      })
    })
  </script>
@endsection