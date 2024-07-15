{
    "name": "Dein App-Name",
    "short_name": "App",
    "start_url": "{{ url('shop/' . $shop->id) }}",
    "display": "standalone",
    "background_color": "#ffffff",
    "theme_color": "#000000",
    "icons": [
        {
            "src": "/frontend/img/apple-touch-icon-57x57-precomposed.png",
            "sizes": "57x57",
            "type": "image/png"
        },
        {
            "src": "/frontend/img/apple-touch-icon-114x114-precomposed.png",
            "sizes": "114x114",
            "type": "image/png"
        }
    ]
}
