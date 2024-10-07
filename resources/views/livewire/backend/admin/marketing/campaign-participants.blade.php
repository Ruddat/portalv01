<div class="container-fluid">
    <h2 class="mb-4">@autotranslate('Marketing Campaign Participants', app()->getLocale())</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th class="d-none d-md-table-cell">@autotranslate('Email', app()->getLocale())</th>
                    <th>@autotranslate('Shop', app()->getLocale())</th>
                    <th class="d-none d-md-table-cell">@autotranslate('Discount Percentage ', app()->getLocale())</th> <!-- Ausblenden auf kleineren Bildschirmen -->
                    <th class="d-none d-md-table-cell">@autotranslate('Voucher Code', app()->getLocale())</th> <!-- Ausblenden auf kleineren Bildschirmen -->
                    <th>@autotranslate('Valid Until', app()->getLocale())</th>
                    <th>@autotranslate('Used', app()->getLocale())</th>
                    <th>@autotranslate('Action', app()->getLocale())</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participants as $participant)
                    <tr>
                        <td class="d-none d-md-table-cell">{{ $participant->email }}</td>
                        <td>{{ $participant->shop->title ?? 'N/A' }}</td>
                        <td class="d-none d-md-table-cell">{{ $participant->discount_percentage }}%</td> <!-- Ausblenden auf kleineren Bildschirmen -->
                        <td class="d-none d-md-table-cell">{{ $participant->voucher_code }}</td> <!-- Ausblenden auf kleineren Bildschirmen -->
                        <td>{{ $participant->valid_until ? $participant->valid_until->format('Y-m-d') : 'N/A' }}</td>
                        <td>
                            @if ($participant->used)
                                <span class="badge bg-success">Used</span>
                            @else
                                <span class="badge bg-warning">Not Used</span>
                            @endif
                        </td>
                        <td>
                            <button wire:click="deleteParticipant({{ $participant->id }})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $participants->links() }}
    </div>
</div>
