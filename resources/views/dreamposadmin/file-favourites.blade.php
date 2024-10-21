<?php $page = 'file-favourites'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper notes-page-wrapper file-manager">
        <div class="content">


            <div class="page-header page-add-notes d-flex align-items-center justify-content-between">
                <div class="add-item d-flex align-items-center">
                    <div class="page-title">
                        <h4>File Manager</h4>
                        <p>Manage your files</p>
                    </div>
                    <a id="toggle_btn2" class="notes-tog" href="javascript:void(0);">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </div>
                <div class="d-sm-flex align-items-center">
                    <div class="form-sort owned-by w-auto">
                        <span><i data-feather="sliders" class="info-img"></i></span>
                        <select class="select">
                            <option>Owned By Me</option>
                            <option>Owned by Anyone</option>
                            <option>Not Owned by Me</option>
                        </select>
                    </div>
                    <ul class="table-top-head">
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="rotate"><i data-feather="rotate-ccw"
                                    class="feather-rotate-ccw"></i></a>
                        </li>
                        <li class="full-height">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                    data-feather="chevron-up" class="feather-chevron-up"></i></a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-added" data-bs-toggle="modal"
                        data-bs-target="#upload-file"><span class="me-1 d-flex align-items-center"><i data-feather="upload"
                                class="feather-16"></i></span>Upload Files</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-12 sidebars-right theiaStickySidebar section-bulk-widget">
                    <aside class="card file-manager-sidebar mb-0">
                        <h5 class="d-flex align-items-center"><span class="me-2 d-flex align-items-center"><i
                                    data-feather="folder" class="feather-20"></i></span>Files</h5>
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropset btn btn-primary mb-3 btn-icon">
                                <span class="me-1 btn-icon"><i data-feather="plus-circle" class="feather-16"></i></span>New
                            </a>
                            <ul class="dropdown-menu">
                                <li data-bs-toggle="modal" data-bs-target="#upload-file"><a href="javascript:void(0);"
                                        class="dropdown-item"><i data-feather="upload-cloud"
                                            class="feather-16 me-2"></i>Upload File</a></li>
                                <li data-bs-toggle="modal" data-bs-target="#upload-folder"><a href="javascript:void(0);"
                                        class="dropdown-item"><i data-feather="folder" class="feather-16 me-2"></i>Upload
                                        Folder</a></li>
                                <li data-bs-toggle="modal" data-bs-target="#create-folder"><a href="javascript:void(0);"
                                        class="dropdown-item"><i data-feather="folder-minus"
                                            class="feather-16 me-2"></i>Create folder</a></li>
                            </ul>
                        </div>

                        <ul class="mb-5">
                            <li><a href="{{ url('file-manager') }}"><span class="me-2 btn-icon"><i data-feather="file-text"
                                            class="feather-16"></i></span>My Files</a></li>
                            <li><a href="javascript:void(0);"><span class="me-2 btn-icon"><i data-feather="star"
                                            class="feather-16"></i></span>Google Drive</a></li>
                            <li><a href="javascript:void(0);"><span class="me-2 btn-icon"><i data-feather="send"
                                            class="feather-16"></i></span>Dropbox</a></li>
                            <li><a href="{{ url('file-shared') }}"><span class="me-2 btn-icon"><i data-feather="file"
                                            class="feather-16"></i></span>Shared With Me</a></li>
                            <li><a href="{{ url('file-document') }}"><span class="me-2 btn-icon"><i data-feather="file"
                                            class="feather-16"></i></span>Document</a></li>
                            <li><a href="{{ url('file-recent') }}"><span class="me-2 btn-icon"><i data-feather="clock"
                                            class="feather-16"></i></span>Recent</a></li>
                            <li><a href="{{ url('file-favourites') }}" class="active"><span class="me-2 btn-icon"><i
                                            data-feather="star" class="feather-16"></i></span>Favourites</a></li>
                            <li><a href="{{ url('file-archived') }}"><span class="me-2 btn-icon"><i data-feather="target"
                                            class="feather-16"></i></span>Archived</a></li>
                            <li><a href="{{ url('file-manager-deleted') }}"><span class="me-2 btn-icon"><i
                                            data-feather="trash-2" class="feather-16"></i></span>Deleted</a></li>
                            <li><a href="javascript:void(0);"><span class="me-2 btn-icon"><i data-feather="settings"
                                            class="feather-16"></i></span>Settings</a></li>
                        </ul>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="me-2 btn-icon"><i data-feather="hard-drive" class="feather-16"></i></span>
                                <h6>Storage</h6>
                            </div>
                            <span>70%</span>
                        </div>
                        <div class="progress my-2">
                            <div class="progress-bar progress-bar bg-danger" role="progressbar" style="width: 75%"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span>78.5 GB of 1 TB Free Used</span>
                        <div class="space-manager p-4">
                            <img src="{{ URL::asset('/build/img/icons/half-circle.svg') }}" alt="Folder">
                            <h6><a href="javascript:void(0);">Need More Space?</a></h6>
                            <p>Upgrade storage for 2TB for $60 per month</p>
                            <a href="javascript:void(0);" class="btn btn-outline-primary">Upgrade<span
                                    class="ms-1 btn-icon"><i data-feather="repeat" class="feather-16"></i></span></a>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-9 budget-role-notes">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-bulk-wrap">
                                <div class="bulk-action-type col-lg-6 col-md-6">
                                    <div class="form-sort select-bluk">
                                        <select class="select">
                                            <option>Sort by Date</option>
                                            <option>Sort By Relevance</option>
                                            <option>Sort By Size</option>
                                            <option>Order Ascending</option>
                                            <option>Order Descending</option>
                                            <option>Upload Time</option>
                                        </select>
                                    </div>
                                    <div class="search-set me-2" id="dropdownSort" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside">
                                        <div class="search-input">
                                            <a href="" class="btn btn-searchset"><i data-feather="search"
                                                    class="feather-search"></i></a>
                                            <div class="dataTables_filter">
                                                <label> <input type="search"
                                                        class="form-control form-control-sm width-auto"
                                                        placeholder="Search"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuClickable">
                                        <div class="search-info">
                                            <h6><span><i data-feather="search" class="feather-16"></i></span>Recent
                                                Searches</h6>
                                            <ul class="search-tags">
                                                <li><a href="javascript:void(0);">Filename</a></li>
                                                <li><a href="javascript:void(0);">Excel Files</a></li>
                                            </ul>
                                        </div>
                                        <div class="search-info">
                                            <h6>Search Results</h6>
                                            <p class="d-flex align-items-center justify-content-between">Sportsmodel.pdf <i
                                                    data-feather="chevron-right" class="feather-16"></i></p>
                                            <p class="d-flex align-items-center justify-content-between">
                                                Projectdetails.xls<i data-feather="chevron-right" class="feather-16"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center col-lg-6 col-md-6 justify-content-end">
                                    <div class="form-sort me-3">
                                        <i data-feather="filter" class="fa-filter"></i>
                                        <select class="select">
                                            <option>Recent</option>
                                            <option>Last Week</option>
                                            <option>Last Month</option>
                                        </select>
                                    </div>
                                    <div class="form-sort">
                                        <i data-feather="file-text" class="fa-filter"></i>
                                        <select class="select">
                                            <option>All File types</option>
                                            <option>Folders</option>
                                            <option>PDF</option>
                                            <option>Images</option>
                                            <option>Videos</option>
                                            <option>Audios</option>
                                            <option>Excel</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Accordian -->
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item seprator-lg">
                            <h4 class="accordion-header d-flex align-items-center justify-content-between"
                                id="panelsStayOpen-headingOne">Folders
                                <a href="javascript:void(0);" class="accordion-button a-auto" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne"></a>
                            </h4>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <div class="row mt-3">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/folder.svg') }}"
                                                            alt="Folder" class="me-2">
                                                        <h6 class="popup-toggle"><a href="javascript:void(0);">Project
                                                                Details</a></h6>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                            aria-expanded="false" class="dropset">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Details</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Share</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Copy</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Move</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Download</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Rename</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Archeived</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan my-3">
                                                    <label>Project plan</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">154 KB</li>
                                                        <li class="d-flex align-items-center">8 Files</li>
                                                    </ul>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between avatar-wrap">
                                                    <div class="group-avatar">
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 1"
                                                                data-bs-original-title="Member 1"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-2.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 2"
                                                                data-bs-original-title="Member 2"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-1.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="count">
                                                            <a href="javascript:void(0);">1 Members</a>
                                                        </span>
                                                    </div>
                                                    <a href="javascript:void(0);" class=""><i
                                                            class="fa fa-star me-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/folder.svg') }}"
                                                            alt="Folder" class="me-2">
                                                        <h6 class="popup-toggle"><a href="javascript:void(0);">Project
                                                                Details</a></h6>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                            aria-expanded="false" class="dropset">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Details</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Share</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Copy</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Move</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Download</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Rename</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Archeived</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan my-3">
                                                    <label>Project plan</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">154 KB</li>
                                                        <li class="d-flex align-items-center">8 Files</li>
                                                    </ul>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between avatar-wrap">
                                                    <div class="group-avatar">
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 1"
                                                                data-bs-original-title="Member 1"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-6.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 2"
                                                                data-bs-original-title="Member 2"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-14.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 3"
                                                                data-bs-original-title="Member 3"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-15.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 4"
                                                                data-bs-original-title="Member 4"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-16.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 5"
                                                                data-bs-original-title="Member 5"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-17.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="count">
                                                            <a href="javascript:void(0);">+9 Members</a>
                                                        </span>
                                                    </div>
                                                    <a href="javascript:void(0);" class=""><i
                                                            class="fa fa-star me-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/folder.svg') }}"
                                                            alt="Folder" class="me-2">
                                                        <h6 class="popup-toggle"><a href="javascript:void(0);">Project
                                                                Details</a></h6>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                            aria-expanded="false" class="dropset">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Details</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Share</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Copy</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Move</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Download</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Rename</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Archeived</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan my-3">
                                                    <label>Project plan</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">154 KB</li>
                                                        <li class="d-flex align-items-center">8 Files</li>
                                                    </ul>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between avatar-wrap">
                                                    <div class="group-avatar">
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 1"
                                                                data-bs-original-title="Member 1"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-18.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 2"
                                                                data-bs-original-title="Member 2"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-5.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="count">
                                                            <a href="javascript:void(0);">
                                                                +2 Members</a>
                                                        </span>
                                                    </div>
                                                    <a href="javascript:void(0);" class=""><i
                                                            class="fa fa-star me-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/folder.svg') }}"
                                                            alt="Folder" class="me-2">
                                                        <h6 class="popup-toggle"><a href="javascript:void(0);">Project
                                                                Details</a></h6>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                            aria-expanded="false" class="dropset">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Details</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Share</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Copy</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Move</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Download</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Rename</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Archeived</a></li>
                                                            <li><a href="javascript:void(0);"
                                                                    class="dropdown-item">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan my-3">
                                                    <label>Project plan</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">154 KB</li>
                                                        <li class="d-flex align-items-center">8 Files</li>
                                                    </ul>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between avatar-wrap">
                                                    <div class="group-avatar">
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 1"
                                                                data-bs-original-title="Member 1"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-2.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="avatar">
                                                            <a href="javascript:void(0);" data-bs-toggle="tooltip"
                                                                data-bs-placement="right" aria-label="Member 2"
                                                                data-bs-original-title="Member 2"><img
                                                                    src="{{ URL::asset('/build/img/avatar/avatar-1.jpg') }}"
                                                                    alt="Avatar"></a>
                                                        </span>
                                                        <span class="count">
                                                            <a href="javascript:void(0);">1 Members</a>
                                                        </span>
                                                    </div>
                                                    <a href="javascript:void(0);" class=""><i
                                                            class="fa fa-star me-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item seprator-lg">
                            <h4 class="accordion-header d-flex align-items-center justify-content-between"
                                id="panelsStayOpen-headingTwo">Files
                                <a href="javascript:void(0);" class="accordion-button w-auto" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                </a>
                            </h4>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <div class="row mt-3">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/pdf-02.svg') }}"
                                                            alt="File" class="me-2">
                                                        <h6 class="popup-toggle"><a href="javascript:void(0);">hsa.pdf</a>
                                                        </h6>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class=""><i
                                                                class="fa fa-star me-2"></i></a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                                aria-expanded="false" class="dropset">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Details</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Share</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Copy</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Move</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Download</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Rename</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Archeived</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan mt-3">
                                                    <label>Last edited 12 Jul</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">15 Memebers</li>
                                                        <li class="d-flex align-items-center">8 5 MB</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/pdf-02.svg') }}"
                                                            alt="File" class="me-2">
                                                        <h6 class="popup-toggle"><a
                                                                href="javascript:void(0);">Haird.pdf</a></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class=""><i
                                                                class="fa fa-star me-2"></i></a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                                aria-expanded="false" class="dropset">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Details</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Share</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Copy</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Move</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Download</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Rename</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Archeived</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan mt-3">
                                                    <label>Last edited 14 Jul</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">09 Memebers</li>
                                                        <li class="d-flex align-items-center">4 MB</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/xls.svg') }}"
                                                            alt="File" class="me-2">
                                                        <h6 class="popup-toggle"><a
                                                                href="javascript:void(0);">Estimation.xls</a></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class=""><i
                                                                class="fa fa-star me-2"></i></a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                                aria-expanded="false" class="dropset">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Details</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Share</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Copy</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Move</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Download</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Rename</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Archeived</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan mt-3">
                                                    <label>Last edited 14 Jul</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">05 Memebers</li>
                                                        <li class="d-flex align-items-center">500 KB</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/pdf-02.svg') }}"
                                                            alt="File" class="me-2">
                                                        <h6 class="popup-toggle"><a href="javascript:void(0);">hsa.pdf</a>
                                                        </h6>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class=""><i
                                                                class="fa fa-star me-2"></i></a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                                aria-expanded="false" class="dropset">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Details</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Share</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Copy</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Move</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Download</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Rename</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Archeived</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan mt-3">
                                                    <label>Last edited 12 Jul</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">15 Memebers</li>
                                                        <li class="d-flex align-items-center">8 5 MB</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/pdf-02.svg') }}"
                                                            alt="File" class="me-2">
                                                        <h6 class="popup-toggle"><a
                                                                href="javascript:void(0);">Haird.pdf</a></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class=""><i
                                                                class="fa fa-star me-2"></i></a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                                aria-expanded="false" class="dropset">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Details</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Share</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Copy</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Move</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Download</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Rename</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Archeived</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan mt-3">
                                                    <label>Last edited 14 Jul</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">09 Memebers</li>
                                                        <li class="d-flex align-items-center">4 MB</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="folders p-3 mb-3">
                                                <div class="d-flex align-items-center justify-content-between head">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('/build/img/icons/xls.svg') }}"
                                                            alt="File" class="me-2">
                                                        <h6 class="popup-toggle"><a
                                                                href="javascript:void(0);">Estimation.xls</a></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0);" class=""><i
                                                                class="fa fa-star me-2"></i></a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                                aria-expanded="false" class="dropset">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Details</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Share</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Copy</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Move</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Download</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Rename</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Archeived</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                        class="dropdown-item">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex align-items-center justify-content-start project-plan mt-3">
                                                    <label>Last edited 14 Jul</label>
                                                    <ul class="d-flex">
                                                        <li class="d-flex align-items-center">05 Memebers</li>
                                                        <li class="d-flex align-items-center">500 KB</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Accordian -->

                    <div class="card p-4 bg-white all-files mb-0">
                        <div class="seprator-lg d-lg-flex align-items-center justify-content-between">
                            <h4>All Files</h4>
                            <div class="d-sm-flex align-items-center btn-grp">
                                <a href="javascript:void(0);" class="btn btn-primary me-2"><i data-feather="list"
                                        class="feather-20"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary me-2"><i
                                        data-feather="layout" class="feather-20"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary me-2"><i
                                        data-feather="grid" class="feather-20"></i></a>

                                <div class="icon-select">
                                    <span class="icon"><i data-feather="calendar" class="feather-16"></i></span>
                                    <select class="select">
                                        <option>Last Modified</option>
                                        <option>Last Modified by Me</option>
                                        <option>Last Opened by Me</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>Name</th>
                                        <th>Last Modified</th>
                                        <th>Size</th>
                                        <th>Owned Memebr</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td class="productimgname">
                                            <a href="{{ url('product-list') }}"
                                                class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/icons/folder.svg') }}"
                                                    alt="Product" class="me-2">
                                                <span>Digimed</span>
                                            </a>
                                        </td>
                                        <td>Today 08:30 AM <br>by Angel</td>
                                        <td>200 MB</td>
                                        <td>
                                            <a href="javascript:void(0);" class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/avatar/avatar-6.jpg') }}"
                                                    alt="Product" class="me-2 rounded-circle">
                                                <span>Nolan Christopher</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class=""><i data-feather="star"
                                                        class="feather-16 me-2 color-primary"></i></a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                        aria-expanded="false" class="dropset">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="trash-2"
                                                                    class="feather-14 me-2"></i>Permanent Delete</a></li>
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="edit"
                                                                    class="feather-14 me-2"></i>Restore File</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td class="productimgname">
                                            <a href="{{ url('product-list') }}"
                                                class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/icons/xls.svg') }}" alt="Product"
                                                    class="me-2">
                                                <span>Estimation</span>
                                            </a>
                                        </td>
                                        <td>Today 09:20 AM</td>
                                        <td>140 MB</td>
                                        <td>
                                            <a href="javascript:void(0);" class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/avatar/avatar-5.jpg') }}"
                                                    alt="Product" class="me-2 rounded-circle">
                                                <span>Nolan Harris</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class=""><i data-feather="star"
                                                        class="feather-16 me-2 color-primary"></i></a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                        aria-expanded="false" class="dropset">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="trash-2"
                                                                    class="feather-14 me-2"></i>Permanent Delete</a></li>
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="edit"
                                                                    class="feather-14 me-2"></i>Restore File</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td class="productimgname">
                                            <a href="{{ url('product-list') }}"
                                                class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/icons/pdf-02.svg') }}"
                                                    alt="Product" class="me-2">
                                                <span>Intro.pdf</span>
                                            </a>
                                        </td>
                                        <td>27 July 2023</td>
                                        <td>70 MB</td>
                                        <td>
                                            <a href="javascript:void(0);" class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/avatar/avatar-10.jpg') }}"
                                                    alt="Product" class="me-2 rounded-circle">
                                                <span>Me</span>
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class=""><i data-feather="star"
                                                        class="feather-16 me-2 color-primary"></i></a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                        aria-expanded="false" class="dropset">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="trash-2"
                                                                    class="feather-14 me-2"></i>Permanent Delete</a></li>
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="edit"
                                                                    class="feather-14 me-2"></i>Restore File</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td class="productimgname">
                                            <a href="{{ url('product-list') }}"
                                                class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/icons/video.svg') }}" alt="Product"
                                                    class="me-2">
                                                <span>Demoworrking.mp4</span>
                                            </a>
                                        </td>
                                        <td>24 July 2023<br>08:25 AM</td>
                                        <td>180 MB</td>
                                        <td>
                                            <a href="javascript:void(0);" class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/avatar/avatar-2.jpg') }}"
                                                    alt="Product" class="me-2 rounded-circle">
                                                <span>Daniel</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class=""><i data-feather="star"
                                                        class="feather-16 me-2 color-primary"></i></a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                        aria-expanded="false" class="dropset">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="trash-2"
                                                                    class="feather-14 me-2"></i>Permanent Delete</a></li>
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="edit"
                                                                    class="feather-14 me-2"></i>Restore File</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td class="productimgname">
                                            <a href="{{ url('product-list') }}"
                                                class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/icons/audio.svg') }}" alt="Product"
                                                    class="me-2">
                                                <span>voice.mp3</span>
                                            </a>
                                        </td>
                                        <td>27 July 2023</td>
                                        <td>80 MB</td>
                                        <td>
                                            <a href="javascript:void(0);" class="product-img d-flex align-items-center">
                                                <img src="{{ URL::asset('/build/img/avatar/avatar-7.jpg') }}"
                                                    alt="Product" class="me-2 rounded-circle">
                                                <span>Henriques</span>
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class=""><i data-feather="star"
                                                        class="feather-16 me-2 color-primary"></i></a>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                        aria-expanded="false" class="dropset">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="trash-2"
                                                                    class="feather-14 me-2"></i>Permanent Delete</a></li>
                                                        <li><a href="javascript:void(0);" class="dropdown-item"><i
                                                                    data-feather="edit"
                                                                    class="feather-14 me-2"></i>Restore File</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- /Content -->
    </div>
@endsection
