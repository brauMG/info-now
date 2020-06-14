<html lang="en">
    <head itemscope="" itemtype="http://schema.org/WebSite">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="canonical" href="//rapidoss.info-now.app" itemprop="url">



        <title itemprop="name">Sistema de Enfoque Rapido</title>


        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/landing-page.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="//fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            /*!
            * Start Bootstrap - Landing Page Bootstrap Theme (http://startbootstrap.com)
            * Code licensed under the Apache License v2.0.
            * For details, see http://www.apache.org/licenses/LICENSE-2.0.
                            */

            body,
            html {
                width: 100%;
                height: 100%;
            }

            body,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
                font-weight: 700;
            }

            .topnav {
                font-size: 14px;
            }

            .lead {
                font-size: 18px;
                font-weight: 400;
            }

            .intro-header {
                width: 100%;
                height: 100%;
                text-align: center;
                color: #f8f8f8;
                background: url(../img/background.jpeg) no-repeat center center;
                background-size: cover;
                overflow-y: hidden;
                overflow-x: hidden;
            }

            .intro-message {
                position: relative;
                padding-top: 20%;
                padding-bottom: 15px;
            }

            .intro-message > h1 {
                margin: 0;
                text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
                font-size: 5em;
            }

            .intro-divider {
                width: 80%;
                border-top: 1px solid #f8f8f8;
                border-bottom: 1px solid rgba(0,0,0,0.2);
            }

            .intro-message > h3 {
                text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
            }

            @media(max-width:767px) {
                .intro-message {
                    padding-bottom: 15%;
                }

                .intro-message > h1 {
                    font-size: 3em;
                }

                ul.intro-social-buttons > li {
                    display: block;
                    margin-bottom: 20px;
                    padding: 0;
                }

                ul.intro-social-buttons > li:last-child {
                    margin-bottom: 0;
                }

                .intro-divider {
                    width: 100%;
                }
            }
            .network-name {
                text-transform: uppercase;
                font-size: 14px;
                font-weight: 400;
                letter-spacing: 2px;
            }

            .content-section-a {
                padding: 50px 0;
                background-color: #f8f8f8;
            }

            .content-section-b {
                padding: 50px 0;
                border-top: 1px solid #e7e7e7;
                border-bottom: 1px solid #e7e7e7;
            }

            .section-heading {
                margin-bottom: 30px;
            }

            .section-heading-spacer {
                float: left;
                width: 200px;
                border-top: 3px solid #e7e7e7;
            }

            .banner {
                padding: 100px 0;
                color: #f8f8f8;
                background: url(../img/banner-bg.jpg) no-repeat center center;
                background-size: cover;
            }

            .banner h2 {
                margin: 0;
                text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
                font-size: 3em;
            }

            .banner ul {
                margin-bottom: 0;
            }

            .banner-social-buttons {
                float: right;
                margin-top: 0;
            }
            @media(max-width:1199px) {
                ul.banner-social-buttons {
                    float: left;
                    margin-top: 15px;
                }
            }

            @media(max-width:767px) {
                .banner h2 {
                    margin: 0;
                    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
                    font-size: 3em;
                }

                ul.banner-social-buttons > li {
                    display: block;
                    margin-bottom: 20px;
                    padding: 0;
                }

                ul.banner-social-buttons > li:last-child {
                    margin-bottom: 0;
                }
            }

            footer {
                padding: 50px 0;
                background-color: #f8f8f8;
            }

            p.copyright {
                margin: 15px 0 0;
            }

            a.email-address {
                color: #FFFFFF;
                text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
            }

            a.email-address:hover {
                color: #FFFFFF;
            }
        </style>
    </head>
    <body>
        <div class="intro-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-message">
                            <h1 id="hdrDescription">Sistema de Enfoque Rapido</h1>
                            <hr class="intro-divider">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="nombres" class="col-md-4 col-form-label text-md-right">Nombre(s)</label>
                                <div class="col-md-6">
                                    <input id="nombres" type="text" class="form-control @error('name') is-invalid @enderror" name="nombres" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="correo" class="col-md-4 col-form-label text-md-right">Correo</label>
                                <div class="col-md-6">
                                    <input id="correo" type="email" class="form-control @error('email') is-invalid @enderror" name="correo" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contrasena" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input id="contrasena" type="password" class="form-control @error('password') is-invalid @enderror" name="contrasena" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contrasena-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="contrasena-confirm" type="password" class="form-control" name="contrasena_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.intro-header -->
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
