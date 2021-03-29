<?php
    $evento = new Evento;
    $evento->novoEvento($b);
    if(isset($respObj->alterar)){
        $evento->setNome($respObj->nome);
        $evento->setInicio($respObj->inicio);
        $evento->setEncerramento($respObj->encerramento);
        $evento->setAtivo($respObj->ativo);
        $evento->setContato($respObj->contato);
        $evento->setInscricao($respObj->inscricao);
        $evento->CadastrarEvento();
      }
      ?>
    <form method="post" method="POST" action="administrar.php?tp=Eventos&ac=Criar">
        <?php require_once('incl/FormEventos.php'); ?>
    </form>

