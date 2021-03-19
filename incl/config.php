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
$respObj = (object) filter_input_array(INPUT_POST, FILTER_DEFAULT);


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
