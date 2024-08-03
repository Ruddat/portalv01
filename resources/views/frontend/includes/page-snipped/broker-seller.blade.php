        <!-- /shape_element_2 -->
        <div class="shape_element_2">
            <div class="container margin_60_0">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box_info_1 pr-lg-3">
                                    <div class="wrapper_img">
                                        <figure><img src="{{ asset('frontend/img/lazy-placeholder-600-400.png') }}" data-src="{{ asset('frontend/img/submit_restaurant_home.jpg') }}" alt="" class="img-fluid lazy"></figure><span></span>
                                    </div>
                                    <h3>@autotranslate('Add Your Restaurant', app()->getLocale())</h3>
                                    <p>Willkommen in unserem Netzwerk! Hier haben Sie die Möglichkeit, Ihr Restaurant schnell und einfach hinzuzufügen. Schließen Sie sich uns an und profitieren Sie von zahlreichen Vorteilen.</p>
                                    <p><a href="{{ route('seller.register') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Tragen Sie Ihr Restaurant ein', app()->getLocale())</a>
                                        <a href="{{ route('broker.register') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Become a broker', app()->getLocale())</a></p>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="box_info_1 pl-lg-3">
                                    <div class="wrapper_img">
                                        <figure><img src="{{ asset('frontend/img/lazy-placeholder-600-400.png') }}" data-src="{{ asset('frontend/img/submit_rider_home.jpg') }}" alt="" class="img-fluid lazy"></figure><span></span>
                                    </div>
                                    <h3>@autotranslate('Already a partner', app()->getLocale())</h3>
                                    <p>Wenn Sie bereits ein Partner sind, können Sie sich hier einloggen und auf das Partnercenter oder das Broker-Portal zugreifen.</p>
                                    <p><a href="{{ route('seller.login') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate('Partnercenter', app()->getLocale())</a>
                                    <a href="{{ route('broker.login') }}" class="btn_1 medium gradient pulse_bt mt-2">@autotranslate(' Broker Portal ', app()->getLocale())</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
