<div>
    <div class="row">
        <!-- Row start -->

        <div class="col-xl-6 col-lg-6">
            <div class="card">
            <div class="card-header">
                <h4 class="card-title">Neue Zutatenbeschreibung oder Zutat eingeben</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form wire:submit.prevent="updateIngredientName">

<!-- Beispiel für die Anzeige des Ingredients-Titels im Bearbeitungsformular -->
<div class="mb-3">
    <label for="title" class="me-sm-12">Titel</label>
    <textarea wire:model="title" id="title" class="form-control h-auto" rows="2"></textarea>
    @error('title')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
                       <!-- Größen-Kategorie-Formular anzeigen -->
                       <div class="mb-3">
                        <label for="sizes" class="me-sm-12">Größen Kategorie</label>
                        <select wire:model="sizes" id="sizes" class="me-sm-12 multi-select form-control wide ms-0" multiple style="height: 130px;">
                            <!-- Iteriere über die verfügbaren Größenoptionen und füge sie als Optionen hinzu -->
                            @foreach($sizeOptions as $id => $title)
                                <option value="{{ $id }}" @if(isset($ingredientSizes[$id])) selected @endif>{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('sizes')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-check custom-checkbox mb-3 checkbox-success">
                        <input wire:model="published" type="checkbox" class="form-check-input" id="active" {{ $published ? 'checked' : '' }}>
                        <label for="active" class="form-check-label">Aktiv</label>
                    </div>



                        <button class="btn btn-primary" type="submit">Speichern</button>
                    </form>
                </div>
            </div>
             </div>

    </div>





</div>

