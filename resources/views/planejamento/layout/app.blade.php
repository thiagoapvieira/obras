<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>SISGPR</title>

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

    <link href="{{asset('cool_admin_master/css/style.css')}}" rel="stylesheet" media="all">

    <style type="text/css">

        .table-data2.table thead th {
            padding: 5px 5px;
        }
         
        .table-data2.table tbody td {
            font-size: 13px;            
            padding: 5px 5px;
                
            padding-right: 10px;
            border: none;
        }

        .table-data2.table tbody tr td:last-child {         
            padding-right: 0px;
        } 

        .statistic__item {
            min-height: 0px;         
        }   

    </style>


</head>

<body>
    <div class="page-wrapper">
        
        @include('planejamento.layout.menu_planejamento')

        <div id="app">
        @yield('content')
        </div>

            <!-- COPYRIGHT-->            
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">                                
                            <p>Desenvolvido por <a href="https://colorlib.com">SUPEC/DTIN</a>.</p>
                        </div>
                    </div>
                </div>
            </div>            
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS -->
    <script src="{{asset('cool_admin_master/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('cool_admin_master/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS -->
    <script src="{{asset('cool_admin_master/vendor/slick/slick.min.js')}}"> </script>
    <script src="{{asset('cool_admin_master/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"> </script>
    <script src="{{asset('cool_admin_master/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/counter-up/jquery.counterup.min.js')}}"> </script>
    <script src="{{asset('cool_admin_master/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/select2/select2.min.js')}}"> </script>

    <!-- Main JS-->
    <script src="{{asset('cool_admin_master/js/main.js')}}"></script>

    <!--mascara-->    
    <script src="{{asset('cool_admin_master/js/jquery.mask.min.js')}}"></script>  

    <script>
      $("#dt_atualizacao, #dt_inicio, #dt_conclusao_prevista, #dt_conclusao_realizada, #dt_assinatura_contrato, #dt_termino").mask("00/00/0000");
      $("#prazo_entrega").mask("0000000000");
      // $("#valor_inicial, #valor_investido").mask("000000000000");
    </script>

    <!-- vue app-->
    <script src="{{asset('js/app.js')}}"></script>

</body>

</html>
<!-- end document-->