        <!-- Sign In Modal -->
        <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
            <div class="modal_header">
                <h3>@autotranslate('Sign In', app()->getLocale())</h3>
            </div>
            <form method="POST" action="{{ route('client.login_handler') }}">
                @csrf
                <div class="sign-in-wrapper">
                    <a href="#0" class="social_bt facebook">@autotranslate('Login with Facebook', app()->getLocale())</a>
                    <a href="#0" class="social_bt google">@autotranslate('Login with Google', app()->getLocale())</a>
                    <div class="divider"><span>Or</span></div>
                    <div class="form-group">
                        <label>@autotranslate('Email or Username', app()->getLocale())</label>
                        <input type="text" class="form-control @error('login_id') is-invalid @enderror" name="login_id" id="login_id" value="{{ old('login_id') }}" required>
                        <i class="icon_mail_alt"></i>
                        @error('login_id')
                            <div class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>@autotranslate('Password', app()->getLocale())</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                        <i class="icon_lock_alt"></i>
                        @error('password')
                            <div class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</div>
                        @enderror
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-start">
                            <label class="container_check">@autotranslate('Remember me', app()->getLocale())
                                <input type="checkbox" name="remember">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="float-end"><a id="forgot" href="{{ route('client.forgot-password') }}">@autotranslate('Forgot Password?', app()->getLocale())</a></div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Log In" class="btn_1 full-width mb_5">
                        @autotranslate('Don’t have an account?', app()->getLocale()) <a href="{{ route('client.register') }}">@autotranslate('Sign up', app()->getLocale())</a>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            @foreach ($errors->all() as $error)
                                <div>{{ app(\App\Services\AutoTranslationService::class)->trans($error, app()->getLocale()) }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div id="forgot_pw" style="display: none;">
                        <div class="form-group">
                            <label>@autotranslate('Please confirm login email below', app()->getLocale())</label>
                            <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                            <i class="icon_mail_alt"></i>
                        </div>
                        <p>@autotranslate('You will receive an email containing a link allowing you to reset your password to a new preferred one.', app()->getLocale())</p>
                        <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /Sign In Modal -->

        @push('specific-scripts')
            <script>
                $(document).ready(function() {
                    @if(session('openModal'))
                        $.magnificPopup.open({
                            items: {
                                src: '#sign-in-dialog'
                            },
                            type: 'inline'
                        });
                    @endif

                    @if(session('showResetPassword'))
                        $('#forgot_pw').show();
                    @endif

                    $('#forgot').on('click', function() {
                        $('#forgot_pw').toggle();
                    });
                });
            </script>
        @endpush
