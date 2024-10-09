<?php
use App\Lib\MyHelper;
$grantedFeature     = session('granted_features');
$configs    		= session('configs');
?>

<table class="table table-striped table-bordered table-hover" id="table_product">
    <thead>
    <tr>
        <th> No </th>
        <th> Type </th>
        <th> Total Price </th>
        <th> Price Delivery </th>
        <th> Action </th>
    </tr>
    </thead>
    <tbody>
    @if (!empty($delivery))
        @foreach($delivery as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>@if($value['flat']==1) Flat @else Perkilometer @endif</td>
                <td>{{number_format($value['total_price'] ,0,",",".")}}</td>
                <td>{{number_format($value['price_delivery'] ,0,",",".")}}</td>
                <td>
                  <a href="{{ url('outlet/delivery/delete') }}/{{ $value['id_outlet_delivery'] }}" class="btn btn-sm red"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>