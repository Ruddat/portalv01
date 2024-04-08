<div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Opening Hours</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="saveWorktimes">
                    @csrf
                <div class="table-responsive">
                    <table class="table header-border table-hover verticle-middle">
                        <thead>
                            <tr>
                                <th scope="col">Day of Week</th>
                                <th scope="col">Status</th>
                                <th scope="col">Restaurant open Times</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($openingHours as $day => $data)
                            <tr>
                                <th>{{ ucfirst($day) }}</th>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model="openingHours.{{ $day }}.isChecked" id="{{ $day }}Switch" wire:change="toggleDay('{{ $day }}')">
                                    </div>
                                </td>
                                <td>
                                    @if(isset($data['isChecked']) && $data['isChecked'])
                                        <label class="col-sm-4 col-form-label">From</label>
                                        <label class="col-sm-4 col-form-label">To</label>
                                        <div class="row">
                                            <!-- Felder für die Zeit hinzufügen -->

                                            <div class="mb-3 col-md-4">
                                                <input type="time" id="{{ $day }}StartTime" class="form-control" wire:model="openingHours.{{ $day }}.times.0.start">
                                                @error('openingHours.'.$day.'.times.0.start') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <input type="time" id="{{ $day }}EndTime" class="form-control" wire:model="openingHours.{{ $day }}.times.0.end">
                                                @error('openingHours.'.$day.'.times.0.end') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            @if(isset($data['times']) && count($data['times']) > 1)
                                            @foreach($data['times'] as $index => $time)
                                                @if($index == 0)
                                                    @continue <!-- Das erste Element überspringen -->
                                                @endif
                                                <div class="mb-3 col-md-4"></div>
                                                <div class="mb-3 col-md-4">
                                                    <input type="time" id="{{ $day }}StartTime{{ $index }}" class="form-control" wire:model="openingHours.{{ $day }}.times.{{ $index }}.start">
                                                    @error('openingHours.'.$day.'.times.'.$index.'.start') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <input type="time" id="{{ $day }}EndTime" class="form-control" wire:model="openingHours.{{ $day }}.times.{{ $index }}.end" value="{{ $time['end'] ?? null }}">
                                                    @error('openingHours.'.$day.'.times.'.$index.'.end') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            @endforeach
                                        @endif

                                            @if(isset($data['showAddButton']) && $data['showAddButton'])
                                                <!-- Add-Button anzeigen -->
                                                <div class="mb-3 col-md-4">
                                                    <button type="button" wire:click="addTime('{{ $day }}')" class="btn btn-primary">Add</button>
                                                </div>
                                            @else



                                                <!-- Remove-Button anzeigen -->
                                                <div class="mb-3 col-md-4">
                                                    <button type="button" wire:click="removeTime('{{ $day }}')" class="btn btn-secondary">Remove</button>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach





                        </tbody>
                    </table>


                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>

</div>
