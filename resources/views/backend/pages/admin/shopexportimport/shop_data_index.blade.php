@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shop Daten Import/Export</h1>

    <!-- Form für den Import -->
    <form action="{{ route('shopdata.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="shop_id">Shop auswählen:</label>
            <select name="shop_id" id="shop_id" class="form-control" required>
                @foreach($shops as $shop)
                <option value="{{ $shop->id }}">{{ $shop->title }} - ID:{{ $shop->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="file">Excel-Datei hochladen (Import):</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Importieren</button>
    </form>

    <hr>

    <!-- Form für den Export -->
    <h2>Export Shop Daten</h2>
    <form action="" method="GET" id="export-form">
        <div class="form-group">
            <label for="export_shop_id">Shop auswählen:</label>
            <select name="export_shop_id" id="export_shop_id" class="form-control" required>
                @foreach($shops as $shop)
                <option value="{{ $shop->id }}">{{ $shop->title }} - ID:{{ $shop->id }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-secondary">Exportieren</button>
    </form>
</div>

<script>
    document.getElementById('export-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Verhindert das Standard-Formular-Submit
        var shopId = document.getElementById('export_shop_id').value; // Holen der ausgewählten Shop-ID
        var exportUrl = "{{ route('shopdata.export', ':shop_id') }}"; // Route mit Platzhalter
        exportUrl = exportUrl.replace(':shop_id', shopId); // Platzhalter durch tatsächliche ID ersetzen
        window.location.href = exportUrl; // Weiterleitung zur generierten URL
    });
</script>
@endsection
