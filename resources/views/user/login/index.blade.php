<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login - Big V</title>
    <meta content="Protected page" property="og:title" />
    <meta content="Protected page" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script type="text/javascript">
        ! function(o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);
    </script>
    <link href="{{asset('assets/favicon.png')}}" rel="shortcut icon" type="image/x-icon" />
    <link href="{{asset('assets/favicon.png')}}" rel="apple-touch-icon" />
    <style>
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
    <link href="{{asset('assets/css/style-address-login-register.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body style="background: #f7f7f7; overflow-x:hidden;">
    <div class="content">
        <div class="split-page-wrapper">
            <div class="short-page-wrapper">
                <div class="navbar-5">
                    <div class="container-10"><img src="assets/62ffbe41b946fc3a2b7b6747_Big%20V(NoTag)-ColorB%202.png" loading="lazy" width="100" alt="" /></div>
                </div>
                <div class="flex-stack-center">
                    <div class="form-wrapper-2">
                        <h1 class="signup-header">Login</h1>
                        <div class="margin-bottom-2">to continue to BigV</div>
                        <div class="w-form">
                            <form id="wf-form-signup" name="wf-form-signup" data-name="signup" method="get" data-ms-form="signup" class="form-field-wrapper-2">
                                <div class="form-divider">
                                    <div class="form-div-line"></div>
                                    <div>Login</div>
                                    <div class="form-div-line"></div>
                                </div>
                                <div class="text-field-wrapper"><label for="Email-3" class="field-label">Email</label><input type="email" class="text-field-3 w-input" maxlength="256" name="Email-2" data-name="Email 2" placeholder="e.g. eddy.lin@email.com" id="Email-2" data-ms-member="email" required="" /></div>
                                <div class="text-field-wrapper"><label for="Password-3" class="field-label">Password</label><input type="password" class="text-field-3 w-input" maxlength="256" name="Password-2" data-name="Password 2" placeholder="Password" id="Password-2" data-ms-member="password" required="" /></div><input type="submit" value="Let&#x27;s get started" data-wait="Please wait..." class="button-4 w-button" />
                            </form>
                        </div>
                        <div class="flex-row-center">
                            <div>Forgot Password? <a href="#" data-ms-modal="login" class="link"><strong>Reset Password</strong></a>
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
                        <h3>→ BigV</h3>
                        <p>Your number one Community Marketplace.</p>
                    </div>
                    <div class="browser__wrapper light"><img src="{{asset('assets/633f7db809c5ff224b96427e_image 81.webp')}}" loading="lazy" srcset="{{asset('assets/633f7db809c5ff224b96427e_image%2081.webp')}}" sizes="(max-width: 479px) 100vw, 700px" alt="" /></div>
                </div>
                <div class="colorful-section-bg-fade"></div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/script-address-login-register.js')}}" type="text/javascript"></script>
</body>

</html>