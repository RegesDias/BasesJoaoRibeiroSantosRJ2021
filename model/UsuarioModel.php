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

	//CONSTRUTOR
	public function __construct(){
		$this->setChefeBase($_SESSION['chefeBase']);
		$this->setAdmin($_SESSION['admin']);
		$this->setIdUser($_SESSION['idUser']);
		$this->setAtivo($_SESSION['ativo']);
		$this->setNome($_SESSION['nome']);
	}
	//GET SET

	public function getNotaTotal() {
		return $this->notaTotal;
	}

	public function setNotaTotal($notaTotal) {
		$this->notaTotal= $notaTotal;
	}
	
	public function getAtivo() {
		return $this->ativo;
	}

	public function setAtivo($ativo) {
		$this->senha= $ativo;
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
}
?>