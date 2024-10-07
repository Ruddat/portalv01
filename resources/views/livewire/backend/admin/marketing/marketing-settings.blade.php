<div class="container-fluid">
    <h2 class="mb-4">@autotranslate('Marketing Settings', app()->getLocale())</h2>

    <!-- Button to show the form -->
    @if(!$showForm)
        <button wire:click="$set('showForm', true)" class="btn btn-primary mb-4">@autotranslate('Add New Setting', app()->getLocale())</button>
    @endif

    <!-- Form to add/update settings -->
    @if($showForm)
        <form wire:submit.prevent="addOrUpdateSetting" class="mb-4">
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label for="duration">@autotranslate('Duration (in days)', app()->getLocale()):</label>
                    <input type="number" wire:model="duration" id="duration" class="form-control" required>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="discount_percentage">@autotranslate('Discount Percentage', app()->getLocale()):</label>
                    <input type="number" wire:model="discount_percentage" id="discount_percentage" class="form-control" required>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="validity_days">@autotranslate('Voucher Validity (in days)', app()->getLocale()):</label>
                    <input type="number" wire:model="validity_days" id="validity_days" class="form-control" required>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="usage_limit">@autotranslate('Usage Limit', app()->getLocale()):</label>
                    <input type="number" wire:model="usage_limit" id="usage_limit" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                {{ $editSettingId ? 'Update Setting' : 'Add Setting' }}
            </button>
            <button type="button" wire:click="cancelForm" class="btn btn-secondary">@autotranslate('Cancel', app()->getLocale())</button>
        </form>
    @endif

    <h3 class="mb-3">@autotranslate('Current Settings', app()->getLocale())</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>@autotranslate('Duration (days)', app()->getLocale())</th>
                    <th>@autotranslate('Discount Percentage', app()->getLocale())</th>
                    <th class="d-none d-md-table-cell">@autotranslate('Voucher Validity (days)', app()->getLocale())</th>
                    <th class="d-none d-md-table-cell">@autotranslate('Usage Limit', app()->getLocale())</th>
                    <th>@autotranslate('Action', app()->getLocale())</th>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                    <tr>
                        <td>{{ $setting->duration }}</td>
                        <td>{{ $setting->discount_percentage }}%</td>
                        <td class="d-none d-md-table-cell">{{ $setting->validity_days }}</td>
                        <td class="d-none d-md-table-cell">{{ $setting->usage_limit }}</td>
                        <td>
                            <button wire:click="editSetting({{ $setting->id }})" class="btn btn-warning btn-sm">@autotranslate('Edit', app()->getLocale())</button>
                            <button wire:click="deleteSetting({{ $setting->id }})" class="btn btn-danger btn-sm">@autotranslate('Delete', app()->getLocale())</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
