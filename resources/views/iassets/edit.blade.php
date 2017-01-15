@extends('app')

@section('content')
		<h1> Edit an Asset </h1>
	{!!	Form::model($asset, ['method'=>'PATCH', 'action'=> ['IassetsController@update', $asset->id]]) !!}
		@include('iassets.form', ['submitButtonText' => 'Update Asset'])
	{!! Form::close() !!}

	@include('errors.list')
@stop