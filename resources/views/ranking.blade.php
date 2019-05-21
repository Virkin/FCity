@extends('layouts.app')

@section('title', 'Graph')

@section('content')

<div class="container" id="header-text">
		<ul class="nav nav-tabs">	
		  	<li class="nav-item">
		    	<a href="{{route('ranking', ['rankType' => 'user'])}}" class="nav-link @if( Request::get('rankType')  == "user" or Request::get('rankType') == "") active @endif ">
		    		<center><h3>Par conducteur</h3></center>
				</a>
		  	</li>
		  	<li class="nav-item">
		    	<a href="{{route('ranking', ['rankType' => 'ride'])}}" class="nav-link @if( Request::get('rankType')  == "ride") active @endif "> 
		    		<center><h3>Par trajet</h3></center>
				</a>
		  	</li>
		</ul>
		@php ($i = 0)
		@if( Request::get('rankType')  == "user" or Request::get('rankType') == "")
			<table class="table table-striped table-bordered table-responsive-sm">
		    	<thead class="thead-dark">
			      	<tr>
			        	<th>Position</th>
			        	<th>Utilisateur</th>
			        	<th>Puissance moyenne en W</th>
			      	</tr>
		    	</thead>
		    	<tbody>
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
			<table class="table table-striped table-bordered table-responsive-sm">
		    	<thead class="thead-dark">
			      	<tr>
			        	<th>Position</th>
			        	<th>Identifiant trajet</th>
			        	<th>Utilisateur</th>
			        	<th>Puissance moyenne en W</th>
			      	</tr>
		    	</thead>
		    	<tbody>
				    @foreach($ranking as $rank)
						<tr>
							<td>{{++$i}}</td>
							<td> {{$rank["id"]}} </td>
							<td> {{$rank["nickname"]}} </td>
							<td> {{$rank["score"]}} </td>
						</tr>
			        @endforeach
		    	</tbody>
	  		</table>
		@endif
</div>

@endsection