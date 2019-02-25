@extends('layouts.app')

@section('title', 'Graph')

@section('content')
	<div class="ui container" id="header-text">
		<iframe src="http://{{ $ip }}:3000/d-solo/DP6VyGPmk/fcity2?refresh=30s&orgId=1&var-capteur=vitesse&var-utilisateur=Antoine&var-trajet=All&panelId=2&theme=light" width="100%" height="300" frameborder="0"></iframe>
	</div>
	<div class="ui two column doubling stackable grid container">
		<div class="column">
			<iframe src="http://{{ $ip }}:3000/d-solo/DP6VyGPmk/fcity2?refresh=30s&orgId=1&var-capteur=vitesse&var-utilisateur=Antoine&var-trajet=All&panelId=6&theme=light" width="100%" height="100" frameborder="0"></iframe>
		</div>
		<div class="column">
			<iframe src="http://{{ $ip }}:3000/d-solo/DP6VyGPmk/fcity2?refresh=30s&orgId=1&var-capteur=vitesse&var-utilisateur=Antoine&var-trajet=All&panelId=7&theme=light" width="100%" height="100" frameborder="0"></iframe>
		</div>
	</div>

@endsection
