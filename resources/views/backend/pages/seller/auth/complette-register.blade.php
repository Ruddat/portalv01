<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @extends('backend.includes.head')

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="{{ asset('backend/images/logo-full.png') }}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Complete Registration - Final Step</h4>
                                    <div class="text-center">
                                        <strong>Enter your data and set up your shops!</strong>
                                    </div>

									<form action="{{ route('seller.register_last_step_handler',['token'=>request()->token]) }}" method="POST">
                                        @csrf
                                        @include('backend.includes.errorflash')




                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username" placeholder="username">
                                            @error('username')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>

<div class="row">

                                        <div class="mb-3 col-md-6">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" value="{{ old('new_password') }}" placeholder="Password" name="new_password" id="new_password">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordVisibility">Show</button>
                                            </div>
                                            @error('new_password')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <div class="input-group">
                                                <input type="password" class="form-control"  value="{{ old('new_password_confirmation') }}" placeholder="Confirm Password" name="new_password_confirmation" id="new_password_confirmation">
                                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPasswordVisibility">Show</button>
                                            </div>
                                            @error('new_password_confirmation')
                                            <span class="text-danger hidden">{{ $message }}</span>
                                            @enderror
                                        </div>

</div>



 

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('backend/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('backend/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('backend/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
<script>

document.getElementById('togglePasswordVisibility').addEventListener('click', function() {
    var passwordInput = document.getElementById('new_password');
    var buttonText = this.textContent.trim();
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.textContent = 'Hide';
    } else {
        passwordInput.type = 'password';
        this.textContent = 'Show';
    }
});

document.getElementById('toggleConfirmPasswordVisibility').addEventListener('click', function() {
    var confirmPasswordInput = document.getElementById('new_password_confirmation');
    var buttonText = this.textContent.trim();
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        this.textContent = 'Hide';
    } else {
        confirmPasswordInput.type = 'password';
        this.textContent = 'Show';
    }
});
</script>


</body>
</html>
