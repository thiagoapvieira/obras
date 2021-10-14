@extends('obras.layout.app')
@section('content')
<div class="page-content--bgf7">

    <section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">

          @isset($id)
           <?php $n = 'anexo'; ?>
           @include('obras.obra.obra_menu')
          @endisset

        	<div class="tab-content pl-3 p-1" id="myTabContent">
        	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
              <br> <h5>Obra: {{$obra->descricao}}</h5> <br>

              <!-- <a href="{{url('/obra/'.$obra->id.'/anexo/novo')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
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
                                <th>anexo</th>
                                <th></th>
                              </tr>
                          </thead>
                          <tbody>                                
                              @foreach($anexo as $value)                              
                              <tr>
                                  <td>{{$value->id}}</td>
                                  <td>
                                    <a href="{{env('APP_URL').'/uploads/anexo/'.$value->id.'/'.$value->filename}}" class="img-fluid">
                                      {{$value->descricao}} 
                                    </a>
                                  </td>
                                  <td>
                                    <p class="text-right">
                                    <div class="table-data-feature">                                                                     
                                      <a href="{{url('obras/obra/'.$obra->id.'/anexo/'.$value->id.'/delete')}}" class="item" data-toggle="tooltip" data-placement="top" title="Excluir">
                                        <i class="zmdi zmdi-delete"></i>
                                      </a> 
                                    </div>
                                    </p>
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
                          <input id="descricao" name="descricao" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        </div>
                        <br>
                        
                        <div class="form-group">
                          <label for="arquivo">anexo</label>
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
