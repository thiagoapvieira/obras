<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanoController extends Controller
{
    public function index()
    {
      $plano = DB::table('plano')->where('ativo',1)->get();

      return view('planejamento.plano.plano',['plano'=>$plano]);
    }
}
