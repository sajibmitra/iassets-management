@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <!-- Nav tabs -->
                <div class="card" >
                    {!! Form::open(['url'=>'iassets']) !!}
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#newasset" aria-controls="newasset" role="tab" data-toggle="tab">
                                <h3 class="panel-title"> Create New Asset </h3></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="newasset">
                            <?php $linkTag = 'Iasset'?>
                            <?php $editable='enabled'?>
                                @include('partials.form', ['submitButtonText'=>'Add '.$linkTag])
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('#types').select2();
        $('#asset_brand').select2();
        $('#sections').select2();
        $('#asset_status').select2();
        $('#warranty').select2();
        $('#user_list').select2();
        $('#vendor_list').select2();
        $('#unique_office_id').select2();
        $('#entry_date').select2();
        $('#purchase_date').select2();
    </script>
@endsection