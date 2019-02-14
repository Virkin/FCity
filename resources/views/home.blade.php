@extends('layouts.app')

@section('content')

<div class="ui very padded segment fluid" style="background-image:url('/img/background-home.jpg'); background-size:cover; background-position: center center; height:100%;">
  <div class="ui container">
    <h2 class="ui header centered">Réservez votre voiture électrique dès maintenant</h2>
    <p class="text-center">L'ISEN Brest met à disposition des enseignants un véhicule 100% électrique pour effectuer des trajets au alentour de Brest. Ceci est la page d'accueil de projet FCity 2 qui consiste à la collecte et le traitement de données provenant d'une voiture électrique. Ce projet a été réalisé dans le cadre du projet M1.</p>
    <div class="text-center">
      <button type="button" class="btn btn-lg btn-primary">Réservez maintenant</button>
    </div>
  </div>
</div>


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
    <img class="ui centered medium rounded image" src="/img/fcity.jpg">
</div> -->
@endsection
