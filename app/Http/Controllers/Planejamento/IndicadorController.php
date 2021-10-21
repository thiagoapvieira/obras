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
        //dd($request->all());

        DB::table('indicador') ->where('id', $request->id)->update([
            'nome' => $request->nome,
        ]);

        foreach ($request->meta as $key => $value) {            
            $indicador_meta_id = explode("_", $key);

            //dd($indicador_meta_id[2]);
            // dd($value);

            echo $a = DB::table('indicador_meta') ->where('id', $indicador_meta_id[2])->update([
               'valor' => $value,
            ]);
        }

        return 'OK';

    }


}
