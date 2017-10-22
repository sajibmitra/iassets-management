@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Nav tabs -->
                <div class="card" >
                    {!! Form::open(['url'=>'iresponses']) !!}
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#newasset" aria-controls="newasset" role="tab" data-toggle="tab">
                                <h3 class="panel-title"> Create New response </h3></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="newasset">
                            <?php $linkTag = 'Iresponse'?>
                            <?php $editable='enabled'?>
                            <?php $opcode='create'?>
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
        $('#user_list').select2();
        $('#asset_list').select2();
        $('#report_via').select2();
        $('#request_dtl').select2();
        $('#problem_status').select2();
        $('#responder_list').select2();
        $( "#requested_at" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'yy-m-d',
        });
        $( "#finished_at" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'yy-m-d',
        });
    </script>
    <!--link rel="stylesheet" href="/resources/demos/style.css"-->
    <script>
@endsection
