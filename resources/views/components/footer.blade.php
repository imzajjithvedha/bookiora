<div class="container-fluid footer">
    <div class="container-md">
        <div class="top">
            <p class="text">Need a Help?</p>
            <p class="text">Let's match you with the ideal deal!</p>
        </div>

        <div class="bottom">
            <div class="row">
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <p class="title">About</p>
                    <ul>
                        <li>
                            <a href="{{ route('about-us') }}">About Us</a>
                        </li>

                        <li>
                            <a href="{{ route('careers.index') }}">Careers</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <p class="title">Discover</p>
                    <ul>
                        <li>
                            <a href="{{ route('stays.index') }}">Stays</a>
                        </li>

                        <li>
                            <a href="{{ route('surf-camps.index') }}">Surf Camps</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <p class="title">Support</p>
                    <ul>
                        <li>
                            <a href="{{ route('articles.index') }}">Articles</a>
                        </li>

                        <li>
                            <a href="{{ route('contact-us.index') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <p class="title">Terms and Policy</p>
                    <ul>
                        <li>
                            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                        </li>

                        <li>
                            <a href="{{ route('terms-of-use') }}">Terms and Conditions</a>
                        </li>
                    </ul>
                </div>


            </div>
        </div>

        <hr />

        <div class="copyright">
            <div class="row align-items-center">
                <div class="d-none d-sm-block col-sm-3 col-md-6">
                    <img src="{{ asset('storage/global/logo.png') }}" alt="Logo" class="logo">
                </div>

                <div class="col-12 col-sm-9 col-md-6 text-center text-sm-end">
                    <p class="text">&#169; Bookiora. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>
</div>