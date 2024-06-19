<div>
    @if(!$createMode && !$editMode)
        <button wire:click="create">Neues Banner erstellen</button>
    @endif

    @if($createMode)
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Neues Banner erstellen</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form wire:submit.prevent="submit">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Titel</label>
                                    <input type="text" wire:model="title" class="form-control" placeholder="Titel des Banners">
                                    @error('title') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Bannerbeschreibung wird angezeigt</label>
                                    <textarea wire:model="description" placeholder="Description" class="form-control h-auto" rows="4" id="description"></textarea>
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Chose a Icon</label>
                                    <select wire:model="icon" id="inputState" class="default-select form-control ms-0 wide">
                                        <option selected>Choose...</option>
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
                                    <label class="form-label">Coupon Code</label>
                                    <div class="input-group mb-3">
                                        <input type="text" wire:model="coupon_code" class="form-control">
                                        <button class="btn btn-primary" type="button" wire:click='generateCouponCode'>Erstellen</button>
                                        @error('coupon_code') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Bannerfarbe</label>
                                    <div class="input-group mb-3">
                                        <input type="color" wire:model="banner_color" class="form-control" placeholder="Banner Color">
                                        @error('banner_color') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="is_active">
                                    <label class="form-check-label">
                                        Aktiviert
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-xxl-6 col-md-6">
                                    <label class="form-label">Startdatum festlegen</label>
                                    <div class="input-group clockpicker">
                                        <input type="datetime-local" class="form-control" wire:model="start_time" placeholder="Startdatum festlegen">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    @error('start_time') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-xl-6 col-xxl-6 col-md-6">
                                    <label class="form-label">Enddatum festlegen</label>
                                    <div class="input-group clockpicker">
                                        <input type="datetime-local" class="form-control" wire:model="end_time" placeholder="Enddatum festlegen">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    @error('end_time') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <p></p>
                            <button type="submit" class="btn btn-primary">Erstellen</button>
                            <button type="button" wire:click="cancelEdit" class="btn btn-secondary">Abbrechen</button>
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
                        <h4 class="card-title">Banner bearbeiten</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form wire:submit.prevent="update">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Titel</label>
                                        <input type="text" wire:model="title" class="form-control" placeholder="Titel des Banners">
                                        @error('title') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Bannerbeschreibung wird angezeigt</label>
                                        <textarea wire:model="description" placeholder="Description" class="form-control h-auto" rows="4" id="description"></textarea>
                                        @error('description') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Chose a Icon</label>
                                        <select wire:model="icon" id="inputState" class="default-select form-control ms-0 wide">
                                            <option selected>Choose...</option>
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
                                        <label class="form-label">Coupon Code</label>
                                        <div class="input-group mb-3">
                                            <input type="text" wire:model="coupon_code" class="form-control">
                                            <button class="btn btn-primary" type="button" wire:click='generateCouponCode'>Erstellen</button>
                                            @error('coupon_code') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Bannerfarbe</label>
                                        <div class="input-group mb-3">
                                            <input type="color" wire:model="banner_color" class="form-control" placeholder="Banner Color">
                                            @error('banner_color') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="is_active">
                                        <label class="form-check-label">
                                            Aktiviert
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-xxl-6 col-md-6">
                                        <label class="form-label">Startdatum festlegen</label>
                                        <div class="input-group clockpicker">
                                            <input type="datetime-local" class="form-control" wire:model="start_time" placeholder="Startdatum festlegen">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        @error('start_time') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-xl-6 col-xxl-6 col-md-6">
                                        <label class="form-label">Enddatum festlegen</label>
                                        <div class="input-group clockpicker">
                                            <input type="datetime-local" class="form-control" wire:model="end_time" placeholder="Enddatum festlegen">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        @error('end_time') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <p></p>
                                <button type="submit" class="btn btn-primary">Aktualisieren</button>
                                <button type="button" wire:click="cancelEdit" class="btn btn-secondary">Abbrechen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endif

    @if(!$createMode && !$editMode)



            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@yield('pageTitle')</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">

                                <tbody>
                                    <tr>
                                        @foreach($banners as $banner)
                                        <div class="promo" style="background: {{ $banner->banner_color }} url(../../../frontend/img/pattern.svg) center center repeat;">
                                            <h3>{{ $banner->title }}</h3>
                                            <p class="invert-text">{{ $banner->description }}</p>
                                            <i class="{{ $banner->icon }}"></i>
                                            @if($banner->coupon_code)
                                            <p class="invert-text">Coupon Code: <strong>{{ $banner->coupon_code }}</strong></p>
                                            @endif
                                            <p class="invert-text">Startet: {{ $banner->start_time }} wird angezeigt bis: {{ $banner->end_time }}</p>
                                            <button wire:click="edit({{ $banner->id }})" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></button>
                                            <button wire:click="delete({{ $banner->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                        </div>
                                        @endforeach
                                    </tr>
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
        .error {
            color: red;
            font-size: 0.875em;
        }

        .invert-text {
    filter: invert(1);
}

        </style>



</div>

