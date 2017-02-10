<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Nav tabs -->
            <div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>
                    <li role="presentation"><a href="#update" aria-controls="update" role="tab" data-toggle="tab">Edit</a></li>
                    @if($linkTag == 'Iasset' || $linkTag == 'Iuser' || $linkTag == 'Ivendor')
                        <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
                    @endif
                </ul>

                <!-- Tab panes -->

                @if($linkTag == 'Iasset')
                   <h6 style="color: #0000cc;" align="center"> {{ 'Asset ID: '.$object->iasset_id }}</h6>
                    <h6 style="color: #f20d0d" align="center"> {{ 'Office ID: '.$object->unique_office_id}}</h6>
                @elseif($linkTag == 'Iworkstation')
                    <h6 style="color: #f20d0d;" align="center"> {{ 'Workstation ID: '.$object->iworkstation_id }}</h6>
                @elseif($linkTag == 'Iuser')
                    <h6 style="color: #f20d0d;" align="center"> {{ 'User Name: '.$object->name }}</h6>
                @elseif($linkTag == 'Ivendor')
                    <h6 style="color: #f20d0d;" align="center"> {{ 'Vendor Name: '.$object->name }}</h6>
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
                    @if($linkTag == 'Iasset' || $linkTag == 'Iuser' || $linkTag == 'Ivendor')
                        <div role="tabpanel" class="tab-pane" id="history">
                            @include('partials.history')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
