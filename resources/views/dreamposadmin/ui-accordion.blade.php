<?php $page = 'ui-accordion'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Accordion</h4>
                </div>
            </div>

            <div class="row">

                <!-- Basic Accordion -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Basic Accordion
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use
                                            to
                                            style each element. These classes control the overall appearance, as
                                            well as
                                            the
                                            showing and hiding via CSS transitions. You can modify any of this with
                                            custom
                                            CSS or overriding our default variables. It's also worth noting that
                                            just
                                            about
                                            any HTML can go within the <code>.accordion-body</code>, though the
                                            transition
                                            does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden
                                            by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use
                                            to
                                            style each element. These classes control the overall appearance, as
                                            well as
                                            the
                                            showing and hiding via CSS transitions. You can modify any of this with
                                            custom
                                            CSS or overriding our default variables. It's also worth noting that
                                            just
                                            about
                                            any HTML can go within the <code>.accordion-body</code>, though the
                                            transition
                                            does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden
                                            by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use
                                            to
                                            style each element. These classes control the overall appearance, as
                                            well as
                                            the
                                            showing and hiding via CSS transitions. You can modify any of this with
                                            custom
                                            CSS or overriding our default variables. It's also worth noting that
                                            just
                                            about
                                            any HTML can go within the <code>.accordion-body</code>, though the
                                            transition
                                            does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Basic Accordion -->

                <!-- Always Open Accordion -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Always Open Accordion
                                <p class="text-muted subtitle fs-12 fw-normal">Omit the <code>data-bs-parent</code>
                                    attribute on each
                                    <code>.accordion-collapse</code>
                                    to make accordion items stay open when another item is opened.
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use
                                            to style each element. These classes control the overall appearance, as
                                            well
                                            as the showing and hiding via CSS transitions. It's also worth
                                            noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                            aria-controls="panelsStayOpen-collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden
                                            by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use
                                            to style each element. These classes control the overall appearance, as
                                            well
                                            as the showing and hiding via CSS transitions. You can modify any of
                                            this
                                            with custom CSS or overriding our default variables. It's also worth
                                            noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                            aria-controls="panelsStayOpen-collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden
                                            by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use
                                            to style each element. These classes control the overall appearance, as
                                            well
                                            as the showing and hiding via CSS transitions. You can modify any of
                                            this
                                            with custom CSS or overriding our default variables. It's also worth
                                            noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Always Open Accordion -->

            </div>

            <div class="row">

                <!-- With Spacing -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                With Spacing
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordions-items-seperate" id="accordionSpacingExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSpacingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#SpacingOne" aria-expanded="false"
                                            aria-controls="SpacingOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="SpacingOne" class="accordion-collapse collapse"
                                        aria-labelledby="headingSpacingOne" data-bs-parent="#accordionSpacingExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSpacingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#SpacingTwo" aria-expanded="false"
                                            aria-controls="SpacingTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="SpacingTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingSpacingTwo" data-bs-parent="#accordionSpacingExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSpacingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#SpacingThree"
                                            aria-expanded="false" aria-controls="SpacingThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="SpacingThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingSpacingThree" data-bs-parent="#accordionSpacingExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /With Spacing -->

                <!-- Flush Accordion -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Flush Accordion
                                <p class="subtitle text-muted fs-12 fw-normal">
                                    Add <code>.accordion-flush</code> to remove the default
                                    <code>background-color</code>,
                                    borders, and rounded corners.
                                </p>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion,
                                            which is
                                            intended to demonstrate the <code>.accordion-flush</code> class.
                                            This is
                                            the
                                            first item's accordion body.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion,
                                            which is
                                            intended to demonstrate the <code>.accordion-flush</code> class.
                                            This is
                                            the
                                            second item's accordion body. Let's imagine this being filled
                                            with
                                            some
                                            actual content.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion,
                                            which is
                                            intended to demonstrate the <code>.accordion-flush</code> class.
                                            This is
                                            the
                                            third item's accordion body. Nothing more exciting happening
                                            here in
                                            terms
                                            of content, but just filling up the space to make it look, at
                                            least
                                            at
                                            first
                                            glance, a bit more representative of how this would look in a
                                            real-world
                                            application.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Flush Accordion -->

            </div>

            <!-- Light Colors -->
            <h6 class="mb-3">Light Colors:</h6>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Primary
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-primary" id="accordionPrimaryExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPrimaryOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsePrimaryOne" aria-expanded="true"
                                            aria-controls="collapsePrimaryOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapsePrimaryOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingPrimaryOne" data-bs-parent="#accordionPrimaryExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPrimaryTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePrimaryTwo"
                                            aria-expanded="false" aria-controls="collapsePrimaryTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapsePrimaryTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingPrimaryTwo" data-bs-parent="#accordionPrimaryExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPrimaryThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePrimaryThree"
                                            aria-expanded="false" aria-controls="collapsePrimaryThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapsePrimaryThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingPrimaryThree" data-bs-parent="#accordionPrimaryExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Secondary
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-secondary" id="accordionSecondaryExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondaryOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSecondaryOne" aria-expanded="true"
                                            aria-controls="collapseSecondaryOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseSecondaryOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingSecondaryOne" data-bs-parent="#accordionSecondaryExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondaryTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSecondaryTwo"
                                            aria-expanded="false" aria-controls="collapseSecondaryTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseSecondaryTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingSecondaryTwo" data-bs-parent="#accordionSecondaryExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondaryThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSecondaryThree"
                                            aria-expanded="false" aria-controls="collapseSecondaryThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseSecondaryThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingSecondaryThree"
                                        data-bs-parent="#accordionSecondaryExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Light Colors -->

            <!-- Solid Colors -->
            <h6 class="mb-3">Solid Colors:</h6>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Primary
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-solid-primary" id="accordionPrimarySolidExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPrimarySolidOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsePrimarySolidOne" aria-expanded="true"
                                            aria-controls="collapsePrimarySolidOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapsePrimarySolidOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingPrimarySolidOne"
                                        data-bs-parent="#accordionPrimarySolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPrimarySolidTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePrimarySolidTwo"
                                            aria-expanded="false" aria-controls="collapsePrimarySolidTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapsePrimarySolidTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingPrimarySolidTwo"
                                        data-bs-parent="#accordionPrimarySolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPrimarySolidThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePrimarySolidThree"
                                            aria-expanded="false" aria-controls="collapsePrimarySolidThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapsePrimarySolidThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingPrimarySolidThree"
                                        data-bs-parent="#accordionPrimarySolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Secondary
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-solid-secondary" id="accordionSecondarySolidExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondarySolidOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSecondarySolidOne" aria-expanded="true"
                                            aria-controls="collapseSecondarySolidOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseSecondarySolidOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingSecondarySolidOne"
                                        data-bs-parent="#accordionSecondarySolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondarySolidTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSecondarySolidTwo"
                                            aria-expanded="false" aria-controls="collapseSecondarySolidTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseSecondarySolidTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingSecondarySolidTwo"
                                        data-bs-parent="#accordionSecondarySolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondarySolidThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSecondarySolidThree"
                                            aria-expanded="false" aria-controls="collapseSecondarySolidThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseSecondarySolidThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingSecondarySolidThree"
                                        data-bs-parent="#accordionSecondarySolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Warning
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-solid-warning" id="accordionWarningSolidExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingWarningSolidOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseWarningSolidOne" aria-expanded="true"
                                            aria-controls="collapseWarningSolidOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseWarningSolidOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingWarningSolidOne"
                                        data-bs-parent="#accordionWarningSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingWarningSolidTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseWarningSolidTwo"
                                            aria-expanded="false" aria-controls="collapseWarningSolidTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseWarningSolidTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingWarningSolidTwo"
                                        data-bs-parent="#accordionWarningSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingWarningSolidThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseWarningSolidThree"
                                            aria-expanded="false" aria-controls="collapseWarningSolidThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseWarningSolidThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingWarningSolidThree"
                                        data-bs-parent="#accordionWarningSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Info
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-solid-info" id="accordionInfoSolidExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingInfoSolidOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseInfoSolidOne" aria-expanded="true"
                                            aria-controls="collapseInfoSolidOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseInfoSolidOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingInfoSolidOne" data-bs-parent="#accordionInfoSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingInfoSolidTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseInfoSolidTwo"
                                            aria-expanded="false" aria-controls="collapseInfoSolidTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseInfoSolidTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingInfoSolidTwo" data-bs-parent="#accordionInfoSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingInfoSolidThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseInfoSolidThree"
                                            aria-expanded="false" aria-controls="collapseInfoSolidThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseInfoSolidThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingInfoSolidThree"
                                        data-bs-parent="#accordionInfoSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Success
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-solid-success" id="accordionSuccessSolidExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSuccessSolidOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSuccessSolidOne" aria-expanded="true"
                                            aria-controls="collapseSuccessSolidOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseSuccessSolidOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingSuccessSolidOne"
                                        data-bs-parent="#accordionSuccessSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSuccessSolidTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSuccessSolidTwo"
                                            aria-expanded="false" aria-controls="collapseSuccessSolidTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseSuccessSolidTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingSuccessSolidTwo"
                                        data-bs-parent="#accordionSuccessSolidTwo">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSuccessSolidThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSuccessSolidThree"
                                            aria-expanded="false" aria-controls="collapseSuccessSolidThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseSuccessSolidThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingSuccessSolidThree"
                                        data-bs-parent="#accordionSuccessSolidThree">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Danger
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-solid-danger" id="accordionDangerSolidExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDangerSolidOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseDangerSolidOne" aria-expanded="true"
                                            aria-controls="collapseDangerSolidOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseDangerSolidOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingDangerSolidOne"
                                        data-bs-parent="#accordionDangerSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDangerSolidTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseDangerSolidTwo"
                                            aria-expanded="false" aria-controls="collapseDangerSolidTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseDangerSolidTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingDangerSolidTwo"
                                        data-bs-parent="#accordionDangerSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDangerSolidThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseDangerSolidThree"
                                            aria-expanded="false" aria-controls="collapseDangerSolidThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseDangerSolidThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingDangerSolidThree"
                                        data-bs-parent="#accordionDangerSolidExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Solid Colors -->

            <!-- Colored Borders -->
            <h6 class="mb-3">Colored Borders:</h6>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Primary
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-border-primary accordions-items-seperate"
                                id="accordionprimaryborderExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderprimaryOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#primaryBorderOne" aria-expanded="true"
                                            aria-controls="primaryBorderOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="primaryBorderOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingborderprimaryOne"
                                        data-bs-parent="#accordionprimaryborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderprimaryTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#primaryBorderTwo"
                                            aria-expanded="false" aria-controls="primaryBorderTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="primaryBorderTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderprimaryTwo"
                                        data-bs-parent="#accordionprimaryborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderprimaryThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#primaryBorderThree"
                                            aria-expanded="false" aria-controls="primaryBorderThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="primaryBorderThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderprimaryThree"
                                        data-bs-parent="#accordionprimaryborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Secondary
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-border-secondary accordions-items-seperate"
                                id="accordioninfoborderExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderinfoOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#infoBorderOne" aria-expanded="true"
                                            aria-controls="infoBorderOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="infoBorderOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingborderinfoOne"
                                        data-bs-parent="#accordioninfoborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderinfoTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#infoBorderTwo"
                                            aria-expanded="false" aria-controls="infoBorderTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="infoBorderTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderinfoTwo"
                                        data-bs-parent="#accordioninfoborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderinfoThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#infoBorderThree"
                                            aria-expanded="false" aria-controls="infoBorderThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="infoBorderThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderinfoThree"
                                        data-bs-parent="#accordioninfoborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Success
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-border-success accordions-items-seperate"
                                id="accordionsuccessborderExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingbordersuccessOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#successBorderOne" aria-expanded="true"
                                            aria-controls="successBorderOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="successBorderOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingbordersuccessOne"
                                        data-bs-parent="#accordionsuccessborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingbordersuccessTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#successBorderTwo"
                                            aria-expanded="false" aria-controls="successBorderTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="successBorderTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingbordersuccessTwo"
                                        data-bs-parent="#accordionsuccessborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingbordersuccessThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#successBorderThree"
                                            aria-expanded="false" aria-controls="successBorderThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="successBorderThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingbordersuccessThree"
                                        data-bs-parent="#accordionsuccessborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Info
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-border-info accordions-items-seperate"
                                id="accordioninfoborderExampleTwo">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderinfoTwos">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#infoBorderOnes" aria-expanded="true"
                                            aria-controls="infoBorderOnes">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="infoBorderOnes" class="accordion-collapse collapse show"
                                        aria-labelledby="headingborderinfoTwos"
                                        data-bs-parent="#accordioninfoborderExampleTwo">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderinfoTwoo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#infoBorderTwos"
                                            aria-expanded="false" aria-controls="infoBorderTwos">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="infoBorderTwos" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderinfoTwoo"
                                        data-bs-parent="#accordioninfoborderExample2">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderinfoThrees">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#infoBorderThrees"
                                            aria-expanded="false" aria-controls="infoBorderThrees">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="infoBorderThrees" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderinfoThrees"
                                        data-bs-parent="#accordioninfoborderExample2">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Warning
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-border-warning accordions-items-seperate"
                                id="accordionwarningborderExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderwarningOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#warningBorderOne" aria-expanded="true"
                                            aria-controls="warningBorderOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="warningBorderOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingborderwarningOne"
                                        data-bs-parent="#accordionwarningborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderwarningTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#warningBorderTwo"
                                            aria-expanded="false" aria-controls="warningBorderTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="warningBorderTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderwarningTwo"
                                        data-bs-parent="#accordionwarningborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderwarningThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#warningBorderThree"
                                            aria-expanded="false" aria-controls="warningBorderThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="warningBorderThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderwarningThree"
                                        data-bs-parent="#accordionwarningborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Danger
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-border-danger accordions-items-seperate"
                                id="accordiondangerborderExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderdangerOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#dangerBorderOne" aria-expanded="true"
                                            aria-controls="dangerBorderOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="dangerBorderOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingborderdangerOne"
                                        data-bs-parent="#accordiondangerborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderdangerTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#dangerBorderTwo"
                                            aria-expanded="false" aria-controls="dangerBorderTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="dangerBorderTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderdangerTwo"
                                        data-bs-parent="#accordiondangerborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingborderdangerThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#dangerBorderThree"
                                            aria-expanded="false" aria-controls="dangerBorderThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="dangerBorderThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingborderdangerThree"
                                        data-bs-parent="#accordiondangerborderExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Colored Borders -->

            <div class="row">

                <!-- Left Aligned Icons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Left Aligned Icons
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordionicon-left accordions-items-seperate"
                                id="accordioniconLeftExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingleftOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseleftOne" aria-expanded="true"
                                            aria-controls="collapseleftOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseleftOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingleftOne" data-bs-parent="#accordioniconLeftExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingleftTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseLeftTwo"
                                            aria-expanded="false" aria-controls="collapseLeftTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseLeftTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingleftTwo" data-bs-parent="#accordioniconLeftExample">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden
                                            by default, until the collapse plugin adds the appropriate classes that
                                            we use to style each element. These classes control the overall
                                            appearance, as well as the showing and hiding via CSS transitions. You
                                            can modify any of this with custom CSS or overriding our default
                                            variables. It's also worth noting that just about any HTML can go within
                                            the <code>.accordion-body</code>, though the transition does limit
                                            overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingleftThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseLeftThree"
                                            aria-expanded="false" aria-controls="collapseLeftThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseLeftThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingleftThree" data-bs-parent="#accordioniconLeftExample">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden
                                            by default, until the collapse plugin adds the appropriate classes that
                                            we use to style each element. These classes control the overall
                                            appearance, as well as the showing and hiding via CSS transitions. You
                                            can modify any of this with custom CSS or overriding our default
                                            variables. It's also worth noting that just about any HTML can go within
                                            the <code>.accordion-body</code>, though the transition does limit
                                            overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Left Aligned Icons -->

                <!-- Without Icon -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Without Icon
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordionicon-none accordions-items-seperate"
                                id="accordioniconnoIconExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingnoIconOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsenoIconOne" aria-expanded="true"
                                            aria-controls="collapsenoIconOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapsenoIconOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingnoIconOne" data-bs-parent="#accordioniconnoIconExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingnoIconTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsenoIconTwo"
                                            aria-expanded="false" aria-controls="collapsenoIconTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapsenoIconTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingnoIconTwo" data-bs-parent="#accordioniconnoIconExample">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden
                                            by default, until the collapse plugin adds the appropriate classes that
                                            we use to style each element. These classes control the overall
                                            appearance, as well as the showing and hiding via CSS transitions. You
                                            can modify any of this with custom CSS or overriding our default
                                            variables. It's also worth noting that just about any HTML can go within
                                            the <code>.accordion-body</code>, though the transition does limit
                                            overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingnoIconThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsenoIconThree"
                                            aria-expanded="false" aria-controls="collapsenoIconThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapsenoIconThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingnoIconThree" data-bs-parent="#accordioniconnoIconExample">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden
                                            by default, until the collapse plugin adds the appropriate classes that
                                            we use to style each element. These classes control the overall
                                            appearance, as well as the showing and hiding via CSS transitions. You
                                            can modify any of this with custom CSS or overriding our default
                                            variables. It's also worth noting that just about any HTML can go within
                                            the <code>.accordion-body</code>, though the transition does limit
                                            overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Without Icon -->
            </div>

            <div class="row">

                <!-- Custom Icon Accordion -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Custom Icon Accordion
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-customicon1 accordions-items-seperate"
                                id="accordioncustomicon1Example">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon1One">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsecustomicon1One" aria-expanded="true"
                                            aria-controls="collapsecustomicon1One">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon1One" class="accordion-collapse collapse show"
                                        aria-labelledby="headingcustomicon1One"
                                        data-bs-parent="#accordioncustomicon1Example">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon1Two">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsecustomicon1Two"
                                            aria-expanded="false" aria-controls="collapsecustomicon1Two">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon1Two" class="accordion-collapse collapse"
                                        aria-labelledby="headingcustomicon1Two"
                                        data-bs-parent="#accordioncustomicon1Example">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingcustomicon1Three">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsecustomicon1Three"
                                            aria-expanded="false" aria-controls="collapsecustomicon1Three">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapsecustomicon1Three" class="accordion-collapse collapse"
                                        aria-labelledby="headingcustomicon1Three"
                                        data-bs-parent="#accordioncustomicon1Example">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Custom Icon Accordion -->

                <!-- Custom Accordion -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Custom Accordion
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion customized-accordion accordions-items-seperate"
                                id="customizedAccordion">
                                <div class="accordion-item custom-accordion-primary">
                                    <h2 class="accordion-header" id="customizedAccordionOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#customized-AccordionOne" aria-expanded="true"
                                            aria-controls="customized-AccordionOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="customized-AccordionOne" class="accordion-collapse collapse show"
                                        aria-labelledby="customizedAccordionOne" data-bs-parent="#customizedAccordion">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item custom-accordion-secondary">
                                    <h2 class="accordion-header" id="customizedAccordionTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#customized-AccordionTwo"
                                            aria-expanded="false" aria-controls="customized-AccordionTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="customized-AccordionTwo" class="accordion-collapse collapse"
                                        aria-labelledby="customizedAccordionTwo" data-bs-parent="#customizedAccordion">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item custom-accordion-danger">
                                    <h2 class="accordion-header" id="customizedAccordionThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#customized-AccordionThree"
                                            aria-expanded="false" aria-controls="customized-AccordionThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="customized-AccordionThree" class="accordion-collapse collapse"
                                        aria-labelledby="customizedAccordionThree"
                                        data-bs-parent="#customizedAccordion">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we
                                            use to style each element. These classes control the overall appearance,
                                            as well as the showing and hiding via CSS transitions. You can modify
                                            any of this with custom CSS or overriding our default variables. It's
                                            also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Custom Accordion -->

            </div>

            <div class="row">

                <!-- Example -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Example
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">
                                <a class="btn btn-primary collapsed mb-2" data-bs-toggle="collapse"
                                    href="#collapseExample" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Link with href
                                </a>
                                <button class="btn btn-secondary collapsed mb-2" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Button with data-bs-target
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body mb-0">
                                    Some placeholder content for the collapse component. This panel
                                    is
                                    hidden by default but revealed when the user activates the
                                    relevant
                                    trigger.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Example -->

                <!-- Targets Collapse -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Targets Collapse
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">
                                <a class="btn btn-primary mb-2" data-bs-toggle="collapse"
                                    href="#multiCollapseExample1" role="button" aria-expanded="false"
                                    aria-controls="multiCollapseExample1">Toggle first element</a>
                                <button class="btn btn-success mb-2" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#multiCollapseExample2" aria-expanded="false"
                                    aria-controls="multiCollapseExample2">Toggle second
                                    element</button>
                                <button class="btn btn-danger mb-2" type="button" data-bs-toggle="collapse"
                                    data-bs-target=".multi-collapse" aria-expanded="false"
                                    aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle
                                    both elements</button>
                            </p>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="card card-body mb-0">
                                            Some placeholder content for the first collapse
                                            component of
                                            this multi-collapse example. This panel is hidden by
                                            default
                                            but revealed when the user activates the relevant
                                            trigger.
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <div class="card card-body mb-0">
                                            Some placeholder content for the second collapse
                                            component
                                            of this multi-collapse example. This panel is hidden by
                                            default but revealed when the user activates the
                                            relevant
                                            trigger.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Targets Collapse -->

            </div>

            <div class="row">

                <!-- Horizontal Collapse -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Horizontal Collapse</div>
                        </div>
                        <div class="card-body">
                            <p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseWidthExample" aria-expanded="false"
                                    aria-controls="collapseWidthExample">
                                    Toggle width collapse
                                </button>
                            </p>
                            <div>
                                <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                    <div class="card card-body" style="width: 230px;">
                                        This is some placeholder content for a horizontal collapse. It's
                                        hidden
                                        by default and shown when triggered.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Horizontal Collapse -->

            </div>

        </div>
    </div>
@endsection
