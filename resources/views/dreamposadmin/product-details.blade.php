<?php $page = 'product-details'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Details</h4>
                    <h6>Full details of a product</h6>
                </div>
            </div>
            <!-- /add -->
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bar-code-view">
                                <img src="{{ URL::asset('/build/img/barcode/barcode1.png') }}" alt="barcode">
                                <a class="printimg">
                                    <img src="{{ URL::asset('/build/img/icons/printer.svg') }}" alt="print">
                                </a>
                            </div>
                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Product</h4>
                                        <h6>Macbook pro </h6>
                                    </li>
                                    <li>
                                        <h4>Category</h4>
                                        <h6>Computers</h6>
                                    </li>
                                    <li>
                                        <h4>Sub Category</h4>
                                        <h6>None</h6>
                                    </li>
                                    <li>
                                        <h4>Brand</h4>
                                        <h6>None</h6>
                                    </li>
                                    <li>
                                        <h4>Unit</h4>
                                        <h6>Piece</h6>
                                    </li>
                                    <li>
                                        <h4>SKU</h4>
                                        <h6>PT0001</h6>
                                    </li>
                                    <li>
                                        <h4>Minimum Qty</h4>
                                        <h6>5</h6>
                                    </li>
                                    <li>
                                        <h4>Quantity</h4>
                                        <h6>50</h6>
                                    </li>
                                    <li>
                                        <h4>Tax</h4>
                                        <h6>0.00 %</h6>
                                    </li>
                                    <li>
                                        <h4>Discount Type</h4>
                                        <h6>Percentage</h6>
                                    </li>
                                    <li>
                                        <h4>Price</h4>
                                        <h6>1500.00</h6>
                                    </li>
                                    <li>
                                        <h4>Status</h4>
                                        <h6>Active</h6>
                                    </li>
                                    <li>
                                        <h4>Description</h4>
                                        <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s,</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="slider-product-details">
                                <div class="owl-carousel owl-theme product-slide">
                                    <div class="slider-product">
                                        <img src="{{ URL::asset('/build/img/products/product69.jpg') }}" alt="img">
                                        <h4>macbookpro.jpg</h4>
                                        <h6>581kb</h6>
                                    </div>
                                    <div class="slider-product">
                                        <img src="{{ URL::asset('/build/img/products/product69.jpg') }}" alt="img">
                                        <h4>macbookpro.jpg</h4>
                                        <h6>581kb</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /add -->
        </div>
    </div>
@endsection
