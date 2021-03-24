<?php
session_start();
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
$respObj = (object) filter_input_array(INPUT_POST, FILTER_DEFAULT);
require_once('class/Usuario.php');
require_once('class/Evento.php');
$user = new Usuario;
$user->AtualizaUsuarioBaseAtual();
$evento = new Evento;

if($respObj->entrarSair == '1'){
  $acao = $respObj->acao;
  $id = $respObj->id;
  $user->$acao($id);
  $user = new Usuario;
}

function retornaNome($id ,$tabela){
    global $mysqli;
    $sql = "SELECT nome FROM $tabela WHERE id = '$id'";
    $rnome = $mysqli->query($sql);
    $rn = $rnome->fetch_object();
    echo $rn->nome;
}
function print_p($obj){
  echo "<pre>";
    print_r($obj);
  echo "</pre>";
}
?>
