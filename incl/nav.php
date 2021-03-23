<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <?php $user->usuarioLogado()?>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
         <?php 
              $user->usuarioAdm();
              $user->entrarSair();
          ?>
        </ul>
      </div>
    </div>
</nav>
  <!-- Modal -->
<div class="modal fade" id="Entrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Entrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <label>Usuário</label>
          <input type="text" name='user' class="form-control"  placeholder="usuario">
          <label>Senha</label>
          <input type="password" name='passwd' class="form-control"  placeholder="senha">
          <input type="hidden" name='acao' value='entrar'>
          <input type="hidden" name='entrarSair' value='1'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="submit" value='Entrar' class="btn btn-primary">
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="Sair" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
            Sair do Torneio?
          <input type="hidden" name='acao' value='sair'>
          <input type="hidden" name='entrarSair' value='1'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="submit" value='Sair' class="btn btn-primary">
        </div>
      </form>

    </div>
  </div>
</div>