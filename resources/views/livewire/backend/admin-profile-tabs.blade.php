<div>
    <div class="card-body">
        <div class="profile-tab">
            <div class="custom-tab-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a wire:click.prevent='selectTab("personal_details")' href="#personal_details" data-bs-toggle="tab" data-toggle="tab" class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}">Personal details</a>
                    </li>
                    <li class="nav-item">
                        <a wire:click.prevent='selectTab("update_password")' href="#update_password" data-bs-toggle="tab" class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}">Update Password</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="personal_details" role="tabpanel" class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}">

                        <div class="pt-3">
                            <div class="settings-form">
                                <h4 class="text-primary">Account Setting</h4>
                                <form wire:submit.prevent='updateAdminPersonalDetails()'>
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Name</label>
                                            <input type="text" placeholder="Enter full name" class="form-control" wire:model='name'>
                                            @error('name')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Email</label>
                                            <input type="text" placeholder="Enter email" class="form-control" wire:model='email'>
                                            @error('email')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Username</label>
                                            <input type="text" placeholder="Enter username" class="form-control" wire:model='username'>
                                            @error('username')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div id="update_password" class="tab-pane fade {{ $tab == 'update_password' ? 'show active' : '' }}">




                        <div class="pt-3">
                            <div class="settings-form">
                                <h4 class="text-primary">Update Password</h4>
                                <form wire:submit.prevent='updatePassword()'>
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Current password</label>
                                            <input type="password" placeholder="Enter current password" class="form-control" wire:model.defer='current_password'>
                                            @error('current_password')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">New password</label>
                                            <input type="password" placeholder="Enter new password" class="form-control" wire:model.defer='new_password'>
                                            @error('new_password')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Confirm new password</label>
                                            <input type="password" placeholder="Retype new password" class="form-control" wire:model.defer='new_password_confirmation'>
                                            @error('new_password_confirmation')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                    </div>

                                    <button class="btn btn-primary" type="submit">Update password</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



<script>
    document.addEventListener("livewire:init", () => {
        Livewire.on("toast", (event) => {
            toastr[event.notify](event.message);
        });
    });
</script>



@push('specific-scripts')



<script>
    window.addEventListener('updateAdminInfo', function (event){
        $('#adminProfileName').html(event.detail.adminName);
        $('#adminProfileEmail').html(event.detail.adminEmail);
    });

    $('input[type="file"][name="adminProfilePictureFile"][id="adminProfilePictureFile"]').ijaboCropTool({
          preview : '#adminProfilePicture',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['CROP','QUIT'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl:'{{ route("admin.change-profile-picture") }}',
          withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
            Livewire.dispatch('updateAdminSellerHeaderInfo');
             toastr.success(message);
          },
          onError:function(message, element, status){
            toastr.error(message);
          }
       });

</script>



@endpush
