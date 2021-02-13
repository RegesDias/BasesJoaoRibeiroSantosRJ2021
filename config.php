<?php
session_start();
error_reporting(0);
$server = "localhost";
//$server = "187.45.196.218";
$mysqli = new mysqli($server,"basesgrandejog","ondeumvai@99T","basesgrandejog");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
$respPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

function retornaNome($id ,$tabela){
    $sql = "SELECT nome FROM $tabela WHERE id = '$id'";
    $rnome = $GLOBALS['mysqli']->query($sql);
    $rn = $rnome->fetch_object();
    echo $rn->nome;
}
function retornaNota($idUser, $idBase){
  $sql = "SELECT nota FROM notas WHERE idUser = '$idUser' and idBase = '$idBase'";
  $rnome = $GLOBALS['mysqli']->query($sql);
  $rn = $rnome->fetch_object();
  return $rn->nota;
}
if($respPost['acao'] == 'encaminhar'){
  $id = $respPost['id'];
  $idUser = $_SESSION['idUser'];
  $dd = $mysqli->query("SELECT * FROM base WHERE id ='$id'");
  $direcionar = $dd->fetch_object();
  if($direcionar->status == 'Aberta'){
    $alterar = $mysqli->query("UPDATE base SET status = 'Fechada', idUser = '$idUser' WHERE id = '$id'");
    $insertBase = "INSERT INTO baseFeitas(idBase, idUser,ativo) VALUES ($id,$idUser,1)";
    $ib = $mysqli->query($insertBase);
    header('Location: '.$direcionar->link);
  }else{?>
    <div class="alert alert-warning">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <h4>Alerta!</h4>
      Foi quase... mas infelizmente esta base já foi acessada
    </div><?php
  }
}

if($respPost['acao'] == 'entrar'){
    $senha  = md5($respPost['passwd']);
    $chave = $respPost['user'];
    if ($login = $mysqli->query("SELECT * FROM user WHERE senha = '$senha' AND chave = '$chave'")) {
      $acesso = $login->fetch_object();
      $_SESSION['ativo'] = false;
      $_SESSION['admin'] = false;
      $_SESSION['chefeBase'] = false;
      if($acesso->ativo == 1){
        $_SESSION['idUser'] = $acesso->id;
        $_SESSION['nome'] = $acesso->nome;
        $_SESSION['ativo'] = true;
        if($acesso->admin == 1){
          $_SESSION['admin'] = true;
        }
        if($acesso->chefeBase == 1){
          $_SESSION['chefeBase'] = true;
        }
      }else{?>
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <h4>Alerta!</h4>
        Usuário ou senha incorretos...
    </div><?php
      }
    }
}
if($respPost['acao'] == 'abrirBase'){
  $id = $respPost['id'];
  $idUser = $respPost['idUser'];
  $nota = $respPost['nota'];
  $avaliadoPor = $_SESSION['idUser'];
  if($respPost['status'] == 'Aberta'){
    $status = 'Fechada';
  }else{
    $status = 'Aberta';
  }
  $alterar = $mysqli->query("UPDATE base SET status = '$status' WHERE id = '$id'");
  $insertNota = "INSERT INTO notas(idBase, idUser,nota,avaliadoPor) VALUES ($id,$idUser,$nota,$avaliadoPor )";
  $in = $mysqli->query($insertNota);
}
//testes
//echo '<br>';
//print_r($respPost);
?>
