<?php

namespace App\Http\Controllers\WebService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class WebServiceController extends Controller
{

    public function filter_post(Request $request)
    {
      // dd($request->all());

      $sql  = " select o.* from obra o ";
      $sql .= " inner join obra_orgao oo on oo.obra_id = o.id ";
      $sql .= " where 1 = 1 ";      
      //$sql .= " and oo.orgao_id = 39 "; //orgao SEDURBS

      if( isset($request->descricao) and $request->descricao <> null and $request->descricao <> ''){
        $sql .= " and (o.descricao like '%".$request->descricao."%' or o.obs like '%".$request->descricao."%') ";
      }

      if( isset($request->dt_inicio) and $request->dt_inicio <> null and $request->dt_inicio <> ''){        
        $sql .= " and dt_inicio >= '".$request->dt_inicio.' 00:00:00'."' and dt_inicio <= '".$request->dt_fim.' 00:00:00'."' ";
        //$sql .= " and dt_inicio = '".$request->dt_inicio."'";
      }

      $sql .= " order by o.id desc ";

      $size = 10;
      $data = DB::select($sql);
      $collect = collect($data);

      //paginação customizada
      if(isset(request()->all()['page'])){
          if(request()->all()['page'] == null){
              $page = 1;
          }else{
              $page = request()->all()['page'];
          }
      }else{
          $page = 1;
      }

      $obras = new LengthAwarePaginator(
          $collect->forPage($page, $size),
          $collect->count(),
          $size
      );
      
      $obras = $obras->toArray();

      $a = array();
      foreach ($obras['data'] as $value){
          $obj = new \stdClass();
          $obj->id = $value->id;
          $obj->descricao = $value->descricao;            
          $obj->prioritaria = $value->prioritaria==1?"Sim":"Não";
          $obj->dt_atualizacao = $value->dt_atualizacao;
          $obj->igesp = $value->igesp;
          $obj->setor = setor($value->setor_id);
          $obj->modalidade = modalidade($value->modalidade_id);
          $obj->tipologia = tipologia($value->tipologia_id);
          $obj->percentual_execucao_financeira = $value->percentual_execucao_financeira;
          $obj->status_fases = status_fases($value->status_fases);
          $obj->fase_licitacao = fase_licitacao($value->fase_licitacao_id);
          $obj->inaugurada = $value->inaugurada;
          $obj->local = $value->local;
          $obj->valor_inicial = $value->valor_inicial;
          $obj->valor_investido = $value->valor_investido;
          $obj->fonte = $value->fonte;
          $obj->percentual = $value->percentual;
          $obj->paralisacao = $value->paralisacao;
          $obj->obracol = $value->obracol;
          $obj->status = status($value->status_id);
          $obj->desapropriacao = $value->desapropriacao;
          $obj->licenca_ambiental_previa = $value->licenca_ambiental_previa;
          $obj->licenca_ambiental_instalacao = $value->licenca_ambiental_instalacao;
          $obj->projeto_basico = $value->projeto_basico;
          $obj->projeto_executivo = $value->projeto_executivo;
          $obj->titularidade = $value->titularidade;
          $obj->licenca_outros_orgaos = $value->licenca_outros_orgaos;
          $obj->especifique_orgaos = $value->especifique_orgaos;
          $obj->dt_inicio = $value->dt_inicio;
          $obj->dt_conclusao_prevista = $value->dt_conclusao_prevista;
          $obj->dt_conclusao_realizada = $value->dt_conclusao_realizada;
          $obj->prazo_entrega = $value->prazo_entrega;
          $obj->percentual_execucao_fisica = $value->percentual_execucao_fisica;
          $obj->dt_assinatura_contrato = $value->dt_assinatura_contrato;
          $obj->obs = $value->obs;
          $obj->descricao_estagio = $value->descricao_estagio;
          $obj->descricao_proxima_fase = $value->descricao_proxima_fase;
          $obj->descricao_pendencias_prazo = $value->descricao_pendencias_prazo;
          $obj->status = status($value->status);
          $obj->created_at = $value->created_at;
          $obj->updated_at = $value->updated_at;
          $obj->updated_at_user = $value->updated_at_user;
          $obj->projeto = projeto($value->projeto_id);

          // //CIDADES
          $sql  = " select c.nome from obra_cidade oc ";
          $sql .= " inner join cidade c on c.id = oc.cidade_id ";
          $sql .= " where oc.obra_id = ". $obj->id;
          $obra_cidade = DB::select($sql);
          $b = array();
          foreach ($obra_cidade as $key => $value) {
              $obj1 = new \stdClass();
              $obj1->nome = $value->nome;
              array_push($b, $obj1);
          }
          $obj->cidades = $b;

          // //ORGAOS RESPONSAVEIS
          $sql  = " select o.sigla, o.nome from obra_orgao oo ";
          $sql .= " inner join orgao o on o.id = oo.orgao_id ";
          $sql .= " where oo.obra_id = ". $obj->id;
          $obra_orgao = DB::select($sql);
          $b = array();
          foreach ($obra_orgao as $key => $value) {
              $obj1 = new \stdClass();
              $obj1->sigla = $value->sigla;
              $obj1->nome = $value->nome;
              array_push($b, $obj1);
          }
          $obj->orgaos_responsaveis = $b;

          // //FONTE DE RECURSOS
          $sql  = " select fonte, valor from obra_valor ";
          $sql .= " where obra_id = ". $obj->id;
          $obra_valor = DB::select($sql);
          $b = array();
          foreach ($obra_valor as $key => $value) {
              $obj2 = new \stdClass();
              $obj2->fonte = $value->fonte;
              $obj2->valor = $value->valor;
              array_push($b, $obj2);
          }
          $obj->fonte_de_recusrso = $b;

          array_push($a, $obj);
      }

      $obj_paginacao = new \stdClass();          
      $obj_paginacao->current_page = $obras['current_page'];
      $obj_paginacao->first_page_url = $obras['first_page_url'];
      $obj_paginacao->last_page_url = $obras['last_page_url'];          
      //$obj_paginacao->total = $obras['total'];
      $obj_paginacao->last_page = $obras['last_page'];

      $obj_aux = new \stdClass();
      $obj_aux->data = $a;
      $obj_aux->paginacao = $obj_paginacao;      

      return response()->json($obj_aux);
    }



    public function filter_get(Request $request, $pesq)
    {
      $sql  = " select o.* from obra o ";
      $sql .= " inner join obra_orgao oo on oo.obra_id = o.id ";
      $sql .= " where 1 = 1 ";
      $sql .= " and oo.orgao_id = 39 ";
      $sql .= " and (o.descricao like '%".$pesq."%' or o.obs like '%".$pesq."%') ";
      $sql .= " order by o.id desc ";

      $size = 1;
      $data = DB::select($sql);
      $collect = collect($data);

      //paginação customizada
      if(isset(request()->all()['page'])){
          if(request()->all()['page'] == null){
              $page = 1;
          }else{
              $page = request()->all()['page'];
          }
      }else{
          $page = 1;
      }

      $obras = new LengthAwarePaginator(
          $collect->forPage($page, $size),
          $collect->count(),
          $size
      );

      return $obras = $obras->toArray(); 

      /*
      $a = array();
      foreach ($obras['data'] as $value){
          $obj = new \stdClass();
          $obj->id = $value->id;
          $obj->descricao = $value->descricao;            
          $obj->prioritaria = $value->prioritaria==1?"Sim":"Não";
          $obj->dt_atualizacao = $value->dt_atualizacao;
          $obj->igesp = $value->igesp;
          $obj->setor = setor($value->setor_id);
          $obj->modalidade = modalidade($value->modalidade_id);
          $obj->tipologia = tipologia($value->tipologia_id);
          $obj->percentual_execucao_financeira = $value->percentual_execucao_financeira;
          $obj->status_fases = status_fases($value->status_fases);
          $obj->fase_licitacao = fase_licitacao($value->fase_licitacao_id);
          $obj->inaugurada = $value->inaugurada;
          $obj->local = $value->local;
          $obj->valor_inicial = $value->valor_inicial;
          $obj->valor_investido = $value->valor_investido;
          $obj->fonte = $value->fonte;
          $obj->percentual = $value->percentual;
          $obj->paralisacao = $value->paralisacao;
          $obj->obracol = $value->obracol;
          $obj->status = status($value->status_id);
          $obj->desapropriacao = $value->desapropriacao;
          $obj->licenca_ambiental_previa = $value->licenca_ambiental_previa;
          $obj->licenca_ambiental_instalacao = $value->licenca_ambiental_instalacao;
          $obj->projeto_basico = $value->projeto_basico;
          $obj->projeto_executivo = $value->projeto_executivo;
          $obj->titularidade = $value->titularidade;
          $obj->licenca_outros_orgaos = $value->licenca_outros_orgaos;
          $obj->especifique_orgaos = $value->especifique_orgaos;
          $obj->dt_inicio = $value->dt_inicio;
          $obj->dt_conclusao_prevista = $value->dt_conclusao_prevista;
          $obj->dt_conclusao_realizada = $value->dt_conclusao_realizada;
          $obj->prazo_entrega = $value->prazo_entrega;
          $obj->percentual_execucao_fisica = $value->percentual_execucao_fisica;
          $obj->dt_assinatura_contrato = $value->dt_assinatura_contrato;
          $obj->obs = $value->obs;
          $obj->descricao_estagio = $value->descricao_estagio;
          $obj->descricao_proxima_fase = $value->descricao_proxima_fase;
          $obj->descricao_pendencias_prazo = $value->descricao_pendencias_prazo;
          $obj->status = status($value->status);
          $obj->created_at = $value->created_at;
          $obj->updated_at = $value->updated_at;
          $obj->updated_at_user = $value->updated_at_user;
          $obj->projeto = projeto($value->projeto_id);

          //CIDADES
          $sql  = " select c.nome from obra_cidade oc ";
          $sql .= " inner join cidade c on c.id = oc.cidade_id ";
          $sql .= " where oc.obra_id = ". $obj->id;
          $obra_cidade = DB::select($sql);
          $b = array();
          foreach ($obra_cidade as $key => $value) {
              $obj1 = new \stdClass();
              $obj1->nome = $value->nome;
              array_push($b, $obj1);
          }
          $obj->cidades = $b;

          //ORGAOS RESPONSAVEIS
          $sql  = " select o.sigla, o.nome from obra_orgao oo ";
          $sql .= " inner join orgao o on o.id = oo.orgao_id ";
          $sql .= " where oo.obra_id = ". $obj->id;
          $obra_orgao = DB::select($sql);
          $b = array();
          foreach ($obra_orgao as $key => $value) {
              $obj1 = new \stdClass();
              $obj1->sigla = $value->sigla;
              $obj1->nome = $value->nome;
              array_push($b, $obj1);
          }
          $obj->orgaos_responsaveis = $b;

          //FONTE DE RECURSOS
          $sql  = " select fonte, valor from obra_valor ";
          $sql .= " where obra_id = ". $obj->id;
          $obra_valor = DB::select($sql);
          $b = array();
          foreach ($obra_valor as $key => $value) {
              $obj2 = new \stdClass();
              $obj2->fonte = $value->fonte;
              $obj2->valor = $value->valor;
              array_push($b, $obj2);
          }
          $obj->fonte_de_recusrso = $b;            

          array_push($a, $obj);
      }


      // dd($obra);

      return response()->json($a);
      */
    }

}
