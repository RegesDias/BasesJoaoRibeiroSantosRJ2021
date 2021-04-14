<?php if($user->getAtivo() == 1){?>
  <footer class="py-5 bg-dark sombra">
    <div class="container rodape">
      <?php if(!$user->usuarioAvaliador()){ ?>
      <p>Entre em contato com a coordenação clicando <a href="<?=$evento->getContato()?>" target="_blank">AQUI.</a></p>
      <?php }?>
      <?php require_once('incl/contador.php'); ?>
    </div>
  </footer>
<?php }?>