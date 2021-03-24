<?php
class UsuarioModel {
	private $idUser;
	private $nome;
	private $chave;
	private $senha;
	private $ativo;
	private $notaTotal;
	private $admin;
	private $chefeBase;
	private $idEvento;
	private $idBase;

	//CONSTRUTOR
	public function __construct(){
		$this->setChefeBase($_SESSION['chefeBase']);
		$this->setIdUser($_SESSION['idUser']);
		$this->setNome($_SESSION['nome']);
		$this->setAtivo($_SESSION['ativo']);
		$this->setAdmin($_SESSION['admin']);
		$this->setIdEvento($_SESSION['Evento']);
		$this->setNotaTotal($_SESSION['notaTotal']);
		$this->setIdBase($_SESSION['idBase']);
	}
	public function novoUsuario ($usuario){
        $this->setIdUser($usuario->id);
        $this->setNome($usuario->nome);
        $this->setChave($usuario->chave);
        $this->setIdEvento($usuario->idEvento);
        $this->setNotaTotal($usuario->notaTotal);
        $this->setAdmin($usuario->admin);
        $this->setChefeBase($usuario->chefeBase);
        $this->setAtivo($usuario->ativo);
		$this->setIdBase($usuario->idBase);
      }
	//GET SET

	public function getNotaTotal() {
		return $this->notaTotal;
	}

	public function setNotaTotal($notaTotal) {
		$this->notaTotal= $notaTotal;
	}

	public function getIdEvento() {
		return $this->idEvento;
	}

	public function setIdEvento($idEvento) {
		$this->idEvento= $idEvento;
	}
	
	public function getAtivo() {
		return $this->ativo;
	}

	public function setAtivo($ativo) {
		$this->ativo=$ativo;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($senha) {
		$this->senha=$senha;
	}

	public function getChave() {
		return $this->chave;
	}

	public function setChave($chave) {
		$this->chave= $chave;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome) {
		$this->nome= $nome;
	}

	public function getChefeBase() {
		return $this->chefeBase;
	}

	public function setChefeBase($chefeBase) {
		$this->chefeBase= $chefeBase;
	}

	public function getIdUser() {
		return $this->idUser;
	}
	
	public function setIdUser($idUser) {
		$this->idUser=$idUser;
	}

	public function getAdmin() {
		return $this->admin;
	}
	
	public function setAdmin($admin) {
		$this->admin= $admin;
	}

	public function getIdBase() {
		return $this->idBase;
	}
	
	public function setIdBase($idBase) {
		$this->idBase=$idBase;
	}
}
?>