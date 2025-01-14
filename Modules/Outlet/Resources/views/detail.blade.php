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
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('KEY_MAPS')}}&v=3.exp&signed_in=true&libraries=places"></script>
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
        $('.timepicker').timepicker({
            autoclose: true,
            minuteStep: 5,
            showSeconds: false,

        });
        // sortable
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    </script>
    <script>
        var map;

        var markers = [];

        function initialize(latNow, longNow) {
          var haightAshbury = new google.maps.LatLng(latNow,longNow);
          var marker        = new google.maps.Marker({
            position:new google.maps.LatLng(latNow,longNow),
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
          });

          var mapOptions = {
              zoom: 15,
              center: haightAshbury,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };

          var infowindow = new google.maps.InfoWindow({
              content: '<p>Marker Location:</p>'
          });

          map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

          var input = /** @type  {HTMLInputElement} */(
              document.getElementById('pac-input'));

              var types = document.getElementById('type-selector');
              map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
              map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

              var autocomplete = new google.maps.places.Autocomplete(input);

              autocomplete.bindTo('bounds', map);

              var infowindow = new google.maps.InfoWindow();

              google.maps.event.addListener(autocomplete, 'place_changed', function() {
              deleteMarkers();
              infowindow.close();
              marker.setVisible(true);
              var place = autocomplete.getPlace();
              if (!place.geometry) {
                  return;
              }

            // If the place has a geometry, then present it on a map.
              if (place.geometry.viewport) {
                  map.fitBounds(place.geometry.viewport);
              } else {
                  map.setCenter(place.geometry.location);
                  map.setZoom(17);  // Why 17? Because it looks good.
              }
                  addMarker(place.geometry.location);
              });

              google.maps.event.addListener(map, 'click', function(event) {

              deleteMarkers();
              addMarker(event.latLng);
              // marker.openInfoWindowHtml(latLng);
              // infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
              infowindow.open(map, marker);
          });
          // Adds a marker at the center of the map.
          addMarker(haightAshbury);
        }

        function placeMarker(location) {
          marker = new google.maps.Marker({
            position: location,
            map: map,
          });

          markers.push(marker);

          infowindow = new google.maps.InfoWindow({
             content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
          });
          infowindow.open(map,marker);
        }

        // Add a marker to the map and push to the array.

        function addMarker(location) {
          var marker = new google.maps.Marker({
            position: location,
            map: map
          });

          $('#lat').val(location.lat());
          $('#lng').val(location.lng());
          markers.push(marker);
        }

        // Sets the map on all markers in the array.

        function setAllMap(map) {
          for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
          }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
          setAllMap(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
          setAllMap(map);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
          clearMarkers();
          markers = [];
        }

        google.maps.event.addDomListener(window, 'load', initialize());
    </script>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#table_product').DataTable( {
                "pageLength": 15,
                "lengthChange": false,
                "ordering": false,
                "info" : false
            });
            /* MAPS */
            longNow = "{{ $outlet[0]['outlet_longitude'] }}";
            latNow = "{{ $outlet[0]['outlet_latitude'] }}";

            if (latNow == "" || longNow == "") {
              navigator.geolocation.getCurrentPosition(function(position){
                  initialize(position.coords.latitude, position.coords.longitude);
              },
              function (error) {
                if (error.code == error.PERMISSION_DENIED)
                initialize({{env('LONGITUDE')}}, {{env('LATITUDE')}});
              });
            }
            else {
              initialize(latNow, longNow);
            }

            /*=====================================*/

            // untuk show atau hide informasi photo
            if ($('.deteksi').data('dis') != 1) {
                $('.deteksi-trigger').hide();
            }
            else {
                $('.deteksi-trigger').show();
            }

            let token = "{{ csrf_token() }}";

            // hapus gambar
            $('.hapus-gambar').click(function() {
                let id     = $(this).data('id');
                let parent = $(this).parent().parent().parent().parent();

                $.ajax({
                    type : "POST",
                    url : "{{ url('outlet/photo/delete') }}",
                    data : "_token="+token+"&id_outlet_photo="+id,
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

            // change info
            $('#infoOutlet').click(function() {
            //   initialize();
            // console.log(latNow)
            // console.log(latNow)

            // initialize(latNow, longNow);

            });

            $('#province').change(function() {
                $('#city').empty();
                $('#city').prop('disabled', true);
                $('#district').empty();
                $('#district').prop('disabled', true);
                $('#subdistrict').empty();
                $('#subdistrict').prop('disabled', true);
                $('#outlet_postal_code').val('');

                var isi         = $('#province').val();

                $.ajax({
                    type    : "POST",
                    url     : "<?php echo url('outlet/get/city')?>",
                    data    : "_token="+token+"&id_province="+isi,
                    success : function(result) {
                        if (result['status'] == "success") {
                            $('#city').prop('disabled', false);

                            var city           = result['result'];
                            var selectCity = '<option value=""></option>';

                            for (var i = 0; i < city.length; i++) {
                                selectCity += '<option value="'+city[i]['id_city']+'" >'+city[i]['city_name']+'</option>';
                            }

                            $('#city').html(selectCity);
                        }
                        else {
                            $('#city').prop('disabled', true);
                        }
                    }
                });
            });

            $('#city').change(function() {
                $('#district').empty();
                $('#district').prop('disabled', true);
                $('#subdistrict').empty();
                $('#subdistrict').prop('disabled', true);
                $('#outlet_postal_code').val('');

                var isi   = $('#city').val();
                let token = "{{ csrf_token() }}";

                $.ajax({
                    type    : "POST",
                    url     : "<?php echo url('outlet/get/district')?>",
                    data    : "_token="+token+"&id_city="+isi,
                    success : function(result) {
                        if (result['status'] == "success") {
                            $('#district').prop('disabled', false);

                            var district           = result['result'];
                            var selectDistrict = '<option value=""></option>';

                            for (var i = 0; i < district.length; i++) {
                                selectDistrict += '<option value="'+district[i]['id_district']+'">'+district[i]['district_name']+'</option>';
                            }

                            $('#district').html(selectDistrict);
                        }
                        else {
                            $('#district').prop('disabled', true);
                        }
                    }
                });
            });

            $('#district').change(function() {
                $('#subdistrict').empty();
                $('#subdistrict').prop('disabled', true);
                $('#outlet_postal_code').val('');

                var isi = $('#district').val();
                let token = "{{ csrf_token() }}";

                $.ajax({
                    type    : "POST",
                    url     : "<?php echo url('outlet/get/subdistrict')?>",
                    data    : "_token="+token+"&id_district="+isi,
                    success : function(result) {
                        if (result['status'] == "success") {
                            $('#subdistrict').prop('disabled', false);

                            var subdistrict           = result['result'];
                            var selectSubdistrict = '<option value=""></option>';

                            for (var i = 0; i < subdistrict.length; i++) {
                                selectSubdistrict += '<option value="'+subdistrict[i]['id_subdistrict']+'|'+subdistrict[i]['subdistrict_postal_code']+'">'+subdistrict[i]['subdistrict_name']+'</option>';
                            }

                            $('#subdistrict').html(selectSubdistrict);
                        }
                        else {
                            $('#subdistrict').prop('disabled', true);
                        }
                    }
                });
            });

            $('#subdistrict').change(function() {
                var isi = $('#subdistrict').val();
                var isi = isi.split('|');

                $('#outlet_postal_code').val(isi[1]);
            });

            @foreach($products as $key => $pro)
                var option =  '<option class="option-visibility" data-id={{$pro["id_product"]}}>{{$pro["product_code"]}} - {{$pro["product_name"]}}</option>'
                @if(!empty($pro['product_detail'][0]['product_detail_visibility']) && $pro['product_detail'][0]['product_detail_visibility'] == 'Visible')
                    $('#visibleglobal-{{lcfirst('Visible')}}').append(option)
                @else
                $('#visibleglobal-{{lcfirst('Hidden')}}').append(option)
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
                        url : "{{ url('product/update/visibility/global') }}",
                        data : "_token="+token+"&id_product="+id+"&product_visibility=Hidden",
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
                        url : "{{ url('product/update/visibility/global') }}",
                        data : "_token="+token+"&id_product="+id+"&product_visibility=Visible",
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

            $('#search-product').on("keyup", function(){
                var search = $('#search-product').val();
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
                $('#search-product').val("")
                $(".option-visibility").each(function(){
                    $(this).show()
                })
                $('#btn-reset').hide()
                $('#div-left').show()
            })

            $('.summernote').summernote({
                placeholder: 'Category Description',
                tabsize: 2,
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
                height: 120
            });
        });
    </script>

    <script type="text/javascript">
        $('#sample_1').dataTable({
            order: [0, "asc"],
            "columnDefs": [
                { "width": "100", "targets": 0 }
            ]
        });
        $('#sample_1').on('click', '.delete', function() {
            var token  = "{{ csrf_token() }}";
            var column = $(this).parents('tr');
            var id     = $(this).data('id');

            $.ajax({
                type : "POST",
                url : "{{ url('outlet/detail/'.$outlet[0]['outlet_code'].'/admin/delete') }}",
                data : "_token="+token+"&id_user_outlet="+id,
                success : function(result) {
                    if (result == "success") {
                        $('#sample_1').DataTable().row(column).remove().draw();
                        toastr.info("Admin Outlet has been deleted.");
                    }
                    else {
                        toastr.warning("Something went wrong. Failed to delete admin outlet.");
                    }
                }
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
                    if (this.width == widthImg && this.height == heightImg) {
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
        $(".filePhotoDetail").change(function(e) {
            var _URL = window.URL || window.webkitURL;
            var image, file;

            if ((file = this.files[0])) {
                image = new Image();

                image.onload = function() {
                    if (this.height != 375 && this.width != 720) {
                        toastr.warning("Please check dimension of your photo. Maximum height is 375 px");
                        $('#imageDetail').children('img').attr('src', 'https://www.placehold.it/720x375/EFEFEF/AAAAAA&amp;text=no+image');
                        $("#remove_fieldphotodetail").trigger( "click" );
                    }
                };

                image.src = _URL.createObjectURL(file);
            }

        });

        $(".filePhotoCover").change(function(e) {
            var widthImg  = 720;
            var heightImg = 375;

            var _URL = window.URL || window.webkitURL;
            var image, file;

            if ((file = this.files[0])) {
                image = new Image();

                image.onload = function() {
                    if (this.width != widthImg && this.height != heightImg) {
                        toastr.warning("Please check dimension of your photo.");
                        $('#imageCover').children('img').attr('src', 'https://www.placehold.it/720x375/EFEFEF/AAAAAA&amp;text=no+image');
                        $("#remove_fieldphotocover").trigger( "click" );

                    }
                };

                image.src = _URL.createObjectURL(file);
            }

        });
    </script>
    <script type="text/javascript">
    $(document).on('click', '.same', function() {
      var open = $(this).parent().parent().parent().find('.kelas-open').val();
      var close = $(this).parent().parent().parent().find('.kelas-close').val();
      if (open == '') {
        alert('Open field cannot be empty');
        $(this).parent().parent().parent().find('.kelas-open').focus();
        return false;
      }

      if (close == '') {
        alert('Close field cannot be empty');
        $(this).parent().parent().parent().find('.kelas-close').focus();
        return false;
      }

      if ($(this).is(':checked')) {
        var check = $('input[name="ampas[]"]:checked').length;
        var count = $('.same').prop('checked', false);
        $(this).prop('checked', true);

        if (check == 1) {
            var all_open = $('.kelas-open');
            var array_open = [];
            for (i = 0; i < all_open.length; i++) {
              array_open.push(all_open[i]['defaultValue']);
            }
            sessionStorage.setItem("item_open", array_open);

            var all_close = $('.kelas-close');
            var array_close = [];
            for (i = 0; i < all_close.length; i++) {
              array_close.push(all_close[i]['defaultValue']);
            }
            sessionStorage.setItem("item_close", array_close);
        }

        $('.kelas-open').val(open);
        $('.kelas-close').val(close);

      } else {

          var item_open = sessionStorage.getItem("item_open");
          var item_close = sessionStorage.getItem("item_close");

          var myarr_open = item_open.split(",");
          var myarr_close = item_close.split(",");
          $('.kelas-open').each(function(i, obj) {
              $(this).val(myarr_open[i]);
          });

          $('.kelas-close').each(function(i, obj) {
              $(this).val(myarr_close[i]);
          });

          $(this).parent().parent().parent().find('.kelas-open').val(open);
          $(this).parent().parent().parent().find('.kelas-close').val(close);
      }
    });

    $('.latlong').change(function(){
        var lat = $('#lat').val()
        var long = $('#lng').val()
        initialize(lat, long);
    })
    $('.is_closed').change(function(){
        if($(this).is(':checked')){
            $('#'+$(this).attr('data-id')).val('1')
        }else{
            $('#'+$(this).attr('data-id')).val('0')
        }
    })

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
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

    <a href="{{url('outlet/list')}}" class="btn green" style="margin-bottom: 2%;"><i class="fa fa-arrow-left"></i> Back</a>

    <div class="portlet card_ light bordered">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <span class="caption-subject font-blue bold uppercase">{{ $outlet[0]['outlet_code'] }}</span>
            </div>
            <ul class="nav nav-tabs">

                <li @if(!isset($tipe)) class="active" @endif id="infoOutlet">
                    <a href="#info" data-toggle="tab" > Info </a>
                </li>
                <li id="merchant">
                    <a href="#outlet_merchant" data-toggle="tab" > Merchant </a>
                </li>
                <li id="dataLegalitas">
                    <a href="#data_legalitas" data-toggle="tab" > Data Legalitas </a>
                </li>
                <li id="listProduct">
                    <a href="#list_product" data-toggle="tab" > List Product </a>
                </li>
                <li id="listOngkosKirim">
                    <a href="#list_ongkos_kirim" data-toggle="tab" > List Ongkos Kirim </a>
                </li>
                <li id="listPayment" @if(isset($tipe) && $tipe=='list_payment') class="active" @endif>
                    <a href="#list_payment" data-toggle="tab" > List Payment </a>
                </li>
                <li id="logBalanceOutlet" @if(isset($tipe) && $tipe=='log_balance') class="active" @endif>
                    <a href="#log_balance" data-toggle="tab" > Log Balance </a>
                </li>
                @if(MyHelper::hasAccess([5], $configs))
                <li id="pinOutlet">
                    <a href="#pin" data-toggle="tab" > Update Pin </a>
                </li>
                @endif
                @if(MyHelper::hasAccess([29], $grantedFeature))
                    <li>
                        <a href="#photo" data-toggle="tab"> Photo </a>
                    </li>
                @endif
               {{-- <li>
                    <a href="#holiday" data-toggle="tab"> Holiday </a>
                </li> --}}
                <li>
                    <a href="#bank" data-toggle="tab"> Bank </a>
                </li>
                {{-- @if(MyHelper::hasAccess([5], $configs))
                    @if(MyHelper::hasAccess([39,40,41], $grantedFeature))
                        <li>
                            <a href="#admin" data-toggle="tab"> Admin Outlet </a>
                        </li>
                    @endif
                    <li>
                        <a href="#schedule" data-toggle="tab"> Schedule </a>
                    </li>
                @endif --}}
                <li>
                    <a href="#visibility" data-toggle="tab"> Visibility Product</a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane @if(!isset($tipe)) active @endif" id="info">
                    @include('outlet::info')
                </div>
                <div class="tab-pane @if(isset($tipe) && $tipe=='log_balance') active @endif" id="log_balance">
                    @include('outlet::log_balance')
                </div>
                <div class="tab-pane @if(isset($tipe) && $tipe=='list_payment') active @endif" id="list_payment">
                    @include('outlet::list_payment')
                </div>
                <div class="tab-pane" id="outlet_merchant">
                    @include('outlet::outlet_merchant')
                </div>
                <div class="tab-pane" id="data_legalitas">
                    @include('outlet::data_legalitas')
                </div>
                <div class="tab-pane" id="list_product">
                    @include('outlet::list_product')
                </div>
                <div class="tab-pane" id="list_ongkos_kirim">
                    @include('outlet::list_ongkos_kirim')
                </div>
                <div class="tab-pane" id="pin">
                    @include('outlet::pin')
                </div>
                <div class="tab-pane" id="photo">
                    @include('outlet::photo')
                </div>
                <div class="tab-pane" id="holiday">
                    @include('outlet::holiday')
                </div>
                <div class="tab-pane" id="bank">
                    @include('outlet::bank')
                </div>
                <div class="tab-pane" id="admin">
                    @include('outlet::admin')
                </div>
                <div class="tab-pane" id="schedule">
                    @include('outlet::schedule_open')
                </div>
                <div class="tab-pane" id="visibility">
                    @include('outlet::outlet_visibility')
                </div>
            </div>
        </div>
    </div>


@endsection