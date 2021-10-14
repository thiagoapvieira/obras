<?php

namespace App\Http\Controllers\Obras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Log;

class ObraImagemController extends Controller
{
    public function obra_imagem($obra_id)
    {
        $imagem = DB::table('obra_imagem')->where('obra_id', $obra_id)->get();

        $obra = DB::table('obra')->where('id', $obra_id)->first();
        
        return view('obras.obra.obra_imagem',['id'=>$obra->id, 'obra'=>$obra, 'imagem'=>$imagem]); 
    }


    public function image_upload(Request $request, $obra_id)
    {
        $url = 'uploads/imagem/';

        foreach ($request->arquivo as $file) {

          //crie o registro na imagem
          $image_id = DB::table('obra_imagem')->insertGetId(['obra_id' => $request->obra_id ]);
          $pasta = $image_id;          

          //salve o arquivo
          $n = md5(uniqid(rand(),true));
          $ext = $file->getClientOriginalExtension();
          $file->storeAs($url.'/'.$pasta, $n.'.'.$ext, 'pictures');
          // $file->storeAs($url.'/1', $n.'.'.$ext, 'pictures');

          echo $arquivo = $n.'.'.$ext;

          //coloque o registro do nome da image no banco
          DB::table('obra_imagem') ->where('id', $image_id)
          ->update([
            'descricao' => $request->descricao,
            'filename' => $n.'.'.$ext
          ]);
        }

        //retorne para a pagina        
        return redirect('obras/obra/'.$obra_id.'/imagem');
    }


    public function image_delete(Request $request, $obra_id, $obra_imagem_id)
    {
      $ok = DB::table('obra_imagem')->where('id',$obra_imagem_id)->delete();

      $dir = public_path('/uploads/imagem/'.$obra_imagem_id);
      $files = array_diff(scandir($dir), array('.','..'));
      foreach ($files as $file) {
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
      }
      rmdir($dir);

      return redirect('obras/obra/'.$obra_id.'/imagem')->with('msg', 'Registro excluido com sucesso!');
    }

    
    

}