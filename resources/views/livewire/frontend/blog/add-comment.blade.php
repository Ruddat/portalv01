<div>

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif

    <form wire:submit.prevent="submit">
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <input type="text" wire:model="author" name="name" id="name" class="form-control" placeholder="Your Name">
                @error('author') <span class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <input type="text" wire:model="email" name="email" id="email" class="form-control" placeholder="Email">
                @error('email') <span class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <input type="url" wire:model="website" name="homepage" id="homepage" class="form-control" placeholder="Website">
                @error('website') <span class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <textarea wire:model="content" class="form-control" name="comments" id="comments" rows="6" placeholder="Your Comment"></textarea>
        @error('content') <span class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
    </div>
    <div class="form-group">
        <button type="submit" id="submit" class="btn_1 add_bottom_15">@autotranslate('Submit Comment', app()->getLocale())</button>
    </div>
    </form>


</div>



