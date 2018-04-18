@extends('layouts.app')

@section('content')
    <?php $linkTag = 'Iuser'?>
    @include('partials.navpan')
@endsection
@section('footer')
    <script>
        $('#role').select2();
        $('#departments').select2().on('change', function () {
            var id = $(this).val();
            var newOptions= {"Option 1": "value1",
                "Option 2": "value2",
                "Option 3": "value3"
            };
            document.write(id);
            switch(id){
                case '0':
                    newOptions = <?php echo json_encode($secDeptMapping['Establishment'], JSON_FORCE_OBJECT) ?>;
                    break;
                case '1':
                    newOptions = <?php echo json_encode($secDeptMapping['Small and Medium Enterprise'], JSON_FORCE_OBJECT) ?>;
                    break;
                case '2':
                    newOptions = <?php echo json_encode($secDeptMapping['Agriculture and Credit Dept.'], JSON_FORCE_OBJECT) ?>;
                    break;
                case '3':
                    newOptions = <?php echo json_encode($secDeptMapping['Foreign Exchange Policy Dept.'], JSON_FORCE_OBJECT) ?>;
                    break;
                case '4':
                    newOptions = <?php echo json_encode($secDeptMapping['CASH'], JSON_FORCE_OBJECT) ?>;
                    break;
                case '5':
                    newOptions = <?php echo json_encode($secDeptMapping['Banking'], JSON_FORCE_OBJECT) ?>;
                    break;
                case '6':
                    newOptions = <?php echo json_encode($secDeptMapping['Dept. of Bank Inspection'], JSON_FORCE_OBJECT) ?>;
                    break;
                default:
                    newOptions = <?php echo json_encode($secDeptMapping['Banking'], JSON_FORCE_OBJECT) ?>;
                    break;
            }
            //alert(newOptions);
            var $el = $("#sections");
            $el.empty(); // remove old options
            $.each(newOptions, function(key,value) {
                $el.append($("<option></option>")
                        .attr("value", value).text(key));
            });
        });
        $('#designations').select2();
    </script>
@endsection
