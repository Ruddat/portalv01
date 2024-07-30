<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Badwords Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table header-border table-hover verticle-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Badwort</th>
                            <th scope="col">Count</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($badwords as $index => $badword)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $badword->word }}</td>
                                <td>
                                    <span class="badge badge-primary light">{{ $badword->count }} x erfasst</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button wire:click="editBadword({{ $badword->id }})" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></button>
                                        <button wire:click="deleteBadword({{ $badword->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <input type="text" wire:model="word" wire:keydown.enter="addBadword" placeholder="Neues Badwort hinzufügen" class="form-control">
                <button wire:click="addBadword" class="btn btn-success mt-2">Hinzufügen</button>
                @error('word') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            @if ($editId)
                <div class="mt-4">
                    <input type="text" wire:model="editWord" wire:keydown.enter="updateBadword" placeholder="Badwort bearbeiten" class="form-control">
                    <button wire:click="updateBadword" class="btn btn-warning mt-2">Aktualisieren</button>
                    @error('editWord') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>
    </div>
</div>
