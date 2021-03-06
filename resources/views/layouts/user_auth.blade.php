<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="YMDAL" />
    <meta name="author" content="" />

    <link rel="icon" href="/favicon.ico">

    <title>YMDAL | Check DR</title>

    <link rel="stylesheet" href="/css/neon_auth.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="/neon/assets/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="/neon/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
    var baseurl = '/';
</script>

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">

            <a href="index.html" class="logo">
                <img src="/img/logos/hymdal-tag.png" class="img img-responsive" alt="" />
            </a>
        </div>

    </div>

    <div class="login-progressbar">
        <div></div>
    </div>

    <div class="login-form">

        <div class="login-content">

            <div class="form-login-error">
                <h3>Invalid login</h3>
                <p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
            </div>

            <form method="post" role="form" id="form_login">

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-home" style="color:darkgrey !important;"></i>
                        </div>

                        <input type="text" class="form-control" name="txt_outlet_code" id="txt_outlet_code" placeholder="Outlet Code" autocomplete="off" />
                    </div>

                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clipboard" style="color:darkgrey !important;"></i>
                        </div>

                        <input type="password" class="form-control" name="txt_dr_no" id="txt_dr_no" placeholder="DR Number" autocomplete="off" />
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="fa fa-check"  style="color:darkgrey !important;"></i>
                        Check DR
                    </button>
                </div>

                <!-- Implemented in v1.1.4 -->
               {{-- <div class="form-group">
                    <em>- or -</em>
                </div>

                <div class="form-group">

                    <button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">
                        Login with Facebook
                        <i class="entypo-facebook"></i>
                    </button>

                </div>--}}

                <!--

                You can also use other social network buttons
                <div class="form-group">

                    <button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left twitter-button">
                        Login with Twitter
                        <i class="entypo-twitter"></i>
                    </button>

                </div>

                <div class="form-group">

                    <button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left google-button">
                        Login with Google+
                        <i class="entypo-gplus"></i>
                    </button>

                </div> -->

            </form>

{{--
            <div class="login-bottom-links">

                <a href="extra-forgot-password.html" class="link">Forgot your password?</a>

                <br />

                <a href="#">ToS</a>  - <a href="#">Privacy Policy</a>

            </div>--}}

        </div>

    </div>

</div>


<!-- Bottom scripts (common) -->
<script src="/neon/assets/js/gsap/TweenMax.min.js"></script>
<script src="/neon/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="/neon/assets/js/bootstrap.js"></script>
<script src="/neon/assets/js/joinable.js"></script>
<script src="/neon/assets/js/resizeable.js"></script>
<script src="/neon/assets/js/neon-api.js"></script>
<script src="/neon/assets/js/jquery.validate.min.js"></script>
<script src="/neon/assets/js/neon-login.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="/neon/assets/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="/neon/assets/js/neon-demo.js"></script>

</body>
</html>
