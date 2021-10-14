@extends('obras.layout.app')
@section('content')
<div class="page-content--bgf7">

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">

          @isset($id)
           <?php $n = 'orgao'; ?>
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
                                  <th>Secretaria/Orgão</th>
                                  <th></th>                                  
                              </tr>
                          </thead>
                          <tbody id="orgao">
                              @foreach ($orgao as $value)
                              <tr>
                                  <td>{{$value->id}}</td>
                                  <td>{{$value->sigla}}</td>
                                  <td>{{$value->nome}}</td>
                                  <td>
                                    <button onclick="ObraOrgaoRelacionar({{$value->id}})" class="btn btn-success btn-sm" data-toggle="tooltip" 
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
                          <tbody id="orgao-relacionados">                              
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
    getObraOrgaoRelacionados();
  }


  function pesquisar(){
    var name = document.getElementById("pesq").value;    

    $.ajax({
        url: url1+"/api/obraOrgao/filter/orgao",
        method: "post",
        data: {'name': name},
        async: true,
        success: function(objeto){
          var htmlSelect = "";          
          for (var i = 0; i < objeto.length; i++) {
              htmlSelect+="<tr>";
              htmlSelect+="<td>"+objeto[i].id+"</td>";
              htmlSelect+="<td>"+objeto[i].sigla+"</td>";              
              htmlSelect+="<td>"+objeto[i].nome+"</td>";
              htmlSelect+="<td><button onclick='ObraOrgaoRelacionar("+objeto[i].id+")' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='marcar'> <i class='fa fa-arrow-right'></i> </button></td>";
              htmlSelect+="</tr>";
          }
          $("#orgao").html(htmlSelect);
        }
    });
  }





  function getObraOrgaoRelacionados(){
      var obra_id = '<?= $obra->id ?>';

      $.ajax({
          url: url1+"api/obra/"+obra_id+"/orgao_relacionados",
          method: "post",          
          async: true,        
          success: function(objeto){
            var htmlSelect = "";
            for (var i = 0; i < objeto.length; i++) {
                htmlSelect+="<tr>";
                htmlSelect+="<td>"+objeto[i].id+"</td>";
                htmlSelect+="<td>"+objeto[i].sigla+"</td>";

                if(objeto[i].principal == 1){
                  htmlSelect+="<td><button onclick='ObraOrgaoPrincipal("+objeto[i].id+")' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='principal'> <i class='fa fa-star'></i> </button></td>";
                }else{
                  htmlSelect+="<td><button onclick='ObraOrgaoPrincipal("+objeto[i].id+")' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='principal'> <i class='fa fa-ban'></i> </button></td>";
                }

                htmlSelect+="<td><a href='#' onclick='ObraOrgaoExcluir("+objeto[i].id+")' class='btn btn-danger btn-sm'> <i class='fa fa-remove' aria-hidden='true'></i> </a> </td>";
                htmlSelect+="</tr>";
            }
            $("#orgao-relacionados").html(htmlSelect);
          }
      });
  }


  function ObraOrgaoRelacionar(orgao_id){
      var obra_id = '<?= $obra->id ?>';

      $.ajax({          
          url: url1+"api/obra/"+obra_id+"/orgao/"+orgao_id+"/relacionar",
          method: "post",
          async: true,
          success: function(objeto){
            console.log('ok');
          }
      });

      getObraOrgaoRelacionados();
  }


  function ObraOrgaoExcluir(id){
      $.ajax({          
          url: url1+"api/obraOrgao/"+id+"/excluir",
          method: "post",
          async: true,
          success: function(objeto){
            console.log('excluido');
          }
      });

      getObraOrgaoRelacionados();
  }


  function ObraOrgaoPrincipal(id){
      var obra_id = '<?= $obra->id ?>';

      $.ajax({          
          url: url1+"api/obraOrgao/"+id+"/principal",          
          method: "post",
          data:{'obra_id':obra_id},
          async: false,
          success: function(objeto){
            console.log('principal');
            getObraOrgaoRelacionados();
          }
      });

  }


</script>




@endsection
