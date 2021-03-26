<?php
class EventoModel {
      private $id;
      private $nome;
      private $inicio;	
      private $enceramento;	
      private $contato;	
      private $inscricao;	
      private $dataHora;
      private $ativo;	
      private $imgParticipante;	
      private $imgCoodenacao;	

	  public function __construct(){
        $this->setId($_SESSION['id']);
        $this->setNome($_SESSION['nomeEvento']);
        $this->setInicio($_SESSION['inicio']);
        $this->setEnceramento($_SESSION['enceramento']);
        $this->setContato($_SESSION['contato']);
        $this->setInscricao($_SESSION['inscricoes']);
        $this->setDataHora($_SESSION['datahora']);
        $this->setAtivo($_SESSION['ativo']);
        $this->setImgParticipante($_SESSION['imgParticipante']);
        $this->setImgCoodenacao($_SESSION['imgCoodenacao']);
	}
      public function novoEvento ($evento){
        $this->setId($evento->id);
        $this->setNome($evento->nome);
        $this->setInicio($evento->inicio);
        $this->setEnceramento($evento->enceramento);
        $this->setContato($evento->contato);
        $this->setInscricao($evento->inscricao);
        $this->setDataHora($evento->dataHora);
        $this->setAtivo($evento->ativo);
        $this->setImgParticipante($evento->imgParticipante);
        $this->setImgCoodenacao($evento->imgCoodenacao);
      }
  //GET SET
	public function getImgParticipante(){
		return $this->imgParticipante;
	}

	public function setImgParticipante($imgParticipante){
		 $this->imgParticipante = $imgParticipante;
	}

  public function getImgCoodenacao(){
		return $this->imgCoodenacao;
	}

	public function setImgCoodenacao($imgCoodenacao){
		 $this->imgCoodenacao = $imgCoodenacao;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		 $this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		 $this->nome = $nome;
	}

	public function getInicio(){
		return $this->inicio;
	}

	public function setInicio($inicio){
		 $this->inicio = $inicio;
	}

	public function getEnceramento(){
		return $this->enceramento;
	}

	public function setEnceramento($enceramento){
		 $this->enceramento = $enceramento;
	}

  public function getContato(){
		return $this->contato;
	}

	public function setContato($contato){
		 $this->contato = $contato;
	}

  public function getInscricao(){
		return $this->inscricao;
	}

	public function setInscricao($inscricao){
		 $this->inscricao = $inscricao;
	}

  public function getDataHora(){
		return $this->dataHora;
	}

	public function setDataHora($dataHora){
		 $this->dataHora = $dataHora;
	}

  public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		 $this->ativo = $ativo;
	}
}
?>