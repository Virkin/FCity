@extends('layouts.app')

@section('title', 'Graph')

@section('content')

<div class="container" id="header-text">

@if( Request::get('rankType') != "")

	<table class="table table-striped table-bordered">
    	<thead>
	      	<tr>
	        	<th>Pos</th>
	        	<th>Nom</th>
	        	<th>Puissance moyenne</th>
	      	</tr>
    	</thead>
    	<tbody>
	    @php ($i = 0)

	@if( Request::get('rankType')  == "user")
		
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

	    @foreach($ranking as $rank)
			<tr>
				<td>{{++$i}}</td>
				<td> {{$rank["nickname"]}} </td>
				<td> {{$rank["score"]}} </td>
			</tr>
        @endforeach
    	</tbody>
  		</table>

	 @endif
@else

	<div class="row">
		<div class="col">	
			<button onclick="location.href='{{route('ranking', ['rankType' => 'user'])}}'" type="button" class="btn btn-primary btn-lg btn-block">Par utilisateurs</button>
		</div>
		<div class="col">
			<button onclick="location.href='{{route('ranking', ['rankType' => 'ride'])}}'" type="button" class="btn btn-secondary btn-lg btn-block">Par trajets</button>
		</div>
	</div>

	
	

@endif

</div>

@endsection