<?php

namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index_por_orgao()
    {
        return view('planejamento.relatorio.por_orgao');
    }

    public function get_objetivo_por_orgao()
    {
        dd('asdad');
    }

}



