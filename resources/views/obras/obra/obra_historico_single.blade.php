@extends('layout.app')
@section('content')
<div class="page-content--bgf7">
    
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                          <h3 class="title-5">Obra histórico single</h3>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <b>commit:</b> #{{$obra->id}} <br>
                        <b>ação:</b> {{$obra->acao}} <br>
                        <b>criado em:</b> {{ dateBR($obra->created_at)}} <br>
                        <br>
                        <?php echo htmlspecialchars_decode(stripslashes($obra->texto)) ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
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

    <br>
    <br>
    <br>

</div>
@endsection
