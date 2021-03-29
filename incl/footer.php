<?php if($user->getAtivo == 1){?>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Inicio <?=$evento->getInicio()?></p>
      <p class="m-0 text-center text-white">Encerramento <?=$evento->getInicio()?></p>
      <p class="m-0 text-center text-white">Duvidas entrar em contato com <?=$evento->getContato()?></p>
      <p class="m-0 text-center text-white">Inscreva-se em <?=$evento->getInscricao()?></p>
    </div>
  </footer>
<?php }?>