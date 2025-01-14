<?php
use App\Lib\MyHelper;
$grantedFeature     = session('granted_features');
$configs     = session('configs');
?>
@extends('layouts.main')

@section('page-style')
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/datemultiselect/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/datemultiselect/jquery-ui.multidatespicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOHBNv3Td9_zb_7uW-AJDU6DHFYk-8e9Y&v=3.exp&signed_in=true&libraries=places"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $('input[name=service]').keypress(function (e) {
            var regex = new RegExp("^[0-9]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

            var check_browser = navigator.userAgent.search("Firefox");

            if(check_browser == -1){
                if (regex.test(str) || e.which == 8) {
                    return true;
                }
            }else{
                if (regex.test(str) || e.which == 8 ||  e.keyCode === 46 || (e.keyCode >= 37 && e.keyCode <= 40)) {
                    return true;
                }
            }

            e.preventDefault();
            return false;
        });
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
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#service_fee" data-toggle="tab" > Reminder Tagihan Pembayaran </a>
                </li>
                <li>
                    <a href="#ongkos_fee" data-toggle="tab"> Expired Date Tagihan Pembayaran</a>
                </li>
                <li>
                    <a href="#mdr_fee" data-toggle="tab"> Order Received</a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="service_fee">
                    <form class="form-horizontal" action="{{url('transaction/setting/reminder/reminder')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <label class="col-md-3 control-label">
                                        Reminder
                                        <span class="required" aria-required="true"> * </span>
                                        <i class="fa fa-question-circle tooltips" data-original-title="Pengingat tagihan pembayaran yang belum di bayarkan." data-container="body"></i>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" maxlength="3" min="0" max="100" placeholder="Insert Reminder" class="form-control" name="reminder-tagihan-pembayaran" value="{{$reminder}}" required>
                                        <span class="input-group-addon">Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="ongkos_fee">
                    <form class="form-horizontal" action="{{url('transaction/setting/reminder/expired')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-body">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <label class="col-md-3 control-label">
                                        Expired Date
                                        <span class="required" aria-required="true"> * </span>
                                        <i class="fa fa-question-circle tooltips" data-original-title="Pengingat tagihan pembayaran yang belum di bayarkan." data-container="body"></i>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" maxlength="3" min="0" max="100" placeholder="Insert expired" class="form-control" name="expired-date-tagihan-pembayaran" value="{{$expired}}" required>
                                        <span class="input-group-addon">Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-actions">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="mdr_fee">
                    <form class="form-horizontal" action="{{url('transaction/setting/reminder/received')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <label class="col-md-3 control-label">
                                        Order Received
                                        <span class="required" aria-required="true"> * </span>
                                        <i class="fa fa-question-circle tooltips" data-original-title="Pengingat tagihan pembayaran yang belum di bayarkan." data-container="body"></i>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" maxlength="3" min="0" max="100" placeholder="Insert expired" class="form-control" name="date-order-received" value="{{$expired}}" required>
                                        <span class="input-group-addon">Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection