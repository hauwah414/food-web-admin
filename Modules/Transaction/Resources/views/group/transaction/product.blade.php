<div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <form class="form-horizontal" role="form" action="{{url('transaction/add/item')}}" method="post">  
                                            @foreach($value['item'] as $key =>$products)
                                                <div class="row" style="margin-bottom: 3%">
                                                    <div class="col-md-1">
                                                        <br>
                                                         <input type="checkbox" id="product{{$products['id_product']}}" name="item[{{$key}}][id_product]" value="{{$products['id_product']}}">
                                                    </div>
                                                    <div class="col-md-2">
                                                         <img src="{{$products['image']}}" height="100px" width="100px">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <b><br>{{$products['product_type']}}</b>
                                                        <input type="hidden" name="item[{{$key}}][custom]" value="@if($products['product_type'] == "box") 1 @else 0 @endif">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <b><br>{{$products['product_name']}}</b>
                                                    </div>
                                                        @if($products['product_type'] == "box")
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <h4><b>Product :</b></h4>
                                                                    </div>
                                                                </div>
                                                                @foreach($products['product_custom'] as $custom)
                                                                    <div class="row" style="margin-bottom: 3%">
                                                                        <div class="col-md-1">
                                                                           <input type="checkbox" id="custom{{$custom['id_product']}}" name="item[{{$key}}][item][]" value="{{$custom['id_product']}}">
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            {{$custom['product_name']}} - <b style="color: blue">{{number_format($custom['product_price'],0,",",".")}}</b>
                                                                        </div>
                                                                    </div>
                                                                 @endforeach
                                                                 <div class="row">
                                                                <div class="col-md-8">
                                                                    <h4><b>Cara Penyajian :</b></h4>
                                                                </div>
                                                            </div>
                                                                @foreach($products['serving_method'] as $serv)
                                                                    <div class="row" style="margin-bottom: 3%">
                                                                        <div class="col-md-1">
                                                                           <input type="radio" id="custom{{$serv['id_product_serving_method']}}" name="item[{{$key}}][id_product_serving_method]" value="{{$serv['id_product_serving_method']}}">
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            {{$serv['serving_name']}} - <b style="color: blue">{{number_format($serv['unit_price'],0,",",".")}}</b> - <b style="color: orange">{{$serv['package']}}</b>
                                                                        </div>
                                                                    </div>
                                                                 @endforeach
                                                                 
                                                            </div>    
                                                             
                                                        @else
                                                            <div class="col-md-4">
                                                                <b style="color: blue"><br>{{number_format($products['product_price'],0,",",".")}}</b>
                                                            </div>
                                                        @endif
                                                    <div class="col-md-2">
                                                        <br><input class="form-control" min="{{$products['min_transaction']}}" type="number" name="item[{{$key}}][qty]" value="{{$products['min_transaction']}}">
                                                    </div>
                                                </div>
                                            <hr>
                                            @endforeach
                                                <div class="row" style="margin-top: 10px">
                                                    <input type="hidden" name="id_transaction" value="{{$value['id_transaction']}}">
                                                    <input type="hidden" name="id_transaction_group" value="{{$value['id_transaction_group']}}">
                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-3">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn green-jungle">Tambah Menu</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>