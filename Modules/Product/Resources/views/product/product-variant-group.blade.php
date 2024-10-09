<form class="form-horizontal" role="form" action="{{url('product/spesial_price/create') }}" method="post" enctype="multipart/form-data">
    <div class="form-body">
        <h4>Create Spesial Price</h4>
        <div class="form-group">
            <div class="input-icon right">
                <label class="col-md-3 control-label">
                    Outlet
                    <span class="required" aria-required="true"> * </span>
                    <i class="fa fa-question-circle tooltips" data-original-title="Pilih outlet" data-container="body"></i>
                </label>
            </div>
            <div class="col-md-4">
                <select id="id_user" name="id_user" class="form-control select2-multiple" data-placeholder="Select User" required>
                    <option></option>
                    @foreach($user as $suw)
                        <option value="{{ $suw['id'] }}">{{ $suw['phone'] }} - {{ $suw['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="input-icon right">
                <label class="col-md-3 control-label">
                Price Delivery
                <span class="required" aria-required="true"> * </span>
                <i class="fa fa-question-circle tooltips" data-original-title="Harga perkilometer" data-container="body"></i>
                </label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control price" name="product_price" value="{{ old('product_price') }}" placeholder="Product Price" required>
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
        <th> No </th>
        <th> Nama </th>
        <th> Price </th>
        <th> Action </th>
    </tr>
    </thead>
    <tbody>
    @if (!empty($spesial))
        @foreach($spesial as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{$value['name']}}</td>
                <td>{{number_format($value['product_price'] ,0,",",".")}}</td>
                <td>
                  <a href="{{ url('product/spesial_price/delete') }}/{{ $value['id_product_price_user'] }}" class="btn btn-sm red"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>