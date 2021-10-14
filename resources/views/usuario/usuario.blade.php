@extends('layout.app')
@section('content')
<div class="page-content--bgf7">

    <!-- BREADCRUMB
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">

                        </div>
                        <form class="au-form-icon--sm" action="" method="post">
                        {{ csrf_field() }}
                            <input class="au-input--w300 au-input--style2" type="text" placeholder="Pesquisa ..." name="pesq" value="{{session()->get('user_filtro')['pesq']}}">
                            <button class="au-btn--submit2" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->


    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                          <h3 class="title-5">Usuários</h3>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{url('usuario/novo')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Novo
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>nome</th>
                                    <th>email</th>
                                    <th>status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($usuario as $value)
                                <tr class="tr-shadow">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->nome}}</td>
                                    <td>
                                        <span class="block-email">{{$value->email}}</span>
                                    </td>
                                    <td>
                                        <span class="status--process">{{usuario_status($value->is_active)}}</span>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{url('usuario/'.$value->id.'/editar')}}" class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <a href="{{url('usuario/'.$value->id.'/excluir')}}" class="item" data-toggle="tooltip" data-placement="top" title="Deletar">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                            
                                            <a href="{{url('usuario/'.$value->id.'/edit')}}" class="item" data-toggle="tooltip" data-placement="top" title="Mais informações">
                                                <i class="zmdi zmdi-more"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
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
