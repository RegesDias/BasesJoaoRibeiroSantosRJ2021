<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
        $tp = tirarAcentos($respGet->tp);
        $ac = tirarAcentos($respGet->ac);
        if($ac == ""){
            $ac = 'Buscar';
            $respGet->ac = 'Buscar'; 
        }
    ?>      
    <div class="container">        
    <br>
        <!-- DataTales Example -->
        <div class="container-fluid">
            <br>
            <div class="list-group">
                <div class="row">
                <div class="col-lg-3">
                    <div class="vertical-menu sombra">
                        <a href="#" class="active">Ações</a>
                        <?php require_once('incl/menu'.$tp.'.php'); ?>
                    </div>
                </div>
                    <div class="col-lg-9 border bg-light p-3 sombra">
                        <h1> <?=$respGet->ac." ".$respGet->tp?> </h1>
                        <hr>
                            <?php 
                                if(isset($respGet->ac)){
                                    require_once('incl/'.$ac.$tp.'.php');
                                }
                            ?>
                            <br><br>
                        </hr>
                    </div>
                </div>
            </div>
        </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>