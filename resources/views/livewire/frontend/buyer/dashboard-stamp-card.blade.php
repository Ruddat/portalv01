<div>

    <main>
        @include('layouts.partials.dashboard-header', ['client' => $client])

        <!-- /page_header -->

        <div class="container margin_60_20">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">



                        <div class="col-md-12  mb-4">
                            <div class="welcome-message">
                                <h1 class="greeting">Hallo, {{ $client->name }}!</h1>
                                <p class="welcome-text">
                                    Willkommen zurück bei Appetit! Wir freuen uns, Sie wiederzusehen. Vergessen Sie nicht, Ihre <span class="highlight">StampCards</span> zu überprüfen und Ihre <span class="highlight">Coupons</span> einzulösen, um großartige Rabatte zu erhalten. Schauen Sie sich auch Ihre <span class="highlight">Rechnungen</span> an, um den Überblick über Ihre Bestellungen zu behalten.
                                    <br><br>
                                    Wenn Sie Fragen haben, zögern Sie nicht, uns zu kontaktieren. Viel Spaß beim Stöbern und guten Appetit!
                                </p>
                                <div class="thumb_dashboard">
                                    @if ($client->avatar)
                                        <img src="{{ $client->avatar }}" alt="Avatar" class="avatar_dashboard">
                                    @else
                                        <img src="default-avatar.png" alt="Default Avatar" class="avatar_dashboard">
                                    @endif
                                </div>
                            </div>
                            <!-- /article -->



                        </div>
                        <!-- /col -->



                        <div class="container-xl px-4 mt-4">
                            <!-- Account page navigation-->
                            <nav class="nav nav-borders">
                                <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>
                                <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>
                                <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>
                                <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>
                            </nav>
                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header">Profile Picture</div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                            <!-- Profile picture help block-->
                                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                            <!-- Profile picture upload button-->
                                            <button class="btn btn-primary" type="button">Upload new image</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Account Details</div>
                                        <div class="card-body">
                                            <form>
                                                <!-- Form Group (username)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                                    <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (first name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputFirstName">First name</label>
                                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie">
                                                    </div>
                                                    <!-- Form Group (last name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputLastName">Last name</label>
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna">
                                                    </div>
                                                </div>
                                                <!-- Form Row        -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (organization name)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputOrgName">Organization name</label>
                                                        <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                                                    </div>
                                                    <!-- Form Group (location)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputLocation">Location</label>
                                                        <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">
                                                    </div>
                                                </div>
                                                <!-- Form Group (email address)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (phone number)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                                        <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567">
                                                    </div>
                                                    <!-- Form Group (birthday)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputBirthday">Birthday</label>
                                                        <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988">
                                                    </div>
                                                </div>
                                                <!-- Save changes button-->
                                                <button class="btn btn-primary" type="button">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
















                        <div class="col-md-6">
                            <article class="blog">
                                <figure>
                                    <a href="#"><img src="img/blog-2.jpg" alt="">
                                        <div class="preview"><span>Read more</span></div>
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <small>Category - 20 Nov. 2017</small>
                                    <h2><a href="#">At usu sale dolorum offendit</a></h2>
                                    <p>Quodsi sanctus pro eu, ne audire scripserit quo. Vel an enim offendit salutandi, in eos quod omnes epicurei, ex veri qualisque scriptorem mei.</p>
                                    <ul>
                                        <li>
                                            <div class="thumb_dashboard"><img src="img/avatar.jpg" alt=""></div> Admin
                                        </li>
                                        <li><i class="icon_comment_alt"></i>20</li>
                                    </ul>
                                </div>
                            </article>
                            <!-- /article -->
                        </div>
                        <!-- /col -->

                        <div class="col-md-6">
                            <article class="blog">
                                <figure>
                                    <a href="#"><img src="img/blog-2.jpg" alt="">
                                        <div class="preview"><span>Read more</span></div>
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <small>Category - 20 Nov. 2017</small>
                                    <h2><a href="#">At usu sale dolorum offendit</a></h2>
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



                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    @if ($client->avatar)
                                        <img src="{{ $client->avatar }}" alt="avatar_dashboard" class="img-fluid rounded-circle thumb_dashboard" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <img src="/path/to/default-avatar.png" alt="Default Avatar" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h1>{{ $client->name }} {{ $client->last_name }}</h1>
                                    <p><strong>Email:</strong> {{ $client->email }}</p>
                                    <p><strong>Adresse:</strong> {{ $client->shipping_street }} {{ $client->shipping_house_no }}</p>
                                    <p><strong>Stadt:</strong> {{ $client->city }}</p>
                                    <p><strong>Land:</strong> {{ $client->country }}</p>
                                </div>
                            </div>
                        </div>




                    </div>
                    <!-- /row -->
                </div>
                <!-- /col -->

                @include('layouts.partials.dashboard-links', ['client' => $client])

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>



<style>
    body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>



</div>
