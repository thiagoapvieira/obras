<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class ObraAnexoController extends Controller
{
    public function obra_anexo($obra_id)
    {
        $anexo = DB::table('obra_anexo')->where('obra_id', $obra_id)->get();

        $obra = DB::table('obra')->where('id', $obra_id)->first();
        
        return view('obras.obra.obra_anexo',['id'=>$obra->id, 'obra'=>$obra, 'anexo'=>$anexo]); 
    }


    public function anexo_upload(Request $request, $obra_id)
    {
        $url = 'uploads/anexo/';

        foreach ($request->arquivo as $file) {

          //crie o registro na anexo
          $anexo_id = DB::table('obra_anexo')->insertGetId(['obra_id' => $request->obra_id ]);
          $pasta = $anexo_id;          

          //salve o arquivo
          $n = md5(uniqid(rand(),true));
          $ext = $file->getClientOriginalExtension();
          $file->storeAs($url.'/'.$pasta, $n.'.'.$ext, 'pictures');
          // $file->storeAs($url.'/1', $n.'.'.$ext, 'pictures');

          echo $arquivo = $n.'.'.$ext;

          //coloque o registro do nome da anexo no banco
          DB::table('obra_anexo') ->where('id', $anexo_id)
          ->update([
            'descricao' => $request->descricao,
            'filename' => $n.'.'.$ext
          ]);
        }

        //retorne para a pagina        
        return redirect('obras/obra/'.$obra_id.'/anexo');
    }


    public function anexo_delete(Request $request, $obra_id, $obra_anexo_id)
    {
      $ok = DB::table('obra_anexo')->where('id',$obra_anexo_id)->delete();

      $dir = public_path('/uploads/anexo/'.$obra_anexo_id);
      $files = array_diff(scandir($dir), array('.','..'));
      foreach ($files as $file) {
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
      }
      rmdir($dir);

      return redirect('obras/obra/'.$obra_id.'/anexo')->with('msg', 'Registro excluido com sucesso!');
    }

    
    

}