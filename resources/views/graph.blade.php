@extends('layouts.app')

@section('title', 'Graph')

@section('content')
	<div class="ui container">
		<iframe src="http://127.0.0.1:3000/d-solo/DP6VyGPmk/fcity2?refresh=10s&orgId=1&var-capteur=intensite&panelId=2&theme=light" width="100%" height="300" frameborder="0"></iframe>
	</div>
	<div class="ui two column doubling stackable grid container">
		<div class="column">
			<iframe src="http://localhost:3000/d-solo/DP6VyGPmk/fcity2?refresh=10s&orgId=1&panelId=6&var-capteur=intensite&theme=light" width="450" height="200" frameborder="0"></iframe>
		</div>
		<div class="column">
			<iframe src="http://localhost:3000/d-solo/DP6VyGPmk/fcity2?refresh=10s&orgId=1&panelId=7&var-capteur=intensite&theme=light" width="450" height="200" frameborder="0"></iframe>
		</div>
	</div>

@endsection