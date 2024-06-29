<div>
    <div class="d-flex justify-content-between mb-4">
        <div>
            <input type="text" wire:model.lazy="search" placeholder="Search translations..." class="form-control">
        </div>
        <div>
            <select wire:model.lazy="locale" class="form-control">
                <option value="">@autotranslate('All Locales', app()->getLocale())</option>
                @foreach($locales as $locale)
                    <option value="{{ $locale }}">{{ strtoupper($locale) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select wire:model.lazy="perPage" class="form-control">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="{{ $translations->total() }}">All</option>
            </select>
        </div>
    </div>

    <form wire:submit.prevent="saveTranslations">
        <div class="table-responsive">
            <p>@autotranslate('Total Translations:', app()->getLocale()) {{ $translations->total() }}</p>
            <p>Showing {{ $translations->firstItem() }} to {{ $translations->lastItem() }} of {{ $translations->total() }} translations</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Key</th>
                        <th>Locale</th>
                        <th>Text</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($translations as $translation)
                    <tr>
                        <td>{{ $translation->id }}</td>
                        <td>@wordwrap($translation->key)</td>
                        <td>{{ $translation->locale }}</td>
                        <td>
                            <input type="text" wire:model.defer="saveUpdatedTranslations.{{ $translation->id }}" value="{{ $translation->text }}" class="form-control">
                        </td>
                        <td>
                            <button type="button" wire:click="deleteTranslation({{ $translation->id }})" class="btn btn-danger">@autotranslate('Delete', app()->getLocale())</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $translations->links() }}
        </div>
        <button type="submit" class="btn btn-success mt-3">@autotranslate('Save Changes', app()->getLocale())</button>
    </form>
</div>
