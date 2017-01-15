@extends('app')

@section('content')
		<h1> Add a new Asset </h1>

	{!!	Form::open(['url'=>'assets']) !!}
		@include('iassets.form', ['submitButtonText' => 'Create Asset'])
	{!! Form::close() !!}

	@include('errors.list')
@stop