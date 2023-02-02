<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Register - Big V</title>
    <meta content="Protected page" property="og:title" />
    <meta content="Protected page" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script type="text/javascript">
        ! function(o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                .className += t + "touch")
        }(window, document);
    </script>
    <link href="{{ asset('assets/favicon.png') }}" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('assets/favicon.png') }}" rel="apple-touch-icon" />
    <style>
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .invalid-feedback {
            color: red;
            font-size: .8rem;
            margin-top: .4rem;
            margin-bottom: 1rem;
        }

        input.is-invalid {
            border-color: red !important;
        }
    </style>
    <link href="{{ asset('assets/css/style-address-login-register.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body style="background: #f7f7f7; overflow-x:hidden;">
    <div class="content">
        <div class="split-page-wrapper">
            <div class="short-page-wrapper">
                <div class="navbar-5">
                    <div class="container-10"><img src="{{asset('assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png')}}"
                            loading="lazy" width="100" alt="" /></div>
                </div>
                <div class="flex-stack-center">
                    <div class="form-wrapper-2">
                        <h1 class="signup-header">Get Started</h1>
                        <div class="margin-bottom-2">by creating an account </div>
                        <div class="w-form">
                            <form id="wf-form-signup" name="wf-form-signup" data-name="signup" method="POST"
                                action="{{ route('register') }}" data-ms-form="signup" class="form-field-wrapper-2">
                                @csrf

                                <div class="form-divider">
                                    <div class="form-div-line"></div>
                                    <div>REGISTER</div>
                                    <div class="form-div-line"></div>
                                </div>
                                <div class="text-field-wrapper half" style="margin-bottom: 0 !important;">
                                    <label for="First-Name" class="field-label">First
                                        Name</label>
                                    @php($name = explode(' ', old('name')))
                                    <input type="text"
                                        class="text-field-3 w-input @error('name') is-invalid @enderror" maxlength="256"
                                        data-name="First Name" placeholder="e.g. Eddy" id="firstName"
                                        data-ms-member="first-name"
                                        value="{{ count($name) > 1 ? (isset($name[0]) ? $name[0] : '') : '' }}"
                                        required="" />
                                </div>
                                <div class="text-field-wrapper half" style="margin-bottom: 0 !important;">
                                    <label for="Last-Name" class="field-label">Last
                                        Name</label>
                                    <input type="text"
                                        class="text-field-3 w-input @error('name') is-invalid @enderror" maxlength="256"
                                        data-name="Last Name" placeholder="e.g. Lin" id="lastName"
                                        data-ms-member="last-name"
                                        value="{{ count($name) > 1 ? (isset($name[1]) ? $name[1] : '') : '' }}"
                                        required="" />
                                </div>
                                <div style="margin-bottom: 12px;">
                                    <input type="hidden" id="inputName" name="name">

                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-field-wrapper">
                                    <label for="Email-2" class="field-label">Email</label>
                                    <input type="email"
                                        class="text-field-3 w-input @error('email') is-invalid @enderror"
                                        maxlength="256" name="email" data-name="Email 2"
                                        placeholder="e.g. eddy.lin@email.com" id="Email-2" value="{{ old('email') }}"
                                        required="" />

                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-field-wrapper">
                                    <label for="Password-2" class="field-label">Password</label>
                                    <input type="password"
                                        class="text-field-3 w-input @error('password') is-invalid @enderror"
                                        maxlength="256" name="password" data-name="Password 2" placeholder="Password"
                                        id="Password-2" data-ms-member="password" required="" autocomplete="new-password" />

                                    @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-field-wrapper">
                                    <label for="Password-2" class="field-label">Confirm Password</label>
                                    <input type="password" class="text-field-3 w-input" maxlength="256"
                                        name="password_confirmation" data-name="Password 2"
                                        placeholder="Confirmation Password" id="Password-2" data-ms-member="password"
                                        required="" autocomplete="new-password" />
                                </div>
                                <div class="text-field-wrapper">
                                    <label for="Phone-Number" class="field-label">Phone
                                        Number</label>
                                    <input type="tel"
                                        class="text-field-3 w-input @error('phone') is-invalid @enderror"
                                        maxlength="256" name="phone" data-name="Phone Number"
                                        placeholder="e.g. 6123847502" id="Phone-Number" data-ms-member="password"
                                        value="{{ old('phone') }}" required="" />

                                    @error('phone')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-field-wrapper">
                                    <label for="Birthdate-2" class="field-label">Birthdate</label>
                                    <input type="date"
                                        class="text-field-3 w-input @error('date_of_birth') is-invalid @enderror"
                                        maxlength="256" name="date_of_birth" data-name="Birthdate"
                                        placeholder="e.g. 19 April 2002" id="Birthdate-2" data-ms-member="password"
                                        value="{{ old('date_of_birth') }}" required="" />

                                    @error('date_of_birth')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input id="btnRegister" type="submit" value="Let&#x27;s get started"
                                    data-wait="Please wait..." class="button-4 w-button" />
                            </form>
                        </div>
                        <div class="flex-row-center">
                            <div>Already have an account? <a href="{{ route('login') }}" data-ms-modal="login"
                                    class="link"><strong>Log in</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
                <footer id="footer" class="footer-2 wf-section">
                    <div class="container-10">
                        <div class="footer-flex-container">
                            <div>Copyright © 2022 BigV SG</div>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="colorful-section">
                <div class="colorful-section-contain">
                    <div class="colorful-rich-text w-richtext">
                        <h3>→ Get Started with BigV</h3>
                        <p>Your number one Community Marketplace.</p>
                    </div>
                    <div class="browser__wrapper light"><img
                            src="{{ asset('assets/633f7db809c5ff224b96427e_image 81.webp') }}" loading="lazy"
                            srcset="{{ asset('assets/633f7db809c5ff224b96427e_image%2081.webp') }}"
                            sizes="(max-width: 479px) 100vw, 700px" alt="" /></div>
                </div>
                <div class="colorful-section-bg-fade"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/script-address-login-register.js') }}" type="text/javascript"></script>
    <script>
        $("#btnRegister").on("click", function() {
            $("#inputName").val($("#firstName").val() + " " + $("#lastName").val());
        });
    </script>
</body>

</html>
