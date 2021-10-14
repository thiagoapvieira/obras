<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Obras</title>

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

        @include('obras.layout.menu_obra')

        <?php

        /*calculo de porcentagem */
        $total = $rel_obra_status_fase[0]->qtd + 
                 $rel_obra_status_fase[1]->qtd + 
                 $rel_obra_status_fase[2]->qtd + 
                 $rel_obra_status_fase[3]->qtd + 
                 $rel_obra_status_fase[4]->qtd + 
                 $rel_obra_status_fase[5]->qtd +
                 $rel_obra_status_fase[6]->qtd;        

                 $p0 = ($rel_obra_status_fase[0]->qtd * 100) / $total;
                 $p1 = ($rel_obra_status_fase[1]->qtd * 100) / $total;
                 $p2 = ($rel_obra_status_fase[2]->qtd * 100) / $total;
                 $p3 = ($rel_obra_status_fase[3]->qtd * 100) / $total;
                 $p4 = ($rel_obra_status_fase[4]->qtd * 100) / $total;
                 $p5 = ($rel_obra_status_fase[5]->qtd * 100) / $total;
                 $p6 = ($rel_obra_status_fase[6]->qtd * 100) / $total;
        ?>


        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">

            <!-- WELCOME-->
            <br>
            <br>
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">
                                Painel de controle  
                                <a href="{{url('obras/painel/consolidar_calculo')}}" class="btn btn-dark btn-sm" type="submit">Consolidar cálculos</a> 
                            </h1>
                            <hr class="line-seprate">
                        </div>                        
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- STATISTIC-->
            <section class="statistic statistic2">
            <div class="container">
                <div class="row">
                        <div class="col-xs-12 col-md-5 col-lg-5">
                            <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="statistic__item statistic__item--green">
                                    <h2 class="number">{{$rel_obra_status_fase[5]->qtd}}/{{$total}}</h2>
                                    <span class="desc">Concluídas</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="statistic__item statistic__item--orange">
                                    <h2 class="number">{{$rel_obra_status_fase[3]->qtd}}/{{$total}}</h2>
                                    <span class="desc">Em execução</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-2 col-lg-2">
                            <div class="row">
                            <div class="col-12">
                                <div class="statistic__item statistic__item--blue" style="padding: 20px 0px 20px 15px;">
                                    <h2 class="number">{{$rel_obra_status_fase[0]->qtd}}/{{$total}}</h2>
                                    <span class="desc">Em planejamento</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>                      
                        
                        <div class="col-xs-12 col-md-5 col-lg-5">
                            <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="statistic__item statistic__item--red" style="background: #334d4d;">
                                    <h2 class="number">{{$rel_obra_status_fase[2]->qtd}}/{{$total}}</h2>
                                    <span class="desc">Não iniciadas</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="statistic__item statistic__item--red">
                                    <h2 class="number">{{$rel_obra_status_fase[4]->qtd}}/{{$total}}</h2>
                                    <span class="desc">Paralisadas</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!--
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-2">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">{{$rel_obra_status_fase[5]->qtd}}/{{$total}}</h2>
                                <span class="desc">Concluída</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">{{$rel_obra_status_fase[3]->qtd}}/{{$total}}</h2>
                                <span class="desc">Em execução</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{$rel_obra_status_fase[0]->qtd}}/{{$total}}</h2>
                                <span class="desc" style="font-size: 14px;">Em planejamento</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="statistic__item statistic__item--red" style="background: #334d4d;">
                                <h2 class="number">{{$rel_obra_status_fase[2]->qtd}}/{{$total}}</h2>
                                <span class="desc">Não iniciadas</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">{{$rel_obra_status_fase[4]->qtd}}/{{$total}}</h2>
                                <span class="desc">Paralisada</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">{{$rel_obra_status_fase[1]->qtd}}/{{$total}}</h2>
                                <span class="desc">Em licitação</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">{{$rel_obra_status_fase[6]->qtd}}/{{$total}}</h2>
                                <span class="desc">Cancelada</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            -->
            

            <!-- STATISTIC CHART-->
            <section class="statistic-chart">
            <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">Situação</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                        <div class="task-progress" style="padding-top: 30px; padding-bottom: 20px; border: solid thin #ccc;">
                            <!-- <h3 class="title-3">task progress</h3> -->
                            <div class="au-skill-container">
                                <div class="au-progress">
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$p0}}">
                                            <!-- <span class="au-progress__value js-value"></span> -->
                                        </div>
                                    </div>
                                    <span class="au-progress__title">Em planejamento - {{round($p0,2)}} %</span>
                                </div>                                
                                <div class="au-progress">
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$p1}}">
                                            <!-- <span class="au-progress__value js-value"></span> -->
                                        </div>
                                    </div>
                                    <span class="au-progress__title">Em licitação - {{round($p1,2)}} %</span>
                                </div>
                                <div class="au-progress">
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$p2}}">
                                            <!-- <span class="au-progress__value js-value"></span> -->
                                        </div>
                                    </div>
                                    <span class="au-progress__title">Não iniciada - {{round($p2,2)}} %</span>
                                </div>
                                <div class="au-progress">
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$p3}}">
                                            <!-- <span class="au-progress__value js-value"></span> -->
                                        </div>
                                    </div>
                                    <span class="au-progress__title">Em execução - {{round($p3,2)}} %</span>
                                </div>
                                <div class="au-progress">
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$p4}}">
                                            <!-- <span class="au-progress__value js-value"></span> -->
                                        </div>
                                    </div>
                                    <span class="au-progress__title">Paralisada - {{round($p4,2)}} %</span>
                                </div>                                
                                <div class="au-progress">
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$p5}}">
                                            <!-- <span class="au-progress__value js-value"></span> -->
                                        </div>
                                    </div>
                                    <span class="au-progress__title">Concluída - {{round($p5,2)}} %</span>
                                </div>
                                <div class="au-progress">
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="{{$p6}}">
                                            <!-- <span class="au-progress__value js-value"></span> -->
                                        </div>
                                    </div>
                                    <span class="au-progress__title">Canceladas - {{round($p6,2)}} %</span>
                                </div>
                                Total : {{$total}} obras
                            </div>
                        </div>
                        </div>

                        <!--
                        <div class="col-md-6 col-lg-4">                            
                            <div class="chart-percent-2">
                                <h3 class="title-3 m-b-30">Situação</h3>
                                <div class="chart-wrap">
                                    <canvas id="percent-chart7"></canvas>
                                    <div id="chartjs-tooltip">
                                        <table></table>
                                    </div>
                                </div>
                                
                                <div class="chart-info">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>Concluída</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--red"></span>
                                        <span>Em execução</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--red"></span>
                                        <span>Em planejamento</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--red"></span>
                                        <span>Não iniciada</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--red"></span>
                                        <span>Paralisada</span>
                                    </div>
                                </div>                                
                            </div>                            
                        </div>
                        -->

                        <div class="col-md-8 col-lg-8">                            
                            <div class="top-campaign" style="padding-top: 15px; padding-right: 20px; padding-left: 20px; padding-bottom: 15px; border: solid thin #ccc;">
                                <h3 class="title-3" style="color: #4272d7; margin-bottom: 10px;">Obras por setor</h3>
                                <div class="table-responsive">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>                                               
                                                <th>Setor</th>
                                                <th>Quantidade</th>
                                                <th>Total investido</th>
                                                <th>Total executado</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $soma=0; ?>
                                            @foreach ($rel_obra_setor as $value)
                                            <tr>
                                                <td>{{$value->setor}}</td>
                                                <td>{{$value->qtd}}</td>
                                                <td>R$ {{ number_format($value->investido,2,",",".") }}</td>
                                                <td>R$ {{ number_format($value->executado,2,",",".") }}</td>                                                
                                            </tr>
                                            <?php $soma = $soma + $value->qtd; ?>
                                            @endforeach                                           
                                        </tbody>
                                    </table>
                                    <?= '<br>Total: '.$soma.' obras'; ?>
                                </div>
                            </div>                            
                        </div>
                        
                    </div>
            </div>
            </section>
            <!-- END STATISTIC CHART-->

            
            <div class="container">
            <div class="row">
            <div class="col-md-6 col-lg-6">                            
                <div class="top-campaign" style="padding-top: 15px; padding-right: 20px; padding-left: 20px; padding-bottom: 15px; border: solid thin #ccc;">
                    <h3 class="title-3" style="color: #4272d7; margin-bottom: 10px;">Valor investido</h3>
                    <div class="table-responsive">
                        <table class="table table-data2">
                            <thead>
                                <tr>                                               
                                    <!-- <th>Id</th> -->
                                    <th>Situação</th>
                                    <th class="text-center">Quantidade</th>
                                    <th>Investido</th>
                                    <th>Executado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $soma=0; ?>                                
                                @foreach ($rel_obra_status_fase as $value)
                                <tr>
                                    <!-- <td>{{$value->id}}</td> -->
                                    <td>{{status_fases($value->id_status_fase)}}</td>
                                    <td class="text-center">{{$value->qtd}}</td>
                                    <td>R$ {{ number_format($value->investido,2,",",".") }}</td>
                                    <td>R$ {{ number_format($value->executado,2,",",".") }}</td> 
                                </tr>
                                <?php $soma = $soma + $value->qtd; ?>
                                @endforeach                                           
                            </tbody>
                        </table>
                        <?= '<br>Total: '.$soma.' obras'; ?>
                    </div>
                </div>                            
            </div>

            <div class="col-md-6 col-lg-6">                            
                <div class="top-campaign" style="padding-top: 15px; padding-right: 20px; padding-left: 20px; padding-bottom: 15px; border: solid thin #ccc;">
                    <h3 class="title-3" style="color: #4272d7; margin-bottom: 10px;">Obras por território</h3>
                    <div class="table-responsive">
                        <table class="table table-data2">
                            <thead>
                                <tr>                                               
                                    <!-- <th>Id</th>-->
                                    <th>Cidade</th>
                                    <th class="text-center">Quantidade</th>
                                    <th>Total investido</th>
                                    <th>Total executado</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($rel_obra_regiao as $value)
                                <tr>
                                    <!-- <td>{{$value->id}}</td>-->
                                    <td>{{$value->regiao}}</td>                                    
                                    <td class="text-center">{{$value->qtd}}</td>                                    
                                    <td>R$ {{ number_format($value->investido,2,",",".") }}</td>
                                    <td>R$ {{ number_format($value->executado,2,",",".") }}</td>  
                                </tr>                                
                                @endforeach 
                            </tbody>
                        </table>                        
                    </div>
                </div>                            
            </div>
            </div>
            </div>


            <div class="container">
            <div class="row">
            <div class="col-md-12 col-lg-12">                            
                <div class="top-campaign" style="padding-top: 15px; padding-right: 20px; padding-left: 20px; padding-bottom: 15px; border: solid thin #ccc;">
                    <h3 class="title-3" style="color: #4272d7; margin-bottom: 10px;">Obras por município</h3>
                    <div class="table-responsive table-data">
                        <table class="table table-data2">
                            <thead>
                                <tr>                                               
                                    <th>Cidade</th>
                                    <th class="text-center">Quantidade</th>
                                    <th>Total investido</th>
                                    <th>Total executado</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                @foreach ($rel_obra_cidade as $value)
                                <tr>
                                    <td>{{$value->cidade}}</td>                                    
                                    <td class="text-center">{{$value->qtd}}</td>                                    
                                    <td>R$ {{ number_format($value->investido,2,",",".") }}</td>
                                    <td>R$ {{ number_format($value->executado,2,",",".") }}</td>  
                                </tr>                        
                                @endforeach                                           
                            </tbody>
                        </table>
                        
                    </div>
                </div>                            
            </div>
            </div>
            </div>
            


            <!-- COPYRIGHT-->            
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">                                
                            <p>Desenvolvido por <a href="https://colorlib.com">SECOM/DTIN</a>.</p>
                        </div>
                    </div>
                </div>
            </div>            
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('cool_admin_master/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('cool_admin_master/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('cool_admin_master/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('cool_admin_master/vendor/slick/slick.min.js')}}">
    </script>
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



    <script type="text/javascript">
        try {

            // Percent Chart 2
            var ctx = document.getElementById("percent-chart7");
            if (ctx) {
              ctx.height = 209;
              var myChart = new Chart(ctx, {
                type: 'doughnut',
               
                data: {
                  datasets: [
                    {
                      label: "My First dataset",
                      data: [100, 100, 100, 100, 100], 
                      backgroundColor: ['#00b5e9', '#fa4251','#000','#fa4251','#000'],
                      hoverBackgroundColor: ['#00b5e9', '#fa4251','pink','#fa4251','pink'],
                      borderWidth: [0, 0, 0, 0, 0 ],
                      hoverBorderColor: ['transparent', 'transparent']
                    }
                  ],
                  labels: ['Concluída', 'Em execução', 'Em planejamento', 'Não iniciada', 'Paralisada']
                },

                options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  cutoutPercentage: 87,
                  animation: {
                    animateScale: true,
                    animateRotate: true
                  },
                  legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                      fontSize: 14,
                      fontFamily: "Poppins,sans-serif"
                    }
                  },
                  tooltips: {
                    titleFontFamily: "Poppins",
                    xPadding: 15,
                    yPadding: 10,
                    caretPadding: 0,
                    bodyFontSize: 16,
                  }
                }

              });
            }

          } catch (error) {
            console.log(error);
          }
    </script>





</body>

</html>
<!-- end document-->