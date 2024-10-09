<?php
    use App\Lib\MyHelper;
    $grantedFeature     = session('granted_features');

 ?>
 @extends('layouts.main')

@section('page-style')
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/datemultiselect/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/datemultiselect/jquery-ui.multidatespicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-script')
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-bootstrap-select.min.js') }}"  type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $(".file").change(function(e) {
                var widthImg  = 300;
                var heightImg = 300;

                var _URL = window.URL || window.webkitURL;
                var image, file;

                if ((file = this.files[0])) {
                    image = new Image();

                    image.onload = function() {
                        if (this.width == this.height ) {
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
            $(".fileMultiple").change(function(e) {
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
                            $("#remove_fieldphotoMultiple").trigger( "click" );

                        }
                    };

                    image.src = _URL.createObjectURL(file);
                }

            });
            $('.summernote').summernote({
                placeholder: 'Product Description',
                tabsize: 2,
                height: 120,
                // fontNames: ['Open Sans'],
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
                            }
                        });
                    }
                }
            });


            function sendFile(file, id){
                token = "<?php echo csrf_token(); ?>";
                var data = new FormData();
                data.append('image', file);
                data.append('_token', token);
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
                    },
                    error: function(data){
                    }
                })
            }

            // untuk show atau hide informasi photo
            if ($('.deteksi').data('dis') != 1) {
                $('.deteksi-trigger').hide();
            }
            else {
                $('.deteksi-trigger').show();
            }

            let token = "{{ csrf_token() }}";

            // sortable
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();

            // hapus gambar
            $('.hapus-gambar').click(function() {
                let id     = $(this).data('id');
                let parent = $(this).parent().parent().parent().parent();

                $.ajax({
                    type : "POST",
                    url : "{{ url('product/photo/delete') }}",
                    data : "_token="+token+"&id_product_photo="+id,
                    success : function(result) {
                        if (result == "success") {
                            parent.remove();
                            toastr.info("Photo has been deleted.");
                        }
                        else {
                            toastr.warning("Something went wrong. Failed to delete photo.");
                        }
                    }
                });
            });

            $('.disc').click(function() {
                let type = $(this).data('type');

                if (type == "percentage") {
                    $('.'+type+'-div').show();
                    $('.'+type).prop('required', true);
                    $('.nominal-div').hide();
                    $('.nominal').removeAttr('required');
                    $('.nominal').val('');
                }
                else {
                    $('.'+type+'-div').show();
                    $('.'+type).prop('required', true);
                    $('.percentage-div').hide();
                    $('.percentage').removeAttr('required');
                    $('.percentage').val('');
                }
            });

            @foreach($outlet_all as $key => $ou)
            <?php $marker = 0; ?>
                @foreach($ou['product_detail'] as $keyPrice => $price)
                    @if($price['id_product'] == $product[0]['id_product'])
                        @php $marker = 1; break; @endphp
                    @endif
                @endforeach
                var option =  '<option class="option-visibility" data-id={{$product[0]["id_product"]}}/{{$ou["id_outlet"]}}>{{$ou["outlet_code"]}} - {{$ou["outlet_name"]}}</option>'
                @if($marker == 1 && $price["product_detail_visibility"])
                        $('#visibleglobal-{{lcfirst($price["product_detail_visibility"])}}').append(option)
                @else
                    $('#visibleglobal-default').append(option)
                @endif
            @endforeach

            $('#move-hiden').click(function() {
                if($('#visibleglobal-visible').val() == null){
                    toastr.warning("Choose minimal 1 outlet in visible");
                }else{
                    var id =[];
                    $('#visibleglobal-visible option:selected').each(function () {
                        var $this = $(this);
                        id.push($this.attr('data-id'))
                    })
                    let token  = "{{ csrf_token() }}";

                    $.ajax({
                        type : "POST",
                        url : "{{ url('product/update/visible') }}",
                        data : "_token="+token+"&id_visibility="+id+"&visibility=Hidden",
                        success : function(result) {
                            if (result.status == "success") {
                                toastr.info("Visibility has been updated.");
                                $('#visibleglobal-visible option:selected').each(function () {
                                    var $this = $(this);
                                    var option = '<option class="option-visibility" data-id='+$this.attr('data-id')+'>'+$this.text()+'</option>'
                                    $('#visibleglobal-hidden').append(option)
                                    $(this).remove()
                                })

                            }
                            else {
                                toastr.warning("Something went wrong. Failed to update visibility.");
                            }
                        }
                    });
                }
            });

            $('#move-visible').click(function() {
                if($('#visibleglobal-hidden').val() == null){
                    toastr.warning("Choose minimal 1 outlet in hidden");
                }else{
                    var id =[];
                    $('#visibleglobal-hidden option:selected').each(function () {
                        var $this = $(this);
                        id.push($this.attr('data-id'))
                    })
                    let token  = "{{ csrf_token() }}";

                    $.ajax({
                        type : "POST",
                        url : "{{ url('product/update/visible') }}",
                        data : "_token="+token+"&id_visibility="+id+"&visibility=Visible",
                        success : function(result) {
                            if (result.status == "success") {
                                toastr.info("Visibility has been updated.");
                                $('#visibleglobal-hidden option:selected').each(function () {
                                    var $this = $(this);
                                    var option = '<option class="option-visibility" data-id='+$this.attr('data-id')+'>'+$this.text()+'</option>'
                                    $('#visibleglobal-visible').append(option)
                                    $(this).remove()
                                })

                            }
                            else {
                                toastr.warning("Something went wrong. Failed to update visibility.");
                            }
                        }
                    });
                }
            });

            $('#default-to-hidden').click(function() {
                if($('#visibleglobal-default').val() == null){
                    toastr.warning("Choose minimal 1 outlet in default visibility");
                }else{
                    var id =[];
                    $('#visibleglobal-default option:selected').each(function () {
                        var $this = $(this);
                        id.push($this.attr('data-id'))
                    })
                    let token  = "{{ csrf_token() }}";

                    $.ajax({
                        type : "POST",
                        url : "{{ url('product/update/visible') }}",
                        data : "_token="+token+"&id_visibility="+id+"&visibility=Hidden",
                        success : function(result) {
                            if (result.status == "success") {
                                toastr.info("Visibility has been updated.");
                                $('#visibleglobal-default option:selected').each(function () {
                                    var $this = $(this);
                                    var option = '<option class="option-visibility" data-id='+$this.attr('data-id')+'>'+$this.text()+'</option>'
                                    $('#visibleglobal-hidden').append(option)
                                    $(this).remove()
                                })

                            }
                            else {
                                toastr.warning("Something went wrong. Failed to update visibility.");
                            }
                        }
                    });
                }
            });

            $('#default-to-visible').click(function() {
                if($('#visibleglobal-default').val() == null){
                    toastr.warning("Choose minimal 1 outlet in default visibility");
                }else{
                    var id =[];
                    $('#visibleglobal-default option:selected').each(function () {
                        var $this = $(this);
                        id.push($this.attr('data-id'))
                    })
                    let token  = "{{ csrf_token() }}";

                    $.ajax({
                        type : "POST",
                        url : "{{ url('product/update/visible') }}",
                        data : "_token="+token+"&id_visibility="+id+"&visibility=Visible",
                        success : function(result) {
                            if (result.status == "success") {
                                toastr.info("Visibility has been updated.");
                                $('#visibleglobal-default option:selected').each(function () {
                                    var $this = $(this);
                                    var option = '<option class="option-visibility" data-id='+$this.attr('data-id')+'>'+$this.text()+'</option>'
                                    $('#visibleglobal-visible').append(option)
                                    $(this).remove()
                                })

                            }
                            else {
                                toastr.warning("Something went wrong. Failed to update visibility.");
                            }
                        }
                    });
                }
            });

            $('#move-default').click(function() {
                if($('#visibleglobal-hidden').val() == null && $('#visibleglobal-visible').val() == null){
                    toastr.warning("Choose minimal 1 outlet in hidden or visible");
                }else{
                    var id =[];
                    $('#visibleglobal-hidden option:selected').each(function () {
                        var $this = $(this);
                        id.push($this.attr('data-id'))
                    })
                    $('#visibleglobal-visible option:selected').each(function () {
                        var $this = $(this);
                        id.push($this.attr('data-id'))
                    })
                    let token  = "{{ csrf_token() }}";

                    $.ajax({
                        type : "POST",
                        url : "{{ url('product/update/visible') }}",
                        data : "_token="+token+"&id_visibility="+id+"&visibility=",
                        success : function(result) {
                            if (result.status == "success") {
                                toastr.info("Visibility has been updated.");
                                $('#visibleglobal-hidden option:selected').each(function () {
                                    var $this = $(this);
                                    var option = '<option class="option-visibility" data-id='+$this.attr('data-id')+'>'+$this.text()+'</option>'
                                    $('#visibleglobal-default').append(option)
                                    $(this).remove()
                                })
                                $('#visibleglobal-visible option:selected').each(function () {
                                    var $this = $(this);
                                    var option = '<option class="option-visibility" data-id='+$this.attr('data-id')+'>'+$this.text()+'</option>'
                                    $('#visibleglobal-default').append(option)
                                    $(this).remove()
                                })

                            }
                            else {
                                toastr.warning("Something went wrong. Failed to update visibility.");
                            }
                        }
                    });
                }
            });

            $('#search-outlet').on("keyup", function(){
                var search = $('#search-outlet').val();
                $(".option-visibility").each(function(){
                    if(!$(this).text().toLowerCase().includes(search.toLowerCase())){
                        $(this).hide()
                    }else{
                        $(this).show()
                    }
                });
                $('#btn-reset').show()
                $('#div-left').hide()
            })

            $('#btn-reset').click(function(){
                $('#search-outlet').val("")
                $(".option-visibility").each(function(){
                    $(this).show()
                })
                $('#btn-reset').hide()
                $('#div-left').show()
            })
        });
        $(document).ready(function() {
            $(".price_float").each(function() {
                var input = $(this).val();
                var input = input.replace(/[^[^0-9]\s\_\-]+/g, "");
                input = input ? parseFloat( input ) : 0;
                $(this).val( function() {
                    return ( input === 0 ) ? "" : input.toLocaleString( "id", {minimumFractionDigits: 2} );
                } );
            });
		});

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
		$( "#formWithPrice2" ).submit(function() {
			$( "#submit" ).attr("disabled", true);
			$( "#submit" ).addClass("m-loader m-loader--light m-loader--right");
			$( ".price_float" ).each(function() {
				var number = $( this ).val().replace(/[($)\s\._\-]+/g, '').replace(/[($)\s\,_\-]+/g, '.');
				$(this).val(number);
			});
			$('.price').each(function() {
				var number = $( this ).val().replace(/[($)\s\._\-]+/g, '');
				$(this).val(number);
			});

		});

    </script>
    <script type="text/javascript">
        $('#sample_1').dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn dark btn-outline",
                    exportOptions: {
                         columns: "thead th:not(.noExport)"
                    },
                }, {
                  extend: "copy",
                  className: "btn blue btn-outline",
                  exportOptions: {
                       columns: "thead th:not(.noExport)"
                  },
                },{
                  extend: "pdf",
                  className: "btn yellow-gold btn-outline",
                  exportOptions: {
                       columns: "thead th:not(.noExport)"
                  },
                }, {
                    extend: "excel",
                    className: "btn green btn-outline",
                    exportOptions: {
                         columns: "thead th:not(.noExport)"
                    },
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline ",
                    exportOptions: {
                         columns: "thead th:not(.noExport)"
                    },
                }, {
                  extend: "colvis",
                  className: "btn red",
                  exportOptions: {
                       columns: "thead th:not(.noExport)"
                  },
                }],
                responsive: {
                    details: {
                        type: "column",
                        target: "tr"
                    }
                },
                order: [2, "asc"],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
        });

        $('#sample_1').on('click', '.delete-disc', function() {
            let token  = "{{ csrf_token() }}";
            let column = $(this).parents('tr');
            let id     = $(this).data('id');

            $.ajax({
                type : "POST",
                url : "{{ url('product/discount/delete') }}",
                data : "_token="+token+"&id_product_discount="+id,
                success : function(result) {
                    if (result == "success") {
                        $('#sample_1').DataTable().row(column).remove().draw();
                        toastr.info("Discount has been deleted.");
                    }
                    else {
                        toastr.warning("Something went wrong. Failed to delete discount.");
                    }
                }
            });
        });
        
        $('#select_tag').change(function(){
			var value = $(this).val();
            if(value !== null){
                value.forEach(function(tag_selected,i){
                    if(tag_selected == '+'){
                        $('.bootstrap-select').removeClass('open')
                        $('#m_modal_5').modal('show');
                        value.splice (i, 1);
                    }
                })
                $('#select_tag').val(value)
                $('#select_tag').selectpicker('refresh')
            }
		})

		$('#new_tag').click(function(){
			var tag_name = $('#tag_name').val();
			var token  = "{{ csrf_token() }}";
            var tag_selected = $('#select_tag').val()
			$.ajax({
                type : "POST",
                url : "{{ url('product/tag/create') }}",
                data : "_token="+token+"&tag_name="+tag_name+"&ajax=1",
                success : function(result) {
                    if (result.status == "success") {
                        toastr.info("New tag has been created.");
						$('#option_new_tag').after(
							'<option value="'+result.result.id_tag+'">'+result.result.tag_name+'</option>'
						);
						$('#select_tag').selectpicker('refresh');
                        if(tag_selected !== null){
                            tag_selected.splice (0, 0, result.result.id_tag);
                            $('#select_tag').val(tag_selected)
                        }else{
                            $('#select_tag').val([result.result.id_tag])
                        }
                        $('#select_tag').selectpicker('refresh')
                    }
                    else if(result.status == "fail"){
                        toastr.error(result.messages[0]);
                    }else{
                        toastr.warning('Failed to create tag.');
                    }
                    $('#m_modal_5').modal('hide');
                }
            });
		})
    $('#close_modal').click(function(){
        var value = $('#select_tag').val();
        value.splice (0, 0);
        $('#select_tag').val(value)
        $('#select_tag').selectpicker('refresh')
	})
    </script>

<script type="text/javascript">
     $(document).ready(function() {
         
     })
    $(document).on('click', '.same', function() {
      var price = $(this).parent().parent().parent().find('.product-price').val();
      var visibility = $(this).parent().parent().parent().find('.product-visibility').val();
      var stock = $(this).parent().parent().parent().find('.product-stock').val();

      if (price == '') {
        alert('Price field cannot be empty');
        $(this).parent().parent().parent().find('.product').focus();
        return false;
      }


      if (stock == '') {
        alert('Stock field cannot be empty');
        $(this).parent().parent().parent().find('.product-price-stock').focus();
        return false;
      }

      if ($('.checkbox-outlet').is(':checked')) {
        var check = $('input[name="sameall[]"]:checked').length;
        var count = $('.checkbox-outlet').prop('checked', false);
        $(this).prop('checked', true);

        if (check == 1) {
            var all_visibility = $('.product-visibility-value');
            var array_visibility = [];
            for (i = 0; i < all_visibility.length; i++) {
                array_visibility.push(all_visibility[i]['defaultValue']);
            }
            sessionStorage.setItem("product_visibility", array_visibility);

            var all_stock = $('.product-stock-value');
            var array_stock = [];
            for (i = 0; i < all_stock.length; i++) {
                array_stock.push(all_stock[i]['defaultValue']);
            }
            sessionStorage.setItem("product_stock", array_stock);

        }

        $('.product-visibility').val(visibility);
        $('.product-stock').val(stock);

      } else {

          var item_visibility = sessionStorage.getItem("product_visibility");
          var item_stock = sessionStorage.getItem("product_stock");

          var item_visibility = item_visibility.split(",");
          var item_stock = item_stock.split(",");

          $('.product-visibility').each(function(i, obj) {
              $(this).val(item_visibility[i]);
          });
          $('.product-stock').each(function(i, obj) {
              $(this).val(item_stock[i]);
          });

          $(this).parent().parent().parent().find('.product-visibility').val(visibility);
          $(this).parent().parent().parent().find('.product-stock').val(stock);
      }

        if ($('.checkbox-price').is(':checked')) {
            var check = $('input[name="sameall[]"]:checked').length;
            var count = $('.checkbox-price').prop('checked', false);
            $(this).prop('checked', true);

            if (check == 1) {
                var all_price = $('.product-price');
                var array_price = [];
                for (i = 0; i < all_price.length; i++) {
                    array_price.push(all_price[i]['defaultValue']);
                }
                sessionStorage.setItem("product_price", array_price);
            }

            $('.product-price').val(price);

        } else {

            var item_price = sessionStorage.getItem("product_price");

            var item_price = item_price.split(",");

            $('.product-price').each(function(i, obj) {
                $(this).val(item_price[i]);
            });

            $(this).parent().parent().parent().find('.product-price').val(price);
        }
    });

    $('#checkbox-variant').on('ifChanged', function(event) {
        if(this.checked) {
            $('#variants').show();
        }else{
            $('#variants').hide();
        }
    });

    $('#select2-product-variant').change(function(e) {
        var selected = $(e.target).val();
        if(selected !== null){
            var last = selected[selected.length-1];
            var cek = 0;
            for(var i=0;i<selected.length;i++){
                var split = selected[i].split("|");
                var split2 = last.split("|");

                if(split[0] === split2[1]){
                    cek = 1;
                    selected.splice(i, 1);
                }
            }
            if(cek === 1){
                $("#select2-product-variant").val(selected).trigger('change');
            }
        }
    });
    $(".file").change(function(e) {
            var widthImg  = 300;
            var heightImg = 300;

            var _URL = window.URL || window.webkitURL;
            var image, file;

            if ((file = this.files[0])) {
                image = new Image();

                image.onload = function() {
                    if (this.width == heightImg) {
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
     var j = {{$detail['product_custom_group_count']??0}}
     function addWholesaler(){
        j++;
        var html = '<div class="row" id="wholesaler_'+j+'" style="margin-bottom: 0.5%">' +
            '<input type="hidden" class="form-control" name="serving_method['+j+'][id_product_serving_method]">'+
            '<div class="col-md-3">Name<br><input type="text" class="form-control" name="serving_method['+j+'][serving_name]"></div>'+
            '<div class="col-md-3">Price<br><input type="number" class="form-control" name="serving_method['+j+'][unit_price]"></div>'+
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
    }

    function deleteWholesaler(id){
        $('#wholesaler_'+id).remove();
    }
    var variantWholesalerIndex = 0;
    function addVariantWholesaler(id){
        var split = id.split('_');
        var index = split[1] + variantWholesalerIndex;
        var html = '<div class="row" style="margin-bottom: 2%" id="variant_wholesaler_'+split[0]+'_'+index+'">';
        html += '<div class="col-md-5">';
        html += '<div class="input-group">';
        html += '<span class="input-group-addon">min</span>';
        html += '<input class="form-control price" required name="variant_price['+split[0]+'][wholesaler_price]['+index+'][minimum]">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-5">';
        html += '<div class="input-group">';
        html += '<input class="form-control price" required name="variant_price['+split[0]+'][wholesaler_price]['+index+'][unit_price]">';
        html += '<span class="input-group-addon">/pcs</span>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2">';
        html += '<a class="btn red" onclick="deleteVariantWholesaler(\''+ split[0]+'_'+index + '\')"><i class="fa fa-trash"></i></a>';
        html += '</div>';
        html += '</div>';

        $('#div_variant_wholesaler_'+split[0]).append(html);
        variantWholesalerIndex++;

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
    }

    function deleteVariantWholesaler(id){
        $('#variant_wholesaler_'+id).empty();
    }

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

    var array_color = <?php echo json_encode($array_color);?>;
    var array_size = <?php echo json_encode($array_size);?>;

    function addVariantColor(){
        var name = $('#variant_name_color').val();
        var check = false;
        for (var i=0;i<array_color.length;i++){
            if(name.toLowerCase() == array_color[i].variant_name.toLowerCase()){
                check = true;
            }
        }

        if(!check){
            array_color.push({
                id_product_variant: 0,
                variant_name:  name
            });
            var id = name.replace(" ", "_");
            var html = '<div class="row" id="variant_color_'+id+'" style="margin-bottom: 0.5%">' +
                '<div class="col-md-4"><input type="text" class="form-control" name="variant_color[]" value="'+name+'" readonly></div>'+
                '<div class="col-md-4"><a class="btn btn-danger" onclick="deleteVariantColor(`'+name+'`)"><i class="fa fa-trash"></i></a></div>'+
                '</div>';

            $('#variant_color').append(html);
        }

        $('#variant_name_color').val('');
        $('#modalVariantColor').modal('hide');
        showVariantPrice();
    }

    function deleteVariantColor(name){
        var id = name.replace(" ", "_");
        var id_real = 0;
        for (var i=0;i<array_color.length;i++){
            if(name.toLowerCase() == array_color[i].variant_name.toLowerCase()){
                id_real = array_color[i].id_product_variant;
                array_color.splice(i, 1);
            }
        }
        $('#variant_color_'+id).empty();
        if(id_real > 0){
            $('#variant_color').append('<input type="hidden" name="variant_deletes[]" value="'+id_real+'">');
        }
        showVariantPrice();
    }

    function addVariantSize(){
        var name = $('#variant_name_size').val();
        var check = false;
        for (var i=0;i<array_size.length;i++){
            if(name.toLowerCase() == array_size[i].variant_name.toLowerCase()){
                check = true;
            }
        }

        if(!check){
            array_size.push({
                id_product_variant: 0,
                variant_name:  name
            });
            var id = name.replace(" ", "_");
            var html = '<div class="row" id="variant_size_'+id+'" style="margin-bottom: 0.5%">' +
                '<div class="col-md-4"><input type="text" class="form-control" name="variant_size[]" value="'+name+'" readonly></div>'+
                '<div class="col-md-4"><a class="btn btn-danger" onclick="deleteVariantSize(`'+name+'`)"><i class="fa fa-trash"></i></a></div>'+
                '</div>';

            $('#variant_size').append(html);
        }

        $('#variant_name_size').val('');
        $('#modalVariantSize').modal('hide');
        showVariantPrice();
    }

    function deleteVariantSize(name){
        var id = name.replace(" ", "_");
        var id_real = 0;
        for (var i=0;i<array_size.length;i++){
            if(name.toLowerCase() == array_size[i].variant_name.toLowerCase()){
                id_real = array_size[i].id_product_variant;
                array_size.splice(i, 1);
            }
        }
        $('#variant_size_'+id).empty();
        if(id_real > 0){
            $('#variant_size').append('<input type="hidden" name="variant_deletes[]" value="'+id_real+'">');
        }
        showVariantPrice();
    }
    function statusPreorder(id){
       if(id == 1){
           $('#status_preorder').html('Hari');
       }else{
           $('#status_preorder').html('Jam');
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

    @php
        // print_r($product);die();
    @endphp
    <a href="{{url('product')}}" class="btn green" style="margin-bottom: 2%;"><i class="fa fa-arrow-left"></i> Back</a>
    <div class="portlet card_ light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <span class="caption-subject bold uppercase font-blue">{{ $detail['product_name'] }}</span>
                @if(!empty($product[0]['outlet']['outlet_name']))
                    <br>
                    <span class="caption-subject bold uppercase font-blue">Outlet : {{ $product[0]['outlet']['outlet_name'] }}</span>
                @endif
            </div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#info" data-toggle="tab"> Info </a>
                </li>
                @if($detail['product_type']=="product")
                <li>
                    <a href="#variant" data-toggle="tab">Create Spesial Price</a>
                </li>
                @endif
                <li>
                    <a href="#user" data-toggle="tab">Photos</a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="info">
                    @if($detail['is_approved']=="1")
                        @include('product::product.info')
                    @else
                       @include('product::product.infos')
                    @endif
                </div>
                <div class="tab-pane" id="variant">
                    @include('product::product.product-variant-group')
                </div>
                <div class="tab-pane" id="user">
                    @include('product::product.list_ongkos_kirim')
                </div>
            </div>
        </div>
    </div>


@endsection