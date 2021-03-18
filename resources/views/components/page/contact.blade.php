<div class="mt-3">
    {!! $page->content !!}
</div>

<form action="{{route('message.store')}}" method="POST">

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
    @endif

    @csrf
    <div class="row mt-3">
        <div class="form-group col-lg-4">
            <label for="contact_name">Your Name</label>
            <input type="text" class="form-control" id="contact_name" name="name">
            @error('name')
            <span class="invalid-feedback d-block mt-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-lg-4">
            <label for="contact_email">Your Email</label>
            <input type="email" class="form-control" id="contact_email" name="email">
            @error('email')
            <span class="invalid-feedback d-block mt-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-lg-4">
            <label for="contact_subject">Subject</label>
            <input type="text" class="form-control" id="contact_subject" name="subject">
            @error('subject')
            <span class="invalid-feedback d-block mt-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-lg-12">
            <label for="contact_message">Message</label>
            <textarea name="message" id="contact_message" class="form-control"></textarea>
            @error('message')
            <span class="invalid-feedback d-block mt-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        {!! app('captcha')->display() !!}
        @error('g-recaptcha-response')
        <span class="invalid-feedback d-block mt-2" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button class="btn fpool-button" type="submit">Send Message</button>

</form>

@section('scripts')
    @if(config()->get('captcha.secret') && config()->get('captcha.sitekey'))
        {!! NoCaptcha::renderJs() !!}
    @endif
@append
