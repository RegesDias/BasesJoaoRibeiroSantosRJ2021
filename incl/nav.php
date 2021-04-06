<?php
if (!$user->getAtivo()){
  header('Location:login.php?id='.$_SESSION['erro']);
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar-inner">
  <a class="navbar-brand" href="#">
    <img src="img/icon.png" width="40" height="40" alt="">
  </a>
      <?php $user->usuarioLogado()?>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class='nav-item'>
              <a class='btn btn-outline-success btn-sm' style="margin-right: 5px;" href='index.php'>Bases</a>
          </li>
         <?php 
              $user->usuarioAdm();
              $user->entrarSair();
          ?>
        </ul>
      </div>
</nav>

<div class="modal fade" id="Sair" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Sair do Torneio?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
          <input type="hidden" name='acao' value='sair'>
          <input type="hidden" name='entrarSair' value='1'>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="submit" value='Sair' class="btn btn-primary">
        </div>
      </form>

    </div>
  </div>
</div>