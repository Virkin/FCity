@extends('layouts.app')

@section('content')

<div class="ui raised very padded text container segment">
  <h2 class="ui header">FCity 2</h2>
  <p>Ceci est la page d'accueil de projet FCity 2 qui consiste à la collecte et le traitement de données provenant d'une voiture électrique. Ce projet a été réalisé dans le cadre du projet M1.</p>
  <div class="ui container">
    <img class="ui centered medium rounded image" src="/img/fcity.jpg">
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
</div> -->
@endsection
