<?php
namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;

class TipologiaController extends Controller
{
    public function index()
    {
      $tipologia = DB::table('tipologia')->orderBy('nome')->get();
      return view('obras.tipologia.tipologia',['tipologia'=>$tipologia]);
    }

    public function create()
    {
      $tipologia = DB::table('tipologia')->get();
      return view('obras.tipologia.tipologia_frm',['tipologia'=>$tipologia]);
    }

    public function save(Request $request)
    {
      $n = DB::table('tipologia')->insertGetId(
        ['nome' => $request->nome, ]
      );       

      return redirect('obras/tipologia/')->with('msg', 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {      
      $tipologia = DB::table('tipologia')->where('id', $id)->first();      

      return view('obras.tipologia.tipologia_frm',['tipologia'=>$tipologia]);      
    }

    public function update(Request $request, $id)
    {
      DB::table('tipologia') ->where('id', $id)
      ->update(
        ['nome' => $request->nome, ]
      );

      return redirect('obras/tipologia/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!');      
    }

    public function delete($id){
      DB::table('tipologia')->where('id', $id)->delete();
      
      return redirect('obras/tipologia');
    }

}
