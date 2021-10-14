@extends('obras.layout.app')
@section('content')
<div class="page-content--bgf7">

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">

          @isset($id)
           <?php $n = 'imagem'; ?>
           @include('obras.obra.obra_menu')
          @endisset

        	<div class="tab-content pl-3 p-1" id="myTabContent">
        	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
              <br> <h5>Obra: {{$obra->descricao}}</h5> <br>

              <!-- <a href="{{url('/obra/'.$obra->id.'/imagem/novo')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>Novo
              </a>
              <br>
              <br> -->

              <div class="row">                  
                  <div class="col col-md-10">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                <th width="2%">#</th>
                                <th width="10%">imagem</th>                                
                                <th width="10%">Descrição</th>                                
                                <th width="20%"></th>
                              </tr>
                          </thead>
                          <tbody>                                
                              @foreach($imagem as $value)                              
                              <tr>
                                  <td>{{$value->id}}</td>
                                  <td><img src="{{env('APP_URL').'/uploads/imagem/'.$value->id.'/'.$value->filename}}" class="img-fluid"></td> 
                                  <td>{{$value->descricao}}</td>
                                  <td>
                                    <div class="table-data-feature">                                                                     
                                    <a href="{{url('obras/obra/'.$obra->id.'/imagem/'.$value->id.'/delete')}}" class="item" data-toggle="tooltip" data-placement="top" title="Excluir">
                                      <i class="zmdi zmdi-delete"></i>
                                    </a> 
                                    </div>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>                  
                  </div>
              </div>

              <br>
              <br>
              <div class="row">                  
              <div class="col col-md-10">
                    <form role="form" action="" method="post" enctype="multipart/form-data">        
                    {{ csrf_field() }}  
                      <div class="box-body">
                        <div class="form-group">
                          <label for="descricao" class="control-label">Descrição</label>
                          <input id="descricao" name="descricao" type="text" class="form-control" aria-required="true" aria-invalid="false">
                        </div>
                        <br>
                        
                        <div class="form-group">
                          <label for="arquivo">Imagem</label>
                          <input multiple="multiple" name="arquivo[]" type="file">                          
                        </div>
                      </div>          

                      <div class="box-footer">
                        <input type="hidden" name="obra_id"  value="{{$obra->id}}">
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </div>
                    </form>
              </div>
              </div>


        	</div>        		
        	</div>

        </div>
        </div>
    </div>
    </section>

</div>
@endsection
