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
    <script type="text/javascript">
    var fee = 0;
    $(document).ready(function() {
        $('.summernote').summernote({
            placeholder: 'Product Description',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['misc', ['fullscreen', 'codeview', 'help']], ['height', ['height']]
            ],
            callbacks: {
                onImageUpload: function(files){
                    sendFile(files[0], $(this).attr('id'));
                },
                onMediaDelete: function(target){
                    var name = target[0].src;
                    token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        type: 'post',
                        data: 'filename='+name+'&_token='+token,
                        url: "{{url('summernote/picture/delete/product')}}",
                        success: function(data){
                            // console.log(data);
                        }
                    });
                }
            }
        });
    });


    $('.onlynumber').keypress(function (e) {
        var regex = new RegExp("^[0-9]");
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
    $(".file").change(function(e) {
            var widthImg  = 300;
            var heightImg = 300;

            var _URL = window.URL || window.webkitURL;
            var image, file;

            if ((file = this.files[0])) {
                image = new Image();

                image.onload = function() {
                    if (this.width == this.height) {
                        // image.src = _URL.createObjectURL(file);
                        //    $('#formimage').submit()
                    }
                    else {
                        toastr.warning("Please check dimension of your photo.");
                        $('#image').children('img').attr('src', 'https://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image');
                        $("#remove_fieldphoto").trigger( "click" );

                    }
                };

                image.src = _URL.createObjectURL(file);
            }

        });
    function sendFile(file, id){
        token = "<?php echo csrf_token(); ?>";
        var data = new FormData();
        data.append('image', file);
        data.append('_token', token);
        // document.getElementById('loadingDiv').style.display = "inline";
        $.ajax({
            url : "{{url('summernote/picture/upload/product')}}",
            data: data,
            type: "POST",
            processData: false,
            contentType: false,
            success: function(url) {
                if (url['status'] == "success") {
                    $('#'+id).summernote('editor.saveRange');
                    $('#'+id).summernote('editor.restoreRange');
                    $('#'+id).summernote('editor.focus');
                    $('#'+id).summernote('insertImage', url['result']['pathinfo'], url['result']['filename']);
                }
                // document.getElementById('loadingDiv').style.display = "none";
            },
            error: function(data){
                // document.getElementById('loadingDiv').style.display = "none";
            }
        })
    }

    $('.price').each(function() {
        var input = $(this).val();
        var input = input.replace(/[\D\s\._\-]+/g, "");
        input = input ? parseInt( input, 10 ) : 0;

        $(this).val( function() {
            return ( input === 0 ) ? "" : input.toLocaleString( "id" );
        });
    });

    $( ".price" ).on( "keyup", numberFormat);
    function numberFormat(event){
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {
            return;
        }

        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
            return;
        }
        var $this = $( this );
        var input = $this.val();
        var input = input.replace(/[\D\s\._\-]+/g, "");
        input = input ? parseInt( input, 10 ) : 0;

        $this.val( function() {
            return ( input === 0 ) ? "" : input.toLocaleString( "id" );
        });
    }

    $( ".price" ).on( "blur", checkFormat);
    function checkFormat(event){
        var data = $( this ).val().replace(/[($)\s\._\-]+/g, '');
        if(!$.isNumeric(data)){
            $( this ).val("");
        }
    }

    $('#checkbox-variant').on('ifChanged', function(event) {
        if(this.checked) {
            $('#show_product').show();
            $('#div_wholesaler').show();
            $("input[name=base_price]").val('');
            $("input[name=base_price]").prop('disabled', true);
            $('input[name=base_price]').prop('required',false);

            $('#id_cogs').hide();

        }else{
            $('#show_product').hide();
            $('#div_wholesaler').hide();
            $("input[name=base_price]").val(0);
            $("input[name=base_price]").prop('disabled', false);
            $('input[name=base_price]').prop('required',true);

            
            $('input[name=id_product]').val('');
            $('input[name=id_product]').prop('disabled', false);
            $('input[name=id_product]').prop('required',true);
            $('#id_cogs').show();
        }
    });
    
    $('#id_outlet').change(function() {
            $('#product').empty();
            $('#product').prop('disabled', true);
            var id_outlet   = $('#id_outlet').val();
            let token = "{{ csrf_token() }}";
            fee   	= $(this).find(':selected').data('fee');
            base_price = $('#base_price').val();
            base_price = base_price.replace(/\./g, '');   
            cogs = Math.floor(base_price * (100-fee) / 100);
            $('#cogs').val(cogs);
            $('#view_cogs').val(cogs);
            
            
            $.ajax({
                type    : "POST",
                url     : "<?php echo url('product/merchant')?>",
                data    : "_token="+token+"&id_outlet="+id_outlet,
                success : function(result) {
                    if (result['status'] == "success") {
                        $('#product').prop('disabled', false);

                        var product           = result['result'];
                        var selectProduct = '<option value=""></option>';

                        for (var i = 0; i < product.length; i++) {
                            selectProduct += '<option value="'+product[i]['id_product']+'">'+product[i]['product_name']+'</option>';
                        }

                        $('#product').html(selectProduct);
                    }
                    else {
                        $('#product').prop('disabled', true);
                    }
                }
            });
        });
    $('#base_price').keyup(function() {
      base_price = $('#base_price').val();
      base_price = base_price.replace(/\./g, '');   
      cogs = Math.floor(base_price * (100-fee) / 100);
      $('#cogs').val(cogs);
      $('#view_cogs').val(cogs);
    });
    var j = 0;
    function addWholesaler(){
        var html = '<div class="row" id="wholesaler_'+j+'" style="margin-bottom: 0.5%">' +
            '<div class="col-md-3">Name<br><input type="text" class="form-control" name="serving_method['+j+'][serving_name]"></div>'+
            '<div class="col-md-3">Price<br><input type="text" class="form-control price" name="serving_method['+j+'][unit_price]"></div>'+
            '<div class="col-md-3">Package<br><select class="form-control" name="serving_method['+j+'][package]"><option value="all">All</option><option value="pcs">PCS</option></select></div>'+
            '<div class="col-md-3"><br><a class="btn btn-danger" onclick="deleteWholesaler('+j+')"><i class="fa fa-trash"></i></a></div>'+
            '</div>';

        $('#wholesaler').append(html);

        $('.onlynumber').keypress(function (e) {
            var regex = new RegExp("^[0-9]");
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
        j++;
    }
    function statusPreorder(id){
       if(id == 1){
           $('#status_preorder').html('Hari');
       }else{
           $('#status_preorder').html('Jam');
       }
    }
    function deleteWholesaler(id){
        $('#wholesaler_'+id).remove();
    }

    var variantWholesalerIndex = 0;

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
                <span class="caption-subject sbold uppercase font-blue">New Product</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group">
                        <div class="input-icon right">
                            <label class="col-md-3 control-label">
                                Outlet
                                <span class="required" aria-required="true"> * </span>
                                <i class="fa fa-question-circle tooltips" data-original-title="Pilih outlet" data-container="body"></i>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <select id="id_outlet" name="id_outlet" class="form-control select2-multiple" data-placeholder="Select Outlet" required>
                                <option></option>
                                @foreach($outlets as $suw)
                                    <option value="{{ $suw['id_outlet'] }}" data-fee="{{ $suw['fee'] }}">{{ $suw['outlet_code'] }} - {{ $suw['outlet_name'] }}</option>
                                @endforeach
                            </select>
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
                                    <img src="" alt="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" id="imageproduct" style="max-width: 200px; max-height: 200px;"></div>
                                <div>
                                <span class="btn default btn-file">
                                <span class="fileinput-new"> Select image </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="file" class="file" id="fieldphoto" accept="image/*" name="photo" required>
                                </span>
                                    <a href="javascript:;" id='remove_fieldphoto' class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            @foreach ($suw['category_child']??[] as $child)
                                               <option value="{{ $child['id_product_category'] }}">{{ $child['product_category_name'] }}</option>
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
                                <input type="text" class="form-control" name="product_name" placeholder="Name" required>
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
                                        <input type="radio" id="radio1" name="product_visibility" class="md-radiobtn req-type" value="Visible" required checked>
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
                                        <input type="radio" id="radio2" name="product_visibility" class="md-radiobtn req-type" value="Hidden" required>
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
                            <span class="required" aria-required="true"> * </span>
                            <i class="fa fa-question-circle tooltips" data-original-title="Deskripsi Produk" data-container="body"></i>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <textarea name="product_description" id="pro_text" class="form-control" style="height: 100px" required></textarea>
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
                                        <input type="radio" id="radio3"  onchange="statusPreorder(1)" name="status_preorder" class="md-radiobtn req-type" value="1" required checked>
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
                                        <input type="radio" id="radio4" onchange="statusPreorder(0)" name="status_preorder" class="md-radiobtn req-type" value="0" required>
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
                                <input type="number" class="form-control" name="value_preorder" placeholder="Lama pemesanan" required>
                                <span class="input-group-addon" id="status_preorder">
                                    Hari
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
                                <input type="number" class="form-control" name="min_transaction" placeholder="Minimum Transaction" required>
                                <span class="input-group-addon">
                                    Qty
                                </span>
                            </div>
                        </div>
                    </div>

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
                                    <input type="text" id="base_price" class="form-control price" name="base_price" placeholder="Base Price" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="id_cogs">
                        <label class="col-md-3 control-label">COGS<span class="required" aria-required="true"> * </span>
                            <i class="fa fa-question-circle tooltips" data-original-title="Harga yang diterima oleh vendor" data-container="body"></i>
                        </label>
                        <div class="col-md-6">
                            <div class="input-icon right">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                    Rp
                                    </span>
                                    <input type="hidden" id="cogs"class="form-control price" name="cogs">
                                    <input type="text" id="view_cogs" class="form-control price" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="multiple" class="control-label col-md-3">Type Box
                            <i class="fa fa-question-circle tooltips" data-original-title="Tipe box akan menambahkan product yang akan terisi di box" data-container="body"></i>
                        </label>
                        <div class="col-md-8">
                            <div class="icheck-list" style="margin-top: 1.5%">
                                <label><input type="checkbox" class="icheck" id="checkbox-variant" name="product_type"> </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="show_product" style="display: none">
                        <label for="multiple" class="control-label col-md-3">Product
                            <i class="fa fa-question-circle tooltips" data-original-title="Tipe box akan menambahkan product yang akan terisi di box" data-container="body"></i>
                        </label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="product" name="id_product[]" multiple>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="div_wholesaler" style="display: none">
                        <label class="col-md-3 control-label">Serving Method
                            <i class="fa fa-question-circle tooltips" data-original-title="Cara penyajian type box" data-container="body"></i>
                        </label>
                        <div class="col-md-8">
                            <a onclick="addWholesaler()" class="btn btn-sm yellow" style="margin-bottom: 2%">Add Serving Method</a>
                            <div id="wholesaler">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-offset-3 col-md-8">
                            <button type="submit" class="btn blue">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalVariantColor" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-6 control-label">
                            Variant Color Name
                        </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="variant_name_color" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <a class="btn green" onclick="addVariantColor()">Add</a>
                </div>
            </div>
        </div>
    </div>
@endsection