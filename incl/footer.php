<?php if($user->getAtivo() == 1){?>
  <footer class="py-5 bg-dark sombra">
    <div class="container">
      <p class="m-0 text-center text-white">Inicio <?=exibeDataHoraBr($evento->getInicio())?></p>
      <p class="m-0 text-center text-white">Encerramento <?=exibeDataHoraBr($evento->getEncerramento())?></p>
      <p class="m-0 text-center text-white">Entre em contato com a coordenação clicando <a href="<?=$evento->getContato()?>" target="_blank">AQUI.</a></p>
      <!--
      <p class="m-0 text-center text-white">Inscreva-se em <?=$evento->getInscricao()?></p>
      -->
    </div>
  </footer>
<?php }?>