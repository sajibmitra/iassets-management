@if($linkTag == 'Iasset' || $linkTag == 'Iworkstation' )
    <?php $gui_area="col-md-4"?>
@else
    <?php $gui_area="col-md-8"?>
@endif

@foreach($attributes as $key=>$attribute)
    @if(strtolower($attribute) == 'entry_at')
        <div class={{ $gui_area }}>
            {!! Form::label('entry_at','Entry At') !!}
            {!! Form::input('entry_date','entry_at', date('Y-m-d'), ['class'=>'form-control']) !!}
        </div>
    @elseif(strtolower($attribute) == 'purchase_at')
        <div class={{ $gui_area }}>
                {!! Form::label('purchase_at','Purchase At') !!}
                {!! Form::input('purchase_date','purchase_at', date('Y-m-d'), ['class'=>'form-control']) !!}
        </div>
    @elseif($attribute == 'Type')
        <div class={{ $gui_area }}>
            {!! Form::label('type', 'Type: ') !!}
            {!! Form::select('type', $types , null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Brand')
        <div class={{ $gui_area }}>
            {!! Form::label('brand', 'Brand: ') !!}
            {!! Form::select('brand', $asset_brand, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Section')
        <div class={{ $gui_area }}>
            {!! Form::label('section', 'Section: ') !!}
            {!! Form::select('section', $sections, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Department')
        <div class={{ $gui_area }}>
            {!! Form::label('department', 'Department: ') !!}
            {!! Form::select('department', $departments, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Designation')
        <div class={{ $gui_area }}>
            {!! Form::label('designation', 'Designation: ') !!}
            {!! Form::select('designation', $designations, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Role')
        <div class={{ $gui_area }}>
            {!! Form::label('role', 'Role: ') !!}
            {!! Form::select('role', $roles, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Status')
        <div class={{ $gui_area }}>
            {!! Form::label('status', 'Status: ') !!}
            {!! Form::select('status', $asset_status, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Warranty')
        <div class={{ $gui_area }}>
            {!! Form::label('warranty', 'Warranty: ') !!}
            {!! Form::select('warranty', [0, 1,2,3,4,5], null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Iuser_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('iuser_id', 'Iuser Id: ') !!}
            {!! Form::select('iuser_id', $user_list, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Ivendor_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('ivendor_id', 'Vendor Id: ') !!}
            {!! Form::select('ivendor_id', $vendor_list, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Net_Switch_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('net_switch_id', 'Network Switch Id: ') !!}
            {!! Form::select('net_switch_id', $net_switch_list, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'OS_Detail_Info')
            <div class={{ $gui_area }}>
            {!! Form::label('OS_Detail_Info', 'OS Detail Info: ') !!}
            {!! Form::select('os_detail_info', $os_info_list, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Lnk_Printer_Id')
        <div class={{ $gui_area }}>
            {!! Form::label('lnk_printer_id', 'Link Printer Info ') !!}
            {!! Form::select('lnk_printer_id', $lnk_printer_list, null, ['class'=>'form-control','single']) !!}
        </div>
    @elseif($attribute == 'Net_Login_Status')
        <div class={{ $gui_area }}>
            {!! Form::label('net_login_status', 'Net Login Status: ') !!}
            {!! Form::select('net_login_status', ['No', 'Yes'], null, ['class'=>'form-control','single']) !!}
        </div>
    @else
        <div class={{ $gui_area }}>
            {!! Form::label(strtolower($attribute), $attribute) !!}
            {!! Form::text(strtolower($attribute), null, ['class'=>'form-control']) !!}
        </div>
    @endif
@endforeach
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
</div>