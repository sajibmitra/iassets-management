<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Nav tabs --><div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>
                    <li role="presentation"><a href="#update" aria-controls="update" role="tab" data-toggle="tab">Edit</a></li>
                    @if($linkTag == 'Iasset' || $linkTag == 'User' || $linkTag == 'Ivendor')
                        <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"> History</a></li>
                    @endif
                </ul>

                <!-- Tab panes -->

                @if($linkTag == 'Iasset')
                    {{ 'Asset ID: '.$object->iasset_id }}
                @else
                    {{ $linkTag.' Name: '.$object->name }}
                @endif
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="detail">
                      @include('partials.detail')
                    </div>
                    <div role="tabpanel" class="tab-pane" id="update">
                        {!! Form::model($object, ['method'=>'PATCH','url'=>strtolower($linkTag.'s/').$object->id]) !!}
                            @include('partials.form', ['submitButtonText'=>'Update '.$linkTag])
                        {!! Form::close() !!}
                    </div>
                    @if($linkTag == 'Iasset' || $linkTag == 'User' || $linkTag == 'Ivendor')
                        <div role="tabpanel" class="tab-pane" id="history">
                            @include('partials.history')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>