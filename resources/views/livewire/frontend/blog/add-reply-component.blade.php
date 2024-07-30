<div>
<hr />


    <form wire:submit.prevent="submit">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <input type="text" wire:model="author" name="name" id="name" class="form-control" placeholder="Name">
                @error('author') <span class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
                <input type="text" wire:model="email" name="email" id="email" class="form-control" placeholder="Email">
                @error('email') <span class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <textarea class="form-control" wire:model="content" name="content" id="content" rows="6" placeholder="@autotranslate('Reply Comment', app()->getLocale())"></textarea>
        @error('content') <span class="text-danger">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
    </div>
    <div class="form-group">
        <button type="submit" id="submit2" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Submit Reply', app()->getLocale()) </button>
    </div>
    </form>





</div>
