<?php
    class Usuario{

        private $idUser;
        private $nome;
        private $chave;
        private $senha;
        private $ativo;
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
            $this->senha= $senha;
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
            $this->idUser= $idUser;
        }
        public function getAdmin() {
            return $this->admin;
        }
        public function setAdmin($admin) {
            $this->admin= $admin;
        }
        //FUNCOES

        public function logar($admin) {
            global $respObj;
            global $mysqli;
            $senha  = md5($respObj->passwd);
            if ($login = $mysqli->query("SELECT * FROM user WHERE senha = '$senha' AND chave = '$respObj->user'")) {
                $acesso = $login->fetch_object();
                $_SESSION['ativo'] = false;
                $_SESSION['admin'] = false;
                $_SESSION['chefeBase'] = false;
                    if($acesso->ativo == 1){    
                        $_SESSION['idUser'] = $acesso->id;
                        $_SESSION['nome'] = $acesso->nome;
                        $_SESSION['ativo'] = true;
                        if($acesso->admin == 1){
                            $_SESSION['admin'] = true;
                        }
                        if($acesso->chefeBase == 1){
                            $_SESSION['chefeBase'] = true;
                        }
                    }else{?>
                        <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4>Alerta!</h4>
                            Usuário ou senha incorretos...
                        </div><?php
                    }
            }
        }
    }
?>