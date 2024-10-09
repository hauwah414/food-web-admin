@extends('layouts.main')

@section('page-style')
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-plugin')
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
@endsection

@section('page-script')
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script>
         $(document).ready(function() {
         function number(id){
            $(id).inputmask("remove");
            $(id).inputmask({
                mask: "99999999999999",
                removeMaskOnSubmit: true,
                placeholder:"",
                prefix: "",
                digits: 0,
                // groupSeparator: '.',
                rightAlign: false,
                greedy: false,
                autoGroup: true,
                digitsOptional: false,
            });
        }
        number("#transaction_shipment");
             $('#myBtn').on( 'click', function (e) {
            $("#modal-form").modal("show");
            $("#form-modal").trigger("reset");
            $("#modal-form-title").text("Tambah Ruang");
             $("#modal-form").on('shown.bs.modal', function(){
                if ($('#id_gedung').find("option[value='" +  + "']").length) {
                    $('#id_gedung').val().trigger('change');
                } else { 
                    var newOption = new Option('', '', true, true);
                    $('#id_gedung').append(newOption).trigger('change');
                } 
            });
            $("#btn-simpan").val("tambah");
            $("#modal-form").on('shown.bs.modal', function(){
                $('#status ').bootstrapSwitch('state',true);
                
            });
        });
            $(".sweetalert-reject").each(function() {
                        var token  	= "{{ csrf_token() }}";
                        var pathname = window.location.pathname;
                        let id     	= $(this).data('id');
                        let name    = $(this).data('name');
                        let id_transaction    = $(this).data('id_transaction');
                        $(this).click(function() {
                            swal({
                                    title: name+"\n\nAre you sure want to delete this item?",
                                    text: "Your will not be able to recover this data!",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Yes, delete it!",
                                    closeOnConfirm: false
                                },
                                function(){
                                    $.ajax({
                                        type : "POST",
                                        url : "{{url('transaction/item/delete')}}/"+id,
                                        data : {
                                            '_token' : '{{csrf_token()}}',
                                        },
                                        success : function(response) {
                                            if (response.status == 'success') {
                                                swal("Deleted!", "Item has been deleted.", "success")
                                                location.href = "{{url('transaction/detail')}}/"+id_transaction;
                                            }
                                            else if(response.status == "fail"){
                                                swal("Error!", "Failed to delete Item.", "error")
                                            }
                                            else {
                                                swal("Error!", "Something went wrong. Failed to delete Item.", "error")
                                            }
                                        }
                                    });
                                });
                        })
                    });
         });
    </script>
    <script type="text/javascript">
        function enable_date() {
            $('#change_transaction_date').prop('disabled', false);
          }
        function enable_sumber_dana() {
            $('#change_sumber_dana').prop('disabled', false);
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
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs">

                <li class="active" id="infoVendor">
                    <a href="#info" data-toggle="tab" > Info </a>
                </li>
                <li id="listProduct">
                    <a href="#list_product" data-toggle="tab" > Tambah Menu </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="info">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h4><b>Transaction Info</b></h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">Receipt Number</div>
                                                    <div class="col-md-7"><b>: {{$detail['transaction_receipt_number']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Order Status</div>
                                                    <div class="col-md-7">
                                                        <?php
                                                        $codeColor = [
                                                            1 => '#ff0000',
                                                            2 => '#ffd633',
                                                            3 => '#cccccc',
                                                            4 => '#ffd633',
                                                            5 => '#ffd633',
                                                            6 => '#009900',
                                                        ];
                                                        ?>
                                                        : <span class="badge" style="background-color: {{$codeColor[$detail['transaction_status_code']]??'#cccccc'}};">{{$detail['transaction_status_text']}}</span>
                                                    </div>
                                                </div>
<!--                                                @if($detail['transaction_status_code']==3)
                                                <hr>
                                                <form class="form-horizontal" role="form" action="{{url('transaction/update/date')}}" method="post">  
                                                <div class="row">
                                                    <div class="col-md-4">Time & date</div>
                                                    <div class="col-md-4"><input type="datetime-local" class="form-control form-filter input-sm datetimepicker" 
                                                                                 name="transaction_date" placeholder="From"  
                                                                                 value="{{date('Y-m-d H:i',strtotime($detail['transaction_date_text']))}}" 
                                                                                 onchange="enable_date()"
                                                                                 data-date-format="yyyy-mm-dd hh:ii" min="{{date('Y-m-d H:i')}}" required></div>
                                                </div>
                                                <div class="row" style="margin-top: 10px">
                                                     <input type="hidden" name="id_transaction" value="{{$detail['id_transaction']}}">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4">
                                                        {{ csrf_field() }}
                                                        <button type="submit" id="change_transaction_date" disabled class="btn green-jungle">Update Tanggal Pengiriman</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <hr>
                                                <form class="form-horizontal" role="form" action="{{url('transaction/update/sumber-pembelian')}}" method="post">  
                                                <div class="row">
                                                    <div class="col-md-4">Tujuan Pembelian</div>
                                                    <div class="col-md-4"><input type="text" class="form-control" 
                                                                                 name="tujuan_pembelian" placeholder="From"
                                                                                 value="{{$detail['tujuan_pembelian']}}" required></div>
                                                </div>
                                                <div class="row" style="margin-top: 10px">
                                                    <div class="col-md-4">Sumber Dana</div>
                                                    <div class="col-md-4"><input type="text" class="form-control"
                                                                                 name="sumber_dana" placeholder="From"  
                                                                                 value="{{$detail['sumber_dana']}}" required></div>
                                                </div>
                                                <div class="row" style="margin-top: 10px">
                                                    <input type="hidden" name="id_transaction_group" value="{{$detail['id_transaction_group']}}">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn green-jungle">Update</button>
                                                    </div>
                                                </div>
                                                </form>
-->                                                <div class="row">
                                                    <div class="col-md-4">Tujuan Pembelian</div>
                                                    <div class="col-md-7"><b>: {{$detail['tujuan_pembelian']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Sumber Dana</div>
                                                    <div class="col-md-7"><b>: {{$detail['sumber_dana']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Time & date</div>
                                                    <div class="col-md-7"><b>: {{$detail['transaction_date']}}</b></div>
                                                </div><!--
                                                @endif-->

                                                @if($detail['transaction_status_code'] == 1)
                                                    <div class="row">
                                                        <div class="col-md-4">Reject at</div>
                                                        <div class="col-md-7"><b>: {{$detail['transaction_reject_at']}}</b></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">Reject reason</div>
                                                        <div class="col-md-7"><b>: {{$detail['transaction_reject_reason']}}</b></div>
                                                    </div>
                                                @endif
                                                <br>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4><b>Delivery Info</b></h4>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Shipment Price</div>
                                                    <div class="col-md-7"><b>: @if(empty($detail['delivery']['delivery_price'])) - @else {{$detail['delivery']['delivery_price']}} @endif</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Customer Name</div>
                                                    <div class="col-md-7"><b>: {{$detail['address']['destination_name']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Customer Phone</div>
                                                    <div class="col-md-7"><b>: {{$detail['address']['destination_phone']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Address</div>
                                                    <div class="col-md-7"><b>: {{$detail['address']['destination_address']}} ({{$detail['address']['destination_city']}} - {{$detail['address']['destination_province']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Notes</div>
                                                    <div class="col-md-7"><b>: {{$detail['address']['destination_description']}}</b></div>
                                                </div>
                                                
                                                <div class="row" style='margin-top: 20px'>
                                                    <div class="col-md-4">Call Whatapps</div>
                                                    <div class="col-md-7"><a href="{{$detail['user']['call']??null}}" target="_blank"><button class="btn green-jungle"><i class="fa fa-whatsapp"></i></button></a></div>
                                                </div>
                                                <br>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4><b>Vendor Info</b></h4>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Vendor Name</div>
                                                    <div class="col-md-7"><b>: {{$detail['outlet']['outlet_name']??null}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Vendor Code</div>
                                                    <div class="col-md-7"><b>: {{$detail['outlet']['outlet_code']??null}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Vendor Phone</div>
                                                    <div class="col-md-7"><b>: {{$detail['outlet']['outlet_phone']??null}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Vendor Address</div>
                                                    <div class="col-md-7"><b>: {{$detail['outlet']['outlet_full_address']??null}}</b></div>
                                                </div>
                                                <div class="row" style='margin-top: 20px'>
                                                    <div class="col-md-4">Call Whatapps</div>
                                                    <div class="col-md-7"><a href="{{$detail['outlet']['call']??null}}" target="_blank"><button class="btn green-jungle"><i class="fa fa-whatsapp"></i></button></a></div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <div class="row">
                                                    <div class="col-md-12">
                                                        <h4><b>Update Ongkos Kirim</b></h4>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <form class="form-horizontal" role="form" action="{{url('transaction/update/ongkir')}}" method="post">  
                                                <div class="row">
                                                    <div class="col-md-4">Status Ongkir</div>
                                                    <div class="col-md-1"  style="text-align: right" >
                                                        <label for="html{{$detail['id_transaction']}}">Vendor</label> 
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="radio" id="html{{$detail['id_transaction']}}" name="status_ongkir" value="0" @if($detail['status_ongkir']==0) checked @endif>
                                                    </div>
                                                    <div class="col-md-1"  style="text-align: right" >
                                                         <label for="htmls{{$detail['id_transaction']}}">ITS</label> 
                                                    </div>
                                                    <div class="col-md-1">
                                                         <input type="radio" id="htmls{{$detail['id_transaction']}}" name="status_ongkir" @if($detail['status_ongkir']==1) checked @endif value="1">
                                                    </div>
                                                   
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Ongkos Kirim</div>
                                                    <div class="col-md-4">
                                                        <input type="text" id="transaction_shipment" class="form-control" name="transaction_shipment" value='{{$detail['transaction_shipment']}}' required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ csrf_field() }}
                                                        
                                                    <input type="hidden" name="id_transaction" value="{{$detail['id_transaction']}}">
                                                        <button type="submit" class="btn green-jungle">Update</button>
                                                    </div>
                                                </div>
                                                </form>
                                    </div>
                                </div>
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <form class="form-horizontal" role="form" action="{{url('transaction/update/qty')}}" method="post">  
                                            @foreach($detail['transaction_products'] as $product)
                                                <div class="row" style="margin-bottom: 3%">
                                                    <div class="col-md-4">
                                                        {{$product['product_name']}}<br>
                                                        {{($product['note']??"")}}
                                                    </div>
                                                    <div class="col-md-2">
                                                        {{$product['product_base_price']}}
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input class="form-control" name="id_transaction_product[]" type="hidden" value="{{$product['id_transaction_product']}}">
                                                        <input class="form-control" min="{{$product['min_transaction']}}" type="number" name="qty[]" value="{{$product['product_qty']}}">
                                                    </div>
                                                    <div class="col-md-3" style="text-align: left">
                                                        <b>{{$product['product_total_price']}}</b>
                                                        @if(!empty($product['discount_all']))
                                                            <b style="color: red"><br>- {{number_format($product['discount_all'],0,",",".")}}</b>
                                                        @endif
                                                    </div>
                                                    @if(count($detail['transaction_products'])>1)
                                                    <div class="col-md-1" style="text-align: right">
                                                        <a class="btn red sweetalert-reject" data-id="{{ $product['id_transaction_product'] }}" data-name="{{ $product['product_name'] }}" data-id_transaction="{{ $detail['id_transaction'] }}"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                            <hr>
                                                <div class="row" style="margin-top: 10px">
                                                    <input type="hidden" name="id_transaction" value="{{$detail['id_transaction']}}">
                                                    <input type="hidden" name="id_transaction_group" value="{{$detail['id_transaction_group']}}">
                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-3" style="text-align: right">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn green-jungle">Update Qty</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">

                                        <div class="row">
                                            <div class="col-md-6" style="text-align: left"><h5><b>PAYMENT</b></h5></div>
                                            <div class="col-md-6" style="text-align: right"></div>
                                        </div>
                                        @foreach($detail['payment_detail'] as $pd)
                                            @if(strpos($pd['text'],"Discount") === false && strpos(strtolower($pd['text']),"point") === false)
                                                <div class="row">
                                                    <div class="col-md-6" style="text-align: left"><h5>{{$pd['text']}}</h5></div>
                                                    <div class="col-md-6" style="text-align: right"><h5>{{$pd['value']}}</h5></div>
                                                </div>
                                            @else
                                                <div class="row" style="color: red">
                                                    <div class="col-md-6" style="text-align: left"><h5>{{$pd['text']}}</h5></div>
                                                    <div class="col-md-6" style="text-align: right"><h5>{{$pd['value']}}</h5></div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6" style="text-align: left"><h5><b>GRAND TOTAL</b></h5></div>
                                            <div class="col-md-6" style="text-align: right"><h5><b>{{$detail['transaction_grandtotal']}}</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="text-align: left"><h5><b>PAYMENT USE</b></h5></div>
                                            <div class="col-md-6" style="text-align: right"><h5><b>@if(!empty($detail['payment'])) {{$detail['payment']}} @else - @endif</b></h5></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-12" style="text-align: left"><h4><b>Delivery Tracking Update</b></h4></div>
                                        </div>
                                        <div class="row">
                                            @foreach($detail['delivery']['delivery_tracking'] as $track)
                                                <ul>
                                                    <li>
                                                        {{$track['description']}}<br>
                                                        {{$track['date']}}<br>
                                                        @if($track['attachment'])
                                                        <img src="{{$track['attachment']}}" height='100'alt="alt"/>
                                                        @endif
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @if($detail['transaction_status_code']==4&&$detail['confirm_delivery']==1)
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                 <form class="form-horizontal" role="form" action="{{url('transaction/confirm/'.$detail['id_transaction'])}}" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <h4>Create Photos</h4>
                                                <div class="form-group">
                                                    <label class="col-md-5 control-label">
                                                        Penerima <span class="required" aria-required="true">*</span>
                                                        <i class="fa fa-question-circle tooltips" data-original-title="Penerima Pengiriman" data-container="body"></i>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="penerima" required>     
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-5 control-label">
                                                        Bukti Pengiriman <span class="required" aria-required="true">*</span>
                                                        <i class="fa fa-question-circle tooltips" data-original-title="Bukti Pengiriman" data-container="body"></i>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                <img src="" alt="">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" id="image" style="max-width: 200px; max-height: 200px;"></div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" class="file" id="fieldphoto" accept="image/*" name="attachment" required>
                                                                </span>

                                                                <a href="javascript:;" id="remove_fieldphoto" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="form-actions">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-offset-5 col-md-7">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <a href="{{url('transaction/reject/'.$detail['id_transaction'])}}" class="btn btn-danger">Reject</a>
                                                    </div>
                                                </div>
                                            </div>
                                         </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                     @if($detail['transaction_status_code']==4&&$detail['confirm_delivery']==1)
                                        <div class="portlet light portlet-fit bordered">
                                             <div class="portlet-body">
                                                 <div class="row">
                                                     <div class="col-md-12">
                                                          <form class="form-horizontal" role="form" action="{{url('transaction/confirm/'.$detail['id_transaction'])}}" method="post" enctype="multipart/form-data">
                                                     <div class="form-body">
                                                         <h4>Create Photos</h4>
                                                         <div class="form-group">
                                                             <label class="col-md-5 control-label">
                                                                 Penerima <span class="required" aria-required="true">*</span>
                                                                 <i class="fa fa-question-circle tooltips" data-original-title="Penerima Pengiriman" data-container="body"></i>
                                                             </label>
                                                             <div class="col-md-4">
                                                                 <input type="text" class="form-control" name="penerima" required>     
                                                             </div>
                                                         </div>
                                                         <div class="form-group">
                                                             <label class="col-md-5 control-label">
                                                                 Bukti Pengiriman (1:1) <span class="required" aria-required="true">*</span>
                                                                 <i class="fa fa-question-circle tooltips" data-original-title="Bukti Pengiriman" data-container="body"></i>
                                                             </label>
                                                             <div class="col-md-4">
                                                                 <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                     <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                         <img src="" alt="">
                                                                     </div>
                                                                     <div class="fileinput-preview fileinput-exists thumbnail" id="image" style="max-width: 200px; max-height: 200px;"></div>
                                                                     <div>
                                                                         <span class="btn default btn-file">
                                                                         <span class="fileinput-new"> Select image </span>
                                                                         <span class="fileinput-exists"> Change </span>
                                                                         <input type="file" class="file" id="fieldphoto" accept="image/*" name="attachment" required>
                                                                         </span>

                                                                         <a href="javascript:;" id="remove_fieldphoto" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>


                                                     </div>
                                                     <div class="form-actions">
                                                         {{ csrf_field() }}
                                                         <div class="row">
                                                             <div class="col-md-offset-5 col-md-7">
                                                                 <button type="submit" class="btn green">Submit</button>
                                                                 <button id="myBtn" class="btn btn-danger">Reject</button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                  </form>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     @else
                                     <div class="portlet-body">
                                         @if($detail['transaction_status_code']==3)
                                             <a href="{{url('transaction/accept/'.$detail['id_transaction'])}}" class="btn btn-success">Accept</a>
                                         @elseif($detail['transaction_status_code']==4&&$detail['confirm_delivery']==0)
                                             <a href="{{url('transaction/request/'.$detail['id_transaction'])}}" class="btn btn-success">Request Delivery</a>
                                         @endif
                                         @if($detail['transaction_status_code']==3||$detail['transaction_status_code']==4)
                                             <button id="myBtn" class="btn btn-danger">Reject</button>
                                     @endif
                                     </div>
                                     @endif
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                </div>
                <div class="tab-pane" id="list_product">
                    @include('transaction::product')
                </div>
            </div>
        </div>
    </div>
    
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                     <form class="form-horizontal" role="form" action="{{url('transaction/reject/')}}" method="post" enctype="multipart/form-data">
                         {{csrf_field()}}
                    <div class="modal-body">
                            <div class="col-6">
                                <label for="jabatan" class="form-label">Reject Reason</label>
                                <textarea class="form-control" type="text" name="reject_reason" id="reject_reason" placeholder="Masukkan Alasan transaksi dibatalkan" required></textarea>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <input type="hidden" value="{{$detail['id_transaction']}}" name="id_transaction">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-batal">Batal</button>
                        <button type="submit" class="btn btn-Danger">Reject</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
@endsection