<?php
class Notas{
    private $idBase;
    private $idUser;
    private $nota;
    private $dataHora;
    private $avaliadoPor;

    public function __construct($idBase,$idUser,$nota,$dataHora,$avaliadoPor){
        $this->setIdBase($idBase);
        $this->setidUser($idUser);
        $this->setNota($nota);
        $this->setDataHora($dataHora);
        $this->setAvaliadoPor($avaliadoPor);
      }
    //GETSET
    public function getIdBase(){
		return $this->idBase	;
	}

	public function setIdBase($idBase){
		
        $this->idBase = $idBase	;
	}

    public function getIdUser(){
		return $this->idUser	;
	}

	public function setIdUser($idUser){
		 $this->idUser = $idUser	;
	}

    public function getNota(){
		return $this->nota	;
	}

	public function setNota($nota){
		 $this->nota = $nota	;
	}

    public function getDataHora(){
		return $this->dataHora	;
	}

	public function setDataHora($dataHora){
		 $this->dataHora = $dataHora	;
	}

    public function getAvaliadoPor(){
		return $this->avaliadoPor	;
	}

	public function setAvaliadoPor($avaliadoPor){
		 $this->getAvaliadoPor = $avaliadoPor	;
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
        $nota = new Notas(
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