@extends('layouts.app')

@section('title', 'Graph')

@section('content')
<div class="container" id="header-text">
	<table class="table table-striped table-bordered">
    	<thead>
	      	<tr>
	        	<th>Rank</th>
	        	<th>Name</th>
	        	<th>Value</th>
	      	</tr>
    	</thead>
    	<tbody>
	    @foreach($ranking as $rank)
			<tr>
				<td>1</td>
				<td> {{$rank->name}} </td>
				<td> {{$rank->value}} </td>
			</tr>
         @endforeach
    	</tbody>
  	</table>
</div>
@endsection