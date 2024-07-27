@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\AutoTranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\AutoTranslationService::class)->trans('Page title here....', app()->getLocale()))

@section('content')

@push('specific-css')

<style>
    .stamp-card {
        background-color: white;
        border: 2px solid orange;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .stamp-card h1 {
        color: orange;
        margin-bottom: 20px;
    }
    .stamps {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }
    .stamp {
        width: 50px;
        height: 50px;
        border: 2px solid orange;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        color: orange;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }
    .stamp.stamped {
        background-color: orange;
        color: white;
    }
    .stamp.stamped::before {
        content: "✓";
    }
</style>

@endpush



		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">@yield('pageTitle')</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">


                    <livewire:backend.seller.marketing.stamp-card-component :shopId="$shopId" />


                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="card">

                    <div class="stamp-card">
                        <h1>Stempelkarte</h1>
                        <div class="stamps">
                            <div class="stamp">1</div>
                            <div class="stamp">2</div>
                            <div class="stamp">3</div>
                            <div class="stamp">4</div>
                            <div class="stamp">5</div>
                            <div class="stamp">6</div>
                            <div class="stamp">7</div>
                            <div class="stamp">8</div>
                            <div class="stamp">9</div>
                            <div class="stamp">10</div>
                        </div>
                    </div>

                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                    <div class="l-container">
                        <main id="main" role="main">
                            <div class="title">Mamas Express StampCards Loyalty Program</div>                <div class="section">
                                <span class="the_date">
                                  on October 12, 2021                    </span>
                                                        <span class="categories">
                                   in <a href="https://partneressentials.menulog.com.au/rp_categories/features">Features</a>, <a href="https://partneressentials.menulog.com.au/rp_categories/whats-new">What's new</a>                        </span>
                                                </div>
                            <div class="content">
                                <p><span style="font-weight: 400;">Increase your restaurant orders with Menulog’s</span> <b>StampCards</b><span style="font-weight: 400;">, </span><span style="font-weight: 400;">a new loyalty program which allows your customers to unlock a tasty discount when they collect five stamps from your restaurant – meaning they’ll be ordering more from you!&nbsp;</span></p>
            <ul>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Customers receive a stamp for every order they place with your restaurant</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">After collecting five (5) stamps, the customer receives a discount reward of 15% of the sum of all five (5) orders</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">The reward will be issued as a credit and redeemed automatically on the next qualified order</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Stamps are valid for 365 days from issuance</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Discounts are valid for 90 days from the date of issuance</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">The value of the basket must be greater than the discount amount or the discount will not apply and will carry over to the next order</span></li>
            </ul>
            <p>&nbsp;</p>
            <p><img class="wp-image-13275 aligncenter" src="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141304.png" alt="" width="1074" height="585" srcset="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141304.png 1196w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141304-300x164.png 300w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141304-768x419.png 768w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141304-101x55.png 101w" sizes="(max-width: 1074px) 100vw, 1074px"></p>
            <p><img class="wp-image-13272 aligncenter" src="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141004.png" alt="" width="1102" height="480" srcset="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141004.png 1178w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141004-300x131.png 300w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141004-768x334.png 768w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141004-126x55.png 126w" sizes="(max-width: 1102px) 100vw, 1102px"></p>
            <p><img class="wp-image-13273 aligncenter" src="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141057.png" alt="" width="1043" height="581" srcset="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141057.png 1188w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141057-300x167.png 300w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141057-768x428.png 768w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141057-99x55.png 99w" sizes="(max-width: 1043px) 100vw, 1043px"></p>
            <p><img class="wp-image-13274 aligncenter" src="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141134.png" alt="" width="1014" height="480" srcset="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141134.png 1182w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141134-300x142.png 300w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141134-768x364.png 768w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-141134-116x55.png 116w" sizes="(max-width: 1014px) 100vw, 1014px"></p>
            <p><img class="wp-image-13271 aligncenter" src="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-140619.png" alt="" width="1007" height="418" srcset="https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-140619.png 1145w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-140619-300x125.png 300w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-140619-768x319.png 768w, https://da650dfw9hurg.cloudfront.net/2021/05/Screenshot-2021-05-12-140619-132x55.png 132w" sizes="(max-width: 1007px) 100vw, 1007px"></p>
            <h4><b>TERMS &amp; CONDITIONS</b></h4>
            <p><span style="font-weight: 400;">Click on the below to review StampCards&nbsp;</span><span style="font-weight: 400;">terms and conditions:</span></p>
            <ul>
            <li><a href="https://partner.menulog.com.au/info/stampcard-tcs">Restaurant T&amp;C’s</a></li>
            <li><a href="https://www.menulog.com.au/info/stampcards-customer-tcs">Customer T&amp;C’s</a></li>
            </ul>
            <h4><b>COST</b></h4>
            <ul>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">No upfront costs or joining fee</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Each week the redemption costs will be included in your invoice</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">You are required to complete payment as part of your normal payment</span></li>
            </ul>
            <h4><b>REPORTING</b></h4>
            <ul>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Reporting is available in Partner Center to see the program’s overall performance</span></li>
            <li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">Monthly reporting will be available to track orders and customer performance</span></li>
            </ul>
            <p>&nbsp;</p>
            <p>For more information and to opt-in, please visit <a href="https://partner-centre.menulog.com.au/marketing/stamp-cards">Partner Hub</a>.</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
                            </div>
                        </main>
                    </div>

                        </div>
                    </div>










                </div>
            </div>
            <!-- #/ container -->

            <script>
                document.querySelectorAll('.stamp').forEach(stamp => {
                    stamp.addEventListener('click', () => {
                        stamp.classList.toggle('stamped');
                    });
                });
            </script>







        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        @push('specific-scripts')

    @endpush




@endsection


