<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Dateien einbinden -->
    @foreach($cssData as $css)
        <link rel="stylesheet" href="{{ asset('storage/' . $css->file_path) }}">
    @endforeach

    <!-- Head Sections einfügen -->
    @foreach($sections as $section)
        @if($section->type === 'head')
            {!! $section->content !!}
        @endif
    @endforeach
</head>
<body>

    <!-- Navigation -->
    <nav>
        @foreach($sections as $section)
            @if($section->type === 'nav')
                {!! $section->content !!}
            @endif
        @endforeach
    </nav>

    <!-- Main Content -->
    <main>

                <!-- Dynamische Sections -->
                @foreach($sections as $section)
                @if($section->type === 'hero')
                    {!! $section->content !!}
                @endif
            @endforeach

        <!-- Dynamische Sections -->
        @foreach($sections as $section)
        @if($section->type === 'section')
        <?php echo eval("?>".Blade::compileString($section->content)."<?php "); ?>
        @endif
        @endforeach
    </main>

    <!-- Footer -->
    <footer>
        @foreach($sections as $section)
            @if($section->type === 'footer')
                {!! $section->content !!}
            @endif
        @endforeach
    </footer>

    <!-- JS Dateien einbinden -->
    @foreach($jsData as $js)
        <script src="{{ asset('storage/' . $js->file_path) }}"></script>
    @endforeach
</body>
</html>


<script>
    // Nach dem Rendern des dynamischen Inhalts
    $(document).ready(function(){
        // Initialisiere Carousel neu
        $('#carouselPopularItems').carousel();
    });
</script>
