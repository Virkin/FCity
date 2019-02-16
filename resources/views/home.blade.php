@extends('layouts.app')

@section('content')

<header>
  <div class="ui very padded segment fluid" id="header-img">
    <div class="ui container" id="header-text">
      <h1 class="ui header centered">Réservez gratuitement votre voiture électrique dès maintenant</h2>
      <p class="text-center">L'ISEN Brest met à disposition des enseignants un véhicule 100% électrique connecté pour effectuer des trajets au alentour de Brest.</p>
      <div class="text-center">
        <button type="button" class="btn btn-lg btn-primary">Réservez maintenant</button>
      </div>
    </div>
  </div>
</header>
<div class="ui container">
  <div class="row">
    <div class="col-md-6">
      <h2>Conduire gratuitement un véhicule électrique connecté</h2>
      <p>Le véhicule FCity est constitué de nombreux capteurs (vitesse, accélération, tension des batteries, luminosité...) afin d'améliorer votre conduite, garantir votre sécurité et réduire votre consommation électrique.</p>
      </div>
    <div class="col-md-6">
      <img class="ui centered medium rounded image" src="/img/fcity.jpg">
    </div>
  </div>
</div>
<div class="ui container">
  <div class="row">
    <div class="col-md-6">
      <h2>Analyser votre conduite en temps réel</h2>
      <p>Les données recueillies par le véhicule sont transmises vers le serveur de l'ISEN Brest afin que puissiez les analyser et les comparer.</p>
      </div>
    <div class="col-md-6">
      <img class="ui centered medium rounded image" src="/img/fcity.jpg">
    </div>
  </div>
</div>
<div class="ui container">
  <div class="row">
    <div class="col-md-6">
      <h2>Participer au classement des meilleurs conducteurs</h2>
      <p>L'ISEN Brest propose aux enseignants un classement des conducteurs les plus économe en énergie.</p>
      </div>
    <div class="col-md-6">
      <img class="ui centered medium rounded image" src="/img/fcity.jpg">
    </div>
  </div>
</div>
<div class="ui container">

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
