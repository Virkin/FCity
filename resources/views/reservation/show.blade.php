@extends('layouts.app')

@section('title', 'Reservation')

@section('content')

<div class="container" id="header-text">
  <table class="table table-striped table-bordered">
    <caption>Réservation du trajet n°{{ $ride['0']->id }}</caption>
    <thead>
      <tr>
        @foreach ($columns as $column => $name)
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