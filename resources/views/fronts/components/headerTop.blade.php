<div class="header-top" style="background-color: #e5757e !important;">
    <div class="container">
        <div class="header-left">
            <p class="welcome-msg">{{ setting()->welcome_msg ?? 'Welcome to Glamours World message or remove it!' }}</p>
        </div>
        <div class="header-right">
            <div class="dropdown d-none">
                <a href="#currency">BDT</a>
            </div>
            <!-- End of DropDown Menu -->

            <div class="dropdown d-none">
                <a href="#language"><img src="{{asset('front/assets/images/flags/eng.png')}}" alt="ENG Flag" width="14"
                                         height="8" class="dropdown-image" /> ENG</a>
                <div class="dropdown-box">
                    <a href="#ENG">
                        <img src="{{asset('front/assets/images/flags/eng.png')}}" alt="ENG Flag" width="14" height="8"
                             class="dropdown-image" />
                        ENG
                    </a>
                </div>
            </div>
            <!-- End of Dropdown Menu -->
            <span class="divider d-lg-show d-none"></span>
            <a href="{{ route('contact') }}" class="d-lg-show d-none">Contact Us</a>
            @if(Auth::check())
                <a href="{{ route('my-account') }}" class="d-lg-show my-account">My Account</a>

                <a href="{{'/user-logout'}}" class="d-lg-show user-logout">{{Auth::user()->name}} ( Logout )</a>

            @else
                {{-- <a href="front/assets/ajax/login.html" class="d-lg-show login sign-in"><i
                        class="w-icon-account"></i>Sign In</a> --}}

                <a href="{{url('/login-register')}}" class="d-lg-show login sign-in" style=":hover{color:#fff !important;}">
                    <i class="w-icon-account"></i>
                    Sign In
                </a>
                <span class="delimiter d-lg-show ">/</span>
                <a href="{{url('/login-register')}}" class="ml-0 d-lg-show login register">Register</a>
            @endif

        </div>
    </div>
</div>
