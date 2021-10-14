<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Novo Valor</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
          
        <form>
        <input id="valor_id" name="valor_id" type="hidden">   
          <div class="col-12 col-md-12"> 
            <div class="row form-group">
              <label for="fonte" class="control-label mb-1">Fonte</label>
              <input id="fonte" name="fonte" type="text" class="form-control" aria-required="true" aria-invalid="false"> 
            </div>
            <div class="row form-group">
              <label for="valor" class="control-label mb-1">Valor Total</label>
              <input id="valor" name="valor" type="text" class="form-control" aria-required="true" aria-invalid="false"> 
            </div>
          </div>
        </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-success btn-sm" onclick="save_valor()" data-dismiss="modal">Salvar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
    </div>
  </div>
</div>
</div>


<script type="text/javascript">
  
  var url1 = "<?= env('APP_URL'); ?>";
  var usuario_id = "<?= session()->get('userLogado')['id']; ?>";


  function save_valor(){
    var modo = '';
    var obra_id = <?=$id?>;
    var valor_id = document.getElementById("valor_id").value;
    var fonte = document.getElementById("fonte").value;
    var valor = document.getElementById("valor").value;    

    if(valor_id > 0){
      modo = valor_id+'/update'
    }else{
      modo = 'novo';
    }

    $.ajax({
        url: url1+"api/obra/"+obra_id+"/valor/"+modo,
        method: "post",
        async: false  ,
        data: {'obra_id':obra_id, 'fonte':fonte, 'valor':valor, 'usuario_id':usuario_id},
        success: function(objeto){
          $("#fonte").val('');
          $("#valor").val('');
          liste_obra_valor();
        }
    });

  }


  // function editar_valor(id){
  //   $.ajax({
  //       url: url1+"api/obra/142/valor/"+id+"/editar",
  //       method: "post",        
  //       async: false,        
  //       success: function(objeto){
  //         document.getElementById("fonte").value = objeto[0].fonte;
  //         document.getElementById("valor").value = objeto[0].valor;
  //       }
  //   });

  // }

</script>