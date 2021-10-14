<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller; 
 
class ObjetivoController extends Controller 
{ 
 
	public function limpar() 
	{ 
		$filtro = session()->get('objetivo_filtro');  

		$filtro = [ 
			"pesq" => null,
		];

		session(['objetivo_filtro' => $filtro]); 

		return redirect('objetivo'); 
	}


	public function filter(Request $request)
	{ 
		$filtro = [
			'pesq' => $request->pesq, 
		]; 

		session(['objetivo_filtro' => $filtro]);

		return redirect('objetivo');
	} 


	public function index()
	{
		$filtro = session()->get('objetivo_filtro');
		if($filtro == null){ return redirect('objetivo\limpar'); } 

		$query = DB::table('objetivo');
	
		if( isset($filtro['pesq'])) {
			if($filtro['pesq'] <> 'null'){
				$query->where('nome', 'like', '%'.$filtro['pesq'].'%');
			}
		}

		$query->orderBy('id', 'desc');

		$objetivo = $query->paginate(15);

		return view('objetivo.objetivo', compact('objetivo') );
	}


	public function create()
	{
		return view('objetivo.objetivo_frm');
	}


	public function save(Request $request)
	{
		$n = DB::table('objetivo')->insertGetId([
          'nome' => $request->nome, 
          'per_id' => $request->per_id, 
		]);

		return redirect('objetivo')->with('msg', 'Registro salvo com sucesso!');
	}


	public function edit($id)
	{
		$objetivo = DB::table('objetivo')->where('id',$id)->first();

		return view('objetivo.objetivo_frm', ['id' =>$id ,'objetivo' =>$objetivo]);
	}


	public function update(Request $request, $id)
	{
		$n = DB::table('objetivo')->where('id', $id)->update([
          'nome' => $request->nome, 
          'per_id' => $request->per_id, 
		]);

		return redirect('objetivo/'.$id.'/editar')->with('msg', 'Registro salvo com sucesso!'); 
	}


	public function delete($id)
	{
		DB::table('objetivo')->where('id', $id)->delete();

		return redirect('objetivo');
	}


 
} 
