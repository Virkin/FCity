@extends('layouts.app')

@section('content')

<div class="container" id="header-text">
  @if (count($ride) > 0)
  <table class="table table-striped table-bordered">
    <caption>Liste de vos réservations</caption>
    <thead>
      <tr>
        @foreach ($columns as $column => $name)
          <th scope="col">{{$name}}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < count($ride); $i++)
      <tr>
        @foreach ($columns as $column => $name)
          <td>{{ $ride[$i][$name] }}</td>
        @endforeach
      </tr>
      @endfor
    </tbody>
  </table>
  @else
    <h1 class="text-center">Vous n'avez aucune réservation</h1>
  @endif
</div>

@endsection
