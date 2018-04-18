@if($linkTag == 'Iasset' || $linkTag == 'Iworkstation' )
    <?php $gui_area="col-md-6"?>
@else
    <?php $gui_area="col-md-8"?>
@endif
@foreach($attributes as $key=>$attribute)
    @if($attribute == 'Type')
        <div class={{ $gui_area }}>
            {!! Form::label('type', 'Type: ') !!}
            {!! Form::select('type', $types, null, ['id'=>'types','class'=>'form-control','single', $editable]) !!}
        </div>
    @elseif($attribute == 'Brand')
        <div class={{ $gui_area }}>
            {!! Form::label('brand', 'Brand: ') !!}
            {!! Form::select('brand', $asset_brand, null, ['id'=>'asset_brand','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Section')
        <div class={{ $gui_area }}>
            {!! Form::label('section', 'Section: ') !!}
            {!! Form::select('section', $secDeptMapping['Establishment'], null, ['id'=>'sections','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Department')
        <div class={{ $gui_area }}>
            {!! Form::label('department', 'Department: ') !!}
            {!! Form::select('department', array_keys($secDeptMapping), null, ['id'=>'departments','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Designation')
        <div class={{ $gui_area }}>
            {!! Form::label('designation', 'Designation: ') !!}
            {!! Form::select('designation', $designations, null, ['id'=>'designations','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Role')
        <div class={{ $gui_area }}>
            {!! Form::label('role', 'Role: ') !!}
            {!! Form::select('role', $roles, null, ['id'=>'role','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Status')
        <div class={{ $gui_area }}>
            {!! Form::label('status', 'Status: ') !!}
            {!! Form::select('status', $asset_status, null, ['id'=>'asset_status','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Warranty')
        <div class={{ $gui_area }}>
            {!! Form::label('warranty', 'Warranty: ') !!}
            {!! Form::select('warranty', [0,1,2,3,4,5], null, ['id'=>'warranty','class'=>'form-control','single', $editable]) !!}
        </div>
    @elseif($attribute == 'Iuser_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('iuser_id', 'User Name: ') !!}
            {!! Form::select('iuser_id', $user_list, null, ['id'=>'iuser_id', 'class'=>'form-control', 'single']) !!}
        </div>
    @elseif($attribute == 'Ivendor_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('ivendor_id', 'Vendor Name: ') !!}
            {!! Form::select('ivendor_id', $vendor_list, null, ['id'=>'vendor_list','class'=>'form-control','single', $editable]) !!}
        </div>
    @elseif($attribute == 'Net_Switch_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('net_switch_id', 'Network Switch Id: ') !!}
            {!! Form::select('net_switch_id', $net_switch_list, null, ['id'=>'net_switch_list','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'OS_Detail_Info')
            <div class={{ $gui_area }}>
            {!! Form::label('OS_Detail_Info', 'Operating System: ') !!}
            {!! Form::select('os_detail_info', $os_info_list, null, ['id'=>'os_detail_list','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Lnk_Printer_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('lnk_printer_id', 'Connected Printer: ') !!}
            {!! Form::select('lnk_printer_id', $lnk_printer_list, null, ['id'=>'lnk_printer_id','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Net_Login_Status')
        <div class={{ $gui_area }}>
            {!! Form::label('net_login_status', 'Remote Login Status: ') !!}
            {!! Form::select('net_login_status', ['NO'=>'No', 'YES'=>'Yes'], null , ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Asset_List')
        <div class={{ $gui_area }}>
            {!! Form::label('asset_list', 'Connected Assets: ') !!}
            {!! Form::select('asset_list[]', $asset_list, array_keys($lnk_assets), ['id'=>'asset_list','class'=>'form-control','multiple']) !!}
        </div>
    @elseif($attribute == 'Iasset_Dtl')
        <div class={{ $gui_area }}>
            {!! Form::label('iasset_dtl', 'Connected Assets: ') !!}
            {!! Form::select('iasset_dtl', $asset_list, null, ['id'=>'asset_list','class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Report_Via')
        <div class={{ $gui_area }}>
            {!! Form::label('report_via', 'Reported Mediam: ') !!}
            {!! Form::select('report_via', ['Written'=>'Written', 'Telephone'=>'Telephone'], null , ['id'=>'report_via', 'class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Problem_Dtl')
        <div class={{ $gui_area }}>
            {!! Form::label('problem_dtl', 'Problem Detail: ') !!}
            {!! Form::select('problem_dtl',$problem_list, null, ['id'=>'problem_list','class'=>'form-control']) !!}
        </div>
    @elseif($attribute == 'Problem_Status')
        <div class={{ $gui_area }}>
            {!! Form::label('problem_status', 'Problem Status: ') !!}
            {!! Form::select('problem_status', ['Requested'=>'Requested', 'Pending'=>'Pending', 'Solved'=>'Solved', 'Decline'=>'Decline'], null , ['class'=>'form-control','single']) !!}
        </div>
  @elseif($attribute == 'Respond_By')
      <div class={{ $gui_area }}>
          {!! Form::label('respond_by', 'Responder: ') !!}
          {!! Form::select('respond_by', $responder_list, null, ['id'=>'responder_list','class'=>'form-control','single']) !!}
      </div>
    @elseif($attribute == 'Action_Taken')
        <div class={{ $gui_area }}>
            {!! Form::label('action_taken', 'Action Taken: ') !!}
            {!! Form::select('action_taken',$action_list,null, ['id'=>'action_list','class'=>'form-control']) !!}
        </div>
  @elseif($attribute == 'Remarks')
      <div class={{ $gui_area }}>
          {!! Form::label('remarks', 'Remarks: ') !!}
          {!! Form::textarea('remarks',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
      </div>
    @elseif($attribute == 'Unique_Office_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('unique_office_id', 'Office Id: ') !!}
            {!! Form::text('unique_office_id', null, ['id'=>'unique_office_id','class'=>'form-control']) !!}
        </div>
    @elseif($attribute == 'Net_Switch_Port')
        <div class={{ $gui_area }}>
            {!! Form::label('net_switch_port', 'Switch Port: ') !!}
            {!! Form::text('net_switch_port', null, ['id'=>'net_switch_port','class'=>'form-control']) !!}
        </div>
    @else
        <div class={{ $gui_area }}>
            @if(strtolower($attribute) == 'entry_at'||strtolower($attribute) == 'purchase_at'|| strtolower($attribute) == 'requested_at'||strtolower($attribute) == 'finished_at')
                  @if($opcode == 'create')
                      {!! Form::label(strtolower($attribute), $attribute) !!}
                      {!! Form::text(strtolower($attribute), date('Y-m-d'), [ 'class'=>'form-control']) !!}
                  @else
                      {!! Form::label(strtolower($attribute), $attribute) !!}
                      {!! Form::text(strtolower($attribute), null, ['class'=>'form-control']) !!}
                  @endif
            @else
                    {!! Form::label(strtolower($attribute), $attribute) !!}
                    {!! Form::text(strtolower($attribute), null, ['class'=>'form-control']) !!}
            @endif
        </div>
    @endif
@endforeach
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
</div>
