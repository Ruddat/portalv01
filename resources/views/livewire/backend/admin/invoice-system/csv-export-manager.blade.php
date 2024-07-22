<div wire:poll="loadCsvFiles">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">CSV-Dateien</h4>
        </div>
        <div class="card-body">

            <table class="table header-border table-responsive-sm">
                <thead>
                    <tr>
                        <th>Dateiname</th>
                        <th>Datum</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($csvFiles as $file)
                        <tr>
                            <td>{{ $file->filename }}</td>
                            <td>{{ $file->created_at }}</td>
                            <td>
                                <a href="{{ route('csv.download', $file->id) }}" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-download"></i></a>
                                <button wire:click="deleteCsv({{ $file->id }})" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                <h3>Keine CSV-Dateien gefunden.</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
