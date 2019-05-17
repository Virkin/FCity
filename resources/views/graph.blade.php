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

	<div class="container-fluid" id="header-md-text">
	
		<form id="chartForm" method="get" action="{{ route('graph') }}">
	
			<div class="row">

			<div class="col-6 col-md-3">
	  		
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
	  		</div>

	  		<div class="col-6 col-md-9">
	  		
			<ul class="nav nav-tabs">	
			  	<li class="nav-item">
			    	<a href="javascript:;" onclick="setChartType('vit');" class="nav-link @if($currentChartType == "vit") active @endif">
			    		<center><h3>
			    			<i class="fas fa-tachometer-alt"></i>
			    			Vitesse
			    		</h3></center>
					</a>
			  	</li>
			  	<li class="nav-item">
			    	<a href="javascript:;" onclick="setChartType('puiss');" class="nav-link @if($currentChartType == "puiss") active @endif">
			    		<center><h3>
			    			<i class="fas fa-bolt"></i>
			    			Puissance
			    		</h3></center>
			    	</a>
			  </li>
			  <li class="nav-item">
			    	<a href="javascript:;" onclick="setChartType('lux');" class="nav-link @if($currentChartType == "lux") active @endif">
			    		<center><h3>
			    			<i class="fas fa-sun"></i>
			    			Eclairement
			    		</h3></center>
			    	</a>
			  </li>
			  <li class="nav-item">
			    	<a href="javascript:;" onclick="setChartType('accel');" class="nav-link @if($currentChartType == "accel") active @endif">
			    		<center><h3>
			    			<i class="fas fa-wind"></i>
			    			Acceleration
			    		</h3></center>
			    	</a>
			  </li>
			</ul>

			</div>
			</div>					  		

			<input type="hidden" id="chartType" name="chartType" value="{{$currentChartType}}">

		</form>

		{!! $speedChart->render() !!}	
	</div>
		
	<script>
		function setChartType(type)
		{
			document.getElementById("chartType").value = type;
			document.getElementById("chartForm").submit();
		}
	</script>

@endsection
