@extends('layouts.app')

@section('content')

<div class="container" id="header-text">
  <a class="btn btn-lg btn-primary float-right" href="/reservation/create" role="button">Créez une nouvelle réservation</a>
  @if (count($ride) > 0)
  <table class="table table-striped table-bordered">
    <caption>Liste des réservations</caption>
    <thead>
      <tr>
        @foreach ($columns as $column => $name)
          <th scope="col">{{$name}}</th>
        @endforeach
        <th>Détails</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($ride as $r)
      <tr>
        @foreach ($columns as $column => $name)
          <td>{{ $r->$name }}</td>
        @endforeach
        <td style="padding:0"><a class="btn btn-lg btn-outline-success btn-block" href="{{ route('reservation.show', $r->id) }}" role="button">Détails</a></td>
        @if ($user->id === $r->user_id and $r->start_date === null and $r->end_date === null and $r->start_reservation > date("Y-m-d H:i:s") and $r->end_reservation > date("Y-m-d H:i:s"))
          <td style="padding:0"><a class="btn btn-lg btn-outline-primary btn-block" href="{{ route('reservation.edit', $r->id) }}" role="button">Modifier</a></td>
          <td style="padding:0"><a class="btn btn-lg btn-outline-danger btn-block" data-toggle="modal" data-target="#confirmationSuppression{{ $r->id }}">Supprimer</a></td>
        @endif
        @if ($user->id === $r->user_id and $r->start_date === null and $r->end_date === null and $r->start_reservation < date("Y-m-d H:i:s") and $r->end_reservation < date("Y-m-d H:i:s"))
          <td></td>
          <td style="padding:0"><a class="btn btn-lg btn-outline-danger btn-block" data-toggle="modal" data-target="#confirmationSuppression{{ $r->id }}">Supprimer</a></td>
        @endif
        @if (($user->id != $r->user_id) or ($user->id === $r->user_id and $r->start_date != null or $r->end_date != null))
          <td></td>
          <td></td>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="confirmationSuppression{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationSuppressionLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmationSuppressionLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Voulez-vous supprimer la réservation n°{{ $r->id }} ?
              </div>
              <div class="modal-footer">
                <button class="btn btn-lg btn-danger btn-block" data-dismiss="modal">Annuler</button>
                <form action="{{ route('reservation.destroy', $r->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#confirmationSuppression{{ $r->id }}">Supprimer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
    <h1 class="text-center">Vous n'avez aucune réservation</h1>
  @endif
</div>

@endsection
