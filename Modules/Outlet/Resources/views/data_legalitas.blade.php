<?php
use App\Lib\MyHelper;
$grantedFeature     = session('granted_features');
$configs    		= session('configs');
?>
<form class="form-horizontal" id="form_submit" role="form" action="{{url('outlet/data-legalitas')}}" enctype="multipart/form-data" method="post">
                   
    <div class="form-body">
        <div class="form-group">
            <label for="multiple" class="control-label col-md-3">Nama NPWP <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Nama yang tertera pada NPWP" data-container="body"></i>
            </label>
            <div class="col-md-8">
                <input name="name_npwp" class="form-control" placeholder="Nama NPWP" value="{{ $outlet[0]['name_npwp']??null }}">
            </div>
        </div>
        <div class="form-group">
            <label for="multiple" class="control-label col-md-3">Nama Nomor <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Nomor yang tertera pada NPWP" data-container="body"></i>
            </label>
            <div class="col-md-8">
                <input name="no_npwp" class="form-control" placeholder="No NPWP" value="{{ $outlet[0]['no_npwp']??null }}">
            </div>
        </div>
        @if(isset($outlet[0]['npwp_attachment']))
        <div class="form-group">
            <label class="col-md-3 control-label">
                    Download File NPWP
                </label>
            <div class="col-md-8">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                 <a style="margin-top: 2%" class="btn blue btn-xs" href="{{$outlet[0]['url_npwp_attachment'] }} "><i class="fa fa-download"></i></a>
            </div>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label class="col-md-3 control-label">
                    File NPWP
                    <span class="required" aria-required="true"> * </span>
                    <i class="fa fa-question-circle tooltips" data-original-title="Masukkan File NPWP" data-container="body"></i>
                </label>
            <div class="col-md-8">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                            </div>
                            <span class="input-group-addon btn default btn-file">
                            <span class="fileinput-new"> Select file </span>
                            <span class="fileinput-exists"> Change </span>
                            <input type="file" name="npwp_attachment"> </span>
                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="multiple" class="control-label col-md-3">Nama NIB <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Nama yang tertera pada NIB" data-container="body"></i>
            </label>
            <div class="col-md-8">
                <input name="name_nib" class="form-control" placeholder="Nama NIB" value="{{ $outlet[0]['name_nib']??null }}">
            </div>
        </div>
        <div class="form-group">
            <label for="multiple" class="control-label col-md-3">Nomor NIB <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Nomor yang tertera pada NPWP" data-container="body"></i>
            </label>
            <div class="col-md-8">
                <input name="no_nib" class="form-control" placeholder="Nomor NIB" value="{{ $outlet[0]['no_nib']??null }}">
            </div>
        </div>
        @if(isset($outlet[0]['nib_attachment']))
        <div class="form-group">
              <label class="col-md-3 control-label">
                    Download File NIB
                </label>
            <div class="col-md-8">
                <a style="margin-top: 2%" class="btn blue btn-xs" href="{{$outlet[0]['url_nib_attachment'] }} "><i class="fa fa-download"></i></a>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label class="col-md-3 control-label">
                    File NIB
                    <span class="required" aria-required="true"> * </span>
                    <i class="fa fa-question-circle tooltips" data-original-title="Masukkan File NIB" data-container="body"></i>
                </label>
            <div class="col-md-8">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                            </div>
                            <span class="input-group-addon btn default btn-file">
                            <span class="fileinput-new"> Select file </span>
                            <span class="fileinput-exists"> Change </span>
                            <input type="file" name="nib_attachment"> </span>
                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                </div>
            </div>
        </div>
    </div>
  <input type="hidden" name="id_outlet" value="{{ $outlet[0]['id_outlet'] }}">
    {{ csrf_field() }}
    <div class="row" style="text-align: center">
   <button onclick="submit()" class="btn blue">Submit</button>

    </div>
</form>