<?php
$evento = new Evento;

  if ($evento->getAtivo() == true){
    $titulo = "O evento se encerra em:";
    $dataCont = $evento->getEncerramento();
    $final = "O ".$evento->getNome()." Terminou!";
  }else{
    $titulo = "O evento vai começar em:";
    $dataCont = $evento->getInicio();
    $final = "Já vamos iniciar! O ".$evento->getNome();
  }

?>
<script type='text/javascript' src='jquery/jquery-1.11.1.min.js'></script>
<script type='text/javascript' src='jquery/contador.js'></script>
<p class="m-0 text-center"><?=$titulo?></a></p><br>
  <div class="contador" data-until="<?php echo strtotime($dataCont);?>" data-done="<?=$final?>" data-respond>
    <div class="dias block">
      <div class="conta"></div>
      <div class="label">Dias</div>
    </div>
    <div class="horas block">
      <div class="conta"></div>
      <div class="label">Horas</div>
    </div>
    <div class="minutos block">
      <div class="conta"></div>
      <div class="label">Minutos</div>
    </div>
    <div class="segundos block">
      <div class="conta"></div>
      <div class="label">Segundos</div>
    </div> 
    </div>
