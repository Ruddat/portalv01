<div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Custom Openinghours</h4>
                <div class="pull-right">
                    <button wire:click="toggleAddForm" class="btn btn-primary btn-sm" type="button">
                        <i class="fa fa-plus"></i>
                        Add Custom Hours
                    </button>
                </div>
            </div>
            <div class="card-body">

                @if($showAddForm)
                <form wire:submit.prevent="saveHollyDay">
                <div class="mb-3 col-md-6">
                    <input wire:model="selectedDate" type="date" class="form-control" id="selectedDate" name="selectedDate" spellcheck="false" data-ms-editor="true">
                    @error('selectedDate') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="mb-3 col-md-6">
                    <select class="form-control" wire:model="selectedMessage">
                        <option value="">Select a message</option>
                        <option value="vacation">Urlaub</option>
                        <option value="no_delivery">Keine Lieferung zurzeit</option>
                        <option value="christmas_greetings">Weihnachtsgrüße</option>
                        <option value="easter_greetings">Frohe Ostern</option>
                        <option value="special_hours">Sonderöffnungszeiten</option>
                    </select>
                </div>
                <td>
                    <div class="form-check form-switch mb-3 col-md-2">
                        <input wire:model="isOpen" class="form-check-input center" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:change="toggleIsOpen">
                        @if($isOpen)
                        <label class="form-check-label text-success" for="customCheckBox4">Open from/to</label>
                        @else
                        <label class="form-check-label text-danger" for="customCheckBox4">Closed</label>
                        @endif
                    </div>
                </td>
            @endif

            @if($isOpen)
                <div class="mb-3 col-md-6">
                    <input wire:model="startTime" type="time" class="form-control" placeholder="Start Time">
                    @error('startTime') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="mb-3 col-md-6">
                    <input wire:model="endTime" type="time" class="form-control" placeholder="End Time">
                    @error('endTime') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
            @endif
            @if($showAddForm || $showTimeFields)
            <div class="col-lg-12 mt-3">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
                </form>
            @endif
                <div class="table-responsive">
                    <table class="table header-border table-hover verticle-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">from</th>
                                <th scope="col">to</th>
                                <th scope="col">Message</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                       <!-- Loop through your holidays data and display each row -->
                       @if($holidays->isEmpty())
                       <tr>
                           <td colspan="7" class="text-center">No special hours added</td>
                       </tr>
                   @else
                       @foreach($holidays as $index => $holiday)
                           <tr>
                               <td>{{ $index + 1 }}</td>
                               <td>{{ \Carbon\Carbon::parse($holiday->holiday_date)->format('d. M Y') }}</td>
                               <td>{{ $holiday->is_open ? 'Open' : 'Closed' }}</td>
                               <td>{{ $holiday->open_time ?: '---' }}</td>
                               <td>{{ $holiday->close_time ?: '---' }}</td>
                               <td>{{ $holiday->holiday_message ?: '---' }}</td>
                               <td>
                                   <button class="btn btn-secondary" wire:click="removeHollyDay({{ $holiday->id }})">Remove</button>
                               </td>
                           </tr>
                       @endforeach
                   @endif






                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
