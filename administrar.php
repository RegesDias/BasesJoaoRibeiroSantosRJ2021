<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <link rel="stylesheet" href="css/select2.min.css">
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
    <div class="container"><br>
        <div class="container-fluid"><br>
            <div class="list-group">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="vertical-menu">
                            <div class="panel-group" id="accordion">
                                <div>
                                    <div class="panel-heading">
                                        <h4><a data-toggle="collapse" class="sombra" data-parent="#accordion" href="#usuarios">Usuários</a></h4>
                                    </div>
                                    <div id="usuarios" class="panel-collapse collapse in">
                                        <a href="administrar.php?tp=Usuários&ac=Buscar" class="list-group-item">Buscar</a>
                                        <a href="administrar.php?tp=Usuários&ac=Criar" class="list-group-item">Criar</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="panel-heading">
                                        <h4><a data-toggle="collapse" class="sombra" data-parent="#accordion" href="#bases">Bases</a></h4>
                                    </div>
                                    <div id="bases" class="panel-collapse collapse in">
                                        <a href="administrar.php?tp=Bases&ac=Buscar" class="list-group-item">Buscar</a>
                                        <a href="administrar.php?tp=Bases&ac=Criar" class="list-group-item">Criar</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="panel-heading">
                                        <h4><a data-toggle="collapse" class="sombra" data-parent="#accordion" href="#eventos">Eventos</a></h4>
                                    </div>
                                    <div id="eventos" class="panel-collapse collapse in">
                                        <a href="administrar.php?tp=Eventos&ac=Buscar" class="list-group-item">Buscar</a>
                                        <a href="administrar.php?tp=Eventos&ac=Criar" class="list-group-item">Criar</a>
                                    </div>
                                </div>
                            </div>
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
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="jquery/jquery.min.js"></script>
    <script src="js/select2.full.min.js"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
</body>
</html>