@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <!-- Nav tabs -->
                <div class="card" >
                    {!! Form::open(['url'=>'ivendors']) !!}
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#vendorinfo" aria-controls="vendorinfo" role="tab" data-toggle="tab">
                                <h3 class="panel-title">  Create New Vendor </h3></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="vendorinfo">
                            <?php $linkTag = 'Ivendor'?>
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