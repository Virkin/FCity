@extends('layouts.app')

@section('content')

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  
  <main role="main">

  <section class="jumbotron text-center" id="header-img">
    <div class="container" id="header-text">
      <h1 class="jumbotron-heading">Réservez gratuitement votre voiture électrique dès maintenant</h1>
      <p class="lead text-muted">L'ISEN Brest met à disposition des enseignants un véhicule 100% électrique connecté pour effectuer des trajets au alentour de Brest.</p>
      <p>
        @guest
          <a class="btn btn-lg btn-primary" href="{{ route('login') }}" role="button">Réservez maintenant</a>
        @else
          <a class="btn btn-lg btn-primary" href="/reservation" role="button">Réservez maintenant</a>
        @endguest
      </p>
    </div>
  </section>

  <div class="container">
    <div class="row">
  
      <div class="col-md-12 text-center mt-5 mb-5">
        <h2>Conduire gratuitement un véhicule électrique connecté</h2>
        <p>Le véhicule FCity est constitué de nombreux capteurs (vitesse, accélération, tension des batteries, luminosité...) afin d'améliorer votre conduite, garantir votre sécurité et réduire votre consommation électrique.</p>
        <img class="img-fluid" src="img/gps.png">
        <br>
        <br>
        <a class="btn btn-lg btn-primary" href="register" role="button">Créez votre compte maintenant</a>
      </div>

      <div class="col-md-12 text-center mt-5 mb-5">
        <h2>Analyser votre conduite en temps réel</h2>
        <p>Les données recueillies par le véhicule sont transmises vers le serveur de l'ISEN Brest afin que puissiez les analyser et les comparer.</p>
        <img class="img-fluid" src="img/graph.png">
        <br>
        <br>
        <a class="btn btn-lg btn-primary" href="graph" role="button">Visualisez vos données maintenant</a>
      </div>

      <div class="col-md-12 text-center mt-5 mb-5">
        <h2>Participer au classement des meilleurs conducteurs</h2>
        <p>L'ISEN Brest propose aux enseignants un classement des conducteurs les plus économe en énergie.</p>
        <img class="img-fluid" src="img/ranking.png">
        <br>
        <br>
        <a class="btn btn-lg btn-primary" href="ranking" role="button">Consultez le classement maintenant</a>
      </div>

      <div class="col-md-12 text-center mt-5 mb-5">
        <h2>Vidéo de démonstration du projet F-City</h2>
        <p>Vidéo réalisé fin mai 2019 avec les deux équipes du projet F-City et notre référent M. Le Gall</p>
        <video controls width="100%">
          <source src="video/demo v3 1080p.mp4" type="video/mp4">
          Votre navigateur ne peut pas lire la vidéo
        </video>
      </div>

    </div>
  </div>

  </main>

<!-- <header>
  <div class="ui very padded segment fluid" id="header-img">
    <div class="ui container" id="header-text">
      <h1 class="ui header centered">Réservez gratuitement votre voiture électrique dès maintenant</h2>
      <p class="text-center">L'ISEN Brest met à disposition des enseignants un véhicule 100% électrique connecté pour effectuer des trajets au alentour de Brest.</p>
      <div class="text-center">
        @guest
          <a class="btn btn-lg btn-primary" href="{{ route('login') }}" role="button">Réservez maintenant</a>
        @else
          <a class="btn btn-lg btn-primary" href="/reservation" role="button">Réservez maintenant</a>
        @endguest
      </div>
    </div>
  </div>
</header>
<div class="ui container custom-container">
  <div class="row">
    <div class="col-md-6">
      <h2>Conduire gratuitement un véhicule électrique connecté</h2>
      <p>Le véhicule FCity est constitué de nombreux capteurs (vitesse, accélération, tension des batteries, luminosité...) afin d'améliorer votre conduite, garantir votre sécurité et réduire votre consommation électrique.</p>
      <a class="btn btn-lg btn-primary" href="register" role="button">Créez votre compte maintenant</a>
    </div>
    <div class="col-md-6">
      <img class="ui centered medium rounded image" src="/img/fcity.jpg">
    </div>
  </div>
</div>
<div class="ui container custom-container">
  <div class="row">
    <div class="col-md-6">
      <img class="ui centered medium rounded image" src="/img/fcity.jpg">
    </div>
    <div class="col-md-6">
      <h2>Analyser votre conduite en temps réel</h2>
      <p>Les données recueillies par le véhicule sont transmises vers le serveur de l'ISEN Brest afin que puissiez les analyser et les comparer.</p>
      <a class="btn btn-lg btn-primary" href="graph" role="button">Visualisez vos données maintenant</a>
    </div>
  </div>
</div>
<div class="ui container custom-container">
  <div class="row">
    <div class="col-md-6">
      <h2>Participer au classement des meilleurs conducteurs</h2>
      <p>L'ISEN Brest propose aux enseignants un classement des conducteurs les plus économe en énergie.</p>
      <a class="btn btn-lg btn-primary" href="#" role="button">Consultez le classement maintenant</a>
    </div>
    <div class="col-md-6">
      <img class="ui centered medium rounded image" src="/img/fcity.jpg">
    </div>
  </div>
</div>
-->
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
