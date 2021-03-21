<?php
class BaseModel {
      private $id;
      private $idUser;
      private $ResposavelBase;
      private $nome;	
      private $img;	
      private $link;	
      private $status;	
      private $ativa;	
      private $dataHora;
      
  //Construtor
    public function novaBase($id,$idUser,$ResposavelBase,$nome,$img,$link,$status,$ativa,$dataHora){
      $this->setId($id);
      $this->setidUser($idUser);
      $this->setResposavelBase($ResposavelBase);
      $this->setNome($nome);
      $this->setImg($img);
      $this->setLink($link);
      $this->setStatus($status);
      $this->setAtiva($ativa);
      $this->setDataHora($dataHora);
    }

  //GET SET
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		 $this->id = $id;
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
		return $this->nome	;
	}

	public function setNome($nome){
		 $this->nome = $nome	;
	}

	public function getImg(){
		return $this->img	;
	}

	public function setImg($img){
		 $this->img = $img	;
	}

	public function getLink(){
		return $this->link	;
	}

	public function setLink	($link)  {
		 $this->link	 = $link	;
	}

	public function getStatus	(){
		return $this->status	;
	}

	public function setStatus($status)  {
		 $this->status	 = $status	;
	}

	public function getAtiva	(){
		return $this->ativa	;
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