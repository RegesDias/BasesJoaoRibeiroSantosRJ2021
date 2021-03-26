<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
        $tp = tirarAcentos($respGet->tp);
        $ac = tirarAcentos($respGet->ac);
    ?>      
    <div class="container">        
    <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="col-lg-12">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary"><?=$respGet->tp?></h5>
            </div>
        </div><br>
        <div class="container">
          <div class="row">
          <?php require_once('incl/menu'.$tp.'.php'); ?>
            <div class="col-lg-9">
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

    <script>
        setTimeout(function(){
            window.location.reload(1);
        }, 50000);
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>