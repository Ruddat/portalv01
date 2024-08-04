@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
    @endpush

    <body>
        @include('frontend.includes.header-in-clearfix')


        <main>
            <div class="page_header blog element_to_stick">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
                            <h1>Hallo, Ingo</h1>
                            <div class="thumb"><img src="img/avatar.jpg" alt=""></div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-5">
                            <div class="search_bar_list">
                                <input type="text" class="form-control" placeholder="Dishes, restaurants or cuisines">
                                <button type="submit"><i class="icon_search"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <!-- /page_header -->

            <div class="container margin_60_20">




                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">

                            <div class="col-md-6">
                                <article class="blog">
                                    <figure>
                                        <a href="blog-post.html"><img src="img/blog-2.jpg" alt="">
                                            <div class="preview"><span>Read more</span></div>
                                        </a>
                                    </figure>
                                    <div class="post_info">
                                        <small>Category - 20 Nov. 2017</small>
                                        <h2><a href="blog-post.html">At usu sale dolorum offendit</a></h2>
                                        <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                                        <ul>
                                            <li>
                                                <div class="thumb"><img src="img/avatar.jpg" alt=""></div> Admin
                                            </li>
                                            <li><i class="icon_comment_alt"></i>20</li>
                                        </ul>
                                    </div>
                                </article>
                                <!-- /article -->
                            </div>
                            <!-- /col -->



                        </div>
                        <!-- /row -->



                    </div>
                    <!-- /col -->

                    <aside class="col-lg-3">
                        <div class="widget">
                            <div class="widget-title first">
                                <h4>Mein Bereich</h4>
                            </div>


                            <ul class="cats">
                                <li><a href="#">StampCard<span>(21)</span></a></li>
                                <li><a href="#">Meine Bestellungen<span>(21)</span></a></li>
                                <li><a href="#">Coupons<span>(44)</span></a></li>
                            </ul>


                        </div>
                        <!-- /widget -->
                        <div class="widget">
                            <div class="widget-title">
                                <h4>Einstellungen</h4>
                            </div>
                            <ul class="cats">
                                <li><a href="#">Mein Profil</a></li>
                                <li><a href="#">Adressen</a></li>
                            </ul>
                        </div>
                        <!-- /widget -->

                    </aside>
                    <!-- /aside -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->

        </main>
        <!-- /main -->


        @include('frontend.includes.page-snipped.broker-seller')


		<!-- /container -->


    @endsection
