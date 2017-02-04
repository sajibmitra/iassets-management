@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <!-- Nav tabs -->
                <div class="card" >
                    {!! Form::open(['url'=>'iusers']) !!}
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#newuser" aria-controls="newuser" role="tab" data-toggle="tab">
                                <h3 class="panel-title"> Create New User </h3></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="newuser">
                            <?php $linkTag = 'Iuser'?>
                                @include('partials.form', ['submitButtonText'=>'Add '.$linkTag])
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection