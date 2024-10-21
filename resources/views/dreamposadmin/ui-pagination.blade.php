<?php $page = 'ui-pagination'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <h4 class="page-title my-auto">Pagination</h4>
                <div>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Ui Elements</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pagination</li>
                    </ol>
                </div>
            </div>
            <div class="row">

                <!-- Basic Pagination -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"> Basic Pagination </h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled"><a class="page-link"
                                            href="javascript:void(0);">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Basic Pagination -->

                <!-- Basic Pagination with Arrow -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Basic Pagination with Arrow</h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="javascript:void(0);"><i
                                                class="fas fa-arrow-left-long me-2"></i>Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Next<i
                                                class="fas fa-arrow-right-long ms-2"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Basic Pagination with Arrow -->

                <!-- Basic Pagination with Icons -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pagination With Icons</h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" aria-label="Next">
                                            <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Basic Pagination with Icons -->

                <!-- Pagination Sizing -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pagination Sizing</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap justify-content-between gap-2">
                            <nav aria-label="...">
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">1</span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                </ul>
                            </nav>
                            <nav aria-label="...">
                                <ul class="pagination mb-0">
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">1</span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                </ul>
                            </nav>
                            <nav aria-label="...">
                                <ul class="pagination pagination-lg mb-0">
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">1</span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Pagination Sizing -->

                <!-- Center & Right Aligned Pagination -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Center & Right Aligned Pagination </h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-3">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">Next</a>
                                    </li>
                                </ul>
                            </nav>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Center & Right Aligned Pagination -->

                <!-- Active and Disabled States -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Active and Disabled States</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap">
                            <nav aria-label="..." class="me-3">
                                <ul class="pagination  mb-3">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">Next</a>
                                    </li>
                                </ul>
                            </nav>
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">2</span>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Active and Disabled States -->

                <!-- Pagination Style 1 -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pagination Style 1</h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation" class="pagination-style-1">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0);">
                                            <i class="fas fa-angle-left align-middle"></i>
                                            <i class="ri-arrow-left-s-line align-middle"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">21</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">
                                            <i class="fas fa-angle-right align-middle"></i>
                                            <i class="ri-arrow-right-s-line align-middle"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Pagination Style 1 -->

                <!-- Pagination Style 2 -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pagination Style 2</h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation" class="pagination-style-2">
                                <ul class="pagination mb-0 flex-wrap">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0);">
                                            Prev
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">17</a></li>
                                    <li class="page-item">
                                        <a class="page-link text-primary" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Pagination Style 2 -->

                <!-- Pagination Style 3 -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pagination Style 3</h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation" class="pagination-style-3">
                                <ul class="pagination mb-0 flex-wrap">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0);">
                                            Prev
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">16</a></li>
                                    <li class="page-item">
                                        <a class="page-link text-primary" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Pagination Style 3 -->

                <!-- Pagination Style 4 -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pagination Style 4</h5>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation" class="pagination-style-4">
                                <ul class="pagination mb-0 flex-wrap">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0);">
                                            Prev
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">16</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">17</a></li>
                                    <li class="page-item">
                                        <a class="page-link text-primary" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Pagination Style 4 -->

            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
