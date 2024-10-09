<?php
    use App\Lib\MyHelper;
    $grantedFeature     = session('granted_features');
 ?>
@section('page-style')
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-plugin')
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
@endsection

@section('page-script')
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/form-repeater.js') }}" type="text/javascript"></script>
@endsection

@extends('layouts.main')

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

    <h1 class="page-title" style="margin-top: 0px;">
        {{$sub_title}}
    </h1>
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
                                    <h4><b>Withdrawal Info</b></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">Nominal</div>
                                <div class="col-md-7"><b>: {{abs($detail['nominal'])}}</b></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">Fee</div>
                                <div class="col-md-7"><b>: {{abs($detail['fee'])}}</b></div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">Order Status</div>
                                <div class="col-md-7">
                                    <?php
                                    $codeColor = [
                                        "Rejected" => '#ff0000',
                                        "Pending" => '#ffd633',
                                        "Completed" => '#ffd633',
                                    ];
                                    ?>
                                        : <span class="badge" style="background-color: {{$codeColor[$detail['status']]??'#cccccc'}};">{{$detail['status']}}</span>
                                </div>
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
                                <div class="col-md-4">Vendor Code</div>
                                <div class="col-md-7"><b>:  {{$detail['data_outlet']['outlet_code']}} </b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Vendor Name</div>
                                <div class="col-md-7"><b>:  {{$detail['data_outlet']['outlet_name']}} </b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Vendor Phone</div>
                                <div class="col-md-7"><b>:  {{$detail['data_outlet']['outlet_phone']}} </b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Vendor Email</div>
                                <div class="col-md-7"><b>:  {{$detail['data_outlet']['outlet_email']}} </b></div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><b>Bank Info</b></h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Bank Name</div>
                                <div class="col-md-7"><b>:  {{$detail['data_bank_account']['bank_name']}} </b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Beneficiary Name</div>
                                <div class="col-md-7"><b>:  {{$detail['data_bank_account']['beneficiary_name']}} </b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Beneficiary Account</div>
                                <div class="col-md-7"><b>:  {{$detail['data_bank_account']['beneficiary_account']}} </b></div>
                            </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4><b>Export Tranasction</b></h4>
                                    <hr>
                                </div>
                                <div class="col-md-7"><a href="{{url('merchant/withdrawal/export/'.$detail['id_merchant_log_balance'])}}" class="btn green-jungle"><i class="fa fa-download"></i></a></div>
                            </div>
                            
                            @if($detail['status'] == 'Pending' || empty($detail['status']))
                            <div class="row">
                                <form class="form-horizontal" role="form" action="{{url('merchant/withdrawal/completed')}}" method="post">  
                                <input type="hidden" name="id_merchant_log_balance" value="{{$detail['id_merchant_log_balance']}}">
                                    <div class="modal-footer" style="text-align: center">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn green-jungle">Completed</button>
                                    </div>
                                </form>     
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="col-md-1"></div>
    </div>

    <br>
    <div class="portlet card_ light bordered">
         <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col"> Customer Name </th>
            <th scope="col"> Customer Phone </th>
            <th scope="col"> Customer Email </th>
            <th scope="col"> Receipt Number </th>
            <th scope="col"> Grand Total </th>
            <th scope="col"> Payment Status </th>
            <th scope="col"> Request Date </th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($detail['transanction']))
            @foreach($detail['transanction'] as $key=>$detail)
                <tr>
                    <td>{{$detail['name']}}</td>
                    <td>{{$detail['phone']}}</td>
                    <td>{{$detail['email']}}</td>
                    <td>{{$detail['transaction_receipt_number']}}</td>
                    <td>Rp {{number_format(abs($detail['transaction_grandtotal']),0,",",".")}}</td>
                    <td>{{$detail['transaction_status']}}</td>
                    <td>{{$detail['transaction_payment_status']}}</td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="10" style="text-align: center">Data Not Available</td></tr>
        @endif
        </tbody>
    </table>
    </div>
   
    <br>
@endsection