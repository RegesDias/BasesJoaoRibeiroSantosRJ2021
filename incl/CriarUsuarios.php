<?php
    $usuario = new Usuario;
    $usuario->novoUsuario($respObj);
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
        $usuario->cadastrar();
        
      }
      ?>

<div class="container">
    <form method="post" method="POST" action="administrar.php?tp=Usuarios&ac=Criar" enctype="multipart/form-data">
       <?php require_once('incl/FormUsuarios.php'); ?>
    </form>
  </div>
