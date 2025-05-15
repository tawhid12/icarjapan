@extends('layout.auth')
@section('siteTitle', 'Register')
@section('content')
<h4 class="auth-title">Sign Up</h4>
@if(Session::has('response'))
{!!Session::get('response')['message']!!}
@endif
<form action="{{route('register.store')}}" method="post">
    @csrf
    <div class="form-group position-relative has-icon-left mb-3">
        <input name="FullName" value="{{old('FullName')}}" type="text" class="form-control form-control-sm" placeholder="Full Name" required>
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
        @if($errors->has('FullName'))
        <small class="d-block text-danger">
            {{$errors->first('FullName')}}
        </small>
        @endif
    </div>
    <div class="form-group position-relative has-icon-left mb-3">
        <select id="country_id" name="country_id" class="form-control form-control-sm" required>
            <option value="">Select Country</option>
            @if(count($countries))
            @foreach($countries as $c)
            <option value="{{ $c->code}}">{{$c->name}}</option>
            @endforeach
            @endif
        </select>
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
        @if($errors->has('country_id'))
        <small class="d-block text-danger">
            {{$errors->first('country_id')}}
        </small>
        @endif
    </div>
    {{--<div class="form-group position-relative has-icon-left mb-3">
        <select id="port_id" name="port_id" class="form-control form-control-sm select2" required>
            <option value="">Select Port</option>
            @if(count($ports))
            @foreach($ports as $p)
            <option value="{{ $p->id}}">{{$p->name}}</option>
            @endforeach
            @endif
        </select>
         <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
        @if($errors->has('port_id'))
        <small class="d-block text-danger">
            {{$errors->first('port_id')}}
        </small>
        @endif
    </div>--}}
    <div class="form-group position-relative has-icon-left mb-3">
        <div class="form-group">
            <select name="port_id" class="form-control form-control-sm" id="inv_port_id" required>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-3">
        <input id="phone" name="PhoneNumber" value="{{old('PhoneNumber')}}" type="tel" class="form-control form-control-sm" required>
        <!-- <span id="validMsg" class="hide">✓ Valid</span>
        <span id="errorMsg" class="hide"></span> -->
        @if($errors->has('PhoneNumber'))
        <small class="d-block text-danger">
            {{$errors->first('PhoneNumber')}}
        </small>
        @endif
    </div>
    <div class="form-group position-relative has-icon-left mb-3">
        <input name="EmailAddress" value="{{old('EmailAddress')}}" type="email" class="form-control form-control-sm" placeholder="Email" required>
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
        @if($errors->has('EmailAddress'))
        <small class="d-block text-danger">
            {{$errors->first('EmailAddress')}}
        </small>
        @endif
    </div>
    <div class="form-group position-relative has-icon-left mb-3">
        <input type="password" name="password" class="form-control form-control-sm" placeholder="Password" required>
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        @if($errors->has('password'))
        <small class="d-block text-danger">
            {{$errors->first('password')}}
        </small>
        @endif
    </div>
    <div class="form-group position-relative has-icon-left mb-3">
        <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Confirm Password">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
        @if($errors->has('password_confirmation'))
        <small class="d-block text-danger">
            {{$errors->first('password_confirmation')}}
        </small>
        @endif
    </div>
    <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">
    <button type="submit" class="btn btn-sm btn-primary btn-block btn-lg shadow-lg mt-3">Sign Up</button>
</form>
<div class="text-center mt-3 text-lg fs-4">
    <p class='text-gray-600'>Already have an account? <a href="{{route('login')}}" class="font-bold">Log
            in</a>.</p>
</div>
@endsection
@push('scripts')
   <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'submit'}).then(function(token) {
            document.getElementById('recaptchaResponse').value = token;
        });
    });
</script>

    <script>
        $('#country_id').on('change', function() {
    // Get the selected country's code (value of the option)
    var country_code = $(this).val();

    if (country_code) {
        $.ajax({
            url: "{{route('portByCountryId')}}", // Your route for fetching ports
            type: 'GET',
            dataType: 'json',
            data: {
                country_code: country_code, // Send the country code to the server
            },
            success: function(data) {
                // Clear previous port options
                $('#inv_port_id').empty();
                $('#inv_port_id').append('<option value="">Select a Port</option>');

                // Populate the ports dropdown with the returned data
                $.each(data, function(key, value) {
                    $('#inv_port_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    } else {
        // Clear the ports dropdown if no country is selected
        $('#port_id').empty();
    }
});


        $(document).ready(function() {
            /*$('#country_id').select2({
                placeholder: "Select a country",
                allowClear: true
            });
            $('#port_id').select2({
                placeholder: "Select a port",
                allowClear: true
            });*/
        });


    </script>
@endpush