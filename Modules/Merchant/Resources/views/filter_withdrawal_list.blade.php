<script>
    function changeSelect() {
        setTimeout(function () {
            $(".select2").select2({
                placeholder: "Search"
            });
        }, 100);
    }
    function changeSubject(val) {
        var subject = val;
        var temp1 = subject.replace("conditions[", "");
        var index = temp1.replace("][subject]", "");
        var subject_value = document.getElementsByName(val)[0].value;

        if (subject_value == 'merchant_balance_status') {
            var operator = "conditions[" + index + "][operator]";
            var operator_value = document.getElementsByName(operator)[0];
            for (i = operator_value.options.length - 1; i >= 0; i--)
                operator_value.remove(i);
            operator_value.options[operator_value.options.length] = new Option('Pending', 'Pending');
            operator_value.options[operator_value.options.length] = new Option('Completed', 'Completed');

            var parameter = "conditions[" + index + "][parameter]";
            document.getElementsByName(parameter)[0].type = 'hidden';
        }else{
            var operator = "conditions[" + index + "][operator]";
            var operator_value = document.getElementsByName(operator)[0];
            for (i = operator_value.options.length - 1; i >= 0; i--)
                operator_value.remove(i);
            operator_value.options[operator_value.options.length] = new Option('=', '=');
            operator_value.options[operator_value.options.length] = new Option('like', 'like');

            var parameter = "conditions[" + index + "][parameter]";
            document.getElementsByName(parameter)[0].type = 'text';
        }
    }

</script>

<div class="portlet card_ light bordered">
    <div class="portlet-title">
        <div class="caption font-blue ">
            <i class="icon-settings font-blue "></i>
            <span class="caption-subject bold uppercase">Filter</span>
        </div>
    </div>
    <div class="portlet-body form">

        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">{{ $title_date_start??'Date Start' }} :</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="date" class="form-control" name="date_start" value="{{ $date_start }}">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>

                <label class="col-md-2 control-label">{{ $title_date_end??'Date End' }} :</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="date" class="form-control" name="date_end" value="{{ $date_end }}">
                        <span class="input-group-btn">
                            <button class="btn default" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div><hr>

        <div class="form-body">
            <div class="form-group mt-repeater">
                <div data-repeater-list="conditions">
                    @if (!empty($conditions))
                    @foreach ($conditions as $key => $con)
                    @if(isset($con['subject']))
                    <div data-repeater-item class="mt-repeater-item mt-overflow">
                        <div class="mt-repeater-cell">
                            <div class="col-md-12">
                                <div class="col-md-1">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete mt-repeater-del-right mt-repeater-btn-inline">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <select name="subject" class="form-control input-sm select2" placeholder="Search Subject" onChange="changeSubject(this.name)" style="width:100%">
                                        <option value="merchant_balance_status" @if ($con['subject'] == 'merchant_balance_status') selected @endif>Status</option>
                                        <option value="outlet_code" @if ($con['subject'] == 'outlet_code') selected @endif>Outlet Code</option>
                                        <option value="outlet_name" @if ($con['subject'] == 'outlet_name') selected @endif>Outlet Name</option>
                                        <option value="beneficiary_name" @if ($con['subject'] == 'beneficiary_name') selected @endif>Beneficiary Name</option>
                                        <option value="beneficiary_account" @if ($con['subject'] == 'beneficiary_account') selected @endif>Beneficiary Account</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="operator" class="form-control input-sm select2" placeholder="Search Operator" id="test" style="width:100%">
                                        @if($con['subject'] == 'merchant_balance_status')
                                            <option value="Pending" @if ($con['operator'] == 'Pending') selected @endif>Pending</option>
                                            <option value="Completed" @if ($con['operator']  == 'Completed') selected @endif>Completed</option>
                                        @else
                                            <option value="=" @if ($con['operator'] == '=') selected @endif>=</option>
                                            <option value="like" @if ($con['operator']  == 'like') selected @endif>Like</option>
                                        @endif
                                    </select>
                                </div>

                                @if ($con['subject'] == 'merchant_balance_status')
                                    <div class="col-md-3">
                                        <input type="hidden" placeholder="Keyword" class="form-control" name="parameter" required @if (isset($con['parameter'])) value="{{ $con['parameter'] }}" @endif/>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <input type="text" placeholder="Keyword" class="form-control" name="parameter" required @if (isset($con['parameter'])) value="{{ $con['parameter'] }}" @endif/>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div data-repeater-item class="mt-repeater-item mt-overflow">
                        <div class="mt-repeater-cell">
                            <div class="col-md-12">
                                <div class="col-md-1">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete mt-repeater-del-right mt-repeater-btn-inline">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <select name="subject" class="form-control input-sm select2" placeholder="Search Subject" onChange="changeSubject(this.name)" style="width:100%">
                                        <option value="" selected disabled>Search Subject</option>
                                        <option value="merchant_balance_status">Status</option>
                                        <option value="outlet_code">Outlet Code</option>
                                        <option value="outlet_name">Outlet Name</option>
                                        <option value="beneficiary_name">Beneficiary Name</option>
                                        <option value="beneficiary_account">Beneficiary Account</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="operator" class="form-control input-sm select2" placeholder="Search Operator" id="test" style="width:100%">
                                        <option value="=" selected>=</option>
                                        <option value="like">Like</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Keyword" class="form-control" name="parameter" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <div data-repeater-item class="mt-repeater-item mt-overflow">
                        <div class="mt-repeater-cell">
                            <div class="col-md-12">
                                <div class="col-md-1">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete mt-repeater-del-right mt-repeater-btn-inline">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <select name="subject" class="form-control input-sm select2" placeholder="Search Subject" onChange="changeSubject(this.name)" style="width:100%">
                                        <option value="" selected disabled>Search Subject</option>
                                        <option value="merchant_balance_status">Status</option>
                                        <option value="outlet_code">Outlet Code</option>
                                        <option value="outlet_name">Outlet Name</option>
                                        <option value="beneficiary_name">Beneficiary Name</option>
                                        <option value="beneficiary_account">Beneficiary Account</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="operator" class="form-control input-sm select2" placeholder="Search Operator" id="test" style="width:100%">
                                        <option value="=" selected>=</option>
                                        <option value="like">Like</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Keyword" class="form-control" name="parameter" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="form-action col-md-12">
                    <div class="col-md-12">
                        <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add" onClick="changeSelect();">
                            <i class="fa fa-plus"></i> Add New Condition</a>
                    </div>
                </div>

                <div class="form-action col-md-12" style="margin-top:15px">
                    <div class="col-md-5">
                        <select name="rule" class="form-control input-sm " placeholder="Search Rule" required>
                            <option value="and" @if (isset($rule) && $rule == 'and') selected @endif>Valid when all conditions are met</option>
                            <option value="or" @if (isset($rule) && $rule == 'or') selected @endif>Valid when minimum one condition is met</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        {{ csrf_field() }}
                        <button type="submit" class="btn yellow"><i class="fa fa-search"></i> Search</button>
                        <a class="btn green" href="{{url()->current()}}">Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>