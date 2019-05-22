@extends('layouts.app')

@section('title', 'Reservation')

@section('content')

<div class="container" id="header-text">
	<a class="btn btn-lg btn-primary float-left" href="/reservation" role="button">Retour</a>
  <table class="table table-striped table-bordered table-responsive-lg">
    <caption>Réservation du trajet n°{{ $ride['0']->id }}</caption>
    <thead class="thead-dark">
      <tr>
        @foreach ($columns_name as $column => $name)
          <th scope="col">{{$name}}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach ($columns as $column => $name)
          <td>{{ $ride['0']->$name }}</td>
        @endforeach
      </tr>
    </tbody>
  </table>
</div>

@endsection