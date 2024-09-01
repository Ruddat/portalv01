<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Vorschau</title>

    <!-- Dynamisch geladenes CSS -->
    @if($templateData && $templateData->css)
        @foreach($templateData->css as $css)
            @if($css->file_path)
                <link rel="stylesheet" href="{{ asset('storage/' . $css->file_path) }}">
            @else
                <style>
                    {!! $css->css_content !!}
                </style>
            @endif
        @endforeach
    @endif
</head>
<body>
    <div class="container">
        <h1>{{ $templateData->name }} - Vorschau</h1>

        <div class="template-preview">
            <!-- Angepasster Inhalt des Templates -->
            {!! $templateContent !!}
        </div>
    </div>

    <!-- Dynamisch geladenes JavaScript -->
    @if($templateData && $templateData->js)
        @foreach($templateData->js as $js)
            @if($js->file_path)
                <script src="{{ asset('storage/' . $js->file_path) }}"></script>
            @else
                <script>
                    {!! $js->js_content !!}
                </script>
            @endif
        @endforeach
    @endif
</body>
</html>
