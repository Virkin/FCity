@extends('layouts.app')

@section('title', 'Reservation')

@section('content')

<div class="container" id="header-text">
  <form method="get" action="{{ route('reservation.edit', $ride->id) }}">
    @csrf
    <div class="form-group row">
      <div class="col">
        <label for="start">Start reservation (date) :</label>
        <input type="date" class="form-control" name="start_reservation_date" value="{{$datetime['start_reservation_date']}}" required/>
      </div>
      <div class="col">
        <label for="start">Start reservation (time) :</label>
        <input type="time" class="form-control" name="start_reservation_time" value="{{$datetime['start_reservation_time']}}" step="1" required/>
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <label for="start">End reservation (date) :</label>
        <input type="date" class="form-control" name="end_reservation_date" value="{{$datetime['end_reservation_date']}}" required/>
      </div>
      <div class="col">
        <label for="start">End reservation (time) :</label>
        <input type="time" class="form-control" name="end_reservation_time" value="{{$datetime['end_reservation_time']}}" step="1" required/>
      </div>
    </div>

    <input type="hidden" class="form-control" name="start_reservation" value="{{$datetime['start_reservation']}}"/>
    <input type="hidden" class="form-control" name="end_reservation" value="{{$datetime['end_reservation']}}"/>

    <button type="submit" class="btn btn-primary">Vérifier</button>
  </form>
  @if(isset($datetime) and isset($vehicle))
  <form method="post" action="{{ route('reservation.update', $ride->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
      <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}"/>
    </div>
    <div class="form-group">
      <label for="brand">Véhicule :</label>
      <select class="form-control" name="vehicle_id">
        @foreach($vehicle as $v)
          <option value="{{ $v->id }}">{{ $v->brand }} {{ $v->model }} ({{ $v->type }})</option>
        @endforeach
      </select>
    </div>
   
      <input type="hidden" class="form-control" name="start_reservation" value="{{$datetime['start_reservation']}}"/>
      <input type="hidden" class="form-control" name="end_reservation" value="{{$datetime['end_reservation']}}"/>
  
      <input type="hidden" class="form-control" name="start_date"/>
      <input type="hidden" class="form-control" name="end_date"/>
    
    <button type="submit" class="btn btn-primary">Réserver</button>
  </form>
  @elseif(isset($datetime))
  <div class="alert alert-danger text-center" role="alert">
    Veuillez choisir un autre créneau, aucune voiture n'est diponible !
  </div>
  @endif
</div>

@endsection