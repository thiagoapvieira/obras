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

                // echo $value->id;
                // echo '<br>';

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
        //edite
        if( $request->id > 0 ){

            DB::table('indicador') ->where('id', $request->id)->update([
                'nome' => $request->nome,
                'meta_agregada' => $request->meta_agregada,
                'realizado_acumulado' => $request->realizado_acumulado,
                'execucao_agregada' => $request->execucao_agregada,
                'status' => $request->status,
                'responsavel' => $request->responsavel,
            ]);

            foreach ($request->meta as $key => $value) {            
                $indicador_meta_id = explode("_", $key);

                //dd($indicador_meta_id[2]);
                // dd($value);

                $a = DB::table('indicador_meta') ->where('id', $indicador_meta_id[2])->update([
                   'valor' => $value,
                ]);
            }

            return 'edicao';

        }

        
        //insert
        if( $request->id == 0 ){

            $n = DB::table('indicador') ->insertGetId([
                'est_id' => $request->est_id,
                'nome' => $request->nome,
                'meta_agregada' => $request->meta_agregada,
                'realizado_acumulado' => $request->realizado_acumulado,
                'execucao_agregada' => $request->execucao_agregada,
                'status' => $request->status,
                'responsavel' => $request->responsavel,
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

            return 'insert';

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

    }



    public function delete_ano_meta_indicador(Request $request){
        
        $a = DB::table('indicador_meta')->where('indicador_id',$request->indicador_id)->where('ano', $request->ano)->delete();
        
    }

    public function delete( $id ){
      DB::table('indicador')->where('id',$id)->update(['ativo'=>0]);
    }


}
