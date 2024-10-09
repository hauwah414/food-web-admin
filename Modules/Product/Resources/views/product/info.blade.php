<?php
    use App\Lib\MyHelper;
    $grantedFeature     = session('granted_features');

 ?>
<form class="form-horizontal" id="formWithPrice" role="form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-3 control-label">Code
            </label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="product_code" value="{{$detail['product_code']}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
               Main Image <span class="required" aria-required="true">* <br>(1:1) </span>
                            <i class="fa fa-question-circle tooltips" data-original-title="Logo product ukuran rasio 1:1" data-container="body"></i>
            </label>
            <div class="col-md-8">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                        <img src="{{$detail['image']['url_product_photo']??''}}" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" id="imageproduct" style="max-width: 200px; max-height: 200px;"></div>
                    <div>
                                <span class="btn default btn-file">
                                <span class="fileinput-new"> Select image </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="file" class="file" id="fieldphoto" accept="image/*" name="photo">
                                </span>
                        <a href="javascript:;" id='remove_fieldphoto' class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="id_product_photo" value="{{$detail['image']['id_product_photo']??null}}">
        <div class="form-group">
            <label for="multiple" class="control-label col-md-3">Category <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Pilih Kategori Produk" data-container="body"></i>
            </label>
            <div class="col-md-6">
                <div class="input-icon right">
                    <select id="multiple" class="form-control select2-multiple" name="id_product_category" data-placeholder="Select category" required>
                        <option></option>
                        @if (!empty($parent))
                            @foreach($parent as $suw)
                                    <optgroup label="{{ $suw['product_category_name'] }}">
                                        @foreach ($suw['category_child']??[] as $subChild)
                                            <option value="{{ $subChild['id_product_category'] }}" @if($detail['id_product_category'] == $subChild['id_product_category']) selected @endif>{{ $subChild['product_category_name'] }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Name <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Nama Produk" data-container="body"></i>
            </label>
            <div class="col-md-6">
                <div class="input-icon right">
                    <input type="text" class="form-control" name="product_name" placeholder="Name" required value="{{$detail['product_name']}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Product Visible
                <i class="fa fa-question-circle tooltips" data-original-title="Setting apakah produk akan ditampilkan di aplikasi" data-container="body"></i>
            </label>
            <div class="input-icon right">
                <div class="col-md-2">
                    <div class="md-radio-inline">
                        <div class="md-radio">
                            <input type="radio" id="radio1" name="product_visibility" class="md-radiobtn req-type" value="Visible" required @if($product[0]['product_visibility'] == 'Visible') checked @endif>
                            <label for="radio1">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Visible</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="md-radio-inline">
                        <div class="md-radio">
                            <input type="radio" id="radio2" name="product_visibility" class="md-radiobtn req-type" value="Hidden" required @if($product[0]['product_visibility'] == 'Hidden') checked @endif>
                            <label for="radio2">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Hidden </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="multiple" class="control-label col-md-3">Description
                <i class="fa fa-question-circle tooltips" data-original-title="Deskripsi Produk" data-container="body"></i>
            </label>
            <div class="col-md-6">
                <div class="input-icon right">
                    <textarea name="product_description" class="form-control" style="height: 100px">{{$detail['product_description']}}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Status Pemesanan
                <i class="fa fa-question-circle tooltips" data-original-title="Pemesanan product dapat dilkaukan secara preorder(hari) atau pesan langsung*(jam)" data-container="body"></i>
            </label>
            <div class="input-icon right">
                <div class="col-md-2">
                    <div class="md-radio-inline">
                        <div class="md-radio">
                            <input type="radio" id="radio3"  onchange="statusPreorder(1)" @if($product[0]['status_preorder'] == '1') checked @endif name="status_preorder" class="md-radiobtn req-type" value="1" required checked>
                            <label for="radio3">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Preorder</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="md-radio-inline">
                        <div class="md-radio">
                            <input type="radio" id="radio4" onchange="statusPreorder(0)" name="status_preorder" @if($product[0]['status_preorder'] == '0') checked @endif class="md-radiobtn req-type" value="0" required>
                            <label for="radio4">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Pesan Langsung </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" id="min_transaction">
            <label class="col-md-3 control-label">Lama Pemesanan <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Lama pemesanan product" data-container="body"></i>
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="number" class="form-control" name="value_preorder" value="{{$detail['value_preorder']??0}}" placeholder="Lama pemesanan" required>
                    <span class="input-group-addon" id="status_preorder">
                        @if($product[0]['status_preorder'] == '1') Hari @else Jam @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group" id="min_transaction">
            <label class="col-md-3 control-label">Minimum Transaction <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Minimal jumlah produk yang di beli" data-container="body"></i>
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control onlynumber" name="min_transaction" placeholder="Minimum Transaction" value="{{$detail['min_transaction']??0}}" required>
                    <span class="input-group-addon">
                        qty
                    </span>
                </div>
            </div>
        </div>
        @if($detail['product_type']=='product')
        <div class="form-group">
            <label class="col-md-3 control-label">Base Price <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Base Price Product, jika memiliki variant maka harga base price akan diambil dari harga terendah variant" data-container="body"></i>
            </label>
            <div class="col-md-6">
                <div class="input-icon right">
                    <div class="input-group">
                        <span class="input-group-addon">
                        Rp
                        </span>
                        <input type="text" id="base_price" class="form-control price" name="base_price" placeholder="Base Price" value="{{$detail['base_price']}}" @if(!empty($variant_price)) readonly @else required @endif>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="form-group" >
            <label for="multiple" class="control-label col-md-3">Product
                <i class="fa fa-question-circle tooltips" data-original-title="Tipe box akan menambahkan product yang akan terisi di box" data-container="body"></i>
            </label>
            <div class="col-md-6">
                <select class="form-control select2" id="product" name="product_custom_group[]" multiple>
                    @foreach($detail['product'] as $value)
                    <option value="{{$value['id_product']}}" @if(in_array($value['id_product'],$detail['product_custom_group'])) selected @endif>{{$value['product_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group" id="div_wholesaler">
            <label class="col-md-3 control-label">Serving Method
                <i class="fa fa-question-circle tooltips" data-original-title="Cara penyajian type box" data-container="body"></i>
            </label>
           
            <div class="col-md-8">
                <a onclick="addWholesaler()" class="btn btn-sm yellow" style="margin-bottom: 2%">Add Serving Method</a>
                @foreach($detail['serving_method'] as $key => $value)
                    <div class="row" id="wholesaler_{{$key+1}}" style="margin-bottom: 0.5%">
                        <input type="hidden" class="form-control" name="serving_method[{{$key+1}}][id_product_serving_method]" value="{{$value['id_product_serving_method']}}">
                        <div class="col-md-3">Name<br>
                            <input type="text" class="form-control" name="serving_method[{{$key+1}}][serving_name]" value="{{$value['serving_name']}}"></div>
                        <div class="col-md-3">Price<br>
                            <input type="number" class="form-control" name="serving_method[{{$key+1}}][unit_price]" value="{{$value['unit_price']}}">
                        </div>
                        <div class="col-md-3">Package<br>
                            <select class="form-control" name="serving_method[{{$key+1}}][package]">
                                <option @if($value['package']=='all') selected @endif value="all">All</option>
                                <option value="pcs" @if($value['package']=='pcs') selected @endif>PCS</option>
                            </select>
                        </div>
                        <div class="col-md-3"><br><a class="btn btn-danger" onclick="deleteWholesaler({{$key+1}})"><i class="fa fa-trash"></i></a></div>
                    </div>
                @endforeach
                <div id="wholesaler">
                </div>
            </div>
        </div>
        @endif
    </div>
    <input type="hidden" name="id_product" value="{{ $detail['id_product'] }}">

    @if(MyHelper::hasAccess([51], $grantedFeature))
        <div class="form-actions">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-offset-3 col-md-8">
                    <button type="submit" id="submit" class="btn green">Update</button>
                </div>
            </div>
        </div>
    @endif
</form>