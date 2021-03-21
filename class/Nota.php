<?php
require_once('model/NotaModel.php');
class Nota extends NotasModel{

    public function setAvaliadoPor($avaliadoPor){
            $this->getAvaliadoPor = $avaliadoPor;
    }
    function insereNotaPor($nota){
        global $mysqli;
        $insertNota = "INSERT INTO notas(idBase, idUser,nota,avaliadoPor) VALUES ($nota->id,$nota->idUser,$nota->nota,$nota->avaliadoPor) ";
        $in = $mysqli->query($insertNota);
    }
    function burcarNotaPorId($id){
        global $mysqli;
        $sql = "SELECT * FROM notas WHERE id = '$id' ";
        $buscaNota = $mysqli->query($sql);
        $bn = $buscaNota->fetch_object();
        $nota = new Nota(
            $bn->idBase,
            $bn->idUser,
            $bn->nota,
            $bn->dataHora,
            $bn->avaliadoPor
        );
        return $nota;
    }
}
?>