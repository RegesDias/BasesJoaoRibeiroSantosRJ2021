<?php
    $evento = new Evento;
    $evento->novoEvento($b);
    if(isset($respObj->alterar)){
        $evento->setId($respObj->id);
        $evento->setNome($respObj->nome);
        $evento->setInicio($respObj->inicio);
        $evento->setEncerramento($respObj->encerramento);
        $evento->setAtivo($respObj->ativo);
        $evento->setContato($respObj->contato);
        $evento->setInscricao($respObj->inscricao);
        if($respObj->id > 0){
          $evento->carregarImagem();
          $evento->Alterar();
          $eventos = $evento->buscarEventoNomeId($respObj->id);
          $b = $eventos->fetch_object();
          $evento->novoEvento($b);
        }else{
          $evento->Cadastrar();
        }
        
      }
      ?>
    <form method="post" method="POST" action="administrar.php?tp=Eventos&ac=Criar" enctype="multipart/form-data">
        <?php require_once('incl/FormEventos.php'); ?>
    </form>