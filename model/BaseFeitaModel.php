<?php
class BaseFeitaModel {
      private $idBase;
      private $idUser;
      private $ativo;
      
  //Construtor
    public function novaBaseFeita($idBase,$idUser){
      $this->setIdBase($idBase);
      $this->setidUser($idUser);
    }

  //GET SET
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
	public function getAtivo() {
		return $this->ativo;
	}

	public function setAtivo($ativo) {
		$this->senha= $ativo;
	}
}
?>