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
        $sql = "SELECT * FROM notas WHERE idUser = '".$user->getIdUser()."' and idBase = '".$idBase."'";
        $buscaNota = $mysqli->query($sql);
        $bn = $buscaNota->fetch_object();
        $this->novaNota($bn);
    }
    public function avaliado($idBase){
        global $mysqli;
        $user = new Usuario;
        $this->burcarNotaPorId($idBase);
        if($this->getIdBase() != '' ){
            return true;
        }else{
            return false;
        }
   }
}
?>