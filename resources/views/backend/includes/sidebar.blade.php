        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav border-right">
            <div class="dlabnav-scroll">
					<p class="menu-title style-1"> Main Menu</p>



				<ul class="metismenu" id="menu">

                    @if (Auth::guard('admin')->check())
                    {{-- Aktives Menu wenn Admin eingeloggt --}}
                    <li><a class="no-arrow " href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="bi bi-house"></i>
                        <span class="nav-text">Admin Home</span>
                    </a>
                    </li>
                    @elseif(Auth::guard('seller')->check())
                    {{-- Aktives Menu wenn Seller eingeloggt --}}
                    <li><a class="no-arrow " href="{{ route('seller.dashboard') }}" aria-expanded="false">
                        <i class="bi bi-house"></i>
                        <span class="nav-text">Home</span>
                    </a>
                    </li>
                    @endif





                    @if (Auth::guard('admin')->check())
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-grid"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Module</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ url('/mod-shops') }}">{{ app(\App\Services\TranslationService::class)->trans('Kundenliste', app()->getLocale()) }}</a></li>
                                    <li><a href="./email-inbox.html">Kontrollcentern</a></li>
                                    <li><a href="./email-read.html">Rechnungen</a></li>
                                </ul>
                            </li>
							<li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Shop</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ url('/mod-liefergebiet') }}">{{ app(\App\Services\TranslationService::class)->trans('Liefergebiet', app()->getLocale()) }}</a></li>
									<li><a href="{{ url('/mod-workingtimes') }}">{{ app(\App\Services\TranslationService::class)->trans('Opening Hours', app()->getLocale()) }}</a></li>
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
							<li><a href="{{ route('admin.live-orders-list') }}">LiveOrders</a></li>
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
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-shop-window"></i>
                            <span class="nav-text"> {{ Str::limit(session('currentShopTitle'), 13) }}</span>
                            </a>


                            <ul aria-expanded="false">
                            <li><a href="{{ route('seller.switchShop', ['id' => $shopId]) }}">Dashboard</a></li>

                            <li><a href="{{ route('seller.restoData', ['shop' => $shopId]) }}">Shopdaten</a></li>
                            <li><a href="#">Domains</a></li>
                            <li><a href="#">Logo & Design</a></li>
                            <li><a href="{{ route('seller.deliveryarea', ['shop' => $shopId]) }}">Liefergebiet</a></li>
                            <li><a href="{{ route('seller.worktimes') }}">Öffnungszeiten</a></li>
                            <li><a href="#">Aktionszeiten</a></li>
                            <li><a href="#">Zahlungsmethoden</a></li>
                            <li><a href="{{ route('seller.indexOrderOverview', ['shopId' => $shopId]) }}">Bestellübersicht</a></li>
                            <hr>
                            <li><a href="{{ route('seller.product-sizes', ['shop' => $shopId]) }}">Produktgroessen</a></li>
                            <li><a href="{{ route('seller.manage-ingredients.ingredients-index', ['shop' => $shopId]) }}">Zutaten</a></li>
                            <hr>
                        </ul>
                    </li>

					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-bicycle"></i>

							<span class="nav-text">Drivers</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="deliver-main.html">Dashboard</a></li>
							<li><a href="deliver-order.html">Orders</a></li>
							<li><a href="feedback.html">Feedback</a></li>
						</ul>
                    </li>


					<li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-bicycle"></i>

							<span class="nav-text">Live Order</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="{{ route('seller.indexAction') }}">LieferandoSpider</a></li>
							<li><a href="deliver-order.html">Orders</a></li>
							<li><a href="feedback.html">Feedback</a></li>
						</ul>
                    </li>


                    {{-- Produkte Aktiver Shop, zeige das entsprechende Menü --}}
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-cart-plus"></i>

							<span class="nav-text">{{ app(\App\Services\TranslationService::class)->trans('Products', app()->getLocale()) }}</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="{{ route('seller.manage-categories.cats-subcats-list') }}">{{ app(\App\Services\TranslationService::class)->trans('Product Categories', app()->getLocale()) }}</a></li>
							<li><a href="deliver-order.html">Orders</a></li>
							<li><a href="feedback.html">Feedback</a></li>


						</ul>
                    </li>

                    @endif


                    <li class="menu-title">Other</li>
                    <li><a href="{{ route('seller.indexAction') }}">LieferandoSpider</a></li>

                    {{-- Bestellungen Aktiver Shop, zeige das entsprechende Menü --}}
                    <li class="menu-title">Bestellungen</li>
                    <li><a href="#" class="" aria-expanded="false">
                        <i class="bi bi-gear-wide"></i>
                        <span class="nav-text">Bestellübersicht</span>

                    </a>
                </li>
                <li><a href="widget-basic.html" class="" aria-expanded="false">
                    <i class="bi bi-gear-wide"></i>
                    <span class="nav-text">Bewertungen</span>
                    </a>
                </li>
                <li><a href="widget-basic.html" class="" aria-expanded="false">
                    <i class="bi bi-gear-wide"></i>
                    <span class="nav-text">Rechnungen</span>
                    </a>
                </li>



                    {{-- Karte Aktiver Shop, zeige das entsprechende Menü --}}
                    <li class="menu-title">Karte</li>
                    <li><a href="widget-basic.html" class="" aria-expanded="false">
                        <i class="bi bi-gear-wide"></i>
                        <span class="nav-text">Größen</span>
                    </a>
                </li>
                <li><a href="widget-basic.html" class="" aria-expanded="false">
                    <i class="bi bi-gear-wide"></i>
                    <span class="nav-text">Zutaten</span>
                    </a>
                </li>



                    @if (Auth::guard('admin')->check())
                    {{-- Aktives Menu wenn Admin eingeloggt --}}
                     <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-info-circle"></i>
							<span class="nav-text">Apps</span>
						</a>
                         <ul aria-expanded="false">
                            <li><a href="{{ route('admin.profile') }}">{{ app(\App\Services\TranslationService::class)->trans('Profile', app()->getLocale()) }}</a></li>
                            <li><a href="{{ route('admin.settings') }}">{{ app(\App\Services\TranslationService::class)->trans('Settings', app()->getLocale()) }}</a></li>
                            <li><a href="{{ route('admin.bottles-list') }}" class="no-arrow" {{ Route::is('admin.manage-intern.*') ? 'active' : '' }}>{{ app(\App\Services\TranslationService::class)->trans('Flaschenpfand', app()->getLocale()) }}</a></li>
                            <li>
                                <a href="{{ route('admin.additives-list') }}" class="no-arrow {{ Route::currentRouteName() === 'admin.additives-list' ? 'active' : '' }}">
                                    {{ app(\App\Services\TranslationService::class)->trans('Zusatzstoffe', app()->getLocale()) }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.allergens-list') }}" class="no-arrow {{ Route::currentRouteName() === 'admin.additives-list' ? 'active' : '' }}">
                                    {{ app(\App\Services\TranslationService::class)->trans('Allergenes', app()->getLocale()) }}</a></li>
                                </a>
                            </li>

                          </ul>
                      </li>
                      @elseif(Auth::guard('seller')->check())
                       {{-- Aktives Menu wenn Seller eingeloggt --}}



                      <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
						<i class="bi bi-info-circle"></i>
							<span class="nav-text">Settings</span>
						</a>
                         <ul aria-expanded="false">
                            <li><a href="{{ route('seller.profile') }}">{{ app(\App\Services\TranslationService::class)->trans('Profile', app()->getLocale()) }}</a></li>

                        </ul>
                    </li>


                    @endif



                     <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-pie-chart"></i>
							<span class="nav-text">Charts</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./chart-flot.html">Flot</a></li>
                            <li><a href="./chart-morris.html">Morris</a></li>
                            <li><a href="./chart-chartjs.html">Chartjs</a></li>
                            <li><a href="./chart-chartist.html">Chartist</a></li>
                            <li><a href="./chart-sparkline.html">Sparkline</a></li>
                            <li><a href="./chart-peity.html">Peity</a></li>
                        </ul>
                    </li>
                     <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-star"></i>
							<span class="nav-text">Bootstrap</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.html">Accordion</a></li>
                            <li><a href="./ui-alert.html">Alert</a></li>
                            <li><a href="./ui-badge.html">Badge</a></li>
                            <li><a href="./ui-button.html">Button</a></li>
                            <li><a href="./ui-modal.html">Modal</a></li>
                            <li><a href="./ui-button-group.html">Button Group</a></li>
                            <li><a href="./ui-list-group.html">List Group</a></li>
                            <li><a href="./ui-card.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-grid.html">Grid</a></li>

                        </ul>
                    </li>
                     <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-heart"></i>
							<span class="nav-text">Plugins</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./uc-select2.html">Select 2</a></li>
                            <li><a href="./uc-nestable.html">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.html">Toastr</a></li>
                            <li><a href="./map-jqvmap.html">Jqv Map</a></li>
							<li><a href="./uc-lightgallery.html">Light Gallery</a></li>
                        </ul>
                    </li>
                    <li><a href="widget-basic.html" class="" aria-expanded="false">
							<i class="bi bi-gear-wide"></i>
							<span class="nav-text">Widget</span>
						</a>
					</li>
                     <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-file-earmark-check"></i>
							<span class="nav-text">Forms</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./form-element.html">Form Elements</a></li>
                            <li><a href="./form-wizard.html">Wizard</a></li>
                            <li><a href="./form-ckeditor.html">CkEditor</a></li>
                            <li><a href="form-pickers.html">Pickers</a></li>
                            <li><a href="form-validation.html">Form Validate</a></li>
                        </ul>
                    </li>
                     <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-file-earmark-spreadsheet"></i>
							<span class="nav-text">Table</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>
                     <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
							<i class="bi bi-file-earmark-break"></i>
							<span class="nav-text">Pages</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./page-login.html">Login</a></li>
                            <li><a href="./page-register.html">Register</a></li>
                            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="./page-error-400.html">Error 400</a></li>
                                    <li><a href="./page-error-403.html">Error 403</a></li>
                                    <li><a href="./page-error-404.html">Error 404</a></li>
                                    <li><a href="./page-error-500.html">Error 500</a></li>
                                    <li><a href="./page-error-503.html">Error 503</a></li>
                                </ul>
                            </li>
                            <li><a href="./page-lock-screen.html">Lock Screen</a></li>
                            <li><a href="./empty-page.html">Empty Page</a></li>
                        </ul>
                    </li>
                </ul>
				<div class="plus-box">
					<div class="d-flex align-items-center">
						<h5>Upgrade your Account to Get Free Voucher</h5>

					</div>
					<a href="javascript:void(0);" class="btn bg-white btn-sm">Upgrade</a>
				</div>
				<div class="copyright mt-0">
					<p><strong>Food Desk - Online Food Delivery Admin Dashboard</strong> © 2022 All Rights Reserved</p>
					<p class="fs-12">Made with <span class="heart"></span> by DexignLab</p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
