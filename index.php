<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
        require_once('class/Base.php');
        require_once('class/Usuario.php');
        $base = new Base;
        $user = new Usuario;
        
        if($respObj->acao == 'logar'){
          $acao = $respObj->acao;
          $id = $respObj->id;
          $user->$acao($id);
        }else if(isset($respObj->acao)){
          $acao = $respObj->acao;
          $id = $respObj->id;
          $base->$acao($id);
        }
    ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

      <?php require_once('incl/carousel.php'); ?>
        <div class="row">
        <?php
          if($_SESSION['ativo'] == true){
            $bases = $mysqli->query($base->listar());
            while ($b = $bases->fetch_object()){
              $base = new Base;
              $base->novaBase(
                          $b->id, 
                          $b->idUser,
                          $b->ResposavelBase,
                          $b->nome,
                          $b->img,
                          $b->link,
                          $b->status,
                          $b->ativa,
                          $b->dataHora
              );
              ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <?php 
                          $base->imagem();
                        ?>
                        <div class="card-footer">
                          <?php
                              
                              if($base->avaliado() == 1){
                                $base->exibeNota($b->id); 
                              }else{
                                $base->botoes();
                              }
                              
                            ?>
                        </div>
                    </div>
                </div><?php 
            }
          }
          ?>
      </div>
    </div>
  </div>
  <?php 
        require_once('incl/footer.php');
  ?>
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
