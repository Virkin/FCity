@extends('layouts.app')

@section('title', 'Graph')

@section('content')
<div class="container" id="header-text">
	<table class="table table-striped table-bordered">
    	<thead>
	      	<tr>
	        	<th>Rank</th>
	        	<th>Name</th>
	        	<th>V/KM</th>
	      	</tr>
    	</thead>
    	<tbody>
	    @php ($i = 0)
	    @foreach($ranking as $rank)
			<tr>
				<td>{{++$i}}</td>
				<td> {{$rank->name}} </td>
				<td> {{$rank->score}} </td>
			</tr>
         @endforeach
    	</tbody>
  	</table>
</div>
@endsection