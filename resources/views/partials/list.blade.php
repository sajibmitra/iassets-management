<div class="container">
    <div class="row">
        <div class="panel panel-primary filterable">

            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter">
                    <span class="glyphicon glyphicon-filter"> Search Anything </span>  </button>
            </div>
            <div class="panel-heading " align="left" >
                <h3 class="panel-title">
                    @if($linkTag == 'Iasset' || $linkTag == 'Iuser'|| $linkTag == 'Ivendor' || $linkTag == 'Iworkstation')
                        <a href="{{url( strtolower($linkTag.'s/create'))}}"> {{$linkTag.' (Create New)'}}</a>
                    @endif
                </h3>
            </div>
            <table class="table">
                <thead>
                <tr class="filters" bgcolor="#f4a460">
                    @foreach($attributes as $attribute)
                        <th><input type="text" class="form-control" placeholder="{{$attribute}}" disabled></th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <?php $rowColor ="#90dd90"; $rowColorFlag= true ?>
                    @foreach($objects as $object)
                        <tr bgcolor= {{$rowColor}}>
                            @foreach($attributes as $key=>$attribute)

                                <td align="center" >
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
                                        @elseif($attribute == 'Iuser_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                            <a href="{{ url('iusers/'.$id)}}"> {{$user_list[$id]}} </a>
                                        @elseif($attribute == 'Ivendor_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                            <a href="{{ url('ivendors/'.$id)}}">  {{$vendor_list[$id]}} </a>
                                        @elseif($attribute == 'Lnk_Printer_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                                    {{$lnk_printer_list[$id]}}
                                        @else
                                            {{object_get($object, strtolower($attribute), null)}}
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        @if($rowColorFlag == true)
                            <?php $rowColor= "#f0eef0";  $rowColorFlag= false ?>
                        @else
                            <?php $rowColor= "#90dd90"; $rowColorFlag= true ?>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>