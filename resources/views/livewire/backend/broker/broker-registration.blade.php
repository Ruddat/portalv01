<form wire:submit.prevent="submit">
    @csrf
    <div class="login-userset">
        <div class="login-logo logo-normal">
            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
        </div>
        <a href="{{ url('index') }}" class="login-logo logo-white">
            <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="">
        </a>
        <div class="login-userheading">
            <h3>@autotranslate('Register', app()->getLocale())</h3>
            <h4>@autotranslate('Create New Dreamspos Account', app()->getLocale())</h4>
        </div>
        <div class="form-login">
            <label>@autotranslate('Name', app()->getLocale())</label>
            <div class="form-addons">
                <input type="text" class="form-control" wire:model="name" autocomplete="name">
                <img src="{{ URL::asset('/build/img/icons/user-icon.svg') }}" alt="img">
            </div>
            <div class="text-danger pt-2">
                @error('name')
                    {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                @enderror
            </div>
        </div>
        <div class="form-login">
            <label>@autotranslate('Email Address', app()->getLocale())</label>
            <div class="form-addons">
                <input type="text" class="form-control" wire:model="email" autocomplete="email">
                <img src="{{ URL::asset('/build/img/icons/mail.svg') }}" alt="img">
            </div>
            <div class="text-danger pt-2">
                @error('email')
                    {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                @enderror
            </div>
        </div>
        <div class="form-login">
            <label>@autotranslate('Password', app()->getLocale())</label>
            <div class="pass-group">
                <input type="password" class="pass-input" wire:model="password" autocomplete="new-password">
                <span class="fas toggle-password fa-eye-slash"></span>
            </div>
            <div class="text-danger pt-2">
                @error('password')
                    {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                @enderror
            </div>
        </div>
        <div class="form-login">
            <label>@autotranslate('Confirm Password', app()->getLocale())</label>
            <div class="pass-group">
                <input type="password" class="pass-inputs" wire:model="confirmpassword" autocomplete="new-password">
                <span class="fas toggle-passwords fa-eye-slash"></span>
            </div>
            <div class="text-danger pt-2">
                @error('confirmpassword')
                    {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                @enderror
            </div>
        </div>
        <div class="form-login authentication-check">
            <div class="row">
                <div class="col-sm-8">
                    <div class="custom-control custom-checkbox justify-content-start">
                        <div class="custom-control custom-checkbox">
                            <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                <input type="checkbox" wire:model="terms">
                                <span class="checkmarks"></span>@autotranslate('I agree to the', app()->getLocale()) <a href="#"
                                    class="hover-a">@autotranslate('Terms & Privacy', app()->getLocale())</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-danger pt-2">
                @error('terms')
                    {{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                @enderror
            </div>
        </div>
        <div class="form-login">
            <button type="submit" class="btn btn-login">@autotranslate('Sign Up', app()->getLocale())</button>
        </div>
        <div class="signinform">
            <h4>@autotranslate('Already have an account ?', app()->getLocale()) <a href="{{ url('signin') }}" class="hover-a">@autotranslate('Sign In Instead', app()->getLocale())</a>
            </h4>
        </div>
        <div class="form-setlogin or-text">
            <h4>@autotranslate('OR', app()->getLocale())</h4>
        </div>
        <div class="form-sociallink">
            <ul class="d-flex">
                <li>
                    <a href="javascript:void(0);" class="facebook-logo">
                        <img src="{{ URL::asset('/build/img/icons/facebook-logo.svg') }}" alt="Facebook">
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <img src="{{ URL::asset('/build/img/icons/google.png') }}" alt="Google">
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="apple-logo">
                        <img src="{{ URL::asset('/build/img/icons/apple-logo.svg') }}" alt="Apple">
                    </a>
                </li>
            </ul>
        </div>
        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
            <p>@autotranslate('Copyright &copy; 2023 DreamsPOS. All rights reserved', app()->getLocale())</p>
        </div>
    </div>
</form>

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif
