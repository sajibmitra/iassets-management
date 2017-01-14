@extends('app')

@section('content')
<h1> Contact Me </h1>
<p>
    Sajib Kumar Mitra
    Contact no- 01710283239
</p>
@if(count($people))
	<h3> People I like: </h3>
	<ul>
		@foreach ($people as $person)
			<li> {{	$person }} </li>
		@endforeach	
	</ul>
@endif

@stop

@section('footer')
	<h3> This is Footer </h3>
@stop