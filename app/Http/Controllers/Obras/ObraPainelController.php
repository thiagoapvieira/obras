<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\User;

use Illuminate\Support\Facades\Log;

class ObraPainelController extends Controller
{
    public function index()
    {
		// $sql  = " select S.id, S.nome, ";
		// $sql .= " (select count(O.id) from obra O where O.setor_id = S.id) as qtd ";
		// $sql .= " from setor S ";
        // $rel_obra_setor = DB::select($sql);

    	// dd($rel_obra_setor);

    	// $sql = " call relatorio_obra_setor() "; DB::select($sql);

    	$sql = " select * from relatorio_obra_setor";
    	$rel_obra_setor = DB::select($sql);

    	// $sql = " call relatorio_status_fases() "; DB::select($sql);
    	$sql = " select * from relatorio_obra_status_fase order by id_status_fase ";
    	$rel_obra_status_fase = DB::select($sql);                

    	// $sql = " call relatorio_obra_cidade() "; DB::select($sql);
    	$sql = " select * from relatorio_obra_cidade ";
    	$rel_obra_cidade = DB::select($sql);

        // $sql = " call relatorio_obra_regiao() "; DB::select($sql);
        $sql = " select * from relatorio_obra_regiao ";
        $rel_obra_regiao = DB::select($sql);    	

        return view('obras.painel.painel',[
        	'rel_obra_setor'=>$rel_obra_setor,
        	'rel_obra_status_fase'=>$rel_obra_status_fase,
        	'rel_obra_cidade'=>$rel_obra_cidade,
            'rel_obra_regiao'=>$rel_obra_regiao,
        ]);
    }    

    public function consolidar_calculo(){
        $sql = " call relatorio_obra_setor() "; DB::select($sql);
        $sql = " call relatorio_status_fases() "; DB::select($sql);
        $sql = " call relatorio_obra_cidade() "; DB::select($sql);
        $sql = " call relatorio_obra_regiao() "; DB::select($sql);

        return redirect('obras/painel');
    }

}




