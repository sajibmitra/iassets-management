<div class="form-group">
		{!! Form::label('asset_id','Asset ID: ') !!}
		{!! Form::text('asset_id', null, ['class' => 'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('serial_id','Serial ID: ') !!}
		{!! Form::text('serial_id', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('product_id','Product ID: ') !!}
		{!! Form::text('product_id', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('type','Type: ') !!}
		{!! Form::text('type', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('brand','brand: ') !!}
		{!! Form::text('brand', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('model','Model: ') !!}
		{!! Form::text('model', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('purchase_at','Purchase On: ') !!}
		{!! Form::input('date','purchase_at', date('Y-m-d'), ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('entry_at','Entry On: ') !!}
		{!! Form::input('date','entry_at', date('Y-m-d'), ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('warranty','Warranty: ') !!}
		{!! Form::text('warranty', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('status','Status: ') !!}
		{!! Form::text('status', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('section','Section: ') !!}
		{!! Form::text('section', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('vendor_id','Vendor: ') !!}
		{!! Form::text('vendor_id', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('user_id','User: ') !!}
		{!! Form::text('user_id', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
	</div>