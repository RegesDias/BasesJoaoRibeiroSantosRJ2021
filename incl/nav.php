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
          <li class="nav-item">
            <a class="nav-link" href="#">Administrar</a>
          </li>
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