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
        ?>
    </body>
</html>