<?php
namespace App\Http\Controllers\Planejamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProblemaController extends Controller
{
    public function all(Request $request)
    {
        $problema = DB::table('problema')->get();

        return response()->json($problema);
    }

}



