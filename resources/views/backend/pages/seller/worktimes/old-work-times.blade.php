@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')





        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4 class="card-title">Regular opening hours </h4>
                                <p class="mb-0 subtitle">{{ app(\App\Services\TranslationService::class)->trans('You can update the regular opening hours of your restaurant. Please select a day of the week below and fill out the opening hours of your restaurant.', app()->getLocale()) }}</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Delivery</th>
                                                <th>Pickup</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Monday</th>
                                                <td>17:00 - 22:00</td>
                                                <td>17:00 - 22:00</td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="me-4" data-bs-toggle="modal" data-bs-target="#modalGrid" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                    </span>
                                            </tr>

                                            <tr>
                                                <th>Tuesday</th>
                                                <td data-label="Delivery"><span class="cell-inner status-closed">Closed</span></td>
                                                <td data-label="Picup"><span class="cell-inner status-closed">Closed</span></td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="me-4" data-bs-toggle="modal" data-bs-target="#modalGrid" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                    </span>
                                            </tr>

                                            <tr>
                                                <th>Wednesday</th>
                                                <td>17:00 - 22:00</td>
                                                <td>17:00 - 22:00</td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="me-4" data-bs-toggle="modal" data-bs-target="#modalGrid" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                    </span>
                                            </tr>
                                            <tr>
                                                <th>Thursday</th>
                                                <td>17:00 - 22:00</td>
                                                <td>17:00 - 22:00</td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="me-4" data-bs-toggle="modal" data-bs-target="#modalGrid" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                    </span>
                                            </tr>

                                            <tr>
                                                <th>Friday</th>
                                                <td data-label="Delivery"><span class="cell-inner status-closed">Closed</span></td>
                                                <td data-label="Picup"><span class="cell-inner status-closed">Closed</span></td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="me-4" data-bs-toggle="modal" data-bs-target="#modalGrid" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                    </span>
                                            </tr>

                                            <tr>
                                                <th>Saturday</th>
                                                <td>17:00 - 22:00</td>
                                                <td>17:00 - 22:00</td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="me-4" data-bs-toggle="modal" data-bs-target="#modalGrid" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                    </span>
                                            </tr>
                                            <tr>
                                                <th>Sunday</th>
                                                <td>17:00 - 22:00 <br>
                                                    17:00 - 22:00</td>
                                                <td>17:00 - 22:00</td>
                                                <td>
                                                    <span>
                                                        <a href="#" class="me-4" data-bs-toggle="modal" data-bs-target="#modalGrid" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                    </span>
                                                </tr>





                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>




                                    <!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="modalGrid">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Monday</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Schiebeschalter für Delivery -->
                <div class="mb-3 form-check form-switch">
                    <label class="form-check-label" for="delivery_switch">Delivery</label>
                    <input class="form-check-input" type="checkbox" id="delivery_switch" checked>
                </div>
                <!-- Dropdown-Menüs für Delivery-Zeiten -->
                <div class="container" id="opening_hours_div">
                    <form class="d-flex align-items-center flex-wrap">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Open from</label>
                                <select id="open_from_1" class="form-select ms-0 wide scrollable-select" name="open_from_1">
                                    <!-- Optionen werden durch JavaScript generiert -->
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Open till</label>
                                <select id="open_till_1" class="form-select ms-0 wide scrollable-select" name="open_till_1">
                                    <!-- Optionen werden durch JavaScript generiert -->
                                </select>
                            </div>
                            <!-- Plus-Button für zusätzliche Zeit für Delivery -->
                            <div class="mb-3 col-md-4 d-flex align-items-end">
                                <label class="form-label me-2">Add Time</label>
                                <button id="plus_button_1" type="button" class="btn btn-primary" onclick="addAdditionalTime(1)">+</button>
                            </div>
                            <!-- Zusätzliche Zeit für Delivery -->
                            <div id="additional_time_1" style="display: none;" class="mb-3 col-md-8">
                                <!-- Hier wird die zusätzliche Zeit für Delivery generiert -->
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Schiebeschalter für Pickup -->
                <div class="mb-3 form-check form-switch">
                    <label class="form-check-label" for="pickup_switch">Pickup</label>
                    <input class="form-check-input" type="checkbox" id="pickup_switch" checked>
                </div>
                <!-- Dropdown-Menüs für Pickup-Zeiten -->
                <div class="container" id="pickup_opening_hours_div">
                    <form class="d-flex align-items-center flex-wrap">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Open from</label>
                                <select id="open_from_2" class="form-select ms-0 wide scrollable-select" name="open_from_2">
                                    <!-- Optionen werden durch JavaScript generiert -->
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Open till</label>
                                <select id="open_till_2" class="form-select ms-0 wide scrollable-select" name="open_till_2">
                                    <!-- Optionen werden durch JavaScript generiert -->
                                </select>
                            </div>
                            <!-- Plus-Button für zusätzliche Zeit für Pickup -->
                            <div class="mb-3 col-md-4 d-flex align-items-end">
                                <label class="form-label me-2">Add Time</label>
                                <button id="plus_button_2" type="button" class="btn btn-primary" onclick="addAdditionalTime(2)">+</button>
                            </div>
                            <!-- Zusätzliche Zeit für Pickup -->
                            <div id="additional_time_2" style="display: none;" class="mb-3 col-md-8">
                                <!-- Hier wird die zusätzliche Zeit für Pickup generiert -->
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Zusätzliches Select-Menü für optionale Aktionen -->
                <div class="mb-3">
                    <label class="form-label">Optional actions</label>
                    <select id="optional_actions" class="form-select ms-0 wide">
                        <option value="apply_all">Apply to all days of the week</option>
                        <option value="apply_monday">Apply only to Monday</option>
                        <!-- Weitere Optionen hier einfügen -->
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Apply</button>
            </div>
        </div>
    </div>
</div>




                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->







    @push('specific-css')
<!-- CSS-Stil für das Scrollable-Menü -->
<style>
    .scrollable-select {
        max-height: 200px; /* Maximale Höhe des Select-Elements */
        overflow-y: auto; /* Vertikale Scrollleiste anzeigen */
    }
</style>

    @endpush

    @push('specific-scripts')



    <script>
        // Funktion zum Generieren der Zeiten im 15-Minuten-Intervall
        function generateTimes() {
            // IDs der Dropdown-Menüs im Modal
            var selectIds = ["open_from_1", "open_till_1", "open_from_2", "open_till_2"];

            // Iteriere über alle Dropdown-Menüs
            selectIds.forEach(function(selectId) {
                var select = document.getElementById(selectId);
                if (select) {
                    // Setze den Start auf 00:00:00 Uhr
                    var start = new Date();
                    start.setHours(0, 0, 0, 0);

                    // Iteriere über 24 Stunden im 15-Minuten-Intervall
                    for (var i = 0; i < 24 * 4; i++) {
                        var option = document.createElement("option");
                        var hours = start.getHours().toString().padStart(2, "0"); // Führende Nullen hinzufügen
                        var minutes = start.getMinutes() + i * 15;
                        var adjustedHours = Math.floor(minutes / 60); // Stunden anpassen, falls Minuten über 59 sind
                        var adjustedMinutes = minutes % 60; // Minuten innerhalb des 0-59 Bereichs halten
                        var hoursStr = (start.getHours() + adjustedHours) % 24; // Stunden innerhalb des 0-23 Bereichs halten
                        var hoursStr = hoursStr.toString().padStart(2, "0"); // Führende Nullen hinzufügen
                        var minutesStr = adjustedMinutes.toString().padStart(2, "0"); // Führende Nullen hinzufügen
                        var timeString = hoursStr + ":" + minutesStr;
                        option.text = timeString;
                        option.value = timeString;
                        select.add(option);
                    }
                    select.classList.add("scrollable-select"); // Füge der Klasse das Scrollverhalten hinzu
                }
            });
        }

        // Aufruf der Funktion zum Generieren der Zeiten, wenn das Dokument geladen ist
        document.addEventListener("DOMContentLoaded", function() {
            generateTimes();
        });


    </script>





<!-- Funktion zum Hinzufügen einer zusätzlichen Zeit für Delivery oder Pickup -->
<script>
    function addAdditionalTime(sectionId) {
        var additionalTimeSection = document.getElementById("additional_time_" + sectionId);
        if (additionalTimeSection.style.display === "none") {
            additionalTimeSection.style.display = "block";
        }
        var selectFrom = document.createElement("select");
        var selectTill = document.createElement("select");
        selectFrom.classList.add("form-select", "ms-0", "wide", "scrollable-select");
        selectTill.classList.add("form-select", "ms-0", "wide", "scrollable-select");
        selectFrom.setAttribute("name", "open_from_" + sectionId);
        selectTill.setAttribute("name", "open_till_" + sectionId);

        // Hier werden die Optionen für die zusätzliche Zeit generiert und den Select-Menüs hinzugefügt
        for (var i = 0; i < 24 * 4; i++) {
            var option = document.createElement("option");
            var hours = Math.floor(i / 4);
            var minutes = (i % 4) * 15;
            var timeString = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes);
            option.text = timeString;
            option.value = timeString;
            selectFrom.add(option.cloneNode(true));
            selectTill.add(option.cloneNode(true));
        }

        // Füge die Select-Menüs zur zusätzlichen Zeit hinzu
        additionalTimeSection.appendChild(selectFrom);
        additionalTimeSection.appendChild(selectTill);

        // Plus-Button für zusätzliche Zeit wird ausgeblendet, um mehrfache Hinzufügungen zu verhindern
        var plusButton = document.getElementById("plus_button_" + sectionId);
        if (plusButton) {
            plusButton.disabled = true; // Den Plus-Button deaktivieren, um mehrfache Hinzufügungen zu verhindern
        }

        // Erstelle den Trash-Button zum Entfernen der zusätzlichen Zeit
        var trashButton = document.createElement("button");
        trashButton.classList.add("btn", "btn-danger");
        trashButton.innerText = "Trash";
        trashButton.onclick = function() {
            additionalTimeSection.innerHTML = ""; // Entferne den Inhalt der zusätzlichen Zeit
            additionalTimeSection.style.display = "none"; // Verstecke die zusätzliche Zeit
            plusButton.disabled = false; // Aktiviere den Plus-Button wieder
        };

        // Füge den Trash-Button hinzu
        additionalTimeSection.appendChild(trashButton);
    }
</script>

<!-- JavaScript-Code -->
<script>
    // Warten, bis das Dokument vollständig geladen ist
    document.addEventListener("DOMContentLoaded", function() {
        // Lieferungskontrollkästchen abrufen
        var deliveryCheckbox = document.getElementById("delivery_switch");
        // Pickup-Kontrollkästchen abrufen
        var pickupCheckbox = document.getElementById("pickup_switch");

        // Event-Listener hinzufügen, um Änderungen am Lieferungskontrollkästchen zu überwachen
        deliveryCheckbox.addEventListener("change", function() {
            // Öffnungszeiten-Div abrufen
            var openingHoursDiv = document.getElementById("opening_hours_div");

            // Überprüfen, ob das Lieferungskontrollkästchen aktiviert ist
            if (deliveryCheckbox.checked) {
                // Lieferung aktiviert: Öffnungszeiten anzeigen
                openingHoursDiv.style.display = "block";
            } else {
                // Lieferung deaktiviert: Öffnungszeiten ausblenden und "closed" anzeigen
                openingHoursDiv.style.display = "none";
                // Optional: "closed" anzeigen
                // var closedMessage = document.createElement("p");
                // closedMessage.textContent = "Closed";
                // openingHoursDiv.appendChild(closedMessage);
            }
        });

        // Event-Listener hinzufügen, um Änderungen am Pickup-Kontrollkästchen zu überwachen
        pickupCheckbox.addEventListener("change", function() {
            // Öffnungszeiten-Div für Pickup abrufen
            var pickupOpeningHoursDiv = document.getElementById("pickup_opening_hours_div");

            // Überprüfen, ob das Pickup-Kontrollkästchen aktiviert ist
            if (pickupCheckbox.checked) {
                // Pickup aktiviert: Öffnungszeiten anzeigen
                pickupOpeningHoursDiv.style.display = "block";
            } else {
                // Pickup deaktiviert: Öffnungszeiten ausblenden und "closed" anzeigen
                pickupOpeningHoursDiv.style.display = "none";
                // Optional: "closed" anzeigen
                // var closedMessage = document.createElement("p");
                // closedMessage.textContent = "Closed";
                // pickupOpeningHoursDiv.appendChild(closedMessage);
            }
        });
    });
</script>





    @endpush

@endsection


