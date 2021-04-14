<?php
class EventoModel {
      private $id;
      private $nome;
      private $inicio;	
      private $encerramento;	
      private $contato;	
      private $inscricao;	
      private $dataHora;
      private $ativo;	
      private $imgParticipante;	
      private $imgCoodenacao;	
	  private $imgChefeBase;	

	  public function __construct(){
		if (isset($_SESSION['evento'])){
			$this->setId(unserialize($_SESSION['evento'])->getId());
			$this->setNome(unserialize($_SESSION['evento'])->getNome());
			$this->setInicio(unserialize($_SESSION['evento'])->getInicio());
			$this->setEncerramento(unserialize($_SESSION['evento'])->getEncerramento());
			$this->setContato(unserialize($_SESSION['evento'])->getContato());
			$this->setInscricao(unserialize($_SESSION['evento'])->getInscricao());
			$this->setDataHora(unserialize($_SESSION['evento'])->getDataHora());
			$this->setAtivo($_SESSION['eventoAtivo']);
			$this->setImgParticipante(unserialize($_SESSION['evento'])->getImgParticipante());
			$this->setImgCoodenacao(unserialize($_SESSION['evento'])->getImgCoodenacao());
			$this->setImgChefeBase(unserialize($_SESSION['evento'])->getImgChefeBase());
		}
	}
      public function novoEvento ($evento){
        $this->setId($evento->id);
        $this->setNome($evento->nome);
        $this->setInicio($evento->inicio);
        $this->setEncerramento($evento->encerramento);
        $this->setContato($evento->contato);
        $this->setInscricao($evento->inscricao);
        $this->setDataHora($evento->dataHora);
        $this->setAtivo($evento->ativo);
        $this->setImgParticipante($evento->imgParticipante);
        $this->setImgCoodenacao($evento->imgCoodenacao);
		$this->setImgChefeBase($evento->imgChefeBase);
      }
  //GET SET
  	public function getImgChefeBase(){
		return $this->imgChefeBase;
	}

	public function setImgChefeBase($imgChefeBase){
		$this->imgChefeBase = $imgChefeBase;
	}

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
		return DataHoraBr($this->inicio);
	}

	public function setInicio($inicio){
		 $this->inicio = $inicio;
	}

	public function getEncerramento(){
		return DataHoraBr($this->encerramento);
	}

	public function setEncerramento($encerramento){
		 $this->encerramento = $encerramento;
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