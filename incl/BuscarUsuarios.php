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
          $usuario = new Usuario;
          print_p($respObj);
          if(isset($respObj->alterar)){
            $usuario->setIdUser($respObj->idUser);
            $usuario->setNome($respObj->nome);
            $usuario->setAtivo($respObj->ativo);
            $usuario->setAdmin($respObj->admin);
            $usuario->setChefeBase($respObj->chefeBase);
            $usuario->setIdEvento($respObj->idEvento);
            $usuario->setChefeCoord($respObj->chefeCoord);
            $usuario->setGrupo($respObj->grupo);
            $usuario->setChave($respObj->chave);
            $usuario->Alterar();
          }
          $usuario->setNome($respObj->nome);
          $user = $usuario->buscarUsuarioNomeId($respObj->id);
          while ($b = $user->fetch_object()){
            $usuario->novoUsuario($b);
            echo "<tr><th scope='row'>".$usuario->getIdUser()."</th>";
            echo "<td>".$usuario->getNome()."</td>";
            echo "<td>".status($usuario->getAtivo())."</td>";
            ?>
            <td>
              <form method="post" method="POST" action="administrar.php?tp=Usuarios&ac=Buscar" class="form-inline">
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
    <form method="post" method="POST" action="administrar.php?tp=Usuarios&ac=Buscar" enctype="multipart/form-data">
       <?php require_once('incl/FormUsuarios.php'); ?>
    </form>
</div>
<?php require_once('incl/alterarUsuariosBase.php'); ?>
<?php } ?>