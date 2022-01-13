<?php
namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObraController extends Controller
{

  public function filterLimpar(){
    $filtro = [
       "codigo" => null,
       "descricao" => null,
       "regiao_id" => null,
       "cidade_id" => null,
       "orgao_id" => null,
       "projeto_id" => null,
       "tipologia_id" => null,
       "status_id" => -1,
       "dt_inicio" => null,
       "dt_conclusao_realizada" => null,
       "setor_id" => null,
       "modalidade_id" => null,
       "fonte" => null,
    ];

    session(['obra_filtro' => $filtro]);

    return redirect('obras/obra');
  }


  public function filter(Request $request){
    $filtro = [
       "codigo" => $request->codigo,
       "descricao" => $request->descricao,
       "regiao_id" => $request->regiao_id,
       "cidade_id" => $request->cidade_id,
       "orgao_id" => $request->orgao_id,
       "projeto_id" => $request->projeto_id,
       "tipologia_id" => $request->tipologia_id,
       "status_id" => $request->status_id,
       "dt_inicio" => $request->dt_inicio,
       "dt_conclusao_realizada" => $request->dt_conclusao_realizada,
       "setor_id" => $request->setor_id,
       "modalidade_id" => $request->modalidade_id,
       "fonte" => $request->fonte,
    ];

    session(['obra_filtro' => $filtro]);

    //modulo pdf - se apertou o botao imprimir
    if( $request->pdf > 0 ){
        session_start();
        $_SESSION["obra_filtro"] = $filtro;

        return redirect( getenv('APP_URL').'pdf/examples/lista.php');
    }

    //modulo de excel
    if( $request->excel > 0 ){
        return redirect('obras/obra/excel');
    }

    return redirect('obras/obra');
  }


  public function obra(){

    $filtro = session()->get('obra_filtro');

    $cidade = DB::table('cidade')->orderBy('nome')->get();
    $orgao = DB::table('orgao')->orderBy('nome')->get();
    $projeto = DB::table('projeto')->orderBy('nome')->get();
    $regiao = DB::table('regiao')->orderBy('nome')->get();
    $tipologia = DB::table('tipologia')->orderBy('nome')->orderBy('nome')->get();
    $setor = DB::table('setor')->orderBy('nome')->get();
    $modalidade = DB::table('modalidade')->orderBy('nome')->get();
    // $obras = DB::table('obra_view')->where('descricao', 'like', '%'.$filtro['descricao'].'%')->get();

    //filtro cidades
    $c = '';
    if( isset($filtro['cidade_id'])) {
      if($filtro['cidade_id'] > 0){
        $c = 'and cidade_id = '.$filtro['cidade_id'];
      }
    }

    $query = DB::table('obra');

    $query->select(
      'obra.id',
      'obra.tipologia_id',
      'obra.descricao',
      'obra.local',
      'obra.valor_inicial',
      'obra.valor_investido',
      'obra.fonte',
      'obra.dt_inicio',
      'obra.dt_conclusao_realizada',
      'obra.prazo_entrega',
      'obra.percentual',
      'obra.status',
      'obra.created_at',
      'obra.updated_at',
      'obra.obs',
      'obra.paralisacao',
      'obra.percentual_execucao_financeira',
      'obra.percentual_execucao_fisica',
      'obra.status_fases',
      'obra.prioritaria',
      'obra.setor_id',
      'obra.modalidade_id',
      'tipologia.nome as tipologia_nome',

      (DB::raw("(select sum(valor) from obra_valor where obra_id = obra.id) as valor_total"))
    );

    $query->leftJoin('tipologia', 'obra.tipologia_id', '=', 'tipologia.id');

    $query->leftJoin('obra_cidade', 'obra_cidade.obra_id', '=', 'obra.id');

    $query->leftJoin('cidade', 'cidade.id', '=', 'obra_cidade.cidade_id');

    $query->leftJoin('obra_orgao', 'obra_orgao.obra_id', '=', 'obra.id');

    $query->leftJoin('orgao', 'orgao.id', '=', 'obra_orgao.orgao_id');

    $query->leftJoin('projeto', 'projeto.id', '=', 'obra.projeto_id');

    $query->leftJoin('regiao', 'regiao.id', '=', 'cidade.regiao_id');

    $query->where('status','>=',0);
    $query->where('status','<>',99); //rascunho


    if( isset($filtro['codigo'])) {
      if($filtro['codigo'] <> null and $filtro['codigo'] <> null){
           $query->where('obra.id', 'like', '%'.$filtro['codigo'].'%');
      }
    }

    $obras = $query->paginate(50);



    if( isset($filtro['descricao'])) {
      if($filtro['descricao'] <> null and $filtro['descricao'] <> null){
          $query->where('descricao', 'like', '%'.$filtro['descricao'].'%');
      }
    }

    if( isset($filtro['fonte'])) {
      if($filtro['fonte'] <> null and $filtro['fonte'] <> null){
          $query->where('fonte', 'like', '%'.$filtro['fonte'].'%');
      }
    }

    //regiao
    if( isset($filtro['regiao_id'])) {
      if($filtro['regiao_id'] > 0){
        $query->where('regiao.id',$filtro['regiao_id']);
      }
    }

    //cidade
    if( isset($filtro['cidade_id'])) {
      if($filtro['cidade_id'] > 0){
        $query->where('cidade.id',$filtro['cidade_id']);
      }
    }

    //orgao
    if( isset($filtro['orgao_id'])) {
      if($filtro['orgao_id'] > 0){
        $query->where('orgao.id',$filtro['orgao_id']);
      }
    }

    //projeto
    if( isset($filtro['projeto_id'])) {
      if($filtro['projeto_id'] > 0){
        $query->where('projeto.id',$filtro['projeto_id']);
      }
    }

    //tipologia
    if( isset($filtro['tipologia_id'])) {
      if($filtro['tipologia_id'] > 0){
        $query->where('tipologia.id',$filtro['tipologia_id']);
      }
    }

    //setor
    if( isset($filtro['setor_id'])) {
      if($filtro['setor_id'] > 0){
        $query->where('setor_id',$filtro['setor_id']);
      }
    }

    //setor
    if( isset($filtro['modalidade_id'])) {
      if($filtro['modalidade_id'] > 0){
        $query->where('modalidade_id',$filtro['modalidade_id']);
      }
    }

    //status
    if( isset($filtro['status_id'])) {
      if($filtro['status_id'] >= 0){
        $query->where('obra.status_fases',$filtro['status_id']);
      }
    }

    //ajuste o formato data e hora
    if( isset($filtro['dt_inicio']) and $filtro['dt_inicio'] <> null){
      $arrayData = explode("/",$filtro['dt_inicio']);
      $date = date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
      $data_inicio = date_format($date,"Y-m-d");
    }

    if( isset($filtro['dt_conclusao_realizada']) and ($filtro['dt_conclusao_realizada'] <> null or $filtro['dt_conclusao_realizada'] <> '') ){
      $arrayData = explode("/",$filtro['dt_conclusao_realizada']);
      $date = date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
      $data_fim = date_format($date,"Y-m-d");
    }

    //periodo
    if( isset($filtro['dt_inicio']) and isset($filtro['dt_conclusao_realizada']) ) {
      if($filtro['dt_inicio'] != '' and $filtro['dt_conclusao_realizada'] != ''){
        $query->whereBetween('obra.dt_inicio', [$data_inicio, $data_fim]);
      }
    }


    $query->groupBy(
      'obra.id',
      'obra.tipologia_id',
      'obra.descricao',
      'obra.local',
      'obra.valor_inicial',
      'obra.valor_investido',
      'obra.fonte',
      'obra.dt_inicio',
      'obra.dt_conclusao_realizada',
      'obra.prazo_entrega',
      'obra.percentual',
      'obra.status',
      'obra.created_at',
      'obra.updated_at',
      'obra.obs',
      'obra.paralisacao',
      'tipologia.nome'
      );

      $query->orderBy('obra.prioritaria', 'desc');

      $query->orderBy('valor_total', 'desc');

      $obras = $query->paginate(50);

      // $obras = $query->get();
      // $i=0;
      // foreach ($obras as $key => $value) {
      //   echo $i . ' ' . $value->id . ' ' . $value->descricao;
      //   echo '<br>';
      //   $i++;
      // }

      // dd($obras);

      $numero_registro = $obras->total();


      //estatisticas
      $em_andamento = DB::table('obra')->where('status', '=', 1)->count();
      $paralisado = DB::table('obra')->where('status', '=', 2)->count();
      $finalizado = DB::table('obra')->where('status', '=', 3)->count();
      $entregue = DB::table('obra')->where('status', '=', 4)->count();
      $total = $em_andamento + $paralisado + $finalizado + $entregue;



      return view('obras.obra.obra',[
        'obra'=>$obras,
        'filtro' => $filtro,
        'setor' => $setor,
        'modalidade' => $modalidade,
        'cidade' => $cidade,
        'regiao' => $regiao,
        'orgao' => $orgao,
        'projeto' => $projeto,
        'tipologia'=>$tipologia,
        'em_andamento'=>$em_andamento,
        'paralisado'=>$paralisado,
        'finalizado'=>$finalizado,
        'entregue'=>$entregue,
        'total'=>$total,
        'numero_registro'=>$numero_registro,
      ])->with('items', $obras);
  }



    //cria um registro temporario
    public function create() {
      $n = DB::table('obra')->insertGetId(['status' => 99]);
      return redirect('obras/obra/'.$n.'/editar');
    }


    public function edit($id)
    {
      $obra = DB::table('obra')->where('id', $id)->first();
      $tipologia = DB::table('tipologia')->orderBy('nome')->get();
      $setor = DB::table('setor')->orderBy('nome')->get();
      $modalidade = DB::table('modalidade')->orderBy('nome')->get();
      $fase_licitacao = DB::table('fase_licitacao')->orderBy('nome')->get();
      $projeto = DB::table('projeto')->orderBy('nome')->get();

      return view('obras.obra.obra_frm', compact('id', 'obra', 'setor', 'modalidade', 'tipologia', 'fase_licitacao', 'projeto'));
    }


    public function update(Request $request, $id)
    {

      //verifique o antes e o depois e monte o log
      log_hitorico($request, $id);

      if($request->dt_atualizacao <> '' or $request->dt_atualizacao <> null){
        $arrayData = explode("/",$request->dt_atualizacao);
        $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
        $dt_atualizacao = date_format($date,"Y-m-d H:i:s");
      }else{
        $dt_atualizacao = null;
      }

      // //formate o valor para moeda banco (9999.99)
      $valor_inicial = str_replace(',', '.', str_replace('.', '', $request->valor_inicial));
      $valor_investido = str_replace(',', '.', str_replace('.', '', $request->valor_investido));

      if($request->dt_inicio <> '' or $request->dt_inicio <> null){
        /*ajuste o formato data e hora*/
        $arrayData = explode("/",$request->dt_inicio);
        $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
        $dt_inicio = date_format($date,"Y-m-d H:i:s");
      }else{
        $dt_inicio = null;
      }

      if($request->dt_conclusao_prevista <> '' or $request->dt_conclusao_prevista <> null){
        /*ajuste o formato data e hora*/
        $arrayData = explode("/",$request->dt_conclusao_prevista);
        $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
        $dt_conclusao_prevista = date_format($date,"Y-m-d H:i:s");
      }else{
        $dt_conclusao_prevista = null;
      }

      if($request->dt_conclusao_realizada <> '' or $request->dt_conclusao_realizada <> null){
        /*ajuste o formato data e hora*/
        $arrayData = explode("/",$request->dt_conclusao_realizada);
        $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
        $dt_conclusao_realizada = date_format($date,"Y-m-d H:i:s");
      }else{
        $dt_conclusao_realizada = null;
      }

      if($request->dt_assinatura_contrato <> '' or $request->dt_assinatura_contrato <> null){
        /*ajuste o formato data e hora*/
        $arrayData = explode("/",$request->dt_assinatura_contrato);
        $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
        $dt_assinatura_contrato = date_format($date,"Y-m-d H:i:s");
      }else{
        $dt_assinatura_contrato = null;
      }


      // dd($request->desapropriacao);

      $data = date("Y-m-d H:i:s");
      DB::table('obra') ->where('id', $id)
      ->update(
        [
         'descricao' => $request->descricao,
         'prioritaria' => $request->prioritaria,
         'dt_atualizacao' => $dt_atualizacao,
         'igesp' => $request->igesp,
         'setor_id' => $request->setor_id,
         'modalidade_id' => $request->modalidade_id,
         'tipologia_id' => $request->tipologia_id,
         'projeto_id' => $request->projeto_id,

         'percentual_execucao_financeira' => $request->percentual_execucao_financeira,

         'status_fases' => $request->status_fases,
         'inaugurada' => $request->inaugurada,
         'desapropriacao' => $request->desapropriacao,
         'licenca_ambiental_previa' => $request->licenca_ambiental_previa,
         'licenca_ambiental_instalacao' => $request->licenca_ambiental_instalacao,
         'projeto_basico' => $request->projeto_basico,
         'projeto_executivo' => $request->projeto_executivo,
         'titularidade' => $request->titularidade,

         'licenca_outros_orgaos' => $request->licenca_outros_orgaos,
         'especifique_orgaos' => $request->especifique_orgaos,
         'fase_licitacao_id' => $request->fase_licitacao,

         'dt_inicio' => $dt_inicio,
         'dt_conclusao_prevista' => $dt_conclusao_prevista,
         'dt_conclusao_realizada' => $dt_conclusao_realizada,
         'prazo_entrega' => $request->prazo_entrega,
         'percentual_execucao_fisica' => $request->percentual_execucao_fisica,
         'dt_assinatura_contrato' => $dt_assinatura_contrato,
         'obs' => $request->obs,
         'descricao_estagio' => $request->descricao_estagio,
         'descricao_pendencias_prazo' => $request->descricao_pendencias_prazo,
         'descricao_proxima_fase' => $request->descricao_proxima_fase,
         'status' => $request->status,

         'updated_at'=> $data,
         'updated_at_user'=> session()->get('userLogado')['id'],

        ]
      );

      $tipologia = DB::table('tipologia')->get();

      $obra = DB::table('obra')->where('id', $id)->first();


      //editar um campo de fonte auxiliar para consulta
      //precisei fazer isso por ser mais facil
      //pego da tabela de obra_valor o campo FONTE contacateno e monte uma string
      $obra_valor = DB::table('obra_valor')->where('obra_id', $id)->get();
      $texto = '';
      foreach ($obra_valor as $key => $value) {
         $texto .= $value->fonte;
      }
      DB::table('obra') ->where('id', $id)->update(['fonte' => $texto]);


      return redirect('obras/obra/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');
    }


    public function delete($id){
      DB::table('obra') ->where('id', $id)
      ->update(
        ['status' => -1]
      );
      return redirect('obras/obra');
    }


    /*
      cidade
    */

    public function cidade_obra($id)
    {
      $obra = DB::table('obra')->where('id', $id)->first();
      $cidade = DB::table('cidade_view')->get();

      return view('obras.obra.obra_cidade',['obra'=>$obra, 'id'=>$id, 'cidade'=>$cidade]);
    }


    /*
      obra
    */

    public function orgaos_obra($id)
    {
      $obra = DB::table('obra')->where('id', $id)->first();
      $orgao = DB::table('orgao')->get();

      return view('obras.obra.obra_orgao',['obra'=>$obra, 'id'=>$id, 'orgao'=>$orgao]);
    }


    /*
      aditivo
    */

    public function aditivo_obra($id)
    {
      $obra = DB::table('obra')->where('id', $id)->first();
      $aditivo = DB::table('obra_aditivo')->where('obra_id', $obra->id)->get();

      return view('obras.obra.obra_aditivo',['obra'=>$obra, 'id'=>$id,'aditivo'=>$aditivo]);
    }

    public function aditivo_obra_create($obra_id)
    {
      $obra = DB::table('obra')->where('id', $obra_id)->first();
      $dt_inclusao = null;
      return view('obras.obra.obra_aditivo_frm',['obra'=>$obra,'dt_inclusao'=>$dt_inclusao]);
    }

    public function aditivo_obra_save(Request $request,$obra_id)
    {
      $valor = str_replace(',', '.', str_replace('.', '', $request->valor));
      $data = date("Y-m-d H:i:s");

      $obra = DB::table('obra')->where('id', $obra_id)->first();
      $n = DB::table('obra_aditivo')->insert(
        ['obra_id' => $obra_id,
         'valor' => $valor,
         'created_at' => $data,
         'updated_at' => $data,
        ]
      );
      return redirect('obras/obra/'.$obra_id.'/aditivo');
    }


    public function aditivo_obra_edit($id, $aditivo_id)
    {
      $obra = DB::table('obra')->where('id', $id)->first();
      $aditivo = DB::table('obra_aditivo')->where('id', $aditivo_id)->first();

      $dt_inclusao = $aditivo->dt_inclusao;

      return view('obras.obra.obra_aditivo_frm',['obra'=>$obra, 'aditivo'=>$aditivo, 'dt_inclusao'=>$dt_inclusao,]);
    }


    public function aditivo_obra_update(Request $request, $obra_id, $aditivo_id)
    {

      if($request->dt_inclusao <> '' or $request->dt_inclusao <> null){
        /*ajuste o formato data e hora*/
        $arrayData = explode("/",$request->dt_inclusao);
        $date=date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
        $dt_inclusao = date_format($date,"Y-m-d H:i:s");
      }else{
        $dt_inclusao = null;
      }

      //formate o valor para moeda banco (9999.99)
      $valor = str_replace(',', '.', str_replace('.', '', $request->valor));

      $data = date("Y-m-d H:i:s");
      DB::table('obra_aditivo') ->where('id', $aditivo_id)
      ->update(
        ['valor' => $valor,
         'updated_at' => $data,
         'dt_inclusao' => $dt_inclusao,
        ]);

      return redirect('obras/obra/'.$obra_id.'/aditivo');
    }



    public function aditivo_obra_excluir($obra_id, $aditivo_id)
    {
      $obra = DB::table('obra_aditivo')->where('id', $aditivo_id)->delete();
      return redirect('obras/obra/'.$obra_id.'/aditivo');
    }


    /*
      imagem
    */

    public function imagem_obra($obra_id)
    {
      $obra = DB::table('obra')->where('id', $obra_id)->first();
      $imagem = DB::table('obra_imagem')->where('obra_id', $obra_id)->get();

      return view('obras.obra.obra_imagem',['obra'=>$obra, 'imagem'=>$imagem]);
    }



  public function view($id)
  {
    $sql  = ' select O.*, FL.nome as fase_licitacao, ';

    $sql .= ' (select nome from obra_orgao where obra_id = O.id limit 1) as principal';

    $sql .= ' from obra O ';
    $sql .= ' left join fase_licitacao FL on FL.id = O.fase_licitacao_id ';
    $sql .= ' where O.id = '.$id;
    $obra = DB::select($sql)[0];

    $sql  = " select group_concat(C.nome) as cidades FROM obra_cidade OC ";
    $sql .= " left join cidade C on C.id = OC.cidade_id ";
    $sql .= " where obra_id = ".$id;
    $cidades = DB::select($sql)[0]->cidades;

    $sql  = ' select group_concat(O.sigla) as orgaos FROM obra_orgao OO ';
    $sql .= ' left join orgao O on O.id = OO.orgao_id ';
    $sql .= ' where obra_id = '.$id;
    $orgaos = DB::select($sql);

    if($orgaos == null or $orgaos == []){
      $orgaos = 0;
    }else{
      $orgaos = DB::select($sql)[0]->orgaos;
    }

    $sql  = ' select O.sigla as orgao_principal FROM obra_orgao OO ';
    $sql .= ' left join orgao O on O.id = OO.orgao_id ';
    $sql .= ' where obra_id = '.$id;
    $sql .= ' and principal = 1';
    $orgao_principal = DB::select($sql);

    if($orgao_principal == null or $orgao_principal == []){
      $orgao_principal = 0;
    }else{
      $orgao_principal = DB::select($sql)[0]->orgao_principal;
    }

    $obra_valor = DB::table('obra_valor')->where('obra_id', $obra->id)->get();

    $total = DB::select('select sum(valor) as total from obra_valor where obra_id = '.$obra->id);
    $valor_total = $total[0]->total;

    $valor_executado = (($valor_total * $obra->percentual_execucao_financeira)/100);
    $valor_a_executar = $valor_total - $valor_executado;

    $imagem = DB::table('obra_imagem')->where('obra_id', $obra->id)->get();

    $anexo = DB::table('obra_anexo')->where('obra_id', $obra->id)->get();

    $cronograma = DB::table('obra_cronograma')->where('obra_id', $obra->id)->orderBy('index')->get();

    $setor = DB::table('setor')->where('id', $obra->setor_id)->value('nome');

    $modalidade = DB::table('modalidade')->where('id', $obra->modalidade_id)->value('nome');

    $tipologia = DB::table('tipologia')->where('id', $obra->tipologia_id)->value('nome');

    return view('obras.obra.obra_view',[
      'id'=>$id,
      'obra'=>$obra,
      'obra_valor'=>$obra_valor,
      'valor_total'=>$valor_total,
      'valor_executado'=>$valor_executado,
      'valor_a_executar'=>$valor_a_executar,
      'orgaos'=>$orgaos,
      'orgao_principal'=>$orgao_principal,
      'cidades'=>$cidades,
      'imagem'=>$imagem,
      'anexo'=>$anexo,
      'cronograma'=>$cronograma,
      'setor'=>$setor,
      'modalidade'=>$modalidade,
      'tipologia'=>$tipologia,
    ]);
  }




  public function excel(){

    $filtro = session()->get('obra_filtro');

    //filtro cidades
    $c = '';
    if( isset($filtro['cidade_id'])) {
      if($filtro['cidade_id'] > 0){
        $c = 'and cidade_id = '.$filtro['cidade_id'];
      }
    }

    $query = DB::table('obra');

    $query->select(
      'obra.id',
      'obra.descricao',
      'obra.prioritaria',
      'obra.dt_atualizacao',
      'obra.igesp',
      'obra.setor_id',
      'obra.modalidade_id',
      'obra.tipologia_id',
      'obra.percentual_execucao_financeira',
      'obra.status_fases',
      'obra.fase_licitacao_id',
      'obra.inaugurada',
      'obra.local',
      'obra.valor_inicial',
      'obra.valor_investido',
      'obra.fonte',
      'obra.percentual',
      'obra.created_at',
      'obra.updated_at',
      'obra.paralisacao',
      'obra.obracol',
      'obra.status_id',
      'obra.desapropriacao',
      'obra.licenca_ambiental_previa',
      'obra.licenca_ambiental_instalacao',
      'obra.projeto_basico',
      'obra.projeto_executivo',
      'obra.titularidade',
      'obra.licenca_outros_orgaos',
      'obra.especifique_orgaos',
      'obra.dt_inicio',
      'obra.dt_conclusao_prevista',
      'obra.dt_conclusao_realizada',
      'obra.prazo_entrega',
      'obra.percentual_execucao_fisica',
      'obra.dt_assinatura_contrato',
      'obra.obs',
      'obra.descricao_estagio',
      'obra.descricao_proxima_fase',
      'obra.descricao_pendencias_prazo',
      'obra.status',
      'tipologia.nome as tipologia',
      'setor.nome as setor',
      'modalidade.nome as modalidade',
      'fase_licitacao.nome as fase_licitacao',

      (DB::raw("(select sum(valor) from obra_valor where obra_id = obra.id) as valor_total"))
    );

    $query->leftJoin('setor', 'obra.setor_id', '=', 'setor.id');
    $query->leftJoin('modalidade', 'modalidade.id', '=', 'obra.modalidade_id');
    $query->leftJoin('fase_licitacao', 'fase_licitacao.id', '=', 'obra.fase_licitacao_id');
    $query->leftJoin('tipologia', 'obra.tipologia_id', '=', 'tipologia.id');
    $query->leftJoin('obra_cidade', 'obra_cidade.obra_id', '=', 'obra.id');
    $query->leftJoin('cidade', 'cidade.id', '=', 'obra_cidade.cidade_id');
    $query->leftJoin('regiao', 'regiao.id', '=', 'cidade.regiao_id');

    $query->where('status','>=',0);
    $query->where('status','<>',99);

    if( isset($filtro['descricao'])) {
      if($filtro['descricao'] <> null and $filtro['descricao'] <> null){
          $query->where('descricao', 'like', '%'.$filtro['descricao'].'%');
      }
    }

    //regiao
    if( isset($filtro['regiao_id'])) {
      if($filtro['regiao_id'] > 0){
        $query->where('regiao.id',$filtro['regiao_id']);
      }
    }

    //cidade
    if( isset($filtro['cidade_id'])) {
      if($filtro['cidade_id'] > 0){
        $query->where('cidade.id',$filtro['cidade_id']);
      }
    }

    //tipologia
    if( isset($filtro['tipologia_id'])) {
      if($filtro['tipologia_id'] > 0){
        $query->where('tipologia.id',$filtro['tipologia_id']);
      }
    }

    //status
    if( isset($filtro['status_id'])) {
      if($filtro['status_id'] > 0){
        $query->where('obra.status_fases',$filtro['status_id']);
      }
    }

    /*ajuste o formato data e hora*/
    if( isset($filtro['dt_inicio']) and $filtro['dt_inicio'] <> null){
      $arrayData = explode("/",$filtro['dt_inicio']);
      $date = date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
      $data_inicio = date_format($date,"Y-m-d");
    }

    if( isset($filtro['dt_conclusao_realizada']) and ($filtro['dt_conclusao_realizada'] <> null or $filtro['dt_conclusao_realizada'] <> '') ){
      $arrayData = explode("/",$filtro['dt_conclusao_realizada']);
      $date = date_create($arrayData[2].'-'.$arrayData[1].'-'.$arrayData[0]);
      $data_fim = date_format($date,"Y-m-d");
    }

    //periodo
    if( isset($filtro['dt_inicio']) and isset($filtro['dt_conclusao_realizada']) ) {
      if($filtro['dt_inicio'] != '' and $filtro['dt_conclusao_realizada'] != ''){
        $query->whereBetween('obra.dt_inicio', [$data_inicio, $data_fim]);
      }
    }


    $query->groupBy(
      'obra.id',
      'obra.tipologia_id',
      'obra.descricao',
      'obra.local',
      'obra.valor_inicial',
      'obra.valor_investido',
      'obra.fonte',
      'obra.dt_inicio',
      'obra.dt_conclusao_realizada',
      'obra.prazo_entrega',
      'obra.percentual',
      'obra.status',
      'obra.created_at',
      'obra.updated_at',
      'obra.obs',
      'obra.paralisacao',
      'tipologia.nome'
      );

      $query->orderBy('obra.id','desc');
      $obras = $query->get();



      /*EXCEL *************************************/
      $html  = "<table>";
      $html .= "<th>";
      $html .= "<thead>";
      $html .= "<tr>";
      $html .= " <th>Codigo</th>";
      $html .= " <th>Descricao</th>";
      $html .= " <th>Cidades</th>";
      $html .= " <th>Orgao</th>";
      $html .= " <th>Orgao principal</th>";
      $html .= " <th>Prioritaria</th>";
      $html .= " <th>Data de dt_atualizacao</th>";
      $html .= " <th>IGESP</th>";
      $html .= " <th>Setor</th>";
      $html .= " <th>Modalidade</th>";
      $html .= " <th>Tipologia</th>";
      $html .= " <th>Percentual execucao financeira</th>";
      $html .= " <th>Valor total</th>";
      $html .= " <th>Valor executado</th>";
      $html .= " <th>Valor a executar</th>";
      $html .= " <th>Status fases</th>";
      $html .= " <th>Fase da licitação</th>";


      $html .= " <th>Requer desapropriação? </th>";
      $html .= " <th>Licenca ambiental prévia?</th>";
      $html .= " <th>Licenca ambiental de instalação?</th>";
      $html .= " <th>Projeto básico? </th>";
      $html .= " <th>Projeto executivo?</th>";
      $html .= " <th>Tem titularidade?</th>";
      $html .= " <th>Licenca de outros orgãos? </th>";
      $html .= " <th>Especifique quais orgãos </th>";

      $html .= " <th>Data de inicio </th>";
      $html .= " <th>Data de conclusão prevista </th>";
      $html .= " <th>Data de conclusão realizada </th>";
      $html .= " <th>Prazo entrega (dias) </th>";
      $html .= " <th>Percentual de execução física</th>";
      $html .= " <th>Data de assinatura do contrato</th>";

      $html .= " <th>Observações</th>";
      $html .= " <th>Detalhar o estágio atual da obra</th>";
      $html .= " <th>Descrever próxima fase da obra</th>";
      $html .= " <th>Descrever as pendências (se houver) e o prazo estimado para a obra ir para a próxima fase.</th>";
      $html .= " <th>alerta de status</th>";
      $html .= "<tr>";
      $html .= "</thead>";
      $html .= "<tbody>";


      foreach ($obras as $key => $value) {

        //valor
        $total = DB::select('select sum(valor) as total from obra_valor where obra_id = '.$value->id);
        $valor_total = $total[0]->total;
        $valor_executado = (($valor_total * $value->percentual_execucao_financeira)/100);
        $valor_a_executar = $valor_total - $valor_executado;

        //bloco1
        $prioritaria = $value->prioritaria==1?'SIM':'NAO';
        $desapropriacao = caixa_cinza($value->desapropriacao);
        $licenca_ambiental_previa = caixa_cinza($value->licenca_ambiental_previa);
        $licenca_ambiental_instalacao = caixa_cinza($value->licenca_ambiental_instalacao);
        $projeto_basico = caixa_cinza($value->projeto_basico);
        $projeto_executivo = caixa_cinza($value->projeto_executivo);
        $titularidade = caixa_cinza($value->titularidade);
        $licenca_outros_orgaos = caixa_cinza($value->licenca_outros_orgaos);

        //orgaos
        $sql  = ' select group_concat(O.sigla) as orgao FROM obra_orgao OO ';
        $sql .= ' left join orgao O on O.id = OO.orgao_id ';
        $sql .= ' where obra_id = '.$value->id;
        $orgao = DB::select($sql);

        //orgao principal
        $sql  = ' select O.sigla as orgao_principal FROM obra_orgao OO ';
        $sql .= ' left join orgao O on O.id = OO.orgao_id ';
        $sql .= ' where obra_id = '.$value->id;
        $sql .= ' and principal = 1';
        $orgao_principal = DB::select($sql);

        if($orgao_principal == null or $orgao_principal == []){
          $orgao_principal = 0;
        }else{
          $orgao_principal = DB::select($sql)[0]->orgao_principal;
        }

        //cidades
        $sql  = " select group_concat(c.nome) as cidade from obra_cidade oc ";
        $sql .= " inner join cidade c on c.id = oc.cidade_id ";
        $sql .= " where  oc.obra_id = ".$value->id;
        $cidade = DB::select($sql);

        if($value->status_fases>1){
          $fase_licitacao = '';
        }else{
          $fase_licitacao = $value->fase_licitacao;
        }

        $html .="
            <tr>
                <td>".$value->id."</td>
                <td>".$value->descricao."</td>
                <td>".$cidade[0]->cidade."</td>
                <td>".$orgao[0]->orgao."</td>
                <td>".$orgao_principal."</td>
                <td>".$prioritaria."</td>
                <td>".$value->dt_atualizacao."</td>
                <td>".$value->igesp."</td>
                <td>".$value->setor."</td>
                <td>".$value->modalidade."</td>
                <td>".$value->tipologia."</td>
                <td>".$value->percentual_execucao_financeira."</td>
                <td>".$valor_total."</td>
                <td>".$valor_executado."</td>
                <td>".$valor_a_executar."</td>
                <td>".status_fases($value->status_fases)."</td>
                <td>".$fase_licitacao."</td>
                <td>".$desapropriacao."</td>
                <td>".$licenca_ambiental_previa."</td>
                <td>".$licenca_ambiental_instalacao."</td>
                <td>".$projeto_basico."</td>
                <td>".$projeto_executivo."</td>
                <td>".$titularidade."</td>
                <td>".$licenca_outros_orgaos."</td>
                <td>".$value->especifique_orgaos."</td>

                <td>".$value->dt_inicio."</td>
                <td>".$value->dt_conclusao_prevista."</td>
                <td>".$value->dt_conclusao_realizada."</td>
                <td>".$value->prazo_entrega."</td>
                <td>".$value->percentual_execucao_fisica."</td>
                <td>".$value->dt_assinatura_contrato."</td>
                <td>".$value->obs."</td>
                <td>".$value->descricao_estagio."</td>
                <td>".$value->descricao_proxima_fase."</td>
                <td>".$value->descricao_pendencias_prazo."</td>
                <td>".status($value->status)."</td>
            </tr>
        ";
      }

      $html .= "</tbody>";
      $html .= "</table>";


    //Configurações header para forçar o download
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"nome_arquivo.xls\"" );
    header ("Content-Description: PHP Generated Data" );

    echo $html;

    exit;


  }









}
