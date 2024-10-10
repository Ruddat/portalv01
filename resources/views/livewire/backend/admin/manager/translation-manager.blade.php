<div>
    <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
        <div class="mb-2 mb-md-0">
            <input type="text" wire:model.live="search" placeholder="Search translations..." class="form-control form-control-sm">
        </div>
        <div class="mb-2 mb-md-0">
            <select wire:model.lazy="locale" class="form-control form-control-sm">
                <option value="">@autotranslate('All Locales', app()->getLocale())</option>
                @foreach($locales as $locale)
                    <option value="{{ $locale }}">{{ strtoupper($locale) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select wire:model.lazy="perPage" class="form-control form-control-sm">
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

            <!-- Responsive table with scrollable feature on small screens -->
            <table class="table table-striped table-sm table-bordered">
                <thead class="thead-light">
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
                        <td class="text-wrap">{{ $translation->key }}</td>
                        <td>{{ $translation->locale }}</td>
                        <td>
                            <textarea id="{{ $translation->id }}" wire:model="saveUpdatedTranslations.{{ $translation->id }}" class="form-control form-control-sm" rows="3"></textarea>
                        </td>
                        <td>
                            <button type="button" wire:click="deleteTranslation({{ $translation->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $translations->links() }}
        </div>
        <button type="submit" class="btn btn-success btn-sm mt-3">@autotranslate('Save Changes', app()->getLocale())</button>
    </form>
</div>
