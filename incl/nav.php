<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <?php
     if($_SESSION['ativo'] == true){
        if($_SESSION['admin'] === true){ ?>
            <a class="navbar-brand" href="#">Bom vindo Chefe <?=$_SESSION['nome']?></a>
        <?php }else{
              $idUser = $_SESSION['idUser'];
              $basesql = "SELECT * FROM notas WHERE idUser = '$idUser' ";
              $result = $mysqli->query($basesql);
              while ($notas = $result->fetch_object()) {
                $total= $total + $notas->nota;
              }?>
          <a class="navbar-brand" href="#">Patrulha <?=$_SESSION['nome']?> Alerta! - <b>Pontos:</b> <i><?=$total?></i></a>
        <?php }
      }?>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Bases</a>
          </li>
         <?php if($_SESSION['admin'] === true){ ?>
          <li class="nav-item">
            <a class="nav-link" href="admin.php">Administrar</a>
          </li>
          <?php }?>
          <li class="nav-item">
            <a class="nav-link" href="ranking.php">Ranking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"  data-toggle="modal" data-target="#modalExemplo">Entrar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <label>Usuário</label>
          <input type="text" name='user' class="form-control"  placeholder="usuario">
          <label>Senha</label>
          <input type="password" name='passwd' class="form-control"  placeholder="senha">
          <input type="hidden" name='acao' value='logar'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="submit" value='Entrar' class="btn btn-primary">
        </div>
      </form>

    </div>
  </div>
</div>