<table class="table">
    <tbody>
    @foreach($attributes as $attribute)
        <tr>
            <td> {{ $attribute }} </td>
            <td>
                @if($attribute == 'Department')
                    {{$departments[object_get($object, strtolower($attribute), null)]}}
                @elseif($attribute == 'Status' )
                    {{$asset_status[object_get($object, strtolower($attribute), null)]}}
                @elseif($attribute == 'Brand' )
                    {{$asset_brand[object_get($object, strtolower($attribute), null)]}}
                @elseif($attribute == 'Type' )
                    {{$types[object_get($object, strtolower($attribute), null)]}}
                @elseif($attribute == 'Iuser_Id' )
                    <?php $id=object_get($object, strtolower($attribute), null)?>
                    <a href="{{ url('iusers/'.$id)}}"> {{$user_list[$id]}}</a>
                @elseif($attribute == 'Ivendor_Id' )
                    {{$vendor_list[object_get($object, strtolower($attribute), null)]}}
                @elseif($attribute == 'Lnk_Printer_Id' )
                    <?php $id = object_get($object, strtolower($attribute), null) ?>
                        @if($id == null)
                            {{'No Printer'}}
                        @else
                            {{$lnk_printer_list[$id]}}
                        @endif
                @elseif($attribute == 'Net_Switch_Id')
                    <?php $id = object_get($object, strtolower($attribute), null) ?>
                    {{$net_switch_list[$id]}}
                @elseif($attribute == 'OS_Detail_Info' )
                    <?php $id = object_get($object, strtolower($attribute), null) ?>
                    {{$os_info_list[$id]}}
                @elseif($attribute == 'Asset_List' )
                    @foreach($assets as $id => $unique_office_id)
                      <a href="{{ url('iassets/'.$id)}}"> {{ $unique_office_id }} </a>
                    @endforeach
                @else
                    {{object_get($object, strtolower($attribute), null)}}
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>