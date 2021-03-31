<form method="post" method="POST" action="administrar.php?tp=Usuarios&ac=Buscar">

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
          require_once('class/Usuario.php');
          if(isset($respObj->alterar)){
            /*
            $usuario->setId($respObj->id);
            $usuario->setNome($respObj->nome);
            $usuario->setInicio($respObj->inicio);
            $usuario->setEncerramento($respObj->encerramento);
            $usuario->setAtivo($respObj->ativo);
            $usuario->setContato($respObj->contato);
            $usuario->setInscricao($respObj->inscricao);
            $usuario->carregarImagem();
            $usuario->Alterar();
            */
          }
          $usuario = new Usuario;
          $usuario->setNome($respObj->nome);
          $user = $usuario->buscarUsuarioNomeId($respObj->id);
          while ($b = $user->fetch_object()){
            $usuario->novoUsuario($b);
            echo "<tr><th scope='row'>".$usuario->getIdUser()."</th>";
            echo "<td>".$usuario->getNome()."</td>";
            echo "<td>".status($usuario->getAtivo())."</td>";
            ?>
            <td>
              <form method="post" method="POST" action="administrar.php?tp=Eventos&ac=Buscar" class="form-inline">
                <input type="hidden" name='id' value="<?=$usuario->getIdUser()?>">
                <input type="hidden" name='nome' value="<?=$usuario->getNome()?>">
                <input type="hidden" name='acao' value="alterar">
                <button type="submit" class="btn btn-primary btn-sm mb-1"><i class="icon-search"></i>Modificar</button>
              </form>
            </td></tr><?php
          }
      ?>
  </tbody>
</table>
<?php }?>
<?php 
if($respObj->acao == 'alterar'){?>
<div class="container">
    <form method="post" method="POST" action="administrar.php?tp=Usuario&ac=Buscar" enctype="multipart/form-data">
       <?php require_once('incl/FormUsuario.php'); ?>
    </form>
  </div>
<?php } ?>