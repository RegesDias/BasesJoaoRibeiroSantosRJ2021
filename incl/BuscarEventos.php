<form method="post" method="POST" action="administrar.php?tp=Eventos&ac=Buscar" class="form-inline">
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Nome</label>
    <input type="text" name='nome' class="form-control" id="inputPassword2" placeholder="nome">
    <input type="hidden" name='acao' value="buscar">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Buscar</button>
</form>
<?php
if($respObj->acao == "buscar"){
    require_once('class/Evento.php');
    $evento = new Evento;
    $evento->setNome($respObj->nome);
    $evento = $evento->buscarEventoNome();
    while ($b = $evento->fetch_object()){
    $e = new Evento;
    $e->novoEvento($b);
    print_p($e);
    }
}
?>