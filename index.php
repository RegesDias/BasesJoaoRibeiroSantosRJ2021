<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
<div class="container">
    <div class="row">
      <div class="col-lg-12">
    <?php
        require_once('incl/config.php');
        require_once('class/Base.php');
        require_once('incl/carousel.php');
        $base = new Base;
        if(isset($respObj->acao)AND($respObj->entrarSair != '1')){
          $acao = $respObj->acao;
          $id = $respObj->id;
          $base->$acao($id);
        }
        $evento = new Evento;
        require_once('incl/nav.php');

          if($user->getAtivo() == true){
            $bases = $base->listar();
            echo "<div class='row'>";
            while ($b = $bases->fetchobject()){
              $base = new Base;
              $base->novaBase($b);
              ?>
                <div class="col-lg-3 col-md-6 mb-4">
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
 if(!$user->usuarioAvaliador()){ 
    require_once('incl/footer.php');?>
    <script> 
        setTimeout(function(){
          window.location.reload(1);
        }, 50000);
    </script><?php 
}?>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  function recarregar(){
      var url_do_post;
      var data;
      $.ajax({
            type: "POST",
            url: url_do_post,
            data: data,
            success: function(){
              location.reload();  
            }
          });
  }
</script>
</body>
</html>