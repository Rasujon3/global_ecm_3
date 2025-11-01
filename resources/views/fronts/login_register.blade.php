<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#sign-in" class="nav-link active">Sign In</a>
            </li>
            <li class="nav-item">
                <a href="#sign-up" class="nav-link">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="sign-in">
             <form id="signinUser">
                <div class="form-group">
                    <label>Email or Phone Number *</label>
                    <input type="text" class="form-control" name="email_or_phone" id="email_or_phone" required>
                </div>
                <div class="form-group mb-0">
                    <label>Password *</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                {{-- <div class="form-checkbox d-flex align-items-center justify-content-between">
                    <input type="checkbox" class="custom-checkbox" id="remember" name="remember" required="">
                    <label for="remember">Remember me</label>
                    <a href="#" class="d-none">Last your password?</a>
                </div> --}}
                <button type="submit" class="btn btn-primary" style="margin-top: 5px;">Sign In</button>
               </form>
            </div>
            <div class="tab-pane" id="sign-up">
             <form id="signupUser">

             	<div class="form-group">
                    <label>Name *</label>
                    <input type="text" class="form-control" name="name_1" id="name_1">
                </div>

                <div class="form-group">
                    <label>Your Email address *</label>
                    <input type="email" class="form-control" name="email_1" id="email_1">
                </div>

                <div class="form-group">
                    <label>Your Phone Number *</label>
                    <input type="text" class="form-control" name="phone_1" id="phone_1">
                </div>

                <div class="form-group mb-5">
                    <label>Password *</label>
                    <input type="password" class="form-control" name="password_1" id="password_1" required>
                </div>

                <div class="form-group mb-5">
                    <label>Confirm Password *</label>
                    <input type="password" class="form-control" name="password_2" id="password_2" required>
                </div>

                <p>Your personal data will be used to support your experience 
                    throughout this website, to manage access to your account, 
                    and for other purposes described in our <a href="#" class="text-primary">privacy policy</a>.</p>
                {{-- <a href="#" class="d-block mb-5 text-primary d-none">Signup as a vendor?</a> --}}
                <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                    <input type="checkbox" class="custom-checkbox" id="agree" name="agree" required="">
                    <label for="agree" class="font-size-md">I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
            </div>
        </div>
        {{-- <p class="text-center d-none">Sign in with social account</p>
        <div class="social-icons social-icon-border-color d-flex justify-content-center d-none">
            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
            <a href="#" class="social-icon social-google fab fa-google"></a>
        </div> --}}
    </div>
</div>

