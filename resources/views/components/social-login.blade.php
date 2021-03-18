@php $status =  has_settings('facebook_client_id', 'facebook_secret') || has_settings('google_client_id', 'google_secret'); @endphp

@if ($status)
    <div class="login-types-title">
        {{ $title }}
    </div>
@endif

<div class="login-types">
    @if (has_settings('facebook_client_id', 'facebook_secret'))
        <a href="{{ route('user.facebook.login') }}" class="login-type">
            <div class="login-type-icon">
                <i data-feather="facebook" stroke-width="1.5"></i>
            </div>
            <div class="login-type-title">Facebook</div>
        </a>
    @endif

    @if (has_settings('google_client_id', 'google_secret'))
        <a href="{{ route('user.google.login') }}" class="login-type">
            <div class="login-type-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M21.8,10h-2.6l0,0H12v4h5.7c-0.8,2.3-3,4-5.7,4c-3.3,0-6-2.7-6-6s2.7-6,6-6c1.7,0,3.2,0.7,4.2,1.8l2.8-2.8C17.3,3.1,14.8,2,12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10C22,11.3,21.9,10.6,21.8,10z" />
                </svg>
            </div>

            <div class="login-type-title">Google</div>
        </a>
    @endif

</div>

@if ($status)
    <div class="login-types-title mt-4 mb-4">
        OR
    </div>
@endif
