@extends('layout.app')
@section('content')
<div class="page-content--bgf7">

    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                          <h3 class="title-5">Obra histórico</h3>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="15%">Data</th>
                                    <th>Usuario</th>
                                    <th width="10%">Ação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($obra as $value)                                
                                <tr class="tr-shadow">
                                    <td>
                                        <a href="{{url('obras/obra/'.$obra_id.'/historico/'.$value->id)}}">
                                        {{$value->id}}
                                        </a>
                                    </td>
                                    <td>
                                       <a href="{{url('obras/obra/'.$obra_id.'/historico/'.$value->id)}}">
                                       {{dateBR($value->created_at)}}
                                       </a>
                                   </td>
                                    <td> <span class="block-email">{{usuario_nome($value->usuario_id)}}</span> </td> 
                                    <td>{{$value->acao}}</td>
                                    <td class="text-right">
                                        <!-- <div class="table-data-feature">
                                            <a href="{{url('obras/obra/'.$obra_id.'/historico/'.$value->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                                <i class="zmdi zmdi-more"></i> 
                                            </a>
                                        </div> -->

                                        <a href="{{url('obras/obra/'.$obra_id.'/historico/'.$value->id)}}" class="btn btn-primary btn-sm">Visualizar</a>
                                    </td>
                                </tr>                                
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->


     <!-- COPYRIGHT-->
    <section class="p-t-60 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <!-- <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END COPYRIGHT-->

    <br>
    <br>
    <br>

</div>
@endsection
