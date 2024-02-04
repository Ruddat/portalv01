@extends('backend.layouts.default-dark')
@section('content')

@push('specific-css')

@endpush




        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Profile</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo rounded"></div>
                                </div>
                                <div class="profile-info">
                                    <div class="profile-photo">
                                        <a href="javascript:;" onclick="event.preventDefault();document.getElementById('adminProfilePictureFile').click();" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                        <img src="{{ $admin->picture }}" class="img-fluid rounded-circle" alt="" id="adminProfilePicture">
                                        <input type="file" name="adminProfilePictureFile" id="adminProfilePictureFile" class="d-none" style="opacity:0">
                                    </div>
									<div class="profile-details">
										<div class="profile-name px-3 pt-2">
											<h4 class="text-primary mb-0" id="adminProfileName">{{ $admin->name }}</h4>
											<p></p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0" id="adminProfileEmail">{{ $admin->email }}</h4>
											<p>Email</p>
										</div>
										<div class="dropdown ms-auto">
											<a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
											<ul class="dropdown-menu dropdown-menu-end">
												<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
												<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to friends</li>
												<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to group</li>
												<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
											</ul>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="profile-statistics">
											<div class="text-center">
												<div class="row">
													<div class="col">
														<h3 class="m-b-0">150</h3><span>Follower</span>
													</div>
													<div class="col">
														<h3 class="m-b-0">140</h3><span>Place Stay</span>
													</div>
													<div class="col">
														<h3 class="m-b-0">45</h3><span>Reviews</span>
													</div>
												</div>
												<div class="mt-4">
													<a href="" class="btn btn-primary mb-1 me-1">Follow</a>
													<a href="" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#sendMessageModal">Send Message</a>
												</div>
											</div>
											<!-- Modal -->
											<div class="modal fade" id="sendMessageModal">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Send Message</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body">
															<form class="comment-form">
																<div class="row">
																	<div class="col-lg-6">
																		<div class="mb-3">
																			<label class="text-black font-w600 form-label">Name <span class="required">*</span></label>
																			<input type="text" class="form-control" value="Author" name="Author" placeholder="Author">
																		</div>
																	</div>
																	<div class="col-lg-6">
																		<div class="mb-3">
																			<label class="text-black font-w600 form-label">Email <span class="required">*</span></label>
																			<input type="text" class="form-control" value="Email" placeholder="Email" name="Email">
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="mb-3">
																			<label class="text-black font-w600 form-label">Comment</label>
																			<textarea rows="8" class="form-control" name="comment" placeholder="Comment"></textarea>
																		</div>
																	</div>
																	<div class="col-lg-12">
																		<div class="mb-3 mb-0">
																			<input type="submit" value="Post Comment" class="submit btn btn-primary" name="submit">
																		</div>
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="profile-blog">
											<h5 class="text-primary d-inline">Today Highlights</h5>
											<img src="{{ asset('backend/images/profile/1.jpg') }}" alt="" class="img-fluid mt-4 mb-4 w-100 rounded">
											<h4><a href="post-details.html" class="text-black">Darwin Creative Agency Theme</a></h4>
											<p class="mb-0">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="profile-interest">
											<h5 class="text-primary d-inline">Interest</h5>
											<div class="row mt-4 sp4" id=";lk;lk;htgallery">
												<a href="{{ asset('backend/images/profile/2.jpg') }}" data-exthumbimage="{{ asset('backend/images/profile/2.jpg') }}" data-src="{{ asset('backend/images/profile/2.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
													<img src="{{ asset('backend/images/profile/2.jpg') }}" alt="" class="img-fluid rounded">
												</a>
												<a href="{{ asset('backend/images/profile/3.jpg') }}" data-exthumbimage="{{ asset('backend/images/profile/3.jpg') }}" data-src="{{ asset('backend/images/profile/3.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
													<img src="{{ asset('backend/images/profile/3.jpg') }}" alt="" class="img-fluid rounded">
												</a>
												<a href="{{ asset('backend/images/profile/4.jpg') }}" data-exthumbimage="{{ asset('backend/images/profile/4.jpg') }}" data-src="{{ asset('backend/images/profile/4.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
													<img src="{{ asset('backend/images/profile/4.jpg') }}" alt="" class="img-fluid rounded">
												</a>
												<a href="{{ asset('backend/images/profile/3.jpg') }}" data-exthumbimage="{{ asset('backend/images/profile/3.jpg') }}" data-src="{{ asset('backend/images/profile/3.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
													<img src="{{ asset('backend/images/profile/3.jpg') }}" alt="" class="img-fluid rounded">
												</a>
												<a href="{{ asset('backend/images/profile/4.jpg') }}" data-exthumbimage="{{ asset('backend/images/profile/4.jpg') }}" data-src="{{ asset('backend/images/profile/4.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
													<img src="{{ asset('backend/images/profile/4.jpg') }}" alt="" class="img-fluid rounded">
												</a>
												<a href="{{ asset('backend/images/profile/2.jpg') }}" data-exthumbimage="{{ asset('backend/images/profile/2.jpg') }}" data-src="{{ asset('backend/images/profile/2.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
													<img src="{{ asset('backend/images/profile/2.jpg') }}" alt="" class="img-fluid rounded">
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="profile-news">
											<h5 class="text-primary d-inline">Our Latest News</h5>
											<div class="media pt-3 pb-3">
												<img src="{{ asset('backend/images/profile/5.jpg') }}" alt="image" class="me-3 rounded" width="75">
												<div class="media-body">
													<h5 class="m-b-5"><a href="post-details.html" class="text-black">Collection of textile samples</a></h5>
													<p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
												</div>
											</div>
											<div class="media pt-3 pb-3">
												<img src="{{ asset('backend/images/profile/6.jpg') }}" alt="image" class="me-3 rounded" width="75">
												<div class="media-body">
													<h5 class="m-b-5"><a href="post-details.html" class="text-black">Collection of textile samples</a></h5>
													<p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
												</div>
											</div>
											<div class="media pt-3 pb-3">
												<img src="{{ asset('backend/images/profile/7.jpg') }}" alt="image" class="me-3 rounded" width="75">
												<div class="media-body">
													<h5 class="m-b-5"><a href="post-details.html" class="text-black">Collection of textile samples</a></h5>
													<p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card h-auto">

                    @livewire('backend.admin-profile-tabs')



                </div>
               </div>



                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->





@endsection


