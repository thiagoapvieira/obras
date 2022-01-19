@extends('planejamento.layout.app')
@section('content')

<relatorio_por_orgao_component url="{{env('APP_URL')}}"></relatorio_por_orgao_component>

@endsection