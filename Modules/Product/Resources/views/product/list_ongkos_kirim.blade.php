<form class="form-horizontal" role="form" action="{{url('product/photo/create') }}" method="post" enctype="multipart/form-data">
    <div class="form-body">
        <h4>Create Photos</h4>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Image Logo <span class="required" aria-required="true">* <br>1:1 </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Logo product multiple ukuran 1:1" data-container="body"></i>
            </label>
            <div class="col-md-8">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                        <img src="" alt="">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" id="image" style="max-width: 200px; max-height: 200px;"></div>
                    <div>
                        <span class="btn default btn-file">
                        <span class="fileinput-new"> Select image </span>
                        <span class="fileinput-exists"> Change </span>
                        <input type="file" class="fileMultiple" id="fieldphotoMultiple" accept="image/*" name="product_image" @if(empty($val['outlet_image_logo_portrait'])) required @endif>
                        </span>

                        <a href="javascript:;" id="remove_fieldphotoMultiple" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="form-actions">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                
                <input type="hidden" name="id_product" value="{{ $detail['id_product'] }}" required>
                <button type="submit" class="btn green">Submit</button>
            </div>
        </div>
    </div>
</form>
<hr>
<br>
<table class="table table-striped table-bordered table-hover" id="table_product">
    <thead>
    <tr>
        <th> Photo </th>
        <th> Action </th>
    </tr>
    </thead>
    <tbody>
    @if (!empty($product_photo))
        @foreach($product_photo as $key => $value)
            <tr>
                <td><img src="{{$value['url_photo_image']}}" width="30"></td>
                <td>
                  <a href="{{ url('product/photo/delete') }}/{{ $value['id_product_multiple_photo'] }}" class="btn btn-sm red"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>