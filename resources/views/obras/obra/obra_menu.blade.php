<ul class="nav nav-tabs" id="myTab" role="tablist">
  
  <li class="nav-item">
    <a href="{{url('obras/obra/'.$id.'/editar')}}" class="nav-link <?= $n=='obra'?"active":''?>">
      Obra
    </a>
  </li>

  <li class="nav-item">
    <a href="{{url('obras/obra/'.$id.'/cidade')}}" class="nav-link  <?= $n=='cidade'?"active":''?>">
      Cidades
    </a>
  </li>
  
  <li class="nav-item">
    <a href="{{url('obras/obra/'.$id.'/orgao')}}" class="nav-link  <?= $n=='orgao'?"active":''?>">
      Secretarias e Orgãos
    </a>
  </li>
  
  <!--
  <li class="nav-item">
    <a href="{{url('obras/obra/'.$id.'/aditivo')}}" class="nav-link <?= $n=='aditivo'?"active":''?>">
      Aditivos
    </a>
  </li>
  -->

  <li class="nav-item">
    <a href="{{url('obras/obra/'.$id.'/cronograma')}}" class="nav-link <?= $n=='cronograma'?"active":''?>">
      Cronograma
    </a>
  </li>

<li class="nav-item">
    <a href="{{url('obras/obra/'.$id.'/imagem')}}" class="nav-link <?= $n=='imagem'?"active":''?>">
      Imagens
    </a>
</li>

<li class="nav-item">
    <a href="{{url('obras/obra/'.$id.'/anexo')}}" class="nav-link <?= $n=='anexo'?"active":''?>">
      Anexos
    </a>
</li>


</ul>
