<table class="table">
    @if($linkTag == 'Iasset')
        <thead>
        <tr>
            <th> User Id </th>
            <th> Use From </th>
            <th> Ended At </th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0 ?>
        @foreach($users as $user)
            <?php $i= $i+1 ?>
        @endforeach
        <?php $n=1 ?>
        @foreach($users as $user)
            <tr>
                <td>
                    <a href="{{ url('iusers/'.$user['id'])}}"> {{ $user['name'] }} </a>
                </td>
                <td>
                    {{ $user['pivot']['created_at'] }}
                </td>
                <td>
                    @if($n < $i )
                        {{ $users[$n]['pivot']['created_at'] }}
                        <?php $n=$n+1 ?>
                    @else
                        {{ 'Present use' }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    @elseif($linkTag == 'Iuser')
        <thead>
        <tr>
            <th> Asset Id </th>
            <th> Use From </th>
            <th> Status </th>
        </tr>
        </thead>
        <tbody>
        <?php $useInFlag = false ?>
        <?php $previousAssetId = 0 ?>
        @foreach($iassets as $asset)
            <tr>
                <td>
                    <a href="{{ url('iassets/'.$asset['id'])}}"> {{ $asset['unique_office_id'] }} </a>
                </td>
                <td>
                    {{ $asset['pivot']['created_at'] }}
                </td>
                <td>
                    @if($previousAssetId != $asset['id'])
                        <?php $useInFlag = false ?>
                    @endif
                    @if($asset['iuser_id'] == object_get($object, 'id', null))
                        @if($useInFlag == false)
                            In Use
                            <?php $useInFlag = true ?>
                            @else
                            Returned
                        @endif
                    @else
                        Returned
                    @endif
                    <?php $previousAssetId = $asset['id'] ?>

                </td>
            </tr>
        @endforeach
        </tbody>
    @elseif($linkTag == 'Ivendor')
        <thead>
        <tr>

            <th> Asset Id </th>
            <th> Purchased On </th>
            <th> Warranty </th>
            <th> Status </th>
        </tr>
        </thead>
        <tbody>
        @foreach($iassets as $asset)
            <tr>
                <td>
                    <a href="{{ url('iassets/'.$asset['id'])}}"> {{ $asset['unique_office_id'] }} </a>
                </td>
                <td>
                    {{ $asset['purchase_at'] }}
                </td>
                <td>
                    {{ $asset['warranty'].' yrs' }}
                </td>
                <td>
                    {{ $asset['status'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    @elseif($linkTag == 'Iworkstation' )
        @if($histFlag == 'Iuser')
            <thead>
            <tr>
                <th> User Id </th>
                <th> Assigned On </th>
                <th> Released On </th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0 ?>
            @foreach($users as $user)
                <?php $i= $i+1 ?>
            @endforeach
            <?php $n=1 ?>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ url('iusers/'.$user['id'])}}"> {{ $user['name'] }} </a>
                    </td>
                    <td>
                        {{ $user['pivot']['created_at'] }}
                    </td>
                    <td>
                        @if($n < $i )
                            {{ $users[$n]['pivot']['created_at'] }}
                            <?php $n=$n+1 ?>
                        @else
                            {{ 'Present use' }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        @elseif($histFlag == 'Iasset')
            <thead>
            <tr>
                <th> Asset Id </th>
                <th> Assigned On </th>
                <th> Released On </th>
            </tr>
            </thead>
            <tbody>
            <?php $useInFlag = false ?>
            <?php $previousAssetId = 0 ?>
            @foreach($assets as $asset)
                <tr>
                    <td>
                        <a href="{{ url('iassets/'.$asset['id'])}}"> {{ $asset['unique_office_id'] }} </a>
                    </td>
                    <td>
                        {{ $asset['pivot']['created_at'] }}
                    </td>
                    <td>
                        @if($previousAssetId != $asset['id'])
                            <?php $useInFlag = false ?>
                        @endif
                        @if($asset['iuser_id'] == object_get($object, 'id', null))
                            @if($useInFlag == false)
                                In Use
                                <?php $useInFlag = true ?>
                            @else
                                Returned
                            @endif
                        @else
                            Returned
                        @endif
                        <?php $previousAssetId = $asset['id'] ?>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    @endif
</table>