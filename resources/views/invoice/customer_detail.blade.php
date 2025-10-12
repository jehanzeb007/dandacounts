@if(!empty($customer))
    <div class="row">
        <div class="col-md-10">
            Customer Details
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5">
                    <h6>{{__('Name')}}</h6>
                    <div class="bill-to">
                        <span>{{$customer['name']}}</span>
                    </div>
                </div>
                <div class="col-md-5">
                    <h6>{{__('Email')}}</h6>
                    <div class="bill-to">
                        <span>{{$customer['email']}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <a href="#" id="remove" class="text-sm btn btn-danger">X</a>
        </div>

        <div class="col-md-12">
            @if(App\Models\Utility::getValByName('shipping_display')=='on')
                <div class="col-md-3">
                    <h6>{{__('Bill to')}}</h6>
                    <div class="bill-to">
                        <small>
                            <span>{{$customer['billing_name']}}</span><br>
                            <span>{{$customer['billing_phone']}}</span><br>
                            <span>{{$customer['billing_address']}}</span><br>
                            <span>{{$customer['billing_zip']}}</span><br>
                            <span>{{$customer['billing_country'] . ' , '.$customer['billing_city'].' , '.$customer['billing_state'].'.'}}</span>
                        </small>
                    </div>
                </div>
            @endif
            @if(App\Models\Utility::getValByName('shipping_display')=='on')
                <div class="col-md-3">
                    <h6>{{__('Ship to')}}</h6>
                    <div class="bill-to">
                        <small>
                            <span>{{$customer['shipping_name']}}</span><br>
                            <span>{{$customer['shipping_phone']}}</span><br>
                            <span>{{$customer['shipping_address']}}</span><br>
                            <span>{{$customer['shipping_zip']}}</span><br>
                            <span>{{$customer['shipping_country'] . ' , '.$customer['shipping_state'].' , '.$customer['shipping_city'].'.'}}</span>
                        </small>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
