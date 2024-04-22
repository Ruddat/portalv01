<div>
    {{-- Do your work, then step back. --}}






    <div>
        <!-- Button zum Öffnen des Overlays -->
        <button wire:click="openOverlay">Overlay öffnen</button>

        <!-- Overlay -->
        @if($showOverlay)
            <div class="overlay">
                <div class="overlay-content">
                    <h1>Overlay Content</h1>
                    <p>Dies ist der Inhalt des Overlays.</p>
                    <!-- Weitere Inhalte können hier eingefügt werden -->
                    <!-- Zum Schließen des Overlays -->
                    <button wire:click="closeOverlay">Overlay schließen</button>
                </div>
            </div>
        @endif
    </div>

    <style>
        /* Stil für das Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Hintergrundfarbe mit Transparenz */
            z-index: 9999; /* Stellen Sie sicher, dass das Overlay über allem anderen liegt */
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px); /* Unschärfeeffekt für den Hintergrund */
        }
        /* Stil für den Inhalt des Overlays */
        .overlay-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Schatten für den Inhalt */
        }
    </style>


    </div>








