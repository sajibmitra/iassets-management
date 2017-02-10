@extends('layouts.app')

@section('content')
    <?php $linkTag = 'Iasset'?>
    @include('partials.navpan')
@endsection
@section('footer')
    <script>
        $('#types').select2();
        $('#asset_brand').select2();
        $('#sections').select2();
        $('#asset_status').select2();
        $('#warranty').select2();
        $('#user_list').select2();
        $('#vendor_list').select2();
    </script>
@endsection