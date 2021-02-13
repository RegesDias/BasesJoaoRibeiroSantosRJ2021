<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
  <?php 
    require_once('config.php');
    require_once('incl/nav.php');
  ?>
  <div class="container">

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
          <input type="hidden" name='acao' value='entrar'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="submit" value='Entrar' class="btn btn-primary">
        </div>
      </form>

    </div>
  </div>
</div>
    <div class="row">
      <div class="col-lg-12">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="img/joaoRibeiro.jpeg" alt="First slide">
            </div>
          </div>
        </div>
        <div class="row">
        <?php
          if($_SESSION['ativo'] == true){
            if($_SESSION['chefeBase'] == true){
              $idUser = $_SESSION['idUser'];
              $basesql = "SELECT * FROM base WHERE ResposavelBase = '$idUser' ";
            }else{
              $basesql = "SELECT * FROM base";
            }
            if ($result = $mysqli->query($basesql)) {
              while ($base = $result->fetch_object()) {?>
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                      <a href="#"><img height="700" width="50" class="card-img-top img-fluid border-radius img-thumbnail" src="img/<?=$base->img?>" alt=""></a>
                        <div class="card-footer"><?php
                          $idUser = $_SESSION['idUser'];
                          $feita = $mysqli->query("SELECT * FROM baseFeitas WHERE idBase = '$base->id' AND idUser = '$idUser'");
                          $baseJaFeita = $feita->fetch_object();
                          if($baseJaFeita->ativo == 1){
                            echo "<button class='btn btn-large btn-block '  disabled href='#'>Nota ".retornaNota($_SESSION['idUser'],$base->id)."</button>";
                          }else{
                                  if(($base->status === 'Aberta') and ($_SESSION['admin'] != true)){?>
                                    <form method="post">
                                      <input type='hidden' name='acao' value='encaminhar'>
                                      <input type='hidden' name='status' value='<?=$base->status?>'>
                                      <input type='hidden' name='id' value='<?=$base->id?>'>
                                      <input type='submit' value='Aberta!' class="btn btn-large btn-block btn-success">
                                    </form><?php
                                  }
                                  if(($base->status === 'Aberta') and ($_SESSION['admin'] == true)){
                                    echo "<button class='btn btn-large btn-block btn-success'  disabled href='#'>Vazia</button>";
                                  }
                                  if(($_SESSION['admin'] === true) and ($base->status != 'Aberta')){
                                      ?>
                                      <form method="post">
                                        <label>Avaliar Patrulha <?=retornaNome($base->idUser ,'user')?></label>
                                        <input type="text" name='nota' class="form-control"  placeholder="Nota">
                                        <input type='hidden' name='acao' value='abrirBase'>
                                        <input type='hidden' name='status' value='<?=$base->status?>'>
                                        <input type='hidden' name='idUser' value='<?=$base->idUser?>'>
                                        <input type='hidden' name='id' value='<?=$base->id?>'>
                                        <label></label>
                                        <input type='submit' value='Abrir e Avaliar' class="btn btn-large btn-block btn-primary">
                                      </form><?php
                                  }
                                  if(($base->status === 'Fechada')and ($_SESSION['admin'] != true)){
                                    echo "<button class='btn btn-large btn-block btn-danger'  disabled href='#'>Fechada</button>";
                                  }
                                  
                           }?>
                        </div>
                    </div>
                  </div><?php 
              }
            }
          }
          ?>



  

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Inicio do evento dia 00/00/0000 as 00:00</p>
      <p class="m-0 text-center text-white">Enceramento dia 00/00/0000 as 00:00</p>
      <p class="m-0 text-center text-white">Duvidas entrar em contato com ddd@ddd.com</p>
      <p class="m-0 text-center text-white">Inscreva-se em www.lugar.com.br</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  setTimeout(function(){
    window.location.reload(1);
  }, 50000);
</script>
</body>

</html>
