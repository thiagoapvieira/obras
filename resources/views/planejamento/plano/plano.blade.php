@extends('planejamento.layout.app')
@section('content')
<div class="page-content--bgf7">

    <section class="p-t-20">
    <div class="container">
    <div class="row">
    <div class="col-md-8 offset-md-2">

        <br>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <h3 class="title-5 m-b-35">Plano</h3>
            </div>
            <div class="table-data__tool-right">
                <a href="{{url('planejamento/plano/novo')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>Novo
                </a>
            </div>
        </div>

        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th width="6%">id</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($plano as $value)
                    <tr class="tr-shadow">
                        <td>{{$value->id}}</td>
                        <td>
                        	<a href="{{url('planejamento/plano/'.$value->id.'/perspectiva')}}"> {{$value->nome}} </a>
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <a href="{{url('planejamento/plano/'.$value->id.'/editar')}}" class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                                <a href="{{url('planejamento/plano/'.$value->id.'/excluir')}}" class="item" data-toggle="tooltip" data-placement="top" title="Excluir" onClick="return confirm('Deseja realmente excluir?')">
                                    <i class="zmdi zmdi-delete"></i>
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

    <br>
    <br>
    <br>

</div>
@endsection
