<div class="container">
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">
                    @if($linkTag == 'Iasset' || $linkTag == 'Ivendor' || $linkTag == 'Iworkstation')
                        <a href="{{url( strtolower($linkTag.'s/create'))}}"> {{$linkTag.' (Create New)'}}</a>
                    @elseif($linkTag == 'User')
                        {{$linkTag}}
                    @endif
                </h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter">
                        <span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr class="filters">
                    @foreach($attributes as $attribute)
                        <th><input type="text" class="form-control" placeholder="{{$attribute}}" disabled></th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @foreach($objects as $object)
                        <tr>
                            @foreach($attributes as $key=>$attribute)
                                <td>
                                    @if($key == 0)
                                        <a href="{{ url(strtolower($linkTag.'s/'.$object->id))}}"> {{object_get($object, strtolower($attribute), null)}} </a>
                                    @else
                                        @if($attribute == 'Department')
                                            {{$departments[object_get($object, strtolower($attribute), null)]}}
                                        @elseif( $attribute == 'Role')
                                            {{$roles[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Section')
                                            {{$sections[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Designation' )
                                            {{$designations[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Status' )
                                            {{$asset_status[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Brand' )
                                            {{$asset_brand[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Type' )
                                            {{$types[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'User_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                            <a href="{{ url('users/'.$id)}}"> {{$user_list[$id]}} </a>
                                        @elseif($attribute == 'Ivendor_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                            <a href="{{ url('ivendors/'.$id)}}">  {{$vendor_list[$id]}} </a>
                                        @else
                                            {{object_get($object, strtolower($attribute), null)}}
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>