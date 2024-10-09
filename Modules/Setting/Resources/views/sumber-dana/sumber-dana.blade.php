@extends('layouts.main')

@section('page-style')
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/datemultiselect/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-script')
    <script src="{{env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        function addTextReplace(id ,param){
            if (id == 'mobile') {
                var textvalue = $('#display_text_mobile').val();
                var textvaluebaru = textvalue+" "+param;
                $('#display_text_mobile').val(textvaluebaru);
            } else if (id == 'outlet') {
                var textvalue = $('#display_text_outlet').val();
                var textvaluebaru = textvalue+" "+param;
                $('#display_text_outlet').val(textvaluebaru);
            } else if (id == 'doctor') {
                var textvalue = $('#display_text_doctor_mobile').val();
                var textvaluebaru = textvalue+" "+param;
                $('#display_text_doctor_mobile').val(textvaluebaru);
            }
        }
    </script>
@endsection

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ $title }}</span>
                @if (!empty($sub_title))
                    <i class="fa fa-circle"></i>
                @endif
            </li>
            @if (!empty($sub_title))
            <li>
                <span>{{ $sub_title }}</span>
            </li>
            @endif
        </ul>
    </div><br>

    @include('layouts.notifications')

    <div class="portlet card_ light bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-blue bold uppercase">Sumber Dana Setting</span>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_Android">
                        <form class="form-horizontal" role="form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
                            <div class="portlet light">
                                <div id="addAndroid">
                                    <div class="mt-repeater" id="Android0">
                                        <div class="mt-repeater-item mt-overflow">
                                            <div class="mt-repeater-cell">
                                                <div class="col-md-12">
                                                    <div class="col-md-1">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete mt-repeater-del-right mt-repeater-btn-inline" onclick="deleteCondition('Android0')">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="name[][sumber-dana]" required placeholder="Sumber Dana">
                                                            <span class="input-group-addon">
                                                                <i style="color:#333" class="fa fa-question-circle tooltips" data-original-title="Sumber dana" data-container="body"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:;" class="btn btn-success mt-repeater-add" onclick="addVersion('Android')">
                                <i class="fa fa-plus"></i> Add New Sumber Dana</a>
                            </div>
                            <div class="form-actions">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button type="submit" class="btn green">Save</button>
                                        <button type="button" class="btn default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                var noAndroid = 1;
                var noIOS = 1;
                var noOutletApp = 1;
                var noDoctorAndroid = 1;
                var noDoctorIOS = 1;

                window.onload = function(event) {
                    var android = JSON.parse('{!! json_encode($version) !!}');
                    if (android.length != 0) {
                        android.forEach(function(entry) {
                            $('#Android0').remove()
                            appendData('Android', 'Android', noAndroid, 'sumber_dana', entry.sumber_dana, entry.rules);
                            noAndroid++;
                        });
                    } 
                };

                function appendData(id, device, number, name, version, rules) {
                    var allow = ''
                    var not_allow = ''
                    if (rules == 1) {
                        var allow = 'selected'
                    } else if (rules == 0) {
                        var not_allow = 'selected'
                    }
                    $("#add"+id).append(
                        '<div class="mt-repeater" id="'+id+number+'">'+
                            '<div class="mt-repeater-item mt-overflow">'+
                                '<div class="mt-repeater-cell">'+
                                    '<div class="col-md-12">'+
                                        '<div class="col-md-1">'+
                                            '<a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete mt-repeater-del-right mt-repeater-btn-inline" onclick="deleteCondition(`'+id+number+'`)">'+
                                                '<i class="fa fa-close"></i>'+
                                            '</a>'+
                                        '</div>'+
                                        '<div class="col-md-5">'+
                                            '<div class="input-group">'+
                                                '<input type="text" class="form-control" name="name[][sumber-dana]" value="'+version+'" required placeholder="Sumber Dana">'+
                                                '<span class="input-group-addon">'+
                                                    '<i style="color:#333" class="fa fa-question-circle tooltips" data-original-title="Sumber dana" data-container="body"></i>'+
                                                '</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('.tooltips').tooltip()
                }


                function dataAppend(item) {
                    if (item.app_type == "Android") {
                        appendDiv('Android', 'Android', noAndroid, 'sumber_dana')
                        noAndroid++;
                    }
                }

                function addVersion(id){
                    if (id == "Android") {
                        appendDiv('Android', 'Android', noAndroid, 'sumber_dana')
                        noAndroid++;
                    } 
                }

                function appendDiv(id, device, number, name) {
                    $("#add"+id).append(
                        '<div class="mt-repeater" id="'+id+number+'">'+
                            '<div class="mt-repeater-item mt-overflow">'+
                                '<div class="mt-repeater-cell">'+
                                    '<div class="col-md-12">'+
                                        '<div class="col-md-1">'+
                                            '<a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete mt-repeater-del-right mt-repeater-btn-inline" onclick="deleteCondition(`'+id+number+'`)">'+
                                                '<i class="fa fa-close"></i>'+
                                            '</a>'+
                                        '</div>'+
                                        '<div class="col-md-5">'+
                                            '<div class="input-group">'+
                                                '<input type="text" class="form-control" name="name[][sumber-dana]" value="" required placeholder="Sumber Dana">'+
                                                '<span class="input-group-addon">'+
                                                    '<i style="color:#333" class="fa fa-question-circle tooltips" data-original-title="Sumber dana" data-container="body"></i>'+
                                                '</span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('.tooltips').tooltip()
                }
                function deleteCondition(response) {
                    $('#'+response).remove()
                }
            </script>
            </div>
        </div>
    </div>
@endsection