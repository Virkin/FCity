@extends('layouts.app')

@section('content')
<div class="container" id="header-text">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vérifiez votre adresse email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </div>
                    @endif

                    Avant de continuer, veuillez vérifier votre courrier électronique pour un lien de vérification.
                    Si vous n'avez pas reçu l'email, <a href="{{ route('verification.resend') }}">cliquez ici pour demander un autre</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
