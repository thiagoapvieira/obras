@extends('planejamento.layout.app')
@section('content')

<perspectiva_component url="{{env('APP_URL')}}" plano_id = {{$plano_id}} ></perspectiva_component>

@endsection
