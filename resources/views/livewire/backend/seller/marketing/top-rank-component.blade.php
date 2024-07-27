    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Boost your Rank to top #1</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                    <div class="d-profile">
                        <div class="d-flex justify-content-between mb-3 mb-sm-0">
                            <div class="d-flex">
                                <img src="{{ asset('backend/images/chat-img/pic-6.jpg') }}" alt="">
                                <div>
                                    <h3 class="font-w700">Restaurant Title</h3>
                                    <div class="d-flex align-items-center">
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0.500031L9.79611 6.02789H15.6085L10.9062 9.4443L12.7023 14.9722L8 11.5558L3.29772 14.9722L5.09383 9.4443L0.391548 6.02789H6.20389L8 0.500031Z" fill="#FC8019"></path>
                                        </svg>
                                        <p class="mb-0 px-2">5.0</p>
                                        <svg class="me-2" width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="2" cy="2.50003" r="2" fill="#C4C4C4"></circle>
                                        </svg>
                                        <p class="mb-0">1k+ Reviews</p>
                                    </div>
                                    <p>Join June 2020</p>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
									<div class="col-xl-4 col-xxl-6 col-sm-4 sp15">
										<div class="card">
											<div class="card-body p-4">
												<div class="text-center">
													<svg class="mb-2" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M12.8596 26C12.481 26 12.1069 25.8538 11.8233 25.5688L7.42915 21.1522C6.85695 20.5778 6.85695 19.6449 7.42915 19.0705C8.00135 18.4954 8.92798 18.4954 9.50018 19.0705L13.0335 22.6219L23.7065 15.2583C24.373 14.7985 25.285 14.9689 25.7425 15.6388C26.2007 16.3094 26.0311 17.2254 25.3639 17.6859L13.6883 25.7414C13.4361 25.9148 13.1475 26 12.8596 26Z" fill="#A6C44A"></path>
													<path d="M12.8596 17C12.481 17 12.1069 16.8538 11.8233 16.5688L7.42915 12.1522C6.85695 11.577 6.85695 10.6449 7.42915 10.0705C8.00135 9.49539 8.92798 9.49539 9.50018 10.0705L13.0335 13.6219L23.7065 6.25835C24.373 5.79854 25.285 5.96895 25.7425 6.63883C26.2007 7.30945 26.0311 8.2254 25.3639 8.68594L13.6883 16.7422C13.4361 16.9155 13.1475 17 12.8596 17Z" fill="#A6C44A"></path>
													</svg>
													<h4 class="mb-0">{{ $topRankPosition }}</h4>
													<p class="mb-0">Top Rank Position</p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-xxl-6 col-sm-4 sp15">
										<div class="card">
											<div class="card-body p-4">
												<div class="text-center pt-2">
													<svg class="mb-2" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M12.2101 24C5.61008 24 0.210083 18.6 0.210083 12C0.210083 5.4 5.61008 0 12.2101 0C18.8101 0 24.2101 5.4 24.2101 12C24.2101 18.6 18.8101 24 12.2101 24ZM12.2101 2.5C7.01008 2.5 2.71008 6.8 2.71008 12C2.71008 17.2 7.01008 21.5 12.2101 21.5C17.4101 21.5 21.7101 17.2 21.7101 12C21.7101 6.8 17.4101 2.5 12.2101 2.5Z" fill="#FC8019"></path>
													<path d="M10.31 16.7002C10.01 16.7002 9.61003 16.6002 9.41003 16.3002L6.91003 13.8002C6.41003 13.3002 6.41003 12.5002 6.91003 12.0002C7.41003 11.5002 8.21003 11.5002 8.71003 12.0002L10.31 13.6002L15.71 8.2002C16.21 7.7002 17.01 7.7002 17.51 8.2002C18.01 8.7002 18.01 9.5002 17.51 10.0002L11.21 16.3002C10.91 16.6002 10.61 16.7002 10.31 16.7002Z" fill="#FC8019"></path>
													</svg>
													<h4 class="mb-0">{{ $targetRank }}</h4>
													<p class="mb-0">Your new Rank</p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-xxl-12 col-sm-4 sp15">
										<div class="card">
											<div class="card-body p-4">
												<div class="text-center">
													<svg class="mb-2" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M16.5 4C14.1266 4 11.8066 4.70379 9.83317 6.02237C7.85978 7.34095 6.32171 9.21509 5.41345 11.4078C4.5052 13.6005 4.26756 16.0133 4.73058 18.3411C5.19361 20.6689 6.3365 22.8071 8.01473 24.4853C9.69296 26.1636 11.8312 27.3064 14.1589 27.7695C16.4867 28.2325 18.8995 27.9949 21.0922 27.0866C23.285 26.1783 25.1591 24.6403 26.4777 22.6669C27.7963 20.6935 28.5 18.3734 28.5 16C28.5 14.4242 28.1897 12.8637 27.5866 11.4078C26.9835 9.9519 26.0996 8.62903 24.9853 7.51472C23.871 6.40042 22.5481 5.5165 21.0922 4.91345C19.6363 4.31039 18.0759 4 16.5 4ZM16.5 25.6C14.6013 25.6 12.7453 25.037 11.1665 23.9821C9.58783 22.9273 8.35737 21.428 7.63077 19.6738C6.90417 17.9196 6.71405 15.9894 7.08447 14.1272C7.45489 12.2649 8.3692 10.5544 9.71179 9.21178C11.0544 7.8692 12.7649 6.95489 14.6272 6.58447C16.4894 6.21405 18.4196 6.40416 20.1738 7.13076C21.928 7.85737 23.4273 9.08782 24.4821 10.6665C25.537 12.2453 26.1 14.1013 26.1 16C26.1 18.5461 25.0886 20.9879 23.2883 22.7883C21.4879 24.5886 19.0461 25.6 16.5 25.6Z" fill="#EB5757"></path>
													<path d="M16.5003 10C16.182 10 15.8768 10.1264 15.6517 10.3515C15.4267 10.5765 15.3003 10.8817 15.3003 11.2V17.2C15.3003 17.5183 15.4267 17.8235 15.6517 18.0485C15.8768 18.2736 16.182 18.4 16.5003 18.4C16.8185 18.4 17.1238 18.2736 17.3488 18.0485C17.5738 17.8235 17.7003 17.5183 17.7003 17.2V11.2C17.7003 10.8817 17.5738 10.5765 17.3488 10.3515C17.1238 10.1264 16.8185 10 16.5003 10ZM17.3523 19.972L17.1723 19.816L16.9563 19.708L16.7283 19.6C16.5345 19.5629 16.3346 19.5742 16.1462 19.6328C15.9578 19.6914 15.7868 19.7955 15.6483 19.936C15.5403 20.0466 15.4548 20.177 15.3963 20.32C15.3271 20.4703 15.2942 20.6347 15.3003 20.8C15.3016 21.1148 15.4266 21.4165 15.6483 21.64C15.7646 21.7496 15.8984 21.8388 16.0443 21.904C16.1879 21.9675 16.3432 22.0003 16.5003 22.0003C16.6573 22.0003 16.8126 21.9675 16.9563 21.904C17.1021 21.8388 17.236 21.7496 17.3523 21.64C17.574 21.4165 17.6989 21.1148 17.7003 20.8C17.7 20.6392 17.6673 20.48 17.6043 20.332C17.5431 20.1975 17.4577 20.0755 17.3523 19.972Z" fill="#EB5757"></path>
													</svg>
													<h4 class="mb-0">{{ $currentPrice }}</h4>
													<p class="mb-0">Your Price for Rank</p>
												</div>
											</div>
										</div>
									</div>
								</div>

                                <div class="mb-3 col-md-12">
                                    <label for="target-rank-slider">Boost your Desired Rank:</label>
                                    <input class="custom-slider-burn" type="range" id="target-rank-slider" min="1" max="{{ $initialTopRankPosition }}" step="1" value="{{ $targetRank }}" wire:model.change="targetRank">
                                </div>


                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label for="startTime" class="form-label">Startdatum</label>
                            <input type="datetime-local" class="form-control" id="startTime" wire:model="startTime">
                            @error('startTime') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="endTime" class="form-label">Enddatum</label>
                            <input type="datetime-local" class="form-control" id="endTime" wire:model="endTime">
                            @error('endTime') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-xl-4 col-xxl-6 col-6">
                        <div class="form-check custom-checkbox mb-3 checkbox-success">
                            <input type="checkbox" class="form-check-input" checked="" id="notify_on_outbid" name="notify_on_outbid" value="1">
                            <label class="form-check-label" for="customCheckBox3"> Benachrichtigen Sie mich, wenn mein Gebot überboten wird!</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" wire:click="submit">Submit</button>


<hr />
<hr />
<div class="table-responsive">
    <h2>TopRank Buchungen</h2>
    @if (count($topRanks) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Preis</th>
                    <th>Startzeit</th>
                    <th>Endzeit</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topRanks as $topRank)
                    <tr>
                        <td>{{ $topRank->rank }}</td>
                        <td>{{ number_format($topRank->current_price, 2) }} €</td>
                        <td>{{ $topRank->start_time }}</td>
                        <td>{{ $topRank->end_time }}</td>
                        <td>
                            <button wire:click="deleteTopRank({{ $topRank->id }})" class="btn btn-danger btn-sm">
                                Löschen
                            </button>
                            <button wire:click="editTopRank({{ $topRank->id }})" class="btn btn-primary btn-sm">
                                Bearbeiten
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Keine TopRank-Buchungen gefunden.</p>
    @endif
</div>

<hr />
<div class="table-responsive">
    <h2>Archivierte TopRank Buchungen</h2>
    @php
        $archivedTopRanks = \App\Models\ModTopRankPriceArchived::where('shop_id', $shopId)->get();
    @endphp
    @if (count($archivedTopRanks) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Preis</th>
                    <th>Startzeit</th>
                    <th>Endzeit</th>
                    <th>Gelöscht am</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($archivedTopRanks as $topRank)
                    <tr>
                        <td>{{ $topRank->rank }}</td>
                        <td>{{ number_format($topRank->current_price, 2) }} €</td>
                        <td>{{ $topRank->start_time }}</td>
                        <td>{{ $topRank->end_time }}</td>
                        <td>{{ $topRank->deleted_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Keine archivierten TopRank-Buchungen gefunden.</p>
    @endif
</div>


            </div>
            </div>
        </div>




        <style>
            .custom-slider {
                width: 100%; /* Passt die Breite des Sliders an */
                height: 10px; /* Passt die Höhe des Sliders an */
                -webkit-appearance: none;
                appearance: none;
                background: #ddd; /* Hintergrundfarbe des Sliders */
                outline: none;
                opacity: 0.7;
                transition: opacity .2s;
            }

            .custom-slider:hover {
                opacity: 1;
            }

            .custom-slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 20px; /* Passt die Breite des Schiebereglers an */
                height: 20px; /* Passt die Höhe des Schiebereglers an */
                background: #4CAF50; /* Farbe des Schiebereglers */
                cursor: pointer;
                border-radius: 50%; /* Runde Form des Schiebereglers */
            }

            .custom-slider::-moz-range-thumb {
                width: 20px; /* Passt die Breite des Schiebereglers an */
                height: 20px; /* Passt die Höhe des Schiebereglers an */
                background: #4CAF50; /* Farbe des Schiebereglers */
                cursor: pointer;
                border-radius: 50%; /* Runde Form des Schiebereglers */
            }

            .custom-slider-burn {
            -webkit-appearance: none;
            width: 100%;
            height: 10px; /* Adjusted height for the track */
            border-radius: 5px;
            background: linear-gradient(to right, #ff6600, #ffcc00, #ff6600);
            outline: none;
            opacity: 0.9;
            transition: opacity .15s ease-in-out;
            margin: 0; /* Remove any default margins */
            padding: 0; /* Remove any default padding */
            position: relative;
        }

        .custom-slider-burn::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #fc8019;
            cursor: pointer;
            margin-top: -7.5px; /* Half of the thumb's height to center it */
            position: relative;
        }

        .custom-slider-burn::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #fc8019;
            cursor: pointer;
            margin-top: -7.5px; /* Half of the thumb's height to center it */
            position: relative;
        }

        .custom-slider-burn::-webkit-slider-runnable-track {
            width: 100%;
            height: 10px; /* Same height as the track */
            cursor: pointer;
            background: linear-gradient(to right, #ff6600, #ffcc00, #ff6600);
            border-radius: 5px;
            position: relative;
        }

        .custom-slider-burn::-moz-range-track {
            width: 100%;
            height: 10px; /* Same height as the track */
            cursor: pointer;
            background: linear-gradient(to right, #ff6600, #ffcc00, #ff6600);
            border-radius: 5px;
            position: relative;
        }





        </style>


        <script>
            // Die Funktionen zum Aktualisieren der Werte sind nicht mehr erforderlich,
            // da Livewire automatisch mit wire:model arbeitet und die Werte aktualisiert.
        </script>




    </div>




