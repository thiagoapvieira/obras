<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndicadorController extends Controller
{
    public function find( $id )
    {
        $indicador = DB::table('indicador')->where('id',$id)->get();

        // dd($indicador);

        $array_ind = array();
        foreach ($indicador as $value) {
            $obj = new \stdClass();
            $obj->id = $value->id;
            $obj->est_id = $value->est_id;
            $obj->nome = $value->nome;
            $obj->meta_agregada = $value->meta_agregada;
            $obj->realizado_acumulado = $value->realizado_acumulado;
            $obj->execucao_agregada = $value->execucao_agregada;
            $obj->status = $value->status;
            $obj->responsavel = $value->responsavel;
            $obj->ativo = $value->ativo;
            $obj->complexidade = $value->complexidade;
            $obj->utilizacao_recurso_finan = $value->utilizacao_recurso_finan;
            $obj->capacidade_transformacao = $value->capacidade_transformacao;
            $obj->soma_peso = $value->soma_peso;

                $meta = DB::table('indicador_meta')->where('indicador_id',$value->id)->get();
                $array_meta = array();
                foreach ($meta as $value) {
                    $obj1 = new \stdClass();
                    $obj1->id = $value->id;
                    $obj1->tipo = $value->tipo;
                    $obj1->ano = $value->ano;
                    $obj1->valor = $value->valor;
                    array_push($array_meta, $obj1);
                }
                $obj->meta = $array_meta;

            array_push($array_ind, $obj);
        }

        return response()->json($array_ind);
    }


    public function save(Request $request)
    {

        // dd($request->all());

        //edite
        if( $request->id > 0 ){

            DB::table('indicador') ->where('id', $request->id)->update([
                'nome' => $request->nome,
                'meta_agregada' => $request->meta_agregada,
                'realizado_acumulado' => $request->realizado_acumulado,
                'execucao_agregada' => $request->execucao_agregada,
                'status' => $request->status,
                'responsavel' => $request->responsavel,
                'complexidade' => $request->complexidade,
                'utilizacao_recurso_finan' => $request->utilizacao_recurso_finan,
                'capacidade_transformacao' => $request->capacidade_transformacao,
                'soma_peso' => $request->soma_peso,
            ]);

            foreach ($request->meta as $key => $value) {
                $indicador_meta_id = explode("_", $key);
                $a = DB::table('indicador_meta') ->where('id', $indicador_meta_id[2])->update([
                   'valor' => $value,
                ]);
            }

            return $request->id;

        }


        //insert
        if( $request->id == 0 ){

            $n = DB::table('indicador') ->insertGetId([
                'est_id' => $request->est_id,
                'nome' => $request->nome,
                // 'meta_agregada' => $request->meta_agregada,
                // 'realizado_acumulado' => $request->realizado_acumulado,
                // 'execucao_agregada' => $request->execucao_agregada,
                // 'status' => $request->status,
                // 'responsavel' => $request->responsavel,
                // 'complexidade' => $request->complexidade,
                // 'utilizacao_recurso_finan' => $request->utilizacao_recurso_finan,
                // 'capacidade' => $request->capacidade,
                // 'soma_peso' => $request->soma_peso,
            ]);

            foreach ($request->meta as $key => $value) {
                $indicador_meta_id = explode("_", $key);

                //dd($indicador_meta_id[2]);
                // dd($value);

                $a = DB::table('indicador_meta') ->inset([
                   'indicador_id' => $n,
                   'tipo' => $indicador_meta_id[0],
                   'ano' => $indicador_meta_id[1],
                   'id' => $indicador_meta_id[2],
                   'valor' => $value,
                ]);
            }

            return $n;

        }

    }



    public function inserir_novo_ano_meta_indicador(Request $request){

        // dd( $request->all() );

        $found = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano',$request->ano)->where('tipo','meta')->count();
        if($found == 0){
            $a = DB::table('indicador_meta') ->insert([
               'indicador_id' => $request->indicador_id,
               'tipo' => 'meta',
               'ano' => $request->ano,
            ]);

        }

        $found = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano',$request->ano)->where('tipo','realizado')->count();
        if($found == 0){
            $a = DB::table('indicador_meta') ->insert([
               'indicador_id' => $request->indicador_id,
               'tipo' => "realizado",
               'ano' => $request->ano,
            ]);
        }

        $found = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano',$request->ano)->where('tipo','situacao')->count();
        if($found == 0){
            $a = DB::table('indicador_meta')->insert([
               'indicador_id' => $request->indicador_id,
               'tipo' => "situacao",
               'ano' => $request->ano,
            ]);
        }

        $found = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano',$request->ano)->where('tipo','nota')->count();
        if($found == 0){
            $a = DB::table('indicador_meta')->insert([
               'indicador_id' => $request->indicador_id,
               'tipo' => "nota",
               'ano' => $request->ano,
            ]);
        }

        $found = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano',$request->ano)->where('tipo','ponderada')->count();
        if($found == 0){
            $a = DB::table('indicador_meta')->insert([
               'indicador_id' => $request->indicador_id,
               'tipo' => "ponderada",
               'ano' => $request->ano,
            ]);
        }

        $found = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano',$request->ano)->where('tipo','problema')->count();
        if($found == 0){
            $a = DB::table('indicador_meta')->insert([
               'indicador_id' => $request->indicador_id,
               'tipo' => "problema",
               'ano' => $request->ano,
            ]);
        }

    }



    public function delete_ano_meta_indicador(Request $request)
    {
        $a = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano', $request->ano)->delete();
    }


    public function delete( $id ){

      DB::table('indicador')->where('id',$id)->update(['ativo'=>0]);

    }


    public function incluir_responsavel(Request $request){

        $n = DB::table('indicador_responsavel')
        ->where('indicador_id',$request->indicador_id)
        ->where('orgao_id',$request->orgao_id)
        ->count();

        if($n == 0){
            $n = DB::table('indicador_responsavel')->insert([
            'indicador_id' => $request->indicador_id,
            'orgao_id' => $request->orgao_id,
            ]);
        }else{
            $n = DB::table('indicador_responsavel')
            ->where('indicador_id',$request->indicador_id)
            ->where('orgao_id',$request->orgao_id)
            ->delete();
        }

        $n = DB::table('indicador_responsavel')
        ->where('indicador_id',$request->indicador_id)
        ->get();

        return response()->json($n);
    }


    public function responsavel_all($indicador_id){

        $n = DB::table('indicador_responsavel_view')
        ->where('indicador_id',$indicador_id)
        ->get();

        $texto = "";
        foreach ($n as $value) {
            $texto = $texto . $value->sigla . ", ";
        }

        return $texto;

    }


}
