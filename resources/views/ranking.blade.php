@extends('layouts.app')

@section('title', 'Graph')

@section('content')

<div class="container" id="header-text">

@if( Request::get('rankType')  == "user")
	<table class="table table-striped table-bordered">
    	<thead>
	      	<tr>
	        	<th>Rank</th>
	        	<th>Name</th>
	        	<th>W/H</th>
	      	</tr>
    	</thead>
    	<tbody>
	    @php ($i = 0)
	    @foreach($ranking as $name=>$value)
			<tr>
				<td>{{++$i}}</td>
				<td> {{$name}} </td>
				<td> {{$value}} </td>
			</tr>
         @endforeach
    	</tbody>
  	</table>
@elseif( Request::get('rankType')  == "ride")

	<table class="table table-striped table-bordered">
    	<thead>
	      	<tr>
	        	<th>Rank</th>
	        	<th>Name</th>
	        	<th>W/H</th>
	      	</tr>
    	</thead>
    	<tbody>
	    @php ($i = 0)
	    @foreach($ranking as $rank)
			<tr>
				<td>{{++$i}}</td>
				<td> {{$rank["nickname"]}} </td>
				<td> {{$rank["score"]}} </td>
			</tr>
         @endforeach
    	</tbody>
  	</table>
@else

	<div class="row">
		<div class="col">	
			<button onclick="location.href='{{route('ranking', ['rankType' => 'user'])}}'" type="button" class="btn btn-primary btn-lg btn-block">By users</button>
		</div>
		<div class="col">
			<button onclick="location.href='{{route('ranking', ['rankType' => 'ride'])}}'" type="button" class="btn btn-secondary btn-lg btn-block">By rides</button>
		</div>
	</div>

	
	

@endif

</div>

@endsection