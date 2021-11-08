<?php

namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgaoController extends Controller
{
    public function find(Request $request)
    {
        $orgao = DB::table('orgao')->get();

        return response()->json($orgao);
        
    }    

}



