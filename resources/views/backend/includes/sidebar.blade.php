        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav border-right">
            <div class="dlabnav-scroll">
					<p class="menu-title style-1">@autotranslate('Main Menu', app()->getLocale())</p>



				<ul class="metismenu" id="menu">

                    @if (Auth::guard('admin')->check())
                    {{-- Aktives Menu wenn Admin eingeloggt --}}
                    <li><a class="no-arrow " href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="bi bi-house"></i>
                        <span class="nav-text">@autotranslate('Admin Home', app()->getLocale())</span>
                    </a>
                    </li>
                    @elseif(Auth::guard('seller')->check())
                    {{-- Aktives Menu wenn Seller eingeloggt --}}
                    <li><a class="no-arrow " href="{{ route('seller.dashboard') }}" aria-expanded="false">
                        <i class="bi bi-house"></i>
                        <span class="nav-text">@autotranslate('Home', app()->getLocale())</span>
                    </a>
                    </li>
                    @elseif(Auth::guard('broker')->check())
                    {{-- Aktives Menu wenn Seller eingeloggt --}}
                    <li><a class="no-arrow " href="{{ route('broker.dashboard') }}" aria-expanded="false">
                        <i class="bi bi-house"></i>
                        <span class="nav-text">@autotranslate('Home', app()->getLocale())</span>
                    </a>
                    </li>
                    @endif





                    @if (Auth::guard('admin')->check())
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-grid"></i>
							<span class="nav-text">@autotranslate('Dashboard', app()->getLocale())</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">@autotranslate('Module', app()->getLocale())</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ url('/mod-shops') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Kundenliste', app()->getLocale()) }}</a></li>
                                    <li><a href="./email-inbox.html">Kontrollcentern</a></li>
                                    <li><a href="./email-read.html">Rechnungen</a></li>
                                </ul>
                            </li>
							<li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Shop</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ url('/mod-liefergebiet') }}">@autotranslate('Liefergebiet', app()->getLocale())</a></li>
									<li><a href="{{ url('/mod-workingtimes') }}">@autotranslate('Opening Hours', app()->getLocale())</a></li>
									<li><a href="./ecom-product-detail.html">Product Details</a></li>
									<li><a href="./ecom-product-order.html">Order</a></li>
									<li><a href="./ecom-checkout.html">Checkout</a></li>
									<li><a href="./ecom-invoice.html">Invoice</a></li>
									<li><a href="./ecom-customers.html">Customers</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul aria-expanded="false">
							<li><a href="index.html">Dashboard Light</a></li>
							<li><a href="index-2.html">Dashboard Dark</a></li>
							<li><a href="food-order.html">Food Order</a></li>
							<li><a href="favorite-menu.html">Favorite Menu</a></li>
							<li><a href="message.html">Message</a></li>
							<li><a href="order-history.html">Order History</a></li>
							<li><a href="notification.html">Notification</a></li>
							<li><a href="{{ route('admin.live-orders-list') }}">@autotranslate('LiveOrders', app()->getLocale())</a></li>
                            <li><a href="{{ url('/roles-permissons') }}">Roles and Permission</a></li>
							<li><a href="setting.html">Setting</a></li>
						</ul>
                    </li>
                    @elseif(Auth::guard('seller')->check())

                    @endif


                    @php
                    $shopId = session('currentShopId'); // Annahme: Shop-ID ist in der Sitzung gespeichert
                    @endphp

                    @if ($shopId)
                    {{-- Aktiver Shop, zeige das entsprechende Menü --}}
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="true">
                            <i class="bi bi-shop-window"></i>
                            <span class="nav-text"> {{ Str::limit(session('currentShopTitle'), 13) }}</span>
                            </a>


                            <ul aria-expanded="false">
                            <li><a href="{{ route('seller.switchShop', ['id' => $shopId]) }}">Dashboard</a></li>

                            <li><a href="{{ route('seller.restoData', ['shop' => $shopId]) }}">Shopdaten</a></li>
                            <li><a href="#">Domains</a></li>
                            <li><a href="#">Logo & Design</a></li>
                            <li> <a href="{{ route('seller.deliveryarea', ['shop' => $shopId]) }}">Liefergebiet</a></li>
                            <li><a href="{{ route('seller.worktimes-list', ['shopId' => $shopId]) }}">Öffnungszeiten</a></li>
                            <li><a href="#">Aktionszeiten</a></li>
                            <li><a href="#">Zahlungsmethoden</a></li>
                            <hr>

                            <li><a href="#">Trinkgeld</a></li>
                            <li><a href="#">Gutscheine</a></li>
                            <li><a href="#">Stempelkarte</a></li>
                            <li><a href="{{ route('seller.toprank', ['shopId' => $shopId]) }}">@autotranslate('Top Rank', app()->getLocale())</a></li>
                            <hr>

                            <li><a href="{{ route('seller.indexOrderOverview', ['shopId' => $shopId]) }}">@autotranslate('Order overview', app()->getLocale())</a></li>
                            <li><a href="{{ route('seller.invoices-all', ['shopId' => $shopId]) }}">@autotranslate('Rechnungen', app()->getLocale())</a></li>

                            <li><a href="{{ route('seller.reviews-overview', ['shopId' => $shopId]) }}">@autotranslate('Customer reviews', app()->getLocale())</a></li>
                            <li><a href="#">Stornierungen</a></li>
                            <hr>
                            <li><a href="{{ route('seller.product-sizes', ['shop' => $shopId]) }}">@autotranslate('Product sizes', app()->getLocale())</a></li>
                            <li><a href="{{ route('seller.manage-ingredients.ingredients-index', ['shop' => $shopId]) }}">Zutaten</a></li>
                            <hr>
							<li><a href="{{ route('seller.manage-categories.cats-subcats-list') }}">@autotranslate('Product Categories', app()->getLocale())</a></li>

                            <hr>
                        </ul>
                    </li>

					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-bicycle"></i>

							<span class="nav-text">Drivers</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="#">Dashboard</a></li>
							<li><a href="#">Orders</a></li>
							<li><a href="#">Feedback</a></li>
						</ul>
                    </li>


					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-bicycle"></i>

							<span class="nav-text">@autotranslate('Order overview', app()->getLocale())Live Order</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="{{ route('seller.indexAction') }}">LieferandoSpider</a></li>
							<li><a href="deliver-order.html">Orders</a></li>
							<li><a href="feedback.html">Feedback</a></li>
						</ul>
                    </li>


                    {{-- Produkte Aktiver Shop, zeige das entsprechende Menü --}}


                    @endif


                    <li class="menu-title">Other</li>


                    {{-- Bestellungen Aktiver Shop, zeige das entsprechende Menü --}}
                    <li class="menu-title">Bestellungen</li>


                    {{-- Karte Aktiver Shop, zeige das entsprechende Menü --}}
                    <li class="menu-title">Karte</li>




                    @if (Auth::guard('admin')->check())
                    {{-- Aktives Menu wenn Admin eingeloggt --}}

                    <li>
                        <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-info-circle"></i>
                            <span class="nav-text">@autotranslate('Apps', app()->getLocale())</span>
                        </a>
                         <ul aria-expanded="false">
                            <li><a href="{{ route('admin.profile') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Profile', app()->getLocale()) }}</a></li>
                            <li><a href="{{ route('admin.settings') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Settings', app()->getLocale()) }}</a></li>
                            <li><a href="{{ route('admin.bottles-list') }}" class="no-arrow" {{ Route::is('admin.manage-intern.*') ? 'active' : '' }}>{{ app(\App\Services\AutoTranslationService::class)->trans('Flaschenpfand', app()->getLocale()) }}</a></li>
                            <li>
                                <a href="{{ route('admin.additives-list') }}" class="no-arrow {{ Route::currentRouteName() === 'admin.additives-list' ? 'active' : '' }}">
                                    @autotranslate('Zusatzstoffe', app()->getLocale())
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.allergens-list') }}" class="no-arrow {{ Route::currentRouteName() === 'admin.additives-list' ? 'active' : '' }}">
                                    {{ app(\App\Services\AutoTranslationService::class)->trans('Allergenes', app()->getLocale()) }}</a></li>
                                </a>
                            </li>

                          </ul>
                      </li>

                      <li>
                        <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-info-circle"></i>
                            <span class="nav-text">@autotranslate('Verwaltung', app()->getLocale())</span>
                        </a>
                         <ul aria-expanded="false">
                            <li><a href="{{ route('admin.shopmanagement') }}">@autotranslate('ShopManagement', app()->getLocale())</a></li>
                            <li><a href="{{ route('admin.translations') }}">@autotranslate('Translation', app()->getLocale())</a></li>
                            <li><a href="{{ route('admin.promo-banner-index') }}">@autotranslate('WerbeBanner', app()->getLocale())</a></li>
                            <li><a href="{{ route('admin.invoices-all') }}">@autotranslate('Abrechnungen', app()->getLocale())</a></li>
                            <li><a href="{{ route('admin.storno-manager') }}">@autotranslate('StornoManager', app()->getLocale())</a></li>
                          </ul>
                      </li>
                      @elseif(Auth::guard('seller')->check())
                       {{-- Aktives Menu wenn Seller eingeloggt --}}



                      <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-info-circle"></i>
							<span class="nav-text">@autotranslate('Settings', app()->getLocale())</span>
						</a>
                         <ul aria-expanded="false">
                            <li><a href="{{ route('seller.profile') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Profile', app()->getLocale()) }}</a></li>

                        </ul>
                    </li>


                    @endif








                </ul>
                <div class="plus-box">
					<div class="d-flex align-items-center">
						<h5>Lotto Fun - Check your Numbers</h5>

					</div>
					<a href="{{ route('seller.simulateLotto') }}" class="btn bg-white btn-sm">{{ app(\App\Services\AutoTranslationService::class)->trans('Lotto-Sim', app()->getLocale()) }}</a>
				</div>
				<div class="plus-box">
					<div class="d-flex align-items-center">
						<h5>Upgrade your Account to Get Free Voucher</h5>

					</div>
					<a href="javascript:void(0);" class="btn bg-white btn-sm">Upgrade</a>
				</div>
				<div class="copyright mt-0">
					<p><strong>Food Desk - @autotranslate('Online Food Delivery', app()->getLocale())</strong> © v{{ config('app.version', '1.0') }} - {{ \Carbon\Carbon::createFromDate(2023, 1, 12)->format('Y') }} bis {{ now()->format('Y') }} All Rights Reserved</p>
					<p class="fs-12">Made with <span class="heart"></span> by Ingo Ruddat</p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
