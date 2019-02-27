@extends('layouts.app')

@section('title', 'Reservation')

@section('content')

<div class="container" id="header-text">
  <form method="post" action="{{ route('reservation.store') }}">
    @csrf
    <div class="form-group">
      <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}"/>
    </div>
    <div class="form-group">
      <label for="brand">Véhicule :</label>
      <select class="form-control" name="vehicle_id">
        @foreach($ride as $r)
          <option value="{{ $r->id }}">{{ $r->brand }} {{ $r->model }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="start">Start reservation (YYYY-MM-DD HH:MM:SS) :</label>
      <input type="text" class="form-control" name="start_reservation" value="{{ date('Y-m-d H:i:s') }}"/>
    </div>
    <div class="form-group">
      <label for="end">End reservation (YYYY-MM-DD HH:MM:SS) :</label>
      <input type="text" class="form-control" name="end_reservation" value="{{ date('Y-m-d H:i:s', strtotime('+1 days')) }}"/>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="start_date" value="{{ date('Y-m-d H:i:s') }}"/>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" name="end_date" value="{{ date('Y-m-d H:i:s', strtotime('+1 days')) }}"/>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
  </form>
</div>

@endsection