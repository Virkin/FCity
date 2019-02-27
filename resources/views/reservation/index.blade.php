@extends('layouts.app')

@section('content')

<div class="container" id="header-text">
  <a class="btn btn-lg btn-primary float-right" href="/reservation/create" role="button">Créez une nouvelle réservation</a>
  @if (count($ride) > 0)
  <table class="table table-striped table-bordered">
    <caption>Liste de vos réservations</caption>
    <thead>
      <tr>
        @foreach ($columns as $column => $name)
          <th scope="col">{{$name}}</th>
        @endforeach
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < count($ride); $i++)
      <tr>
        @foreach ($columns as $column => $name)
          <td>{{ $ride[$i]->$name }}</td>
        @endforeach
        <td><a href="/reservation">Modifier</a></td>
      </tr>
      @endfor
    </tbody>
  </table>
  @else
    <h1 class="text-center">Vous n'avez aucune réservation</h1>
  @endif
</div>

@endsection
