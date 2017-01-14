@extends('app')
@section('content')
	@foreach($assets as $asset)
		<h2>
			<a href="/assets/{{$asset->id}}">{{ $asset->type }} {{ $asset->asset_id }}</a>
		</h2>
		<div class="body"> {{ $asset->serial }}</div>
	@endforeach
@stop