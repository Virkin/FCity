@extends('layouts.app')

@section('title', 'Reservation')

@section('content')

<div class="container" id="header-text">
  <form method="post" action="{{ route('reservation.date') }}">
    @csrf
    <div class="form-group row">
      <div class="col">
        <label for="start">Start reservation (date) :</label>
        <input type="date" class="form-control" name="start_reservation_date" value="@if(isset($datetime)){{$datetime['start_reservation_date']}}@endif" required/>
      </div>
      <div class="col">
        <label for="start">Start reservation (time) :</label>
        <input type="time" class="form-control" name="start_reservation_time" value="@if(isset($datetime)){{$datetime['start_reservation_time']}}@endif" step="1" required/>
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <label for="start">End reservation (date) :</label>
        <input type="date" class="form-control" name="end_reservation_date" value="@if(isset($datetime)){{$datetime['end_reservation_date']}}@endif" required/>
      </div>
      <div class="col">
        <label for="start">End reservation (time) :</label>
        <input type="time" class="form-control" name="end_reservation_time" value="@if(isset($datetime)){{$datetime['end_reservation_time']}}@endif" step="1" required/>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Vérifier</button>
  </form>
  @if(isset($datetime) and isset($ride))
  <form method="post" action="{{ route('reservation.store') }}">
    @csrf
    <div class="form-group">
      <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}"/>
    </div>
    <div class="form-group">
      <label for="brand">Véhicule :</label>
      <select class="form-control" name="vehicle_id">
        @foreach($ride as $r)
          <option value="{{ $r->id }}">{{ $r->brand }} {{ $r->model }} ({{ $r->type }})</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="start_reservation" value="@if(isset($datetime)){{$datetime['start_reservation']}}@endif"/>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="end_reservation" value="@if(isset($datetime)){{$datetime['end_reservation']}}@endif"/>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="start_date"/>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="end_date"/>
    </div>
    <button type="submit" class="btn btn-primary">Réserver</button>
  </form>
  @elseif(isset($datetime))
  <div class="alert alert-danger text-center" role="alert">
    Veuillez choisir un autre créneau, aucune voiture n'est diponible !
  </div>
  @endif
</div>

@endsection