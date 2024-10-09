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
                                                    <div class="col-md-7"><b>: {{$value['transaction_receipt_number']}}</b></div>
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
                                                        : <span class="badge" style="background-color: {{$codeColor[$value['transaction_status_code']]??'#cccccc'}};">{{$value['transaction_status_text']}}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Time & date</div>
                                                    <div class="col-md-7"><b>: {{$value['transaction_date']}}</b></div>
                                                </div>

                                                @if($value['transaction_status_code'] == 1)
                                                    <div class="row">
                                                        <div class="col-md-4">Reject at</div>
                                                        <div class="col-md-7"><b>: {{$value['transaction_reject_at']}}</b></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">Reject reason</div>
                                                        <div class="col-md-7"><b>: {{$value['transaction_reject_reason']}}</b></div>
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
                                                    <div class="col-md-7"><b>: @if(empty($value['delivery']['delivery_price'])) - @else {{$value['delivery']['delivery_price']}} @endif</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Customer Name</div>
                                                    <div class="col-md-7"><b>: {{$value['address']['destination_name']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Customer Phone</div>
                                                    <div class="col-md-7"><b>: {{$value['address']['destination_phone']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Address</div>
                                                    <div class="col-md-7"><b>: {{$value['address']['destination_address']}} ({{$value['address']['destination_city']}} - {{$value['address']['destination_province']}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Notes</div>
                                                    <div class="col-md-7"><b>: {{$value['address']['destination_description']}}</b></div>
                                                </div>
                                                
                                                <div class="row" style='margin-top: 20px'>
                                                    <div class="col-md-4">Call Whatapps</div>
                                                    <div class="col-md-7"><a href="{{$value['user']['call']??null}}" target="_blank"><button class="btn green-jungle"><i class="fa fa-whatsapp"></i></button></a></div>
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
                                                    <div class="col-md-7"><b>: {{$value['outlet']['outlet_name']??null}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Vendor Code</div>
                                                    <div class="col-md-7"><b>: {{$value['outlet']['outlet_code']??null}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Vendor Phone</div>
                                                    <div class="col-md-7"><b>: {{$value['outlet']['outlet_phone']??null}}</b></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Vendor Address</div>
                                                    <div class="col-md-7"><b>: {{$value['outlet']['outlet_full_address']??null}}</b></div>
                                                </div>
                                                <div class="row" style='margin-top: 20px'>
                                                    <div class="col-md-4">Call Whatapps</div>
                                                    <div class="col-md-7"><a href="{{$value['outlet']['call']??null}}" target="_blank"><button class="btn green-jungle"><i class="fa fa-whatsapp"></i></button></a></div>
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
                                                        <label for="html{{$value['id_transaction']}}">Vendor</label> 
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="radio" id="html{{$value['id_transaction']}}" name="status_ongkir" value="0" @if($value['status_ongkir']==0) checked @endif>
                                                    </div>
                                                    <div class="col-md-1"  style="text-align: right" >
                                                         <label for="htmls{{$value['id_transaction']}}">ITS</label> 
                                                    </div>
                                                    <div class="col-md-1">
                                                         <input type="radio" id="htmls{{$value['id_transaction']}}" name="status_ongkir" @if($value['status_ongkir']==1) checked @endif value="1">
                                                    </div>
                                                   
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Ongkos Kirim</div>
                                                    <div class="col-md-4">
                                                        <input type="text" id="transaction_shipment" class="form-control" name="transaction_shipment" value='{{$value['transaction_shipment']}}' required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ csrf_field() }}
                                                     @if($value['transaction_status_code']==3||$value['transaction_status_code']==4)   
                                                    <input type="hidden" name="id_transaction" value="{{$value['id_transaction']}}">
                                                        <button type="submit" class="btn green-jungle">Update</button>
                                                    @endif</div>
                                                </div>
                                                </form>
                                    </div>
                                </div>
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <form class="form-horizontal" role="form" action="{{url('transaction/update/qty')}}" method="post">  
                                            @foreach($value['transaction_products'] as $product)
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
                                                        <input class="form-control" @if($value['transaction_status_code']!=3) disabled @endif  min="{{$product['min_transaction']}}" type="number" name="qty[]" value="{{$product['product_qty']}}">
                                                    </div>
                                                    <div class="col-md-3" style="text-align: left">
                                                        <b>{{$product['product_total_price']}}</b>
                                                        @if(!empty($product['discount_all']))
                                                            <b style="color: red"><br>- {{number_format($product['discount_all'],0,",",".")}}</b>
                                                        @endif
                                                    </div>
                                                    @if(count($value['transaction_products'])>1)
                                                    <div class="col-md-1" style="text-align: right">
                                                        <a class="btn red sweetalert-reject" data-id="{{ $product['id_transaction_product'] }}" data-name="{{ $product['product_name'] }}" data-id_transaction="{{ $value['id_transaction'] }}"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                            <hr>
                                                @if($value['transaction_status_code']==3) 
                                                <div class="row" style="margin-top: 10px">
                                                    <input type="hidden" name="id_transaction" value="{{$value['id_transaction']}}">
                                                    <input type="hidden" name="id_transaction_group" value="{{$value['id_transaction_group']}}">
                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-3" style="text-align: right">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn green-jungle">Update Qty</button>
                                                    </div>
                                                </div>
                                                @endif
                                        </form>
                                    </div>
                                </div>
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">

                                        <div class="row">
                                            <div class="col-md-6" style="text-align: left"><h5><b>PAYMENT</b></h5></div>
                                            <div class="col-md-6" style="text-align: right"></div>
                                        </div>
                                        @foreach($value['payment_detail'] as $pd)
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
                                            <div class="col-md-6" style="text-align: right"><h5><b>{{$value['transaction_grandtotal']}}</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="text-align: left"><h5><b>PAYMENT USE</b></h5></div>
                                            <div class="col-md-6" style="text-align: right"><h5><b>@if(!empty($value['payment'])) {{$value['payment']}} @else - @endif</b></h5></div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="portlet light portlet-fit bordered">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: left"><h4><b>Delivery Tracking Update</b></h4></div>
                    </div>
                    <div class="row">
                        @foreach($value['delivery']['delivery_tracking'] as $track)
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
            
            @if(isset($value['contact_kurir']))
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: left"><h4><b>Contact Courier</b></h4></div>
                    </div>
                    <div class="row">
                       <div class="col-md-4" ><h2><a href="{{$value['contact_kurir']??null}}" target="_blank"><i class="fa fa-whatsapp"></i></a></h2></div>
                           
                    </div>
                </div>
            </div>
            @endif
            
             <div class="portlet light portlet-fit bordered">
                    @if($value['transaction_status_code']==4&&$value['confirm_delivery']==1)

                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                         <form class="form-horizontal" role="form" action="{{url('transaction/confirm/'.$value['id_transaction'])}}" method="post" enctype="multipart/form-data">
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
                    @elseif($value['transaction_status_code']==4&&$value['confirm_delivery']==0)
                           <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                         <form class="form-horizontal" role="form" action="{{url('transaction/request/'.$value['id_transaction'])}}" method="post" enctype="multipart/form-data">
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
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">
                                                Bukti Pengiriman <span class="required" aria-required="true">*</span>
                                                <i class="fa fa-question-circle tooltips" data-original-title="Bukti Pengiriman dari Vendor ke Kurir" data-container="body"></i>
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
                    @else
                    <div class="portlet-body">
                        @if($value['transaction_status_code']==3)
                            <a href="{{url('transaction/accept/'.$value['id_transaction'])}}" class="btn btn-success">Accept</a>
                        
                        @endif
                        @if($value['transaction_status_code']==3||$value['transaction_status_code']==4)
                            <button id="myBtn" class="btn btn-danger">Reject</button>
                        @endif
                    </div>
                    @endif
            </div>
    </div>
    <div class="col-md-1"></div>
</div>