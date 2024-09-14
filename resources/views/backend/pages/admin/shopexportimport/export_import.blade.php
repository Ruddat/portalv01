<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Export/Import</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Shop Export/Import</h1>

        <!-- Erfolgsmeldungen -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Auswahl des Shops -->
        <form method="get" action="">
            <label for="shop">Wähle einen Shop:</label>
            <select name="shopId" id="shop" onchange="this.form.submit()">
                <option value="">-- Wähle einen Shop --</option>
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}" {{ request('shopId') == $shop->id ? 'selected' : '' }}>
                        {{ $shop->title }} - {{ $shop->id }}
                    </option>
                @endforeach
            </select>
        </form>

        @if(request('shopId'))
            <!-- Export-Formulare -->
            <h2>Exportieren</h2>
            <form action="{{ route('shop.export.categories', ['shopId' => request('shopId')]) }}" method="get">
                <button type="submit" class="btn btn-primary">Exportiere Kategorien</button>
            </form>
            <form action="{{ route('shop.export.products', ['shopId' => request('shopId')]) }}" method="get">
                <button type="submit" class="btn btn-primary">Exportiere Produkte</button>
            </form>
            <form action="{{ route('export.product.sizes', ['shopId' => request('shopId')]) }}" method="get">
                <button type="submit" class="btn btn-primary">Export Product Sizes</button>
            </form>

            <form action="{{ route('shop.export.product-sizes-prices', ['shopId' => request('shopId')]) }}" method="get">
                <button type="submit" class="btn btn-primary">Export Product Sizes Prices</button>
            </form>

            <!-- Import-Formulare -->
            <h2>Importieren</h2>
            <form action="{{ route('shop.import.categories', ['newShopId' => request('shopId')]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-success">Importiere Kategorien</button>
            </form>
            <form action="{{ route('shop.import.products', ['newShopId' => request('shopId')]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit" class="btn btn-success">Importiere Produkte</button>
            </form>
        @endif
    </div>
</body>
</html>
