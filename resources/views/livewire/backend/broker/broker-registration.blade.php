<div>
    @if($step == 1)
        <div>
            <h3 class="main_question"><strong>1/5</strong> In welcher Stadt möchtest du arbeiten?</h3>
            <div class="form-group">
                <div class="custom_select clearfix">
                    <select class="form-control" wire:model="location">
                        <option value="">Deine Stadt</option>
                        <option value="Frankfurt">Frankfurt</option>
                        <option value="München">München</option>
                        <option value="Berlin">Berlin</option>
                        <option value="Hamburg">Hamburg</option>
                        <option value="Köln">Köln</option>
                    </select>
                    @error('location') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <button wire:click="nextStep" class="btn btn-primary">Weiter</button>
        </div>
    @endif

    @if($step == 2)
        <div>
            <h3 class="main_question"><strong>2/5</strong> Welche Fahrzeugart nutzt du?</h3>
            <div class="form-group">
                <label class="container_radio version_2">Fahrrad
                    <input type="radio" wire:model="vehicle" value="Fahrrad">
                    <span class="checkmark"></span>
                </label>
                @error('vehicle') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="container_radio version_2">Roller
                    <input type="radio" wire:model="vehicle" value="Roller">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <label class="container_radio version_2">Auto
                    <input type="radio" wire:model="vehicle" value="Auto">
                    <span class="checkmark"></span>
                </label>
            </div>
            <p><strong><i class="icon_info"></i> Hinweis</strong><br>Du benötigst ein Fahrzeug (Fahrrad, Roller oder Auto) und ein Smartphone (iPhone oder Android), um als freiberuflicher Verkäufer erfolgreich zu sein.</p>
            <button wire:click="previousStep" class="btn btn-secondary">Zurück</button>
            <button wire:click="nextStep" class="btn btn-primary">Weiter</button>
        </div>
    @endif

    @if($step == 3)
        <div>
            <h3 class="main_question"><strong>3/5</strong> Wie hast du von uns erfahren?</h3>
            <div class="form-group">
                <label class="container_check version_2">Google-Suchmaschine
                    <input type="checkbox" wire:model="how_hear" value="Google-Suchmaschine">
                    <span class="checkmark"></span>
                </label>
                @error('how_hear') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="container_check version_2">Ein Freund von mir
                    <input type="checkbox" wire:model="how_hear" value="Ein Freund von mir">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <label class="container_check version_2">Printwerbung
                    <input type="checkbox" wire:model="how_hear" value="Printwerbung">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <label class="container_check version_2">Zeitung
                    <input type="checkbox" wire:model="how_hear" value="Zeitung">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <label class="container_check version_2">Sonstiges
                    <input type="checkbox" wire:model="how_hear" value="Sonstiges">
                    <span class="checkmark"></span>
                </label>
            </div>
            <button wire:click="previousStep" class="btn btn-secondary">Zurück</button>
            <button wire:click="nextStep" class="btn btn-primary">Weiter</button>
        </div>
    @endif

    @if($step == 4)
        <div>
            <h3 class="main_question"><strong>4/5</strong> Erzähle uns etwas über dich</h3>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="firstname" placeholder="Vorname">
                        @error('firstname') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="surname" placeholder="Nachname">
                        @error('surname') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" wire:model="email" placeholder="Deine E-Mail">
                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control" wire:model="telephone" placeholder="Deine Telefonnummer">
                @error('telephone') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="age" placeholder="Alter">
                        @error('age') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-9">
                    <div class="form-group radio_input">
                        <label class="container_radio">Männlich
                            <input type="radio" wire:model="gender" value="Männlich">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container_radio">Weiblich
                            <input type="radio" wire:model="gender" value="Weiblich">
                            <span class="checkmark"></span>
                        </label>
                        @error('gender') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <button wire:click="previousStep" class="btn btn-secondary">Zurück</button>
            <button wire:click="nextStep" class="btn btn-primary">Weiter</button>
        </div>
    @endif

    @if($step == 5)
        <div>
            <h3 class="main_question"><strong>5/5</strong> Geschäftsbedingungen akzeptieren</h3>
            <div class="form-group terms">
                <label class="container_check">Bitte akzeptiere unsere <a href="#" data-bs-toggle="modal" data-bs-target="#terms-txt">Allgemeinen Geschäftsbedingungen</a>
                    <input type="checkbox" wire:model="terms">
                    <span class="checkmark"></span>
                </label>
                @error('terms') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
            <button wire:click="previousStep" class="btn btn-secondary">Zurück</button>
            <button wire:click="submit" class="btn btn-primary">Absenden</button>
        </div>
    @endif

    <div wire:loading>
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p>Bitte warten, Ihre Anfrage wird verarbeitet...</p>
    </div>
    <style>
        .spinner-border {
            width: 3rem;
            height: 3rem;
            border: .25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
        }

        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }
    </style>

</div>


