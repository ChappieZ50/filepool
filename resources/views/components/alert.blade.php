@if(session()->has('success'))
    <div id="payment_success" class="hide">
        {{session()->get('success')}}
    </div>
@endif

@error('success')
    <div id="payment_success" class="hide">
        {{$message}}
    </div>
@enderror


@error('purchased')
    <div id="payment_error" class="hide">
        {{$message}}
    </div>
@enderror

@error('error')
    <div id="payment_error" class="hide">
        {{$message}}
    </div>
@enderror

@if(session()->has('error'))
    <div id="payment_error" class="hide">
        {{session()->get('error')}}
    </div>
@endif
