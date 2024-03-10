<div>

    <div class="row">
    <!-- Formular zum Hinzufügen von Hauptgrößen -->
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hinzufügen von Hauptgrößen</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form wire:submit.prevent="addSize">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" wire:model="newParentSizeTitle">
                            <button class="btn btn-primary" type="submit">Hauptgröße hinzufügen</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Formular zum Hinzufügen von Untergrößen -->
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hinzufügen von Untergrößen</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form wire:submit.prevent="addChildSize">


                        <div class="mb-3">




                                <!-- Dropdown für Hauptgrößen -->
        <select wire:model="selectedParentSize" wire:change="loadChildSizes"  class="form-control ms-0 wide">
            <option value="">Wähle eine Hauptgröße</option>
            @foreach($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->title }}</option>
            @endforeach
        </select>
                        </div>

                        <div class="input-group mb-3">

                                <!-- Eingabefeld für neue Untergröße -->
        @if($selectedParentSize)
        <input type="text" class="form-control" wire:model="newChildSizeTitle" wire:keydown.enter.prevent="addChildSize">
        <button class="btn btn-primary" type="submit">Untergröße hinzufügen</button>
    @endif
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Produktgrößen / Artikelgrößen</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table header-border table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Hauptgröße</th>
                                <th>Untergröße</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>

        @foreach($sizes as $size)
            <tr>
                <td>
                    @if($editingMainSize && $mainSizeToEdit && $mainSizeToEdit->id === $size->id)
                        <!-- Eingabefeld für die Bearbeitung der Hauptgröße -->
                        <input type="text" class="form-control" wire:model="mainSizeToEdit.title" wire:keydown.enter="saveMainSize">
                    @else
                        <strong>{{ $size->title }}</strong>
                    @endif
                </td>


                <td>
                    @if($size->children->isNotEmpty())
                        <ul class="list-unstyled">
                            @foreach($size->children as $child)
                                <li class="mb-2 pb-2 border-bottom d-flex align-items-center justify-content-between">
                                    <span>{{ $child->title }}</span>
                                    <div>
                                        <!-- Schaltflächen für Sichtbarkeit, Löschen und Reihenfolge -->
                                        <button class="btn btn-link" wire:click="deleteSubSize({{ $child->id }})" title="Löschen">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <!-- Weitere Schaltflächen hier -->

                                        <button class="btn btn-link" wire:click="togglePublished({{ $child->id }})" title="Veröffentlicht ändern">
                                            @if ($child->published)
                                                <i class="fa fa-check-circle text-success" title="Veröffentlicht"></i>
                                            @else
                                                <i class="fa fa-times-circle text-danger" title="Nicht veröffentlicht"></i>
                                            @endif
                                        </button>

                                        <button class="btn btn-link" wire:click="toggleDisplay({{ $child->id }})" title="Anzeigen ändern">
                                            @if ($child->display)
                                                <i class="fa fa-eye text-info" title="Anzeigen"></i>
                                            @else
                                                <i class="fa fa-eye-slash text-muted" title="Ausblenden"></i>
                                            @endif
                                        </button>
                                        <button class="btn btn-link" wire:click="changeOrder({{ $child->id }}, 'up')" title="Nach oben verschieben">
                                            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-link" wire:click="changeOrder({{ $child->id }}, 'down')" title="Nach unten verschieben">
                                            <i class="fa fa-arrow-down text-success" aria-hidden="true"></i>
                                        </button>


                                    </div>
                                </li>

                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>



                    <!-- Aktionen für Hauptgröße -->
                    <button class="btn btn-primary shadow btn-xs sharp me-1" wire:click="editMainSize({{ $size->id }})"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger shadow btn-xs sharp" wire:click="deleteMainSize({{ $size->id }})" @if($size->children->isNotEmpty()) disabled @endif>
                        <i class="fa fa-trash"></i>
                    </button>

                </td>
            </tr>
        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    </div>
