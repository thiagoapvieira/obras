@extends('layout.app')
@section('content')
<div class="page-content--bgf7">

    <section class="p-t-20">
    <div class="container">
    <div class="row">
    <div class="col-md-12" >

        <br><br><br>
        <div class="row">
            <div class="col-md-6">
             <a href="{{url('obras/painel')}}" class="btn btn-secondary btn-lg btn-block">Obras</a>
            </div>
            <div class="col-md-6">
             <a href="{{url('planejamento/inicio')}}" class="btn btn-primary btn-lg btn-block">Planejamento</a>
            </div>
        </div>
        <br><br><br><br>

    </div>    
    </div>    
    </div>    
    </section>

</div>
@endsection