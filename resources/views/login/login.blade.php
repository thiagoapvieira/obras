<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('cool_admin_master/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('cool_admin_master/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('cool_admin_master/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('cool_admin_master/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('cool_admin_master/css/theme.css')}}" rel="stylesheet" media="all">
</head>

<body class="animsition">
<div class="page-wrapper">
<div class="page-content--bge5">

            @if (session('danger'))
              <div class="alert alert-danger">
                  {{ session('danger') }}
              </div>
            @endif

            @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif

            <div class="container">
            <div class="login-wrap">
            <div class="login-content">

                        <div class="login-logo">
                            <a href="#">
                                <!-- <img src="images/icon/logo.png" alt="CoolAdmin"> -->
                                <h1><i>SISGPR - NOVO</i></h1>
                            </a>
                        </div>

                        <form action="" method="post" class="login-form">
                        {{ csrf_field() }}

                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="text" name="email" placeholder="Email" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input class="au-input au-input--full" type="password" name="senha" placeholder="Senha">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    <a href="#">Esqueceu sua senha?</a>
                                </p>
                            </div>
                        </form>
            </div>
            </div>
            </div>
</div>
</div>

    <!-- Jquery JS-->
    <script src="{{asset('cool_admin_master/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('cool_admin_master/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS -->
    <script src="{{asset('cool_admin_master/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('cool_admin_master/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/animsition/animsition.min.js')}}"></script>
    <!-- Main JS-->
    <script src="{{asset('cool_admin_master/js/main.js')}}"></script>

</body>
</html>