<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class ObraHistoricoController extends Controller
{

  public function index($obra_id){

    $obra = DB::table('obra_historico')->where('obra_id',$obra_id)->orderBy('id','desc')->get();
    
    return view('obras/obra/obra_historico',['obra_id'=>$obra_id, 'obra'=>$obra]);
  }


  public function single($obra_id,$id){

    $obra = DB::table('obra_historico')->where('id',$id)->first();    
    
    return view('obras/obra/obra_historico_single',['obra_id'=>$obra_id, 'obra'=>$obra]);
  }









}
