<?php
require_once('Base.php');
require_once('model/UsuarioModel.php');
require_once('class/Evento.php');
class Usuario extends UsuarioModel{
    
    public function entrar() {
        global $respObj;
        $this->setSenha(md5($respObj->passwd));
        $this->setChave($respObj->user);
        $this->buscaUsuarioPorChave();
        if($this->getAtivo() == 1){   
            $_SESSION['idUser'] = $this->getIdUser();
            $_SESSION['nome'] = $this->getNome();
            $_SESSION['ativo'] = $this->getAtivo();
            $_SESSION['admin'] = $this->getAdmin();
            $_SESSION['chefeBase'] = $this->getChefeBase();
            $_SESSION['Evento'] = $this->getIdEvento();
            $_SESSION['notaTotal'] = $this->getNotaTotal();
            $_SESSION['idBase'] = $this->getIdBase();
            $evento = new Evento;
            $evento = $evento->buscarEventoId();
            $_SESSION['id'] = $evento->getId();
            $_SESSION['nomeEvento'] = $evento->getNome();
            $_SESSION['inicio'] = $evento->getInicio();	
            $_SESSION['encerramento'] = $evento->getEncerramento();	
            $_SESSION['contato'] = $evento->getContato();
            $_SESSION['inscricoes'] = $evento->getInscricao();
            $_SESSION['datahora'] = $evento->getDataHora();
            $_SESSION['ativo'] = $evento->getAtivo();
            $_SESSION['imgParticipante'] = $evento->getImgParticipante();
            $_SESSION['imgCoodenacao'] = $evento->getImgCoodenacao();
        }else{?>
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Alerta!</h4>
                Usuário ou senha incorretos...
            </div><?php
        }
    }
    public function sair() {
        $_SESSION['idUser'] = null;
        $_SESSION['nome'] = null;
        $_SESSION['ativo'] = null;
        $_SESSION['admin'] = null;
        $_SESSION['chefeBase'] = null;
        $_SESSION['Evento'] = null;
        $_SESSION['notaTotal'] = null;
        $_SESSION['idBase'] = null;
        session_destroy();

    }

    public function buscaUsuarioPorChave(){
            global $mysqli;
            $slq = "SELECT * FROM user WHERE senha = '".$this->getSenha()."' AND chave = '".$this->getChave()."'";
            $login = $mysqli->query($slq);
            $acesso = $login->fetch_object();
            return $this->novoUsuario($acesso);
    }

    public function AtualizaUsuarioNotaTotal(){
        global $mysqli;
        $slq = "SELECT notaTotal FROM user WHERE  id = '".$this->getIdUser()."'";
        $login = $mysqli->query($slq);
        $acesso = $login->fetch_object();
        $_SESSION['notaTotal'] = $acesso->notaTotal;
        return $user = new Usuario;
    }
    public function AtualizaUsuarioBaseAtual(){
        global $mysqli;
        $slq = "SELECT idBase FROM user WHERE  id = '".$this->getIdUser()."'";
        $login = $mysqli->query($slq);
        $acesso = $login->fetch_object();
        $_SESSION['idBase'] = $acesso->idBase;
        return $user = new Usuario;
    }

    public function entrarUsuarioDaBase(){
        global $mysqli;
        $updateUserBase="UPDATE user SET idBase = '".$this->getIdBase()."' WHERE id = '".$this->getIdUser()."'";
        $ub = $mysqli->query($updateUserBase);
        $_SESSION['idBase'] = $this->getIdBase();
    }

    public function sairUsuarioDaBase($id){
        global $mysqli;
        $updateBase = "UPDATE user SET idBase = NULL WHERE id = '".$id."'";
        $ub = $mysqli->query($updateBase);
    }

    public function listaNotaTotal(){
        global $mysqli;
        $evento = new Evento;
        $patrulhasql = "SELECT * FROM user WHERE admin = '0' AND chefeBase = '0' AND ativo = '1' AND idEvento = '".$evento->getId()."'ORDER BY notaTotal DESC";
        $result = $mysqli->query($patrulhasql);
        return $result;
}

    public function usuarioLogado(){
        if($this->getAtivo() == true){
            if($this->getAdmin() == true){
                echo "<a class='navbar-brand' href='#'>Bem vindo Chefe ".$this->getNome()."</a>";
            }else{
                echo "<a class='navbar-brand' href='#'> Patrulha ".$this->getNome();
                if($this->getNotaTotal() > 0){
                    echo " Alerta! - <b>Pontos:</b> <i>".$this->getNotaTotal()."</i></a>";
                }else{
                    echo "</a>";
                }
            }
        }
    }
    public function usuarioAdm(){

        if( $this->getAdmin() == true){?>
            <li class='nav-item'>
                <a class='nav-link' href='ranking.php'>Ranking</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="administrar.php?tp=Usuários">Usuários</a>
                <a class="dropdown-item" href="administrar.php?tp=Bases">Bases</a>
                <a class="dropdown-item" href="administrar.php?tp=Eventos">Eventos</a>
                </div>
            </li>
        <?php }
    }
    public function entrarSair(){
        if($this->getAtivo() == 1){
            echo"
                <li class='nav-item'>
                    <a class='nav-link' href='index.php'>Bases</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'  data-toggle='modal' data-target='#Sair'>Sair</a>
                </li>
            ";
        }else{
            echo "
                <li class='nav-item'>
                    <a class='nav-link' href='#'  data-toggle='modal' data-target='#Entrar'>Entrar</a>
                </li>";
        }
    }

    public function atualizaNotaTotal($nota) {
        global $mysqli;
        $base = new Base;
        $base->burcarBasePorId($nota->getIdBase());
        if($base->getStatus() == 'Fechada'){
            $buscaNotaTotal = "SELECT notaTotal FROM user WHERE id ='".$nota->getIdUser()."'";
            $notaTotal = $mysqli->query($buscaNotaTotal);
            $evento = $notaTotal->fetch_object();
            $novoTotal = $evento->notaTotal+$nota->getNota();
            $atualizaNotaTotal = "UPDATE user SET notaTotal = '$novoTotal' WHERE id = '".$nota->getIdUser()."'";
            $not = $mysqli->query($atualizaNotaTotal);
            $_SESSION['notaTotal'] = $not;
        }
    }

    public function buscarUsuarioNomeId($id=null) {
        global $mysqli;
        if($id == null){
            $buscaUsuario= "SELECT * FROM user WHERE nome like '%".$this->getNome()."%'";
            
        }else{
            $buscaUsuario= "SELECT * FROM user WHERE id = '$id'";
        }
        $usuario = $mysqli->query($buscaUsuario);
        return $usuario; 
    }

}
?>