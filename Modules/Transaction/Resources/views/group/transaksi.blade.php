 <div class="row">
    <div class="portlet light bordered">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs">

                <li class="active" id="detailInfo">
                    <a href="#detail-info{{$value['id_transaction']}}" data-toggle="tab" > Info </a>
                </li>
                @if($value['transaction_status_code']==3)
                <li id="listProduct{{$value['id_transaction']}}">
                    <a href="#detail_list_product{{$value['id_transaction']}}" data-toggle="tab" > Tambah Menu</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="detail-info{{$value['id_transaction']}}">
                        @include('transaction::group.transaction.info')
                </div>
                 @if($value['transaction_status_code']==3)
                <div class="tab-pane" id="detail_list_product{{$value['id_transaction']}}">
                  @include('transaction::group.transaction.product')
                </div>
                @endif
            </div>
        </div>
    </div>
 </div>