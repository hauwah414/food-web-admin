@extends('layouts.main')


@section('page-style')
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/datemultiselect/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/datemultiselect/jquery-ui.multidatespicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-script')
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-bootstrap-select.min.js') }}"  type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script type="text/javascript">

    $(document).ready(function() {
        
        function number(id){
            $(id).inputmask("remove");
            $(id).inputmask({
                mask: "9999 9999 999999",
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
        number("#no_hp");
        
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
        $(".file").change(function(e) {
            var widthImg  = 300;
            var heightImg = 300;

            var _URL = window.URL || window.webkitURL;
            var image, file;

            if ((file = this.files[0])) {
                image = new Image();

                image.onload = function() {
//                    if (this.width ==  this.height ) {
//                        // image.src = _URL.createObjectURL(file);
//                        //    $('#formimage').submit()
//                    }
//                    else {
//                        toastr.warning("Please check dimension of your photo. Dimension Ration 1:1");
//                        $('#image').children('img').attr('src', 'https://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image');
//                        $("#remove_fieldphoto").trigger( "click" );
//
//                    }
                };

                image.src = _URL.createObjectURL(file);
            }

        });
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
                                <div class="col-md-4">Time & date</div>
                                <div class="col-md-7"><b>: {{$detail['transaction_date']}}</b></div>
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
                            <br>
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
                            
                            <div class="row">
                                <div class="col-md-4">Call Whatapps</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" ><h3><a href="{{$detail['user']['call']??null}}" target="_blank"><i class="fa fa-whatsapp"></i></a></h3></div>
                            </div>
                           
                            <br>
                            <br>
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
                            <div class="row">
                                <div class="col-md-4">Call Whatapps</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" ><h3><a href="{{$detail['outlet']['call']??null}}" target="_blank"><i class="fa fa-whatsapp"></i></a></h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-body">
                    @foreach($detail['transaction_products'] as $product)
                        <div class="row" style="margin-bottom: 3%">
                            <div class="col-md-4">
                                {{$product['product_name']}}<br>
                                @if(!empty($product['need_recipe_status']))<b style="color: red">(Need recipe doctor)</b><br>@endif
                                @if(!empty($product['variants']))
                                    {{($product['variants']??"")}}<br>
                                @endif
                                {{($product['note']??"")}}
                            </div>
                            <div class="col-md-2">
                                <p>x {{$product['product_qty']}}</p>
                            </div>
                            <div class="col-md-2">
                                {{$product['product_base_price']}}
                            </div>
                            <div class="col-md-4" style="text-align: right">
                                <b>{{$product['product_total_price']}}</b>
                                @if(!empty($product['discount_all']))
                                    <b style="color: red"><br>- {{number_format($product['discount_all'],0,",",".")}}</b>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <hr>
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
                                    <img src="{{$track['attachment']}}" height='100' alt="alt"/>
                                    @endif
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            
            @if(isset($detail['contact_kurir']))
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: left"><h4><b>Contact Courier</b></h4></div>
                    </div>
                    <div class="row">
                       <div class="col-md-4" ><h2><a href="{{$detail['contact_kurir']??null}}" target="_blank"><i class="fa fa-whatsapp"></i></a></h2></div>
                           
                    </div>
                </div>
            </div>
            @endif
            
             <div class="portlet light portlet-fit bordered">
                @if($detail['transaction_status_code']==4&&$detail['confirm_delivery']==1)
                  
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
                                            <button id="myBtn" class="btn btn-danger">Reject</button>
                                        </div>
                                    </div>
                                </div>
                             </form>
                                </div>
                            </div>
                        </div>
                @elseif($detail['transaction_status_code']==4&&$detail['confirm_delivery']==0)
                       <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                     <form class="form-horizontal" role="form" action="{{url('transaction/request/'.$detail['id_transaction'])}}" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <h4>Request Delivery</h4>
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">
                                            Contact Kurir <span class="required" aria-required="true">*</span>
                                            <i class="fa fa-question-circle tooltips" data-original-title="Contact Kurir" data-container="body"></i>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" id="no_hp" class="form-control" name="pengirim" required>     
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
                @else
                <div class="portlet-body">
                    @if($detail['transaction_status_code']==3)
                        <a href="{{url('transaction/accept/'.$detail['id_transaction'])}}" class="btn btn-success">Accept</a>
                    @else
                    @endif
                    @if($detail['transaction_status_code']==3||$detail['transaction_status_code']==4)
                        <button id="myBtn" class="btn btn-danger">Reject</button>
                    @endif
                </div>
                @endif
                
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