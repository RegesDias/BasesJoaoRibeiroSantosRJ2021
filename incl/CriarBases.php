<?php
    $base = new Base;
    $base->novaBase($respObj);
    if(isset($respObj->alterar)){
        $base->setId($respObj->id);
        $base->setIdUser($respObj->idUser);
        $base->setResposavelBase($respObj->resposavelBase);
        $base->setNome($respObj->nome);
        $base->setImg($respObj->img);
        $base->setLink($respObj->link);
        $base->setStatus($respObj->status);
        $base->setAtiva($respObj->ativa);
        $base->setDataHora($respObj->dataHora);
        $base->setOrdem($respObj->ordem);
        if($respObj->id > 0){
            $base->alterar();
            $bases = $base-> burcaPorId($respObj->id);
            $b = $Bases->fetch_object();
            $base->novaBase($b);
        }else{
          $base->cadastrar();
        }
        
      }
      ?>

<div class="container">
    <form method="post" method="POST" action="administrar.php?tp=bases&ac=Criar" enctype="multipart/form-data">
       <?php require_once('incl/FormBases.php'); ?>
    </form>
  </div>