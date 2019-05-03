@extends('layouts.app')

@section('title', 'Graph')

@section('content')
	@if(isset($ride_id))
		{{ $currentRideId = $ride_id }}
	@else
		{{ $currentRideId = 0}}
	@endif

	@if(isset($measure_name))
		{{ $currentChartType = $measure_name }}
	@else
		{{ $currentChartType = ""}}
	@endif

	<div class="container-fluid" id="header-text">
		<div class="row">
			<div class="col-2">
				<div class="list-group">
					
					
					  	<form id="chartForm" method="get" action="{{ route('graph') }}">
					  		<div class="input-group mb-3">
						  		<div class="input-group-prepend">
						    		<label class="input-group-text" for="inputGroupSelect01">Trajet</label>
						  		</div>
					  		<select class="custom-select" id="inputGroupSelect01" name="ride" onchange="this.form.submit()">
					    		@foreach($userRide as $ride)
					    			<option value="{{$ride->id}}" @if($currentRideId==$ride->id) selected @endif>{{$ride->start_reservation}}</option>
					    		@endforeach
					  		</select>

					  	</div>
					  		<a href="javascript:;" onclick="setChartType('vit');" class="list-group-item list-group-item-action @if($currentChartType == "vit") active @endif">
							    <center><h3>Vitesse</h3></center>
							</a>
							<a href="javascript:;" onclick="setChartType('puiss');" class="list-group-item list-group-item-action @if($currentChartType == "puiss") active @endif"><center><h3>Puissance</h3></center></a>

							<input type="hidden" id="chartType" name="chartType" value="{{$currentChartType}}">

						</form>
				</div>
			</div>
			<div class="col-10">
				{!! $speedChart->render() !!}
			</div>
		</div>
	</div>

	<script>
		function setChartType(type)
		{
			document.getElementById("chartType").value = type;
			document.getElementById("chartForm").submit();
		}
	</script>

@endsection
