<table class="table">
    <tbody>

    @foreach($attributes as $attribute)
        <tr>
            <td> {{ $attribute }} </td>
            <td>
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
                    {{$user_list[object_get($object, strtolower($attribute), null)]}}
                @elseif($attribute == 'Ivendor_Id' )
                    {{$vendor_list[object_get($object, strtolower($attribute), null)]}}
                @else
                    {{object_get($object, strtolower($attribute), null)}}
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>