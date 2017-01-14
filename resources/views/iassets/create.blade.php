@extends('app')

@section('content')
	<h1> Add a new Asset </h1>

{!!	Form::open(['url'=>'assets']) !!}
<div class="form-group">
	{!! Form::label('Asset ID: ') !!}
	{!! Form::text('asset_id', null, ['class' => 'form-control']) !!}
</div>	

<div class="form-group">
	{!! Form::label('Serial ID: ') !!}
	{!! Form::text('serial_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Product ID: ') !!}
	{!! Form::text('product_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Type: ') !!}
	{!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('brand: ') !!}
	{!! Form::text('brand', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Model: ') !!}
	{!! Form::text('model', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Purchase At: ') !!}
	{!! Form::text('purchase_at', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Entry at: ') !!}
	{!! Form::text('entry_at', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Warranty: ') !!}
	{!! Form::text('warranty', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Status: ') !!}
	{!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Section: ') !!}
	{!! Form::text('section', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('Vendor: ') !!}
	{!! Form::text('vendor_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('User: ') !!}
	{!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit('Add Asset', ['class' => 'btn btn-primary form-control']) !!}
</div>
{!! Form::close() !!}
@stop