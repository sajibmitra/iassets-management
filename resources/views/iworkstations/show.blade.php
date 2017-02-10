@extends('layouts.app')

@section('content')
    <?php $linkTag = 'Iworkstation'?>
    @include('partials.navpan')
@endsection

@section('footer')
    <script>
        $('#asset_list').select2();
        $('#user_list').select2();
        $('#net_switch_list').select2();
        $('#os_info_list').select2();
        $('#lnk_printer_list').select2();
        $('#net_login_status').select2();
    </script>
@endsection