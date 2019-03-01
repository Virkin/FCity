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
        <th>Détails</th>
        <th>Modifier</th>
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < count($ride); $i++)
      <tr>
        @foreach ($columns as $column => $name)
          <td>{{ $ride[$i]->$name }}</td>
        @endforeach
        <td style="padding:0"><a class="btn btn-lg btn-outline-primary btn-block" href="/reservation/{{ $ride[$i]->id }}" role="button">Détails</a></td>
        <td style="padding:0"><a class="btn btn-lg btn-outline-primary btn-block" href="/reservation/{{ $ride[$i]->id }}/edit" role="button">Modifier</a></td>
      </tr>
      @endfor
    </tbody>
  </table>
  @else
    <h1 class="text-center">Vous n'avez aucune réservation</h1>
  @endif
</div>

@endsection
