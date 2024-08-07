<!-- resources/views/components/meta-tags.blade.php -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $description ?? 'Default description' }}">
<meta name="keywords" content="{{ $keywords ?? 'Default keywords' }}">
<meta property="og:title" content="{{ $ogTitle ?? 'Default title' }}">
<meta property="og:description" content="{{ $ogDescription ?? 'Default description' }}">
<meta property="og:image" content="{{ $ogImage ?? asset('default-image.jpg') }}">
<title>{{ $title ?? 'Default title' }}</title>
