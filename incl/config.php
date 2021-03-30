<?php
session_start();
$server = "localhost";

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
$respObj = (object) filter_input_array(INPUT_POST, FILTER_DEFAULT);
$respGet = (object) filter_input_array(INPUT_GET, FILTER_DEFAULT);
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

function dataHoraBr($data){
  $dt = new DateTime($data);
  return $dt->format('Y-m-d\TH:i:s');
}

function print_p($obj){
  echo "<pre>";
    print_r($obj);
  echo "</pre>";
}
function tirarAcentos($string){
  return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}
Function htmlSelectStatus($status){
  if($status == 1){
      $status = 'selected';
  }
  $Html="
              <select class='form-control' name='ativo'>
                  <option value='0'>Inativo</option>
                  <option $status value='1'>Ativo</option>
              </select>";
  return $Html;
}
Function status($status){
  if($status == 1){
      $status = 'Ativo';
  }else{
    $status = 'Inativo';
  }
  return $status;
}
?>
