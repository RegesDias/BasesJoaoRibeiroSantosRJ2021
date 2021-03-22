<?php
require_once('model/NotaModel.php');
require_once('Usuario.php');
class Nota extends NotasModel{

    public function setAvaliadoPor($avaliadoPor){
            $this->getAvaliadoPor = $avaliadoPor;
    }
    function insereNota(){
        global $mysqli;
        $insertNota = "INSERT INTO notas 
                                (idBase, 
                                idUser,
                                nota,
                                avaliadoPor) 
                                VALUES 
                                (
                                '".$this->getIdBase()."',
                                '".$this->getIdUser()."',
                                '".$this->getNota()."',
                                '".$this->getAvaliadoPor()."'
                                )";
        $in = $mysqli->query($insertNota);
    }
    function burcarNotaPorId($idBase){
        global $mysqli;
        $user = new Usuario;
        $sql = "SELECT * FROM notas WHERE idUser = ".$user->getidUser()." and idBase = '".$idBase."'";
        $buscaNota = $mysqli->query($sql);
        $bn = $buscaNota->fetch_object();
        $nota = new Nota;
        $nota->novaNota(
            $bn->idBase,
            $bn->idUser,
            $bn->nota,
            $bn->dataHora,
            $bn->avaliadoPor
        );
        return $nota;
    }
    public function avaliado($id){
        global $mysqli;
        $user = new Usuario;
        $sql = "SELECT nota FROM notas WHERE idUser = ".$user->getidUser()." and idBase = '".$id."'";
        $rnome = $mysqli->query($sql);
        if($rn = $rnome->fetch_object()){
            return true;
        }else{
            return false;
        }
   }
}
?>