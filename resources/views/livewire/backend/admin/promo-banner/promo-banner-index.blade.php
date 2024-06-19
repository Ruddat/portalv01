<div>

    @if($createMode)
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@autotranslate('Neues Banner erstellen', app()->getLocale())</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form wire:submit.prevent="submit">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">@autotranslate('Titel', app()->getLocale())</label>
                                    <input type="text" wire:model="title" class="form-control" placeholder="@autotranslate('Titel des Banners', app()->getLocale())">
                                    @error('title') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label">@autotranslate('Bannerbeschreibung wird angezeigt', app()->getLocale())</label>
                                    <textarea wire:model="description" placeholder="@autotranslate('Description', app()->getLocale())" class="form-control h-auto" rows="4" id="description"></textarea>
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">@autotranslate('Chose a Icon', app()->getLocale())</label>
                                    <select wire:model="icon" id="inputState" class="default-select form-control ms-0 wide">
                                        <option selected>@autotranslate('Choose...', app()->getLocale())</option>
                                        @foreach($icons as $icon)
                                            <option value="{{ $icon }}">{{ $icon }}</option>
                                        @endforeach
                                    </select>
                                    <span class="icon-preview">
                                        @if($icon)
                                            <i class="{{ $icon }}"></i>
                                        @endif
                                    </span>
                                    @error('icon') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">@autotranslate('Coupon Code', app()->getLocale())</label>
                                    <div class="input-group mb-3">
                                        <input type="text" wire:model="coupon_code" class="form-control">
                                        <button class="btn btn-primary" type="button" wire:click='generateCouponCode'>@autotranslate('Erstellen', app()->getLocale())</button>
                                        @error('coupon_code') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">@autotranslate('Bannerfarbe', app()->getLocale())</label>
                                    <div class="input-group mb-3">
                                        <input type="color" wire:model="banner_color" class="form-control" placeholder="@autotranslate('Banner Color', app()->getLocale())">
                                        @error('banner_color') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="is_active">
                                    <label class="form-check-label">
                                        @autotranslate('Aktiviert', app()->getLocale())
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-xxl-6 col-md-6">
                                    <label class="form-label">@autotranslate('Startdatum festlegen', app()->getLocale())</label>
                                    <div class="input-group clockpicker">
                                        <input type="datetime-local" class="form-control" wire:model="start_time" placeholder="@autotranslate('Abbrechen', app()->getLocale())Startdatum festlegen">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    @error('start_time') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-xl-6 col-xxl-6 col-md-6">
                                    <label class="form-label">@autotranslate('Enddatum festlegen', app()->getLocale())</label>
                                    <div class="input-group clockpicker">
                                        <input type="datetime-local" class="form-control" wire:model="end_time" placeholder="@autotranslate('Abbrechen', app()->getLocale())Enddatum festlegen">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    @error('end_time') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <p></p>
                            <button type="submit" class="btn btn-primary">@autotranslate('Erstellen', app()->getLocale())</button>
                            <button type="button" wire:click="cancelEdit" class="btn btn-secondary">@autotranslate('Abbrechen', app()->getLocale())</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





        @elseif($editMode)

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@autotranslate('Banner bearbeiten', app()->getLocale())</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form wire:submit.prevent="update">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">@autotranslate('Titel', app()->getLocale())</label>
                                        <input type="text" wire:model="title" class="form-control" placeholder="@autotranslate('Titel', app()->getLocale())Titel des Banners">
                                        @error('title') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">@autotranslate('Bannerbeschreibung wird angezeigt', app()->getLocale())</label>
                                        <textarea wire:model="description" placeholder="@autotranslate('Titel', app()->getLocale())Description" class="form-control h-auto" rows="4" id="description"></textarea>
                                        @error('description') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">@autotranslate('Chose a Icon', app()->getLocale())</label>
                                        <select wire:model="icon" id="inputState" class="default-select form-control ms-0 wide">
                                            <option selected>@autotranslate('Choose...', app()->getLocale())</option>
                                            @foreach($icons as $icon)
                                                <option value="{{ $icon }}">{{ $icon }}</option>
                                            @endforeach
                                        </select>
                                        <span class="icon-preview">
                                            @if($icon)
                                                <i class="{{ $icon }}"></i>
                                            @endif
                                        </span>
                                        @error('icon') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">@autotranslate('Coupon Code', app()->getLocale())</label>
                                        <div class="input-group mb-3">
                                            <input type="text" wire:model="coupon_code" class="form-control">
                                            <button class="btn btn-primary" type="button" wire:click='generateCouponCode'>@autotranslate('Erstellen', app()->getLocale())</button>
                                            @error('coupon_code') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">@autotranslate('Bannerfarbe', app()->getLocale())</label>
                                        <div class="input-group mb-3">
                                            <input type="color" wire:model="banner_color" class="form-control" placeholder="@autotranslate('Bannerfarbe', app()->getLocale())">
                                            @error('banner_color') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="is_active">
                                        <label class="form-check-label">
                                            @autotranslate('Aktiviert', app()->getLocale())
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6 col-md-6">
                                        <label class="form-label">@autotranslate('Startdatum festlegen', app()->getLocale())</label>
                                        <div class="input-group clockpicker">
                                            <input type="datetime-local" class="form-control" wire:model="start_time" placeholder="@autotranslate('Startdatum festlegen', app()->getLocale())">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        @error('start_time') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-xl-6 col-xxl-6 col-md-6">
                                        <label class="form-label">@autotranslate('Enddatum festlegen', app()->getLocale())</label>
                                        <div class="input-group clockpicker">
                                            <input type="datetime-local" class="form-control" wire:model="end_time" placeholder="@autotranslate('Enddatum festlegen', app()->getLocale())">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        @error('end_time') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <p></p>
                                <button type="submit" class="btn btn-primary">@autotranslate('Aktualisieren', app()->getLocale())</button>
                                <button type="button" wire:click="cancelEdit" class="btn btn-secondary">@autotranslate('Abbrechen', app()->getLocale())</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endif

    @if(!$createMode && !$editMode)
        <!-- Anzeige der vorhandenen Banner -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@yield('pageTitle')</h4>
                <div class="mb-3">
                    <div class="input-group">
                        <button class="btn btn-primary" wire:click="create">@autotranslate('Neues Banner erstellen', app()->getLocale())
                            <span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i></span>
                        </button>
                    </div>
                </div>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <tbody>
                                @foreach($banners as $banner)
                                <tr>
                                    <td>
                                        <div class="promo {{ $this->isBannerExpired($banner->end_time) ? 'expired' : '' }}" style="background: {{ $banner->banner_color }} url(../../../frontend/img/pattern.svg) center center repeat;">
                                            <h3>{{ $banner->title }}</h3>
                                            <p class="invert-text">{{ $banner->description }}</p>
                                            <i class="{{ $banner->icon }}"></i>
                                            @if($banner->coupon_code)
                                            <p class="invert-text">@autotranslate('Coupon Code:', app()->getLocale()) <strong>{{ $banner->coupon_code }}</strong></p>
                                            @endif
                                            <p class="invert-text">@autotranslate('Startet:', app()->getLocale()) {{ $banner->start_time }} @autotranslate('wird angezeigt bis:', app()->getLocale()) {{ $banner->end_time }}</p>
                                            <button wire:click="edit({{ $banner->id }})" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></button>
                                            <button wire:click="delete({{ $banner->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .promo {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 25px;
            padding: 20px 25px;
            color: #fff;
            position: relative;
        }

        .promo i {
            left: -100%;
            animation: moveIcon 6s linear forwards;
            animation-delay: 0.5s;
        }

        .promo.expired {
    /* Fügen Sie hier Ihre gewünschten Stile für abgelaufene Banner hinzu */
    background-image: url('/backend/images/offer-expired.png') !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
    background-color: rgba(228, 227, 227, 0.5) !important; /* Transparenter Overlay */
    color: #050505 !important; /* Textfarbe für abgelaufene Banner */
    /* Weitere Stile für das abgelaufene Banner */
}
        @keyframes moveIcon {
            0% {
                left: -100%;
                top: 50%;
            }
            100% {
                left: 100%;
                top: 50%;
            }
        }

        .icon-preview {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }

        .icon-preview i {
            font-size: 24px; /* Adjust size as needed */
        }
    </style>
</div>
