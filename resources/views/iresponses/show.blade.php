@extends('layouts.app')

@section('content')
    <?php $linkTag = 'Iresponse'?>
    <?php $editable='disabled'?>
    <?php $opcode='show'?>
    @include('partials.navpan')
@endsection
@section('footer')
    <script>
    $('#problem_list').select2();
    $('#action_list').select2()
    $('#asset_list').select2();
    $('#report_via').select2();
    $('#request_dtl').select2();
    $('#problem_status').select2();
    $('#responder_list').select2();
    $( "#requested_at" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-m-d',
    });
    $( "#finished_at" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-m-d',
    });
    </script>
@endsection
