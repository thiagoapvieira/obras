<?php
namespace App\Http\Controllers\Planejamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerspectivaController extends Controller
{
    public function index()
    {      
      return view('planejamento.perspectiva.perspectiva');
    }    

}
