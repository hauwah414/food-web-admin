<div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-blue sbold uppercase">List Outlet Holiday</span>
            </div>
        </div>
        <div class="portlet-body form">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                <thead>
                    <tr>
                        <th> Bank Name</th>
                        <th> Beneficiary Name </th>
                        <th> Beneficiary Account </th>
                        {{-- <th> Action </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($bank))
                        @foreach($bank as $value)
                            <tr>
                                <td>{{ $value['bank_name'] }}</td>
                                <td>{{ $value['beneficiary_name'] }}</td>
                                <td>{{ $value['beneficiary_account'] }}</td>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>