@extends('layouts.app')

@section('title', 'Graph')

@section('content')
<div class="container" id="header-text">
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
</div>
@endsection