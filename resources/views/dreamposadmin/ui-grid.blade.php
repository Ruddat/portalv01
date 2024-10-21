<?php $page = 'ui-grid'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Grid</h4>
                </div>
            </div>
            <div class="row">

                <!-- Grid options -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Grid options</h5>
                            <p class="mt-1 f-m-light"></p>Bootstrap grid system allow all six breakpoints, and any
                            breakpoints
                            you can customize.
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center">
                                                <p>Extra small</p><small>&lt;576px</small>
                                            </th>
                                            <th class="text-center">
                                                <p>Small</p><small>≥576px</small>
                                            </th>
                                            <th class="text-center">
                                                <p>Medium</p><small>≥768px</small>
                                            </th>
                                            <th class="text-center">
                                                <p>Large</p><small>≥992px</small>
                                            </th>
                                            <th class="text-center">
                                                <p>Extra large</p><small>≥1200px</small>
                                            </th>
                                            <th class="text-center">
                                                <p>Extra extra large</p><small class="digits">≥1400px</small>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-nowrap" scope="row">Grid behavior</th>
                                            <td>Horizontal at all times</td>
                                            <td colspan="5">Collapsed to start, horizontal above breakpoints</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" scope="row">Max container width</th>
                                            <td>None (auto)</td>
                                            <td>540px</td>
                                            <td>720px</td>
                                            <td>960px</td>
                                            <td>1140px</td>
                                            <td>1320px</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" scope="row">Class prefix</th>
                                            <td><code>.col-</code></td>
                                            <td><code>.col-sm-</code></td>
                                            <td><code>.col-md-</code></td>
                                            <td><code>.col-lg-</code></td>
                                            <td><code>.col-xl-</code></td>
                                            <td><code>.col-xxl-</code></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" scope="row"># of columns</th>
                                            <td colspan="6">12</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" scope="row">Gutter width</th>
                                            <td colspan="6">1.5rem (.75rem on left and right)</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" scope="row">Nestable</th>
                                            <td colspan="6">Yes</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" scope="row">Offsets</th>
                                            <td colspan="6">Yes</td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap" scope="row">Column ordering</th>
                                            <td colspan="6">Yes</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Grid options -->

                <!-- Grid for column -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Grid for column</h5>
                            <p class="mt-1 f-m-light">You may use predefined grid classes. Using <code>.col-md-* </code>you
                                can set the grid system.</p>
                        </div>
                        <div class="card-body grid-showcase">
                            <div class="row">
                                <div class="col-md-1 text-center"><span>col-md-1</span></div>
                                <div class="col-md-2 text-center"><span>col-md-2</span></div>
                                <div class="col-md-2 text-center"><span>col-md-2</span></div>
                                <div class="col-md-3 text-center"><span>col-md-3</span></div>
                                <div class="col-md-4 text-center"><span>col-md-4</span></div>
                                <div class="col-md-5 text-center"><span>col-md-5</span></div>
                                <div class="col-md-7 text-center"><span>col-md-7</span></div>
                                <div class="col-md-6 text-center"><span>col-md-6</span></div>
                                <div class="col-md-6 text-center"><span>col-md-6</span></div>
                                <div class="col-md-8 text-center"><span>col-md-8</span></div>
                                <div class="col-md-4 text-center"><span>col-md-4</span></div>
                                <div class="col-md-9 text-center"><span>col-md-9</span></div>
                                <div class="col-md-3 text-center"><span>col-md-3</span></div>
                                <div class="col-md-10 text-center"><span>col-md-10</span></div>
                                <div class="col-md-2 text-center"><span>col-md-2</span></div>
                                <div class="col-md-12 text-center"><span>col-md-12</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Grid for column -->

                <!-- Vertical alignment -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Vertical alignment</h5>
                            <p class="mt-1 f-m-light">You can use the <code>align-items-*</code> class to set the vertical
                                alignment.
                            </p>
                        </div>
                        <div class="card-body grid-showcase mb-0">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="row grid-vertical align-items-start m-1 g-2 bg-light">
                                        <div class="col-6"><span class="bg-white">one column</span></div>
                                        <div class="col-6"><span class="bg-white">two column</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row grid-vertical align-items-center m-1 g-2 bg-light">
                                        <div class="col-6"><span class="bg-white">one column</span></div>
                                        <div class="col-6"><span class="bg-white">two column</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row grid-vertical align-items-end m-1 g-2 bg-light">
                                        <div class="col-6"><span class="bg-white">one column</span></div>
                                        <div class="col-6"><span class="bg-white">two column</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Vertical alignment -->

                <!-- Horizontal alignment -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Horizontal alignment</h5>
                            <p class="mt-1 f-m-light">You can use the <code>justify-content-*</code> class to set the
                                horizontal alignment.</p>
                        </div>
                        <div class="card-body grid-showcase grid-align">
                            <div class="row justify-content-start bg-light">
                                <div class="col-5"><span class="bg-white text-dark">One column</span></div>
                                <div class="col-5"><span class="bg-white text-dark">Two column</span></div>
                            </div>
                            <div class="row justify-content-center bg-light">
                                <div class="col-5"><span class="bg-white text-dark">One column</span></div>
                                <div class="col-5"><span class="bg-white text-dark">Two column</span></div>
                            </div>
                            <div class="row justify-content-end bg-light">
                                <div class="col-5"><span class="bg-white text-dark">One column</span></div>
                                <div class="col-5"><span class="bg-white text-dark">Two column</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Horizontal alignment -->

                <!-- Nesting -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Nesting</h5>
                            <p class="mt-1 f-m-light">To nest your content with the default grid, add a
                                new<code>.row</code> and set
                                of <code>.col-sm-*</code> columns within an existing <code>.col-sm-*</code> column.
                            </p>
                        </div>
                        <div class="card-body grid-showcase">
                            <div class="row g-3">
                                <div class="col-3"><span>Level 1: .col-3</span></div>
                                <div class="col-9">
                                    <div class="grid-wrapper pb-0">
                                        <div class="row g-2">
                                            <div class="col-5"><span class="border border-2">Level 2: .col-5</span></div>
                                            <div class="col-7"><span class="border border-2">Level 2: .col-7</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="grid-wrapper pb-0">
                                        <div class="row g-2">
                                            <div class="col-sm-2 col-4"><span class="border border-2">Level 1:
                                                    .col-2</span></div>
                                            <div class="col-sm-10 col-8"><span class="border border-2">Level 1:
                                                    .col-10</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4"><span>Level 2: .col-4 </span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Nesting -->

                <!-- Order -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Order</h5>
                            <p class="mt-1 f-m-light">Using <code>.order </code>class, you can set the order position.</p>
                        </div>
                        <div class="card-body grid-showcase">
                            <div class="row g-2">
                                <div class="col-3 order-3"><span>First Item (order-3)</span></div>
                                <div class="col-5 order-first"><span>Second Item (order-first)</span></div>
                                <div class="col-4 order-last"><span>Third Item (order-last)</span></div>
                                <div class="col-3 order-2"><span>Fourth Item (order-2)</span></div>
                                <div class="col-sm-2 col-4 order-5"><span>fifth Item (order-5)</span></div>
                                <div class="col-sm-6 col-4 order-4"><span>sixth Item (order-4)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Order -->

                <!-- Offset -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Offset</h5>
                            <p class="mt-1 f-m-light">You can offset the grid column using <code>.offset-*</code> grid
                                class.</p>
                        </div>
                        <div class="card-body grid-showcase">
                            <div class="row g-2">
                                <div class="col-sm-5 col-4 offset-sm-3 offset-2"><span>col-5 offset-3</span></div>
                                <div class="col-sm-2 col-4 offset-sm-2 offset-1"><span>col-2 offset-2</span></div>
                                <div class="col-sm-4 col-5 offset-2"><span>col-4 offset-2</span></div>
                                <div class="col-sm-3 col-4 offset-sm-2 offset-1"><span>col-3 offset-2</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Offset -->

                <!-- Column wrapping -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Column wrapping
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="grid-showcase">
                                <div class="row">
                                    <div class="col-9"><span>.col-9</span></div>
                                    <div class="col-4"><span>.col-4<br>Since 9 + 4 = 13 &gt; 12, this
                                            4-column-wide
                                            div gets wrapped onto a new line as one contiguous unit.</span>
                                    </div>
                                    <div class="col-6"><span>.col-6<br>Subsequent columns continue
                                            along the new line.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Column wrapping -->

                <!-- Margin utilities -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Margin utilities
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-4">With the move to flexbox in v4, you can use margin utilities like <span
                                    class="text-danger">.me-auto</span>to force sibling columns away from one another.
                            </p>
                            <div class="grid-showcase">
                                <div class="row mb-3">
                                    <div class="col-md-4"><span>.col-md-4</span></div>
                                    <div class="col-md-4 ms-auto"><span>.col-md-4 .ms-auto</span></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 ms-md-auto"><span>.col-md-3 .ms-md-auto</span></div>
                                    <div class="col-md-3 ms-md-auto"><span>.col-md-3 .ms-md-auto</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-auto me-auto"><span>.col-auto .me-auto</span></div>
                                    <div class="col-auto"><span>.col-auto</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Margin utilities -->

                <!-- Column breaks -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Column breaks
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="grid-showcase mb-3">
                                <div class="row">
                                    <div class="col-6 col-sm-3"><span>.col-6 .col-sm-3</span></div>
                                    <div class="col-6 col-sm-3"><span>.col-6 .col-sm-3</span></div>

                                    <!-- Force next columns to break to new line -->
                                    <div class="w-100"></div>

                                    <div class="col-6 col-sm-3"><span>.col-6 .col-sm-3</span></div>
                                    <div class="col-6 col-sm-3"><span>.col-6 .col-sm-3</span></div>
                                </div>
                            </div>
                            <p>You may also apply this break at specific breakpoints with our <span
                                    class="text-danger">responsive display utilities.</span></p>
                            <div class="grid-showcase">
                                <div class="row">
                                    <div class="col-6 col-sm-4"><span>.col-6 .col-sm-4</span></div>
                                    <div class="col-6 col-sm-4"><span>.col-6 .col-sm-4</span></div>
                                    <div class="w-100 d-none d-md-block"></div>
                                    <div class="col-6 col-sm-4"><span>.col-6 .col-sm-4</span></div>
                                    <div class="col-6 col-sm-4"><span>.col-6 .col-sm-4</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Column breaks -->

                <!-- Standalone column classes -->
                <div class="col-xl-12">
                    <div class="card ">
                        <div class="card-header">
                            <div class="card-title">
                                Standalone column classes
                            </div>
                        </div>
                        <div class="card-body">
                            <p>The <span class="text-danger">.col-*</span> classes can also be used
                                outside a
                                <span class="text-danger">.row</span> to give an element a specific width. Whenever column
                                classes are used as non direct children of a row,the paddings are omitted.
                            </p>
                            <div class="grid-showcase">
                                <div class="col-3">
                                    <span>.col-3: width of 25%</span>
                                </div>
                                <div class="col-sm-9">
                                    <span>.col-sm-9: width of 75% above sm breakpoint</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Standalone column classes -->

                <!-- Wrap -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <P>The classes can be used together with utilities to create responsive floated images. Make
                                sure to wrap the content in a <span class="text-danger">.clearfix</span> wrapper to clear
                                the float if the text is shorter.</P>
                            <div class="clearfix">
                                <img src="{{ URL::asset('/build/img/supplier/edit-supplier.jpg')}}"
                                    class="bd-placeholder-img col-md-6 float-md-end mb-3 ms-md-3 rounded img-fluid"
                                    alt="...">
                                <p> A paragraph of placeholder text. We're using it here to show the use of the
                                    clearfix class. We're adding quite a few meaningless phrases here to demonstrate how the
                                    columns interact here with the floated image.
                                </p>
                                <p>As you can see the paragraphs gracefully wrap around the floated image. Now imagine how
                                    this would look with some actual content in here, rather than just this boring
                                    placeholder text that goes on and on, but actually conveys no tangible information at.
                                    It simply takes up space and should not really be read. </p>
                                <p>And yet, here you are, still persevering in reading this placeholder text, hoping for
                                    some more insights, or some hidden easter egg of content. A joke, perhaps.
                                    Unfortunately, there's none of that here. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Wrap -->

            </div>
        </div>
    </div>
@endsection
