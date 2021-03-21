<?php
class NotasModel{
	private $idBase;
    private $idUser;
    private $nota;
    private $dataHora;
    private $avaliadoPor;

    public function novaNota($idBase,$idUser,$nota,$avaliadoPor){
        $this->setIdBase($idBase);
        $this->setidUser($idUser);
        $this->setNota($nota);
        $this->setAvaliadoP($avaliadoPor);
    }
    //GETSET
    public function getIdBase(){
		return $this->idBase;
	}

	public function setIdBase($idBase){
		
        $this->idBase=$idBase;
	}

    public function getIdUser(){
		return $this->idUser;
	}

	public function setIdUser($idUser){
		 $this->idUser=$idUser;
	}

    public function getNota(){
		return $this->nota;
	}

	public function setNota($nota){
		 $this->nota=$nota;
	}

    public function getDataHora(){
		return $this->dataHora;
	}

	public function setDataHora($dataHora){
		 $this->dataHora=$dataHora;
	}

    public function getAvaliadoPor(){
		return $this->avaliadoPor;
	}

	public function setAvaliadoP($avaliadoPor){
		 $this->avaliadoPor=$avaliadoPor;
	}

}