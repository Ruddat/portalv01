<?php $page = 'ui-scrollbar'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper cardhead">
        <div class="content ">

            @component('components.breadcrumb')
                @slot('title')
                    Scroll Bar
                @endslot
                @slot('li_1')
                    Dashboard
                @endslot
                @slot('li_2')
                    Scroll Bar
                @endslot
            @endcomponent

            <div class="row">

                <!-- Scroll -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Horizontal Scroll</h5>
                        </div>
                        <div class="card-body">
                            <div class="scroll-bar-wrap">
                                <div class="horizontal-scroll scroll-demo">
                                    <div class="horz-scroll-content">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s, when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book. It has survived not only five
                                                    centuries, but also the leap into electronic typesetting, remaining
                                                    essentially unchanged.Lorem Ipsum is simply dummy text of the printing
                                                    and typesetting industry. Lorem Ipsum has been the industry's standard
                                                    dummy text ever since the 1500s, when an unknown printer took a galley
                                                    of type and scrambled it to make a type specimen book. It has survived
                                                    not only five centuries, but also the leap into electronic typesetting,
                                                    remaining essentially unchanged.</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>It was popularised in the 1960s with the release of Letraset sheets
                                                    containing Lorem Ipsum passages, and more recently with desktop
                                                    publishing software like Aldus PageMaker including versions of Lorem
                                                    Ipsum.It was popularised in the 1960s with the release of Letraset
                                                    sheets containing Lorem Ipsum passages, and more recently with desktop
                                                    publishing software like Aldus PageMaker including versions of Lorem
                                                    Ipsum.</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                                    roots in a piece of classical Latin literature from 45 BC, making it
                                                    over 2000 years old. Richard McClintock, a Latin professor at
                                                    Hampden-Sydney College in Virginia, looked up one of the more obscure
                                                    Latin words.It was popularised in the 1960s with the release of Letraset
                                                    sheets containing Lorem Ipsum passages, and more recently with desktop
                                                    publishing software like Aldus PageMaker including versions of Lorem
                                                    Ipsum.</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>It is a long established fact that a reader will be distracted by the
                                                    readable content of a page when looking at its layout. The point of
                                                    using Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters, as opposed to using 'Content here, content here', making it
                                                    look like readable English. Many desktop publishing packages and web
                                                    page editors.It was popularised in the 1960s with the release of
                                                    Letraset sheets containing Lorem Ipsum passages, and more recently with
                                                    desktop publishing software like Aldus PageMaker including versions of
                                                    Lorem Ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Scroll -->

                <!-- Scroll -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Vertical Scroll</h5>
                        </div>
                        <div class="card-body">
                            <div class="vertical-scroll scroll-demo">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged.</p>
                                <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                                    Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
                                    including versions of Lorem Ipsum</p>
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                    piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard
                                    McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of
                                    the more obscure Latin words</p>
                                <p>It is a long established fact that a reader will be distracted by the readable content of
                                    a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                                    more-or-less normal distribution of letters, as opposed to using 'Content here, content
                                    here', making it look like readable English. Many desktop publishing packages and web
                                    page editors.</p>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                                    voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                    occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt
                                    mollitia animi, id est laborum et dolorum fuga.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Scroll -->

                <!-- Scroll -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Small Size Scroll</h5>
                        </div>
                        <div class="card-body">
                            <div class="scrollbar-margins large-margin scroll-demo">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged.</p>
                                <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                                    Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
                                    including versions of Lorem Ipsum</p>
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                    piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard
                                    McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of
                                    the more obscure Latin words</p>
                                <p>It is a long established fact that a reader will be distracted by the readable content of
                                    a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                                    more-or-less normal distribution of letters, as opposed to using 'Content here, content
                                    here', making it look like readable English. Many desktop publishing packages and web
                                    page editors.</p>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                                    voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                    occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt
                                    mollitia animi, id est laborum et dolorum fuga.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Scroll -->

                <!-- Scroll -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Visible Scroll</h5>
                        </div>
                        <div class="card-body">
                            <div class="scroll-bar-wrap">
                                <div class="visible-scroll always-visible scroll-demo">
                                    <div class="horz-scroll-content">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s, when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book. It has survived not only five
                                                    centuries, but also the leap into electronic typesetting, remaining
                                                    essentially unchanged.</p>
                                                <p>It was popularised in the 1960s with the release of Letraset sheets
                                                    containing Lorem Ipsum passages, and more recently with desktop
                                                    publishing software like Aldus PageMaker including versions of Lorem
                                                    Ipsum</p>
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                                    roots in a piece of classical Latin literature from 45 BC, making it
                                                    over 2000 years old. Richard McClintock, a Latin professor at
                                                    Hampden-Sydney College in Virginia, looked up one of the more obscure
                                                    Latin words</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                                    roots in a piece of classical Latin literature from 45 BC, making it
                                                    over 2000 years old. Richard McClintock, a Latin professor at
                                                    Hampden-Sydney College in Virginia, looked up one of the more obscure
                                                    Latin words</p>
                                                <p>It is a long established fact that a reader will be distracted by the
                                                    readable content of a page when looking at its layout. The point of
                                                    using Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters, as opposed to using 'Content here, content here', making it
                                                    look like readable English. Many desktop publishing packages and web
                                                    page editors.</p>
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                                    praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                                    molestias excepturi sint occaecati cupiditate non provident, similique
                                                    sunt in culpa qui officia deserunt mollitia animi, id est laborum et
                                                    dolorum fuga.</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s, when an unknown printer took a galley of type and
                                                    scrambled it to make a type specimen book. It has survived not only five
                                                    centuries, but also the leap into electronic typesetting, remaining
                                                    essentially unchanged.</p>
                                                <p>It was popularised in the 1960s with the release of Letraset sheets
                                                    containing Lorem Ipsum passages, and more recently with desktop
                                                    publishing software like Aldus PageMaker including versions of Lorem
                                                    Ipsum</p>
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                                    roots in a piece of classical Latin literature from 45 BC, making it
                                                    over 2000 years old. Richard McClintock, a Latin professor at
                                                    Hampden-Sydney College in Virginia, looked up one of the more obscure
                                                    Latin words</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                                    roots in a piece of classical Latin literature from 45 BC, making it
                                                    over 2000 years old. Richard McClintock, a Latin professor at
                                                    Hampden-Sydney College in Virginia, looked up one of the more obscure
                                                    Latin words</p>
                                                <p>It is a long established fact that a reader will be distracted by the
                                                    readable content of a page when looking at its layout. The point of
                                                    using Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters, as opposed to using 'Content here, content here', making it
                                                    look like readable English. Many desktop publishing packages and web
                                                    page editors.</p>
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                                    praesentium voluptatum deleniti atque corrupti quos dolores et quas
                                                    molestias excepturi sint occaecati cupiditate non provident, similique
                                                    sunt in culpa qui officia deserunt mollitia animi, id est laborum et
                                                    dolorum fuga.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Scroll -->

            </div>
        </div>
    </div>
@endsection
