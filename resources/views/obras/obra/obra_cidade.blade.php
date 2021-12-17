@extends('obras.layout.app')
@section('content')
<div class="page-content--bgf7">

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">

          @isset($id)
           <?php $n = 'cidade'; ?>
           @include('obras.obra.obra_menu')
          @endisset

        	<div class="tab-content pl-3 p-1" id="myTabContent">
        	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <br>
              <h4>{{$obra->descricao}} </h4>
              <br>

              <div class="row">
                  <div class="col col-md-6">
                      <div class="input-group">
                          <input type="text" id="pesq" name="pesq" placeholder="Pesquisar por secretaria ou orgão ..." class="form-control">
                          <div class="input-group-btn">
                              <button class="btn btn-primary" onclick="pesquisar()">Pesquisar</button>
                          </div>
                      </div>
                  </div>
              </div>
              <br>

              <div class="row">

                  <div class="col col-md-6">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th width="5%">#</th>
                                  <th>SIGLA</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody id="cidade">
                              <tr>
                                  <td>0</td>
                                  <td>TODOS</td>
                                  <td>-</td>
                                  <td>
                                    <button onclick="ObraCidadeRelacionar(0)" class="btn btn-success btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="marcar">
                                      <i class="fa fa-arrow-right"></i>
                                    </button>
                                  </td>
                              </tr>
                              @foreach ($cidade as $value)
                              <tr>
                                  <td>{{$value->id}}</td>
                                  <td>{{$value->nome}}</td>
                                  <td>{{$value->regiao}}</td>
                                  <td>
                                    <button onclick="ObraCidadeRelacionar({{$value->id}})" class="btn btn-success btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="marcar">
                                      <i class="fa fa-arrow-right"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  </div>

                  <div class="col col-md-5 offset-md-1">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th width="5%">#</th>
                                  <th>SIGLA</th>
                                  <th width="10%"></th>
                              </tr>
                          </thead>
                          <tbody id="cidade-relacionados">
                          </tbody>
                      </table>
                  </div>
                  </div>

              </div>


        	</div>
        	</div>

        </div>
        </div>
    </div>
    </section>

</div>



<script type="text/javascript">
  var url1 = "<?= env('APP_URL'); ?>";

  window.onload = function(){
    getObraCidadeRelacionados();
  }

  function pesquisar(){
    var name = document.getElementById("pesq").value;

    $.ajax({
        url: url1+"api/obras/obraCidade/filter/cidade",
        method: "post",
        data: {'name': name},
        async: true,
        success: function(objeto){
          var htmlSelect = "";
          for (var i = 0; i < objeto.length; i++) {
              htmlSelect+="<tr>";
              htmlSelect+="<td>"+objeto[i].id+"</td>";
              htmlSelect+="<td>"+objeto[i].nome+"</td>";
              htmlSelect+="<td>"+objeto[i].regiao+"</td>";
              htmlSelect+="<td><button onclick='ObraCidadeRelacionar("+objeto[i].id+")' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='marcar'> <i class='fa fa-arrow-right'></i> </button></td>";
              htmlSelect+="</tr>";
          }
          $("#cidade").html(htmlSelect);
        }
    });
  }

  function getObraCidadeRelacionados(){
      var obra_id = '<?= $obra->id ?>';

      $.ajax({
          url: url1+"api/obras/obra/"+obra_id+"/cidade_relacionados",
          method: "post",
          async: true,
          success: function(objeto){
            var htmlSelect = "";
            for (var i = 0; i < objeto.length; i++) {
                htmlSelect+="<tr>";
                htmlSelect+="<td>"+objeto[i].id+"</td>";
                htmlSelect+="<td>"+objeto[i].cidade_nome+"</td>";
                htmlSelect+="<td><a href='#' onclick='ObraCidadeExcluir("+objeto[i].id+")' class='btn btn-danger btn-sm'> <i class='fa fa-remove' aria-hidden='true'></i> </a> </td>";
                htmlSelect+="</tr>";
            }
            $("#cidade-relacionados").html(htmlSelect);
          }
      });
  }

  function ObraCidadeRelacionar(cidade_id){
      var obra_id = '<?= $obra->id ?>';

      $.ajax({
          url: url1+"api/obras/obra/"+obra_id+"/cidade/"+cidade_id+"/relacionar",
          method: "post",
          async: true,
          success: function(objeto){
            console.log('ok');
          }
      });

      getObraCidadeRelacionados();
  }

  function ObraCidadeExcluir(id){
      $.ajax({
          url: url1+"api/obras/obraCidade/"+id+"/excluir",
          method: "post",
          async: true,
          success: function(objeto){
            console.log('excluido');
          }
      });

      getObraCidadeRelacionados();
  }


</script>




@endsection
