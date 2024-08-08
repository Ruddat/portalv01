@props([
    'description' => 'Default description',
    'keywords' => 'Default keywords',
    'ogTitle' => 'Default title',
    'ogDescription' => 'Default description',
    'ogImage' => asset('default-image.jpg'),
    'title' => config('app.name', 'Laravel')
])

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="Ingo Ruddat (c) Software Entwicklung, Laravel, MySql, Ajax, Java, Css, Html">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:image" content="{{ $ogImage }}">
<title>{{ $title }}</title>
