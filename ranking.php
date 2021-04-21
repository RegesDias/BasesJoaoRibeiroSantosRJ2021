<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
        require_once('class/Base.php');
        require_once('class/Nota.php');
        $base = new Base;
    ?>      
    <div class="container">        
    <br>
        <!-- DataTales Example -->
        <div class="border bg-light sombra">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ranking</h6>
            </div>
            <?php if(!isset($respGet->idUser)){?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Posição</th>
                                <th>Grupo</th>
                                <th>Patrulha</th>
                                <th>Base Atual</th>
                                <th>Pontos</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                        $result = $user->listaRankingPorNota();
                        $base = new Base;
                        $nomeBase3 = $base->retornaNome(1);
                        while ($patrulha = $result->fetchobject()) {
                            $cont++; 
                            $nomeBase = $base->retornaNome($patrulha->idBase);
                            ?>
                            <tr>
                                <td><?=$cont?></td>
                                <td><?=$patrulha->grupo?></td>
                                <td><a href="ranking.php?idUser=<?=$patrulha->id?>"><?=$patrulha->nome?></td>
                                <td><?=$nomeBase?></td>
                                <td><?=$patrulha->notaTotal?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php }else{ ?>
                <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Patrulha</th>
                            <th scope="col">Grupo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $user = new Usuario;
                            $user->burcaPorId($respGet->idUser);
                            echo "<tr><th scope='row'>".$user->getNome()."</th>";
                            echo "<td>".$user->getGrupo()."</td>";
                        ?>
                        </tbody>
                    </table>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Avaliando em</th>
                            <th scope="col">Avaliado por</th>
                            <th scope="col">Base</th>
                            <th scope="col">Nota</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $nota = new Nota;
                            $nota = $nota->listaPatrulha($respGet->idUser);
                            while ($n = $nota->fetchobject()){
                                echo "<tr><th scope='row'>".exibeDataHoraBr($n->dataHora)."</th>";
                                echo "<td>".$n->avaliador."</td>";
                                echo "<td>".$n->base."</td>";
                                echo "<td>".$n->nota."</td>";
                            }
                            //$aData = $bases->fetchAll();
                            //$bases->closeCursor();
                        ?>
                        </tbody>
                    </table>

            <?php }?>
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