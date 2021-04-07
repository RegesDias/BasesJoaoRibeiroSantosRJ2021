<?php
require_once('Base.php');
require_once('model/UsuarioModel.php');
require_once('class/Evento.php');
class UsuarioClass extends UsuarioModel{
    
    public function entrar() {
        global $respObj;
        $this->setSenha(md5($respObj->passwd));
        $this->setChave($respObj->user);
        $this->autenticar();
        if($this->getAtivo() == 1){   
            $_SESSION['idUser'] = $this->getIdUser();
            $_SESSION['nome'] = $this->getNome();
            $_SESSION['ativoUser'] = $this->getAtivo();
            $_SESSION['admin'] = $this->getAdmin();
            $_SESSION['chefeBase'] = $this->getChefeBase();
            $_SESSION['ChefeCoord'] = $this->getChefeCoord();
            $_SESSION['Evento'] = $this->getIdEvento();
            $_SESSION['notaTotal'] = $this->getNotaTotal();
            $_SESSION['idBase'] = $this->getIdBase();
                
                $_SESSION['usuario'] = serialize($this);
                $evento = new Evento;
                $evento = $evento->buscarEventoId();
                $_SESSION['evento'] = serialize($evento);
        }else{
            $_SESSION['erro'] = "login";
        }
    }
    public function sair() {
        session_destroy();
        header('Location:login.php');

    }

    public function autenticar(){
            global $dbh;
            $call = "call usuarioAutenticar(?, ?)";
            $stmt = $dbh->prepare($call);
            $stmt->execute(array($this->getSenha(),$this->getChave()));
            $acesso = $stmt->fetchobject();
            $this->novoUsuario($acesso);
            return $this;
    }

    public function buscarBaseOcupada(){
        global $dbh;
        $call = "call usuarioBuscarBaseOcupada(?)";
        $stmt = $dbh->prepare($call);
        $stmt->execute(array($this->getIdUser()));
        $acesso = $stmt->fetchobject();
        $_SESSION['idBase'] = $acesso->idBase;
        return $user = new Usuario;
    }

    public function entrarUsuarioDaBase(){
        global $dbh;
        $call = "call usuarioEntrarNaBase(? ,?)";
        $stmt = $dbh->prepare($call);
        $stmt->execute(array($this->getIdBase(),$this->getIdUser()));
        $_SESSION['idBase'] = $this->getIdBase();
    }

    public function sairUsuarioDaBase($id){
        global $dbh;
        $call = "call usuarioSairDaBase(?)";
        $stmt = $dbh->prepare($call);
        $stmt->execute(array($id));
    }

    public function listaRankingPorNota(){
        global $dbh;
        $evento = new Evento;
        $call = "call usuarioListaRankingPorNota(?)";
        $stmt = $dbh->prepare($call);
        $stmt->execute(array($evento->getId()));
        return $stmt;
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

public function Cadastrar(){
    global $mysqli;
    global $respObj;
    $slq="INSERT INTO user(
                            nome,
                            admin,
                            chefeBase, 
                            idEvento, 
                            chefeCoord,
                            ativo,
                            grupo,
                            chave,
                            senha
                            
                )VALUES(
                        '".$this->getNome()."',
                        '".$this->getAdmin()."',
                        '".$this->getChefeBase()."',
                        '".$this->getIdEvento()."',
                        '".$this->getchefeCoord()."',
                        '".$this->getAtivo()."',
                        '".$this->getGrupo()."',
                        '".$this->getChave()."',
                        '".md5($this->getGrupo())."'
                )
    ";
    $ae = $mysqli->query($slq);
    $this->setIdUser($mysqli->insert_id);
    $respObj->id = $mysqli->insert_id;
}

public function Alterar(){
    global $mysqli;
    $atualizarUsuario = " UPDATE user SET 
                                        nome = '".$this->getNome()."',
                                        admin = '".$this->getAdmin()."', 
                                        chefeBase = '".$this->getChefeBase()."', 
                                        chefeCoord = '".$this->getChefeCoord()."', 
                                        idEvento = '".$this->getIdEvento()."', 
                                        chave = '".$this->getChave()."', 
                                        ativo = '".$this->getAtivo()."',
                                        grupo = '".$this->getGrupo()."' 
                                WHERE 
                                        id = '".$this->getIdUser()."'";
    $ae = $mysqli->query($atualizarUsuario);
}
    public function usuarioAvaliador(){
        if(($this->getAdmin() == true) OR ($this->getChefeBase() == true) OR ($this->getChefeCoord() == true)){
            return true;
        }else{
            return false;
        }
    }
    public function usuarioLogado(){
        if($this->getAtivo() == true){
            if($this->usuarioAvaliador()){
                echo "<a class='navbar-brand' href='#'><b>Bem vindo!</b> Chefe ".$this->getNome()."</a>";
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
            if(($this->getChefeCoord() == true)OR($this->getAdmin() == true)){?>
                <li class='nav-item'>
                    <a class='btn btn-outline-success btn-sm' style="margin-right: 5px;" href='ranking.php'>Ranking</a>
                </li>
            <?php } if( $this->getAdmin() == true){?>
            <li class="nav-item dropdown">
                <a class="btn btn-outline-success dropdown-toggle btn-sm" style="margin-right: 5px;" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <div class="vertical-menu">
                    <a class="dropdown-item" href="administrar.php?tp=Usuários">Usuários</a>
                    <a class="dropdown-item" href="administrar.php?tp=Bases">Bases</a>
                    <a class="dropdown-item" href="administrar.php?tp=Eventos">Eventos</a>
                </div>
                </div>
            </li>
        <?php }
    }
    public function entrarSair(){
        if($this->getAtivo() == 1){
            echo"
                <li class='nav-item'>
                    <a class='btn btn-outline-success btn-sm' href='#'  data-toggle='modal' data-target='#Sair'>Sair</a>
                </li>
            ";
        }
    }


}
?>