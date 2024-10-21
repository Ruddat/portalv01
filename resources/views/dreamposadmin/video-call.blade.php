<?php $page = 'varriant-attributes'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header d-flex justify-content-end">
                <div>
                    <ul class="table-top-head">
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="rotate"><i data-feather="rotate-ccw"
                                    class="feather-rotate-ccw"></i></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                    data-feather="chevron-up" class="feather-chevron-up"></i></a>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- /product list -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="conference-meet-group">
                                <div class="meeting-list">
                                    <div class="recession-meet-blk">
                                        <div class="reccession-head">
                                            <h5>2023 Stock Conference Meeting</h5>
                                            <ul class="nav">
                                                <li>Thursday, 19 January 2023 </li>
                                            </ul>
                                        </div>
                                        <div class="partispant-blk">
                                            <a href="javascript:void(0);" class="btn btn-primary me-2"><i
                                                    data-feather="plus"></i>Add Participants</a>
                                            <span class="partispant-chat me-2"><a href="javascript:void(0);"
                                                    id="show-message"><i class="bx bx-message-alt-dots"></i></a></span>
                                            <span class="partispant-users"><a href="javascript:void(0);"
                                                    id="add-partispant"><i class="bx bx-user"></i></a></span>
                                        </div>
                                    </div>

                                    <!-- Horizontal View -->
                                    <div class="join-contents horizontal-view fade-whiteboard">
                                        <div class="join-video user-active">
                                            <img src="{{ URL::asset('/build/img/join-call.jpg') }}" class="img-fluid"
                                                alt="Logo">
                                            <div class="video-avatar">
                                                <div class="text-avatar">
                                                    <div class="text-box">
                                                        S
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="record-time">
                                                <span>40:12</span>
                                            </div>
                                            <div class="audio-volume">
                                                <input class="custom-input" type="range" min="0" max="100"
                                                    step="any" value="0">
                                                <span class="volume-icons"><a href="javascript:void(0);"><i
                                                            class="feather feather-volume-2"></i></a></span>
                                            </div>
                                            <!--<div class="volume-col">
                                                <div class="inner-volume-col text-center">
                                                    <div id="player" class="" >
                                                        <div id="volume"></div>
                                                    </div>
                                                    <span class="volume-icons"><i data-feather="volume-2"></i></span>
                                                </div>
                                            </div>-->
                                            <div class="more-icon">
                                                <a href="javascript:void(0);" class="mic-off">
                                                    <i class="bx bx-microphone-off"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-carousel video-slide owl-theme">
                                            <div class="join-video single-user">
                                                <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                    class="img-fluid" alt="Logo">
                                                <div class="part-name sub-part-name">
                                                    <h4>Barbara</h4>
                                                </div>
                                                <div class="more-icon">
                                                    <a href="javascript:void(0);" class="other-mic-off">
                                                        <i class="bx bx-microphone"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="join-video single-user">
                                                <img src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                    class="img-fluid" alt="Logo">
                                                <div class="part-name sub-part-name">
                                                    <h4>Linnea</h4>
                                                </div>
                                                <div class="more-icon">
                                                    <a href="javascript:void(0);" class="other-mic-off">
                                                        <i class="bx bx-microphone"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="join-video single-user">
                                                <img src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                    class="img-fluid" alt="Logo">
                                                <div class="part-name sub-part-name">
                                                    <h4>Richard</h4>
                                                </div>
                                                <div class="more-icon">
                                                    <a href="javascript:void(0);" class="other-mic-off">
                                                        <i class="bx bx-microphone"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="join-video single-user">
                                                <img src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                    class="img-fluid" alt="Logo">
                                                <div class="part-name sub-part-name">
                                                    <h4>Freda</h4>
                                                </div>
                                                <div class="more-icon">
                                                    <a href="javascript:void(0);" class="other-mic-off">
                                                        <i class="bx bx-microphone"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Horizontal View -->

                                </div>
                                <div class="right-user-side right-partisipants right-side-party theiaStickySidebar mb-2"
                                    id="add-party">
                                    <div class=" slime-grp">
                                        <div class="left-chat-title">
                                            <div class="chat-title">
                                                <h4>Participant <span>10</span></h4>
                                            </div>
                                            <div class="contact-close_call">
                                                <a href="#" class="close_profile close_profile4">
                                                    <i data-feather="x"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body-blk slimscroll">
                                            <div class="party-msg-blk ">
                                                <ul class="user-list mt-2">
                                                    <li>
                                                        <div class="user-list-item">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>Maybelle</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="user-list-item">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-03.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>Benjamin</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="user-list-item">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-04.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>Kaitlin</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="user-list-item">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-05.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>Alwin</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="user-list-item">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-06.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>Freda</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="user-list-item">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-08.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>John Doe</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="user-list-item">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-09.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>John Blair</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="user-list-item mb-0">
                                                            <div class="avatar ">
                                                                <img src="{{ URL::asset('/build/img/users/user-10.jpg') }}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="users-list-body">
                                                                <div class="name-list-user out-going-call">
                                                                    <h5>Joseph Collins</h5>
                                                                </div>
                                                                <div class="last-call-time">
                                                                    <div class="call-recent recent-part me-1"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-mic-off"><i
                                                                                class="bx bx-microphone"></i></a></div>
                                                                    <div class="call-recent recent-part"><a
                                                                            href="javascript:void(0);"
                                                                            class="other-video-off"><i
                                                                                class="bx bx-video"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-user-side chat-rooms theiaStickySidebar mb-2" id="chat-room">
                                    <div class="slime-grp">
                                        <div class="left-chat-title">
                                            <div class="chat-title">
                                                <h4>Message</h4>
                                            </div>
                                            <div class="contact-close_call">
                                                <a href="#" class="close_profile close_profile4">
                                                    <i data-feather="x"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body-blk slimscroll p-0">
                                            <div class="chat-msg-blk ">
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Hi Everyone.!</h4>
                                                        </div>
                                                        <div class="chat-profile-name d-flex justify-content-end">
                                                            <h6>10:00 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats chats-right">
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Good Morning..! Today we have meeting about the new product.
                                                            </h4>
                                                        </div>
                                                        <div class="chat-profile-name text-end">
                                                            <h6><i class="bx bx-check-double"></i> 10:00</h6>
                                                        </div>
                                                    </div>
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                            class=" dreams_chat" alt="image">
                                                    </div>
                                                </div>
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                            class=" dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Hi.! Good Morning all.</h4>
                                                        </div>
                                                        <div class="chat-profile-name d-flex justify-content-end">
                                                            <h6>10:00 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                            class=" dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Nice..which category it belongs to?</h4>
                                                        </div>
                                                        <div class="chat-profile-name d-flex justify-content-end">
                                                            <h6>10:00 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                            class=" dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Great.! This is the second new product that comes in this
                                                                week.</h4>
                                                        </div>
                                                        <div class="chat-profile-name d-flex justify-content-end">
                                                            <h6>10:00 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                            class=" dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Hi.! Good Morning all.</h4>
                                                        </div>
                                                        <div class="chat-profile-name d-flex justify-content-end">
                                                            <h6>10:00 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats">
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                            class=" dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Nice..which category it belongs to?</h4>
                                                        </div>
                                                        <div class="chat-profile-name d-flex justify-content-end">
                                                            <h6>10:00 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chats chats-right">
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Good Morning..! Today we have meeting about the new product.
                                                            </h4>
                                                        </div>
                                                        <div class="chat-profile-name text-end">
                                                            <h6><i class="bx bx-check-double"></i> 10:00</h6>
                                                        </div>
                                                    </div>
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-02.jpg') }}"
                                                            class="dreams_chat" alt="image">
                                                    </div>
                                                </div>
                                                <div class="chats mb-0">
                                                    <div class="chat-avatar">
                                                        <img src="{{ URL::asset('/build/img/users/user-01.jpg') }}"
                                                            class=" dreams_chat" alt="image">
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="message-content">
                                                            <h4>Great.! This is the second new product that comes in this
                                                                week.</h4>
                                                        </div>
                                                        <div class="chat-profile-name d-flex justify-content-end">
                                                            <h6>10:00 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-footer">
                                                <form>
                                                    <div class="smile-col comman-icon">
                                                        <a href="#"><i class="far fa-smile"></i></a>
                                                    </div>
                                                    <div class="attach-col comman-icon">
                                                        <a href="#"><i class="fas fa-paperclip"></i></a>
                                                    </div>
                                                    <div class="micro-col comman-icon">
                                                        <a href="#"><i class="bx bx-microphone"></i></a>
                                                    </div>
                                                    <input type="text" class="form-control chat_form"
                                                        placeholder="Enter Message.....">
                                                    <div class="send-chat comman-icon">
                                                        <a href="#"><i data-feather="send"></i></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="meet-call-menu-blk">
                                <div class="video-call-action">
                                    <ul class="nav">
                                        <li><a href="javascript:void(0);" class="mute-bt "><i
                                                    class="bx bx-microphone"></i></a></li>
                                        <li><a href="javascript:void(0);" class="call-end"><i
                                                    data-feather="phone"></i></a></li>
                                        <li><a href="javascript:void(0);" class="mute-video"><i
                                                    class="bx bx-video"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /product list -->
        </div>
    </div>
    </div>
    <div class="customizer-links" id="setdata">
        <ul class="sticky-sidebar">
            <li class="sidebar-icons">
                <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
                    data-bs-original-title="Theme">
                    <i data-feather="settings" class="feather-five"></i>
                </a>
            </li>
        </ul>
    </div>
@endsection
