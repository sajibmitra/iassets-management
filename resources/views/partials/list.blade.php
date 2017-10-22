<div class="container">
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter">
                    <span class="glyphicon glyphicon-filter"> Search Anything </span>  </button>
            </div>
            <div class="panel-heading" align="left" style="background-color: blueviolet">
                <h3 class="panel-title" style="color: snow"  >
                    @if($linkTag == 'Iasset' || $linkTag == 'Iuser'|| $linkTag == 'Ivendor' || $linkTag == 'Iworkstation' || $linkTag = 'Iresponse')
                        <a href="{{url( strtolower($linkTag.'s/create'))}}"> {{$linkTag.' (Create New)'}}</a>
                    @endif
                        <p id= "demo" align="left"> <?php echo 'Number of Items: '. count($objects) ?></p>
                </h3>
            </div>
            <table class="table" style='font-family:"Verdana", sans-serif; font-size:100%'>
                <thead>
                <tr class="filters" bgcolor="#f4f4a4" >
                    @foreach($attributes as $attribute)
                        @if($attribute == 'Department')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Department' disabled></th>
                        @elseif( $attribute == 'Role')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Role' disabled></th>
                        @elseif($attribute == 'Section')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Section' disabled></th>
                        @elseif($attribute == 'Designation' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Designation' disabled></th>
                        @elseif($attribute == 'Status' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Status' disabled></th>
                        @elseif($attribute == 'Brand' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Brand' disabled></th>
                        @elseif($attribute == 'Type' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Type' disabled></th>
                        @elseif($attribute == 'Iuser_Id' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='User Name' disabled></th>
                        @elseif($attribute == 'Ivendor_Id' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Vendor Name' disabled></th>
                        @elseif($attribute == 'Lnk_Printer_Id' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Connected Printer' disabled></th>
                        @elseif($attribute == 'OS_Detail_Info' )
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Operating System' disabled></th>
                        @elseif($attribute == 'Net_Switch_Id')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Connected Switch' disabled></th>
                        @elseif($attribute == 'Unique_Office_Id')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Office Serial' disabled></th>
                        @elseif($attribute == 'Iworkstation_Id')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Workstation Name' disabled></th>
                        @elseif($attribute == 'Net_Login_Status')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Remote Login' disabled></th>
                        @elseif($attribute == 'Contact_No')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Contact No' disabled></th>
                        @elseif($attribute == 'Purchase_At')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Purchase At' disabled></th>
                        @elseif($attribute == 'Iuser_Dtl')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='User' disabled></th>
                        @elseif($attribute == 'Report_Via')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Type' disabled></th>
                        @elseif($attribute == 'Requested_At')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Report On' disabled></th>
                        @elseif($attribute == 'Problem_Status')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Status' disabled></th>
                        @elseif($attribute == 'Respond_By')
                            <th><input type="text" style="text-align: center" class="form-control" placeholder='Responder' disabled></th>
                        @else
                            <th><input type="text" style="text-align: center" class="form-control" placeholder={{$attribute}} disabled></th>
                        @endif
              @endforeach
                </tr>
                </thead>
                <tbody>
                <?php $rowColor ="#90dd90"; $rowColorFlag= true; ?>
                    @foreach($objects as $object)
                        <tr bgcolor= {{$rowColor}}  >
                            @foreach($attributes as $key=>$attribute)
                                <td align="center" >
                                    @if($key == 0)
                                      @if($linkTag == 'Iresponse')
                                        <a href="{{ url(strtolower($linkTag.'s/'.$object->id))}}"> {{'CASE-'.object_get($object, strtolower($attribute), null)}} </a>
                                      @else
                                        <a href="{{ url(strtolower($linkTag.'s/'.$object->id))}}"> {{object_get($object, strtolower($attribute), null)}} </a>
                                      @endif
                                    @else
                                        @if($attribute == 'Brand' )
                                            {{$asset_brand[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Department' )
                                            {{$departments[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Designation' )
                                            {{$designations[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Type' )
                                            {{$types[object_get($object, strtolower($attribute), null)]}}
                                        @elseif($attribute == 'Iuser_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                                <a href="{{ url('iusers/'.$id)}}"> {{str_limit($user_list[$id],10,'...')}} </a>
                                        @elseif($attribute == 'Iuser_Dtl' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                                <a href="{{ url('iusers/'.$id)}}"> {{str_limit($user_list[$id],20,'...')}} </a>
                                        @elseif($attribute == 'Respond_By' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                                 {{str_limit($responder_list[$id],20,'...')}}

                                        @elseif($attribute == 'Ivendor_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                            <a href="{{ url('ivendors/'.$id)}}">  {{ str_limit($vendor_list[$id],5,'...')}} </a>
                                        @elseif($attribute == 'Lnk_Printer_Id' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                                    @if($id == null)
                                                        {{'No Printer'}}
                                                    @else
                                                       {{$lnk_printer_list[$id]}}
                                                    @endif
                                        @elseif($attribute == 'OS_Detail_Info' )
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                            {{$os_info_list[$id]}}
                                        @elseif($attribute == 'Net_Switch_Id')
                                            <?php $id = object_get($object, strtolower($attribute), null) ?>
                                            {{$net_switch_list[$id]}}
                                        @elseif($attribute == 'Purchase_At' || $attribute == '_At'|| $attribute == 'Requested_At')
                                            {{Carbon\Carbon::parse(object_get($object, strtolower($attribute), null))->format('d.m.Y')}}
                                        @elseif($attribute == 'Serial_Id')
                                            {{object_get($object, strtolower($attribute), null)}}
                                        @else
                                            @if($linkTag == 'Iasset')
                                                {{str_limit(object_get($object, strtolower($attribute), null),30,'...')}}
                                            @else
                                                {{object_get($object, strtolower($attribute))}}
                                            @endif

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
