<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
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
                                <th>Posição</th>
                                <th>Patrulha</th>
                                <th>Pontos</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                        $result = $user->listaNotaTotal();
                        while ($patrulha = $result->fetch_object()) {
                            $cont++; ?>
                            <tr>
                                <td><?=$cont?></td>
                                <td><?=$patrulha->nome?></td>
                                <td><?=$patrulha->notaTotal?></td>
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