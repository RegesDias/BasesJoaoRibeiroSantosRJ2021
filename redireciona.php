<html lang="en">
  <?php require_once("incl/head.php"); ?>
    <body>
        <?php 
            require_once('incl/config.php');
            require_once('class/Base.php');
            $base = new Base;
            $acao = $respObj->acao;

            $base->$acao($respObj->id);
            $evento = new Evento;
        ?>
    </body>
</html>