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
                    <form wire:submit.prevent="saveIngredientTitel">
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
                        <select wire:model="sizes" id="sizes" class="me-sm-12 multi-select form-control wide ms-0" multiple style="height: {{ $dropdownHeight }}px;">
                            <!-- Iteriere über die verfügbaren Größenoptionen und füge sie als Optionen hinzu -->
                            @foreach($sizeOptions as $id => $title)
                                <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('sizes')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                        <div class="form-check custom-checkbox mb-3 checkbox-success">
                            <input wire:model="active" type="checkbox" class="form-check-input" id="active" required>
                            <label for="active" class="form-check-label">Aktiv</label>
                        </div>

                        <button class="btn btn-primary" type="submit">Speichern</button>
                    </form>
                </div>
            </div>
             </div>

    </div>



    <div class="col-xl-6 col-lg-6">
        <div class="card">
        <div class="card-header">
            <h4 class="card-title">Neue Zutaten eingeben</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">


                <form wire:submit.prevent="addIngredient">

                    <div class="mb-3">
                        <label for="selectedCategory" class="me-sm-12">Kategorie</label>
                        <!-- Dropdown für Hauptgrößen -->
                        <select wire:model="selectedCategory" id="selectedCategory" wire:change="loadCategories" class="form-control ms-0 wide">
                            <option value="">Wähle eine Kategorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>


                    @if($selectedCategory)
                    <!-- Zutaten-Formular anzeigen -->
                    <div class="mb-3">
                        <label for="ingredienttitle" class="me-sm-12">Titel</label>
                        <input wire:model="ingredienttitle" id="ingredienttitle" class="form-control" type="text">
                        @error('ingredienttitle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="code_nr" class="form-label">Interne Nr/Kennzahl/Zutaten Nummer</label>
                        <input wire:model="code_nr" id="code_nr" class="form-control" type="text">
                        @error('code_nr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-2">
                        <label for="max_spices" class="form-label">Max Anzahl po Product</label>
                        <input wire:model="max_spices" id="max_spices" class="form-control" type="text">
                        @error('max_spices')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-2">
                        <label for="base_price" class="form-label">Grundpreis</label>
                        <input wire:model="base_price" id="base_price" class="form-control" type="text">
                        @error('base_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <hr>
                        <h4 class="mb-2">Preise</h4>


                    </div>
                    <hr>

<!-- Iteration über die Hauptgrößen -->
@foreach($mainSizes as $mainSize)
    <!-- Überprüfen, ob die Hauptgröße eine Childgröße hat -->
    @if(!empty($mainSize['children']))
        <div class="flex-container">
            <!-- Anzeige der Hauptgröße -->
            <div class="mb-3">
                <label class="sr-only">{{ $mainSize['title'] }}</label>
                <input type="text" readonly class="form-control-plaintext" value="{{ $mainSize['title'] }}">
            </div>

            <!-- Iteration über die Childgrößen -->
            @foreach($mainSize['children'] as $childId => $childTitle)
                <div class="mb-3 mx-sm-3">
                    <!-- Anzeige der Childgröße -->
                    <label>{{ $childTitle }}</label>
                    <label class="sr-only">{{ $childTitle }}</label>
                    <!-- Überprüfen, ob ein Preiswert für diese Größe vorhanden ist -->
                    @if(isset($mainSize['price'][$childId]))
                        <!-- Eingabefeld für den Preis -->
                        <input type="text" wire:model="mainSizes.{{ $loop->parent->index }}.price.{{ $childId }}" class="form-control" placeholder="0.00" value="{{ $mainSize['price'][$childId] }}">
                    @else
                        <!-- Eingabefeld für den Preis ohne voreingestellten Wert -->
                        <input type="text" wire:model="mainSizes.{{ $loop->parent->index }}.price.{{ $childId }}" class="form-control" placeholder="0.00">
                    @endif
                </div>
            @endforeach
        </div>
    @endif
@endforeach




                <div class="mb-3">
                   <div class="form-check custom-checkbox mb-3 checkbox-info">
                    <input wire:model="minordervalue" type="checkbox" class="form-check-input" id="minordervalue" required>
                    <label for="minordervalue" class="form-check-label">Zaehlt zu Mindestbestellwert</label>
                </div>
                </div>

                <div class="mb-3">
                    <div class="form-check custom-checkbox mb-3 checkbox-success">
                        <input wire:model="active" type="checkbox" class="form-check-input" id="active" required>
                        <label for="active" class="form-check-label">Aktiv</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Speichern</button>
                @else

                @endif












                </form>
            </div>
        </div>
         </div>

</div>









    <!-- Row end -->
 </div>






</div>

