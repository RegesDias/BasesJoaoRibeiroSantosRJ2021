<form method="post" method="POST" action="administrar.php?tp=Bases&ac=Buscar">

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
          require_once('class/Base.php');
          if(isset($respObj->alterar)){
            $base->setId($respObj->id);
            $base->setResposavelBase($respObj->resposavelBase);
            $base->setNome($respObj->nome);
            $base->setImg($respObj->img);
            $base->setLink($respObj->link);
            $base->setStatus($respObj->status);
            $base->setAtiva($respObj->ativo);
            $base->setDataHora($respObj->dataHora);
            $base->setOrdem($respObj->ordem);
            $base->alterar();
            
          }
          $base = new Base;
          $base->setNome($respObj->nome);
          $bases = $base->buscaPorIdNome($respObj->id);
          while ($b = $bases->fetchobject()){
            $base->novaBase($b);
            echo "<tr><th scope='row'>".$base->getId()."</th>";
            echo "<td>".$base->getNome()."</td>";
            echo "<td>".status($base->getAtiva())."</td>";
            ?>
            <td>
              <form method="post" method="POST" action="administrar.php?tp=Bases&ac=Buscar" class="form-inline">
                <input type="hidden" name='id' value="<?=$base->getId()?>">
                <input type="hidden" name='nome' value="<?=$base->getNome()?>">
                <input type="hidden" name='acao' value="alterar">
                <button type="submit" class="btn btn-primary btn-sm mb-1"><i class="icon-search"></i>Modificar</button>
              </form>
            </td></tr><?php
          }
          $aData = $bases->fetchAll();
          $bases->closeCursor();
      ?>
  </tbody>
</table>
<?php }?>
<?php 
if($respObj->acao == 'alterar'){?>
<div class="container">
    <form method="post" method="POST" action="administrar.php?tp=Bases&ac=Buscar" enctype="multipart/form-data">
       <?php require_once('front/FormBases.php'); ?>
    </form>
  </div>
<?php } ?>