<form method="post" method="POST" action="administrar.php?tp=Eventos&ac=Buscar">

  <div class="form-group">
    <div class="row">
      <div class="col-lg-10">
    <input type="text" name='nome' class="form-control" id="inputPassword2" placeholder="nome">
    <input type="hidden" name='acao' value="buscar">
      </div>
      <div class="col-lg-2">
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </div>
    </div>
  </div>
</form><br><br>
<?php if(isset($respObj->acao)){?>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">Nome</th>
        <th scope="col">Status</th>
        <th scope="col">Acão</th>
      </tr>
    </thead>
    <tbody>
      <?php
          require_once('class/Evento.php');
          if(isset($respObj->alterar)){
            $evento->setId($respObj->id);
            $evento->setNome($respObj->nome);
            $evento->setInicio($respObj->inicio);
            $evento->setEncerramento($respObj->encerramento);
            $evento->setAtivo($respObj->ativo);
            $evento->setContato($respObj->contato);
            $evento->setInscricao($respObj->inscricao);
            $evento->carregarImagem();
            $evento->alterar();
          }
          $evento = new Evento;
          $evento->setNome($respObj->nome);
          $eventos = $evento->buscaPorIdNome($respObj->id);
          while ($b = $eventos->fetchobject()){
            $evento->novoEvento($b);
            echo "<tr><th scope='row'>".$evento->getId()."</th>";
            echo "<td>".$evento->getNome()."</td>";
            echo "<td>".status($evento->getAtivo())."</td>";
            ?>
            <td>
              <form method="post" method="POST" action="administrar.php?tp=Eventos&ac=Buscar" class="form-inline">
                <input type="hidden" name='id' value="<?=$evento->getId()?>">
                <input type="hidden" name='nome' value="<?=$evento->getNome()?>">
                <input type="hidden" name='acao' value="alterar">
                <button type="submit" class="btn btn-primary btn-sm mb-1"><i class="icon-search"></i>Modificar</button>
              </form>
            </td></tr><?php
          }
          $aData = $eventos->fetchAll();
          $eventos->closeCursor();
      ?>
  </tbody>
</table>
<?php }?>
<?php 
if($respObj->acao == 'alterar'){?>
<div class="container">
    <form method="post" method="POST" action="administrar.php?tp=Eventos&ac=Buscar" enctype="multipart/form-data">
       <?php require_once('front/FormEventos.php'); ?>
    </form>
  </div>
<?php } ?>