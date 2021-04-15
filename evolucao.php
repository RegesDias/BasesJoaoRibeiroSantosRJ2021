<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
        require_once('class/Base.php');
        require_once('class/BaseFeita.php');
        $base = new Base;
        $baseFeita = new BaseFeita;
    ?>      
    <div class="container">        
    <br>
        <!-- DataTales Example -->
        <div class="border bg-light sombra">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ranking</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Base</th>
                                <th>Nome</th>
                                <th>Total de Patrulhas</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                        $result = $bases = $base->listar();
                        $nomeBase3 = $base->retornaNome(1);
                        while ($obj = $result->fetchobject()) {
                            $total = $baseFeita->contarPatrulhas($obj->id);
                            ?>
                            <tr>
                                <td><?=$obj->ordem?></td>
                                <td><?=$obj->nome?></td>
                                <td><?=$total->total?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
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