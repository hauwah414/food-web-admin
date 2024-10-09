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
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-4">Receipt Number</div>
                                <div class="col-md-7"><b>: {{$detail['group']['transaction_receipt_number']}}</b></div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-4">Jenis Pembayaran</div>
                                <div class="col-md-7"><b>: {{$detail['group']['transaction_payment_type']}}</b></div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-4">Status Pembayaran</div>
                                <div class="col-md-7"><b>: {{$detail['group']['transaction_payment_status']}}</b></div>
                            </div>
                            <hr>
                            <form class="form-horizontal" role="form" action="{{url('transaction/update/sumber-pembelian')}}" method="post">  
                            <div class="row">
                                <div class="col-md-4">Tujuan Pembelian</div>
                                <div class="col-md-4"><input type="text" class="form-control" 
                                                             name="tujuan_pembelian" placeholder="From"
                                                             value="{{$detail['group']['tujuan_pembelian']}}" required></div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-4">Sumber Dana</div>
                                <div class="col-md-4"><input type="text" class="form-control"
                                                             name="sumber_dana" placeholder="From"  
                                                             value="{{$detail['group']['sumber_dana']}}" required></div>
                            </div>
                                @if($detail['group']['transaction_payment_status'] == "Pending")
                            <div class="row" style="margin-top: 10px">
                                <input type="hidden" name="id_transaction_group" value="{{$detail['group']['id_transaction_group']}}">
                                <div class="col-md-4"></div>
                                <div class="col-md-4" style="text-align: right">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn green-jungle">Update</button>
                                </div>
                            </div>
                                @endif
                            </form>

                        </div>
                    </div>
            </div>
            </div>
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-body">

                    <div class="row">
                        <div class="col-md-6" style="text-align: left"><h5><b>PAYMENT</b></h5></div>
                        <div class="col-md-6" style="text-align: right"></div>
                    </div>
                    <div class="row">
                            <div class="col-md-6" style="text-align: left"><h5>Subtotal</h5></div>
                            <div class="col-md-6" style="text-align: right"><h5>Rp {{number_format($detail['group']['transaction_subtotal'],0,",",".")}}</h5></div>
                        </div>
                    <div class="row">
                            <div class="col-md-6" style="text-align: left"><h5>Total Biaya Pengiriman</h5></div>
                            <div class="col-md-6" style="text-align: right"><h5>Rp {{number_format($detail['group']['transaction_shipment'],0,",",".")}}</h5></div>
                        </div>
                    <div class="row">
                            <div class="col-md-6" style="text-align: left"><h5>Total Sharing Profit</h5></div>
                            <div class="col-md-6" style="text-align: right"><h5>Rp {{number_format($detail['group']['transaction_service'],0,",",".")}}</h5></div>
                        </div>
                    <div class="row">
                            <div class="col-md-6" style="text-align: left"><h5>COGS</h5></div>
                            <div class="col-md-6" style="text-align: right"><h5>Rp {{number_format($detail['group']['transaction_cogs'],0,",",".")}}</h5></div>
                        </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6" style="text-align: left"><h5><b>GRAND TOTAL</b></h5></div>
                        <div class="col-md-6" style="text-align: right"><h5><b>Rp {{number_format($detail['group']['transaction_grandtotal'],0,",",".")}}</b></h5></div>
                    </div>

                </div>
            </div>
            
            <div class="portlet card_ light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-red sbold uppercase">Transaction</span>
                    </div>
                </div>
                <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Receipt Number</th>
                                <th>Receipt Number Group</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Vendor</th>
                                <th>Tanggal Pengantaran</th>
                                <th>Subtotal</th>
                                <th>Biaya Pengiriman</th>
                                <th>Total COGS</th>
                                <th>Sharing Profit</th>
                                <th>Grandtotal</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($list))
                                @foreach($list as $res)
                                    <tr>
                                        <td>{{ $res['transaction_receipt_number'] }}</td>
                                        <td>{{ $res['transaction_group_receipt_number'] }}</td>
                                         <td>
                                            {{$res['user_name']}} </br>
                                            {{$res['user_phone']}} </br>
                                            {{$res['user_email']}} </br>
                                        </td>
                                        <td>
                                            {{$res['outlet_code']}} </br>
                                            {{$res['outlet_name']}} </br>
                                            {{$res['outlet_phone']}} </br>
                                        </td>
                                       <td>{{ date('d F Y H:i', strtotime($res['transaction_date'])) }}</td>
                                        <td>{{number_format($res['transaction_subtotal'],0,",",".")}}</td>
                                        <td>{{number_format($res['transaction_shipment'],0,",",".")}}</td>
                                        <td>{{number_format($res['transaction_cogs'],0,",",".")}}</td>
                                        <td>{{number_format($res['transaction_service'],0,",",".")}}</td>
                                        <td>{{number_format($res['transaction_grandtotal'],0,",",".")}}</td>
                                        <td><span class="badge badge-sm {{$codeColor[$res['transaction_status_code']]??'badge-default'}}" @if($res['transaction_status_code'] == 6) style="background-color: #28a745;" @endif>{{ $res['transaction_status_text'] }}</span></td>
                                        <td>
                                            @if(MyHelper::hasAccess([39], $grantedFeature))
                                                <a class="btn btn-block yellow btn-xs" href="{{ url('transaction/detail', $res['id_transaction']) }}"><i class="icon-pencil"></i> Detail </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                     <br>
                </div>
            </div>
        </div>
    </div>