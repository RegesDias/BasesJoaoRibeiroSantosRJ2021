<?php
class BaseModel {
      private $id;
	  private $ordem;
      private $idUser;
      private $ResposavelBase;
      private $nome;	
      private $img;	
      private $link;	
      private $status;	
      private $ativa;	
      private $dataHora;
      
  //Construtor
    public function novaBase($base){
      $this->setId($base->id);
      $this->setidUser($base->idUser);
      $this->setResposavelBase($base->ResposavelBase);
      $this->setNome($base->nome);
      $this->setImg($base->img);
      $this->setLink($base->link);
      $this->setStatus($base->status);
      $this->setAtiva($base->ativa);
      $this->setDataHora($base->dataHora);
    }

  //GET SET
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		 $this->id = $id;
	}

	public function getOrdem(){
		return $this->ordem;
	}

	public function setOrdem($ordem){
		 $this->id = $ordem;
	}

	public function getIdUser(){
		return $this->idUser;
	}

	public function setIdUser($idUser){
		 $this->idUser = $idUser;
	}

	public function getResposavelBase(){
		return $this->ResposavelBase;
	}

	public function setResposavelBase($ResposavelBase){
		 $this->ResposavelBase = $ResposavelBase;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		 $this->nome = $nome;
	}

	public function getImg(){
		return $this->img;
	}

	public function setImg($img){
		 $this->img = $img;
	}

	public function getLink(){
		return $this->link;
	}

	public function setLink($link)  {
		 $this->link=$link;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status)  {
		 $this->status	 = $status;
	}

	public function getAtiva(){
		return $this->ativa;
	}

	public function setAtiva($ativa)  {
		 $this->ativa=$ativa;
	}

	public function getDataHora(){
		return $this->dataHora;
	}

	public function setDataHora($dataHora){
		 $this->dataHora = $dataHora;
	}
}
?>