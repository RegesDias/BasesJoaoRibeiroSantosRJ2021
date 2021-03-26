<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('class/Base.php');
        $base = new Base;
        if(isset($respObj->acao)AND($respObj->entrarSair != '1')){
          $acao = $respObj->acao;
          $id = $respObj->id;
          $base->$acao($id);
        }
        $evento = new Evento;
        require_once('incl/nav.php');
    ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

      <?php require_once('incl/carousel.php'); ?>
        
        <?php
          if($user->getAtivo() == true){
            $bases = $base->listar();
            echo "<div class='row'>";
            while ($b = $bases->fetch_object()){
              $base = new Base;
              $base->novaBase($b);
              ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <?php $base->imagem();?>
                        <div class="card-footer">
                            <?php $base->botoes();?>
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
