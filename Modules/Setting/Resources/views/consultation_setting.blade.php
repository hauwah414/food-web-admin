<?php
    use App\Lib\MyHelper;
    $configs  = session('configs');
    $grantedFeature     = session('granted_features');
 ?>
@extends('layouts.main')
@include('infinitescroll')

@section('page-style')
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/css/profile-2.min.css') }}" rel="stylesheet" type="text/css" />

	<style type="text/css">
	    #sample_1_filter label, #sample_5_filter label, #sample_4_filter label, .pagination, .dataTables_filter label {
	        float: right;
	    }

	    .cont-col2{
	        margin-left: 30px;
	    }
	</style>
@yield('is-style')
@endsection

@section('page-plugin')
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
@endsection

@section('page-script')
<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-multi-select.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
	<script src="{{ env('STORAGE_URL_VIEW') }}{{('assets/pages/scripts/ui-confirmations.min.js') }}" type="text/javascript"></script>
    @yield('is-script')
    <script type="text/javascript">
        function enableConfirmation(table,response){
            $(`.page${table.data('page')+1} [data-toggle='confirmation']`).confirmation({
                'btnOkClass':'btn btn-sm green',
                'btnCancelClass':'btn btn-sm red',
                'placement':'left'
            });
            table.parents('.is-container').find('.total-record').text(response.total?response.total:0).val(response.total?response.total:0);
        }
        $(document).ready(function(){
            template = {
                useraddress: function(item){
                    return `
                    <tr class="page${item.page}">
                        <td class="text-center">${item.increment}</td>
                        <td>${item.name}</td>
                        <td>${item.favorite?'Yes':'No'}</td>
                        <td>${item.short_address}</td>
                        <td>${item.address}</td>
                        <td>${item.description?item.description:'-'}</td>
                        <td>${new Date(item.updated_at).toLocaleString('id-ID',{day:"2-digit",month:"short",year:"numeric",timeStyle:"medium",hour:"2-digit",minute:"2-digit"})}</td>
                    </tr>
                    `;
                },
                useraddressfavorite: function(item){
                    return `
                    <tr class="page${item.page}">
                        <td class="text-center">${item.increment}</td>
                        <td>${item.name}</td>
                        <td>${item.type?item.type:'-'}</td>
                        <td>${item.short_address}</td>
                        <td>${item.address}</td>
                        <td>${item.description?item.description:'-'}</td>
                    </tr>
                    `;
                }
            };

            var max_fields = 10;
			var wrapper = $(".container1");
			var add_button = $(".add_form_field");

			var x = 1;
			$(add_button).click(function(e) {
				e.preventDefault();
				if (x < max_fields) {
					x++;
					$(wrapper).append('<div><div class="col-md-8" style="margin-top:10px;"><input type="text" name="value[]" placeholder="Aturan Penggunaan Dosis, ex: 3x1" class="form-control" /></div><div class="col-md-4" style="margin-top:10px;"> <a href="#" class="delete">Delete</a> </div> </div>'); //add input box
				} else {
					alert('You Reached the limits')
				}
			});

			$(wrapper).on("click", ".delete", function(e) {
				e.preventDefault();
				$(this).parent('div').parent('div').remove();
				x--;
			})

            var max_fields2 = 10;
			var wrapper2 = $(".container2");
			var add_button2 = $(".add_form_field_time");

			var x = 1;
			$(add_button2).click(function(e) {
				e.preventDefault();
				if (x < max_fields2) {
					x++;
					$(wrapper2).append('<div><div class="col-md-8" style="margin-top:10px;"><input type="text" name="value[]" placeholder="Aturan Waktu Penggunaan, ex: Siang" class="form-control" /></div><div class="col-md-4" style="margin-top:10px;"> <a href="#" class="delete">Delete</a> </div> </div>'); //add input box
				} else {
					alert('You Reached the limits')
				}
			});

			$(wrapper2).on("click", ".delete", function(e) {
				e.preventDefault();
				$(this).parent('div').parent('div').remove();
				x--;
			})

            var max_fields3 = 10;
			var wrapper3 = $(".container3");
			var add_button3 = $(".add_form_field_additional_time");

			var x = 1;
			$(add_button3).click(function(e) {
				e.preventDefault();
				if (x < max_fields3) {
					x++;
					$(wrapper3).append('<div><div class="col-md-8" style="margin-top:10px;"><input type="text" name="value[]" placeholder="Aturan Tambahan Penggunaan ex: Sebelum Tidur" class="form-control" /></div><div class="col-md-4" style="margin-top:10px;"> <a href="#" class="delete">Delete</a> </div> </div>'); //add input box
				} else {
					alert('You Reached the limits')
				}
			});

			$(wrapper3).on("click", ".delete", function(e) {
				e.preventDefault();
				$(this).parent('div').parent('div').remove();
				x--;
			})

            var max_fields4 = 10;
			var wrapper4 = $(".container4");
			var add_button4 = $(".add_form_field_diagnosis");

			var x = 1;
			$(add_button4).click(function(e) {
				e.preventDefault();
				if (x < max_fields4) {
					x++;
					$(wrapper4).append('<div><div class="col-md-8" style="margin-top:10px;"><input type="text" name="value[]" placeholder="Pilihan Diagnosis , ex: Kulit Kusam" class="form-control" /></div><div class="col-md-4" style="margin-top:10px;"> <a href="#" class="delete">Delete</a> </div> </div>'); //add input box
				} else {
					alert('You Reached the limits')
				}
			});

			$(wrapper4).on("click", ".delete", function(e) {
				e.preventDefault();
				$(this).parent('div').parent('div').remove();
				x--;
			})

            var max_fields5 = 10;
			var wrapper5 = $(".container5");
			var add_button5 = $(".add_form_field_complaints");

			var x = 1;
			$(add_button5).click(function(e) {
				e.preventDefault();
				if (x < max_fields5) {
					x++;
					$(wrapper5).append('<div><div class="col-md-8" style="margin-top:10px;"><input type="text" name="value[]" placeholder="Pilihan Keluhan , ex: Kulit Perih dan Gatal" class="form-control" /></div><div class="col-md-4" style="margin-top:10px;"> <a href="#" class="delete">Delete</a> </div> </div>'); //add input box
				} else {
					alert('You Reached the limits')
				}
			});

			$(wrapper5).on("click", ".delete", function(e) {
				e.preventDefault();
				$(this).parent('div').parent('div').remove();
				x--;
			})
        })
    </script>
	<script>
	function checkAll(var1,var2){
		for(x=1;x<=var2;x++){
			var value = document.getElementById('module_'+var1).checked;
			if(value == true){
				document.getElementById(var1+'_'+x).checked = true;
			} else {
				document.getElementById(var1+'_'+x).checked = false;
			}
		}
	}

	function checkSingle(var1,var2){
		var compare=0;
		var2 = $('.checkbox'+var1).length;
		for(x=1;x<=var2;x++){
			var value = document.getElementById(var1+'_'+x).checked;
			if(value == true){
				compare = compare + 1;
			}
		}
		console.log(var2+ ' ' +compare)
		if(compare == var2){
			document.getElementById('module_'+var1).checked = true;
		} else {
			document.getElementById('module_'+var1).checked = false;
		}
	}

	// $('.sample_1').dataTable({
    //             language: {
    //                 aria: {
    //                     sortAscending: ": activate to sort column ascending",
    //                     sortDescending: ": activate to sort column descending"
    //                 },
    //                 emptyTable: "No data available in table",
    //                 info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 infoEmpty: "No entries found",
    //                 infoFiltered: "(filtered1 from _MAX_ total entries)",
    //                 lengthMenu: "_MENU_ entries",
    //                 search: "Search:",
    //                 zeroRecords: "No matching records found"
    //             },
    //             buttons: [],
    //             responsive: {
    //                 details: {
    //                     type: "column",
    //                     target: "tr"
    //                 }
    //             },
    //             order: [0, "asc"],
    //             lengthMenu: [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"]
    //             ],
    //             pageLength: 10,
    //             dom: "<'row' <'col-md-12'B>><'row'<'col-md-7 col-sm-12'l><'col-md-5 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    //     });
	// $('#sample_1').dataTable({
    //             language: {
    //                 aria: {
    //                     sortAscending: ": activate to sort column ascending",
    //                     sortDescending: ": activate to sort column descending"
    //                 },
    //                 emptyTable: "No data available in table",
    //                 info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 infoEmpty: "No entries found",
    //                 infoFiltered: "(filtered1 from _MAX_ total entries)",
    //                 lengthMenu: "_MENU_ entries",
    //                 search: "Search:",
    //                 zeroRecords: "No matching records found"
    //             },
    //             buttons: [],
    //             responsive: {
    //                 details: {
    //                     type: "column",
    //                     target: "tr"
    //                 }
    //             },
    //             order: [0, "asc"],
    //             lengthMenu: [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"]
    //             ],
    //             pageLength: 10,
    //             dom: "<'row' <'col-md-12'B>><'row'<'col-md-7 col-sm-12'l><'col-md-5 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    //     });

    // $('#sample_2').dataTable({
    //             language: {
    //                 aria: {
    //                     sortAscending: ": activate to sort column ascending",
    //                     sortDescending: ": activate to sort column descending"
    //                 },
    //                 emptyTable: "No data available in table",
    //                 info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 infoEmpty: "No entries found",
    //                 infoFiltered: "(filtered1 from _MAX_ total entries)",
    //                 lengthMenu: "_MENU_ entries",
    //                 search: "Search:",
    //                 zeroRecords: "No matching records found"
    //             },
    //             buttons: [],
    //             responsive: {
    //                 details: {
    //                     type: "column",
    //                     target: "tr"
    //                 }
    //             },
    //             order: [0, "asc"],
    //             lengthMenu: [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"]
    //             ],
    //             pageLength: 10,
    //             dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    //     });

    // $('#sample_3').dataTable({
    //             language: {
    //                 aria: {
    //                     sortAscending: ": activate to sort column ascending",
    //                     sortDescending: ": activate to sort column descending"
    //                 },
    //                 emptyTable: "No data available in table",
    //                 info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 infoEmpty: "No entries found",
    //                 infoFiltered: "(filtered1 from _MAX_ total entries)",
    //                 lengthMenu: "_MENU_ entries",
    //                 search: "Search:",
    //                 zeroRecords: "No matching records found"
    //             },
    //             buttons: [],
    //             responsive: {
    //                 details: {
    //                     type: "column",
    //                     target: "tr"
    //                 }
    //             },
    //             order: [0, "asc"],
    //             lengthMenu: [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"]
    //             ],
    //             pageLength: 10,
    //             dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    //     });

    // $('#sample_4').dataTable({
    //             language: {
    //                 aria: {
    //                     sortAscending: ": activate to sort column ascending",
    //                     sortDescending: ": activate to sort column descending"
    //                 },
    //                 emptyTable: "No data available in table",
    //                 info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 infoEmpty: "No entries found",
    //                 infoFiltered: "(filtered1 from _MAX_ total entries)",
    //                 lengthMenu: "_MENU_ entries",
    //                 search: "Search:",
    //                 zeroRecords: "No matching records found"
    //             },
    //             buttons: [],
    //             responsive: {
    //                 details: {
    //                     type: "column",
    //                     target: "tr"
    //                 }
    //             },
    //             order: [2, "desc"],
    //             lengthMenu: [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"]
    //             ],
    //             pageLength: 10,
    //             dom: "<'row' <'col-md-12'B>><'row'<'col-md-7 col-sm-12'l><'col-md-5 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    //     });

    // $('#sample_5').dataTable({
    //             language: {
    //                 aria: {
    //                     sortAscending: ": activate to sort column ascending",
    //                     sortDescending: ": activate to sort column descending"
    //                 },
    //                 emptyTable: "No data available in table",
    //                 info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 infoEmpty: "No entries found",
    //                 infoFiltered: "(filtered1 from _MAX_ total entries)",
    //                 lengthMenu: "_MENU_ entries",
    //                 search: "Search:",
    //                 zeroRecords: "No matching records found"
    //             },
    //             buttons: [],
    //             responsive: {
    //                 details: {
    //                     type: "column",
    //                     target: "tr"
    //                 }
    //             },
    //             order: [0, "asc"],
    //             lengthMenu: [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"]
    //             ],
    //             pageLength: 10,
    //             dom: "<'row' <'col-md-12'B>><'row'<'col-md-7 col-sm-12'l><'col-md-5 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    //     });

    $('.datatable').dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    //info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    //infoEmpty: "No entries found",
                    //infoFiltered: "(filtered1 from _MAX_ total entries)",
                    //lengthMenu: "_MENU_ entries",
                    //search: "Search:",
                    //zeroRecords: "No matching records found"
                },
                buttons: [],
                responsive: {
                    details: {
                        type: "column",
                        target: "tr"
                    }
                },
                //order: [2, "desc"],
                //lengthMenu: [
                    //[5, 10, 15, 20, -1],
                    //[5, 10, 15, 20, "All"]
                //],
                //pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-7 col-sm-12'l><'col-md-5 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
        });

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
			<a href="{{url('/')}}">Home</a>
            <i class="fa fa-circle"></i>
		</li>
        <li>
            <span>{{ $title }}</span>
            <i class="fa fa-circle"></i>
        </li>
	</ul>
</div>
@include('layouts.notifications')

<div class="row" style="margin-top:20px">
	<div class="col-md-12">
		<div class="profile">
				<div class="tab-content">
					<div class="tab-pane active" id="overview">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12" style="margin-top:30px">
											<div class="tabbable-line tabbable-full-width">
												<ul class="nav nav-tabs">
													<li class="active">
														<a href="#max_consultation_quota" data-toggle="tab"> Maks. Kuota Konsultasi </a>
													</li>
                                                    <li>
														<a href="#consultation_starts_late" data-toggle="tab"> Maks. Terlambat Konsultasi </a>
													</li>
                                                    <li>
														<a href="#consultation_starts_early" data-toggle="tab"> Akses Awal Konsultasi </a>
													</li>
                                                    <li>
														<a href="#max_reschedule_settings" data-toggle="tab"> Maks. Reschedule Konsultasi </a>
													</li>
                                                    <li>
                                                        <a href="#min_session_consultation_now" data-toggle="tab"> Min. Session Konsultasi Now</a>
                                                    </li>
												</ul>
											</div>
											<div class="tab-content">
												<div class="tab-pane active" id="max_consultation_quota">
													<!-- BEGIN: Comments -->
													<div class="mt-comments">
                                                        <div class="portlet light form-fit bordered">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class=" icon-layers font-green"></i>
                                                                    <span class="caption-subject font-green bold uppercase">{{ $subTitle }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body form">
                                                                <form class="form-horizontal" action="{{ url('setting/consultation/max_consultation_quota/update') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <div class="input-icon right">
                                                                                <label class="col-md-4 control-label">
                                                                                    Maks. Kuota Konsultasi
                                                                                <span class="required" aria-required="true"> * </span>
                                                                                    <i class="fa fa-question-circle tooltips" data-original-title="Kuota maksimal untuk setiap satu sesi konsultasi" data-container="body"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="repeat">
                                                                                    <div data-repeater-list="setting">
                                                                                    @if(isset($result['max_consultation_quota']) && is_array($result['max_consultation_quota']))
                                                                                        <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <input type="hidden" name="id_setting" value="{{$result['max_consultation_quota']['id_setting']}}"/>
                                                                                            <div class="col-md-4">
                                                                                                <input type="text" class="form-control" placeholder="quota maximum" name="value" value="{{$result['max_consultation_quota']['value']}}"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @else
                                                                                    <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <div class="col-md-4">
                                                                                                <input type="text" class="form-control" placeholder="quota maximum" name="value"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-actions">
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-10">
                                                                                <button type="submit" class="btn green">
                                                                                    <i class="fa fa-check"></i> Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
													</div>
													<!-- END: Comments -->
												</div>
                                                <div class="tab-pane" id="consultation_starts_late">
													<!-- BEGIN: Comments -->
													<div class="mt-comments">
                                                        <div class="portlet light form-fit bordered">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class=" icon-layers font-green"></i>
                                                                    <span class="caption-subject font-green bold uppercase">{{ $subTitle }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body form">
                                                                <form class="form-horizontal" action="{{ url('setting/consultation/consultation_starts_late/update') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <div class="input-icon right">
                                                                                <label class="col-md-4 control-label">
                                                                                    Maks. Terlambat Konsultasi
                                                                                <span class="required" aria-required="true"> * </span>
                                                                                    <i class="fa fa-question-circle tooltips" data-original-title="Maksimal terlambat konsultasi dalam menit" data-container="body"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="repeat">
                                                                                    <div data-repeater-list="setting">
                                                                                    @if(isset($result['consultation_starts_late']) && is_array($result['consultation_starts_late']))
                                                                                        <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <input type="hidden" name="id_setting" value="{{$result['consultation_starts_late']['id_setting']}}"/>
                                                                                            <div class="col-md-5">
                                                                                                <input type="text" class="form-control" placeholder="Maks. Terlambat Konsultasi" name="value" value="{{$result['consultation_starts_late']['value']}}"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @else
                                                                                    <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <div class="col-md-5">
                                                                                                <input type="text" class="form-control" placeholder="Maks. Terlambat Konsultasi" name="value"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-actions">
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-10">
                                                                                <button type="submit" class="btn green">
                                                                                    <i class="fa fa-check"></i> Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
													</div>
													<!-- END: Comments -->
												</div>
                                                <div class="tab-pane" id="consultation_starts_early">
													<!-- BEGIN: Comments -->
													<div class="mt-comments">
                                                        <div class="portlet light form-fit bordered">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class=" icon-layers font-green"></i>
                                                                    <span class="caption-subject font-green bold uppercase">{{ $subTitle }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body form">
                                                                <form class="form-horizontal" action="{{ url('setting/consultation/consultation_starts_early/update') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <div class="input-icon right">
                                                                                <label class="col-md-4 control-label">
                                                                                    Awal Akses Konsultasi
                                                                                <span class="required" aria-required="true"> * </span>
                                                                                    <i class="fa fa-question-circle tooltips" data-original-title="Dapat mengakses konsultasi lebih awal dalam menit" data-container="body"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="repeat">
                                                                                    <div data-repeater-list="setting">
                                                                                    @if(isset($result['consultation_starts_early']) && is_array($result['consultation_starts_early']))
                                                                                        <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <input type="hidden" name="id_setting" value="{{$result['consultation_starts_early']['id_setting']}}"/>
                                                                                            <div class="col-md-5">
                                                                                                <input type="text" class="form-control" placeholder="Awal Akses Konsultasi" name="value" value="{{$result['consultation_starts_early']['value']}}"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @else
                                                                                    <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <div class="col-md-5">
                                                                                                <input type="text" class="form-control" placeholder="Awal Akses Konsultasi" name="value"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-actions">
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-10">
                                                                                <button type="submit" class="btn green">
                                                                                    <i class="fa fa-check"></i> Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
													</div>
													<!-- END: Comments -->
												</div>
                                                <div class="tab-pane" id="max_reschedule_settings">
													<!-- BEGIN: Comments -->
													<div class="mt-comments">
                                                        <div class="portlet light form-fit bordered">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class=" icon-layers font-green"></i>
                                                                    <span class="caption-subject font-green bold uppercase">{{ $subTitle }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body form">
                                                                <form class="form-horizontal" action="{{ url('setting/consultation/max_reschedule_settings/update') }}" method="post">
                                                                {{ csrf_field() }}
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <div class="input-icon right">
                                                                                <label class="col-md-4 control-label">
                                                                                    Maks. Reschedule Konsultasi
                                                                                <span class="required" aria-required="true"> * </span>
                                                                                    <i class="fa fa-question-circle tooltips" data-original-title="Maksimal Reschedule Sebelum Konsultasi (hari)" data-container="body"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="repeat">
                                                                                    <div data-repeater-list="setting">
                                                                                    @if(isset($result['max_reschedule_settings']) && is_array($result['max_reschedule_settings']))
                                                                                        <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <input type="hidden" name="id_setting" value="{{$result['max_reschedule_settings']['id_setting']}}"/>
                                                                                            <div class="col-md-4">
                                                                                                <input type="text" class="form-control" placeholder="quota maximum" name="value" value="{{$result['max_reschedule_settings']['value']}}"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @else
                                                                                    <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                            <div class="col-md-4">
                                                                                                <input type="text" class="form-control" placeholder="reschedule maximum" name="value"/>
                                                                                            </div>
                                                                                            <br>
                                                                                        </div>
                                                                                    @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-actions">
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-10">
                                                                                <button type="submit" class="btn green">
                                                                                    <i class="fa fa-check"></i> Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
													</div>
													<!-- END: Comments -->
												</div>
                                                <div class="tab-pane" id="min_session_consultation_now">
                                                    <!-- BEGIN: Comments -->
                                                    <div class="mt-comments">
                                                        <div class="portlet light form-fit bordered">
                                                            <div class="portlet-title">
                                                                <div class="caption">
                                                                    <i class=" icon-layers font-green"></i>
                                                                    <span class="caption-subject font-green bold uppercase">{{ $subTitle }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="portlet-body form">
                                                                <form class="form-horizontal" action="{{ url('setting/consultation/min_session_consultation_now/update') }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-body">
                                                                        <div class="form-group">
                                                                            <div class="input-icon right">
                                                                                <label class="col-md-4 control-label">
                                                                                    Min. Session Consultation Now
                                                                                    <span class="required" aria-required="true"> * </span>
                                                                                    <i class="fa fa-question-circle tooltips" data-original-title="Minumum waktu untuk konsultasi saat ini (now)" data-container="body"></i>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="repeat">
                                                                                    <div data-repeater-list="setting">
                                                                                        @if(isset($result['min_session_consultation_now']) && is_array($result['min_session_consultation_now']))
                                                                                            <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                                <input type="hidden" name="id_setting" value="{{$result['min_session_consultation_now']['id_setting']}}"/>
                                                                                                <div class="col-md-5">
                                                                                                    <div class="input-group">
                                                                                                        <input type="text" class="form-control" placeholder="Min. Session Consultation Now" name="value" value="{{$result['min_session_consultation_now']['value']}}"/>
                                                                                                        <span class="input-group-addon">
                                                                                                            minute
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                            </div>
                                                                                        @else
                                                                                            <div data-repeater-item class="row" style="padding-bottom:20px;">
                                                                                                <div class="col-md-5">
                                                                                                    <div class="input-group">
                                                                                                        <input type="text" class="form-control" placeholder="Min. Session Consultation Now" name="value"/>
                                                                                                        <span class="input-group-addon">
                                                                                                            minute
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-actions">
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-10">
                                                                                <button type="submit" class="btn green">
                                                                                    <i class="fa fa-check"></i> Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END: Comments -->
                                                </div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection