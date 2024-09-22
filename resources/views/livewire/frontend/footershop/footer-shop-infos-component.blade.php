<footer class="footer bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="{{ $shop->logo_url }}" alt="Restaurant Logo" class="img-fluid mb-3" style="max-width: 150px;">
            </div>
            <div class="col-md-4 mb-4">
                <h5>Öffnungszeiten</h5>
                <div class="small" itemscope itemtype="http://schema.org/LocalBusiness">
                    <meta itemprop="name" content="{{ $shop->title }}">
                    <meta itemprop="address" content="{{ $shop->street }}, {{ $shop->zip }} {{ $shop->city }}">
                    @foreach($worktimes as $day => $times)
                        <div @if($day === $currentDay) class="text-success" @endif>
                            <strong>{{ ucfirst($day) }}:</strong>
                            @if($times === 'geschlossen')
                                Geschlossen
                            @else
                                @foreach($times as $index => $time)
                                    <span itemprop="openingHours" content="{{ strtoupper($day) }} {{ date('H:i', strtotime($time['open_time'])) }}-{{ date('H:i', strtotime($time['close_time'])) }}">
                                        {{ date('H:i', strtotime($time['open_time'])) }} - {{ date('H:i', strtotime($time['close_time'])) }}
                                    </span>
                                    @if(!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Newsletter</h5>
                @if($subscriptionSuccess)
                    <p class="text-success">Vielen Dank für Ihre Anmeldung!</p>
                @else
                    <p>Melden Sie sich für unseren Newsletter an, um die neuesten Updates und Angebote zu erhalten.</p>
                    <form wire:submit.prevent="subscribe">
                        <div class="form-group">
                            <input type="email" wire:model="email" class="form-control" placeholder="Ihre E-Mail-Adresse" required autocomplete="email">
                        </div>
                        <div class="form-group">
                            <input type="text" wire:model="name" class="form-control" placeholder="Ihr Name (optional)" autocomplete="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Anmelden</button>
                    </form>
                @endif
                <div class="mt-3">
                    <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <hr class="bg-light">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; 2023 {{ $shop->title }}. Alle Rechte vorbehalten.</p>
            </div>
            <div class="col-md-6 text-md-right">
                <p>Adresse: {{ $shop->street }}, {{ $shop->zip }} - {{ $shop->city }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <a href="#" class="text-white mr-3">Impressum</a>
                <a href="#" class="text-white">Datenschutz</a>
            </div>
        </div>
    </div>
</footer>
