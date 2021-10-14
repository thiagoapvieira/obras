@extends('layout.app')
@section('content')
<div class="page-content--bgf7">

    @if (session('success'))
    <div class="alert alert-success"> {{ session('success') }} </div>
    @endif

    @if (session('danger'))
    <div class="alert alert-danger"> {{ session('danger') }} </div>
    @endif

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-6">

          @isset($id)
           <?php $n = 'aditivo'; ?>
           @include('obra.obra_menu')
          @endisset

          <div class="tab-content pl-3 p-1" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              
              <br> <h5>Obra: {{$obra->descricao}}</h5> <br>
              <br>

              <?php 
              if (isset($aditivo->valor)){
                  //formate para modeda(9.999,99)
                  $valor = number_format($aditivo->valor,2,",",".");
              }
              
              // var_dump($aditivo->dt_inclusao); exit;

              if (isset($aditivo->dt_inclusao)){
                  $date = date_create($aditivo->dt_inclusao);                      
                  $dt_inclusao = date_format($date,"d/m/Y");                  
                }else{
                  echo $dt_inclusao = '';                  
              }              
              ?>

              <form action="" method="post" novalidate="novalidate">
              {{ csrf_field() }}
                  <div class="row form-group">
                    <div class="col-6 col-md-6">
                      <label for="valor" class="control-label mb-1">Valor</label>
                      <input id="valor" name="valor" type="text" class="form-control" aria-required="true" aria-invalid="false" 
                      onKeyPress="return(moeda(this,'.',',',event))" value="<?= isset($aditivo->valor)?$valor:'' ?>">
                    </div>  
                    <div class="col-6 col-md-6">
                      <label for="dt_inclusao" class="control-label mb-1">Data</label>
                      <input id="dt_inclusao" name="dt_inclusao" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?= $dt_inclusao?>"> 
                    </div>
                  </div>
                  
                  <br>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{url('obra/'.$obra->id.'/aditivo')}}" class="btn btn-danger">Voltar</a>
                  </div>
              </form>

            </div>            
          </div>

        </div>
        </div>
    </div>
    </section>

</div>


<script language="javascript">  

function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}
</script>

@endsection
