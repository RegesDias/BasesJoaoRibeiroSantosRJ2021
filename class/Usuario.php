<?php
require_once('class/Conexao.php');
require_once('class/Base.php');
require_once('class/Evento.php');
require_once('model/UsuarioModel.php');

class Usuario extends UsuarioModel{

    public function limpar(){
        $call = "call usuarioLimpar()";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute();
    }

    public function burcaPorId($id){
        $call = "call usuarioBuscaPorId(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($id));
        $obj = $exec->fetchobject();
        $this->novoUsuario($obj);
      }

    public function buscaPorIdNome($id=null) {
        if($id == null){
            $call = "call usuarioBuscaPorNome(?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array('%'.$this->getNome().'%'));
        }else{
            $call = "call usuarioBuscaPorId(?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array($id));
        }
        return $exec;
    }

    public function cadastrar(){
        global $respObj;
        $call = "call usuarioCadastrar(?,?,?,?,?,?,?,?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
            $this->getNome(),
            $this->getAdmin(),
            $this->getChefeBase(),
            $this->getIdEvento(),
            $this->getChefeCoord(),
            $this->getAtivo(),
            $this->getGrupo(),
            $this->getChave(),
            MD5($this->getIdUser())
        ));
        msn(5,$exec->errorInfo());
        
    }

    public function alterar(){
        $call = "call usuarioAtualizar(?,?,?,?,?,?,?,?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
            $this->getNome(),
            $this->getAdmin(),
            $this->getChefeBase(),
            $this->getChefeCoord(),
            $this->getIdEvento(),
            $this->getChave(),
            $this->getAtivo(),
            $this->getGrupo(),
            $this->getIdUser()
        ));
        msn(6,$exec->errorInfo());
    }

    public function retornaNome($id){
        $call = "call usuarioRetornaNome(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($id));
        $obj = $exec->fetchobject();
        return $obj->nome;
    }

    public function entrar() {
        global $respObj;
        $this->setSenha(md5($respObj->passwd));
        $this->setChave($respObj->user);
        $this->autenticar();
        if($this->getAtivo() == 1){   
            $_SESSION['usuario'] = serialize($this);
            $_SESSION['NotaTotal'] = $this->getNotaTotal();
			$_SESSION['IdBase'] = $this->getIdBase();
            $evento = new Evento;
            $evento->burcaPorId();
            $_SESSION['evento'] = serialize($evento);
            $_SESSION['eventoAtivo'] = $evento->getAtivo();
            header('Location:index.php');
        }else{
            header('Location:login.php?id=login');
        }
    }

    public function sair() {
        session_destroy();
        header('Location:login.php');

    }

    public function autenticar(){
        $call = "call usuarioAutenticar(?, ?)";
        $conexao = new Conexao();
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($this->getSenha(),$this->getChave()));
        $obj = $exec->fetchobject();
        $this->novoUsuario($obj);
        return $this;
    }

    public function buscarBaseOcupada(){
        if(isset($_SESSION['usuario'])){
            $call = "call usuarioBuscaBaseOcupada(?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array($this->getIdUser()));
            $obj = $exec->fetchobject();
            $_SESSION['IdBase'] = $obj->idBase;
            return $user = new Usuario;
        }
    }

    public function entrarNaBase(){
        $call = "call usuarioEntrarNaBase(? ,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($this->getIdBase(),$this->getIdUser()));
        unserialize($_SESSION['usuario'])->setIdBase($this->getIdBase());
    }

    public function sairDaBase($id){
        $call = "call usuarioSairDaBase(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($id));
    }

    public function listaRankingPorNota(){
        $evento = new Evento;
        $call = "call usuarioListaRankingPorNota(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($evento->getId()));
        return $exec;
    }

    public function atualizaNotaTotal($nota) {
        $base = new Base;
        $base->setId($nota->getIdBase());
        $base->burcaPorId();
        if($base->getIdUser() != NULL){
            $notaTotal = $this->buscaNotaTotal($nota->getIdUser());
            $novoTotal = $notaTotal+$nota->getNota();
            $call = "call usuarioAtualizaNotaTotal(?,?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array($novoTotal,$nota->getIdUser()));
            $_SESSION['NotaTotal'] = $notaTotal;
        }
    }

    public function usuarioAvaliador(){
        if(($this->getAdmin() == true) OR ($this->getChefeBase() == true) OR ($this->getChefeCoord() == true)){
            return true;
        }else{
            return false;
        }
    }

    public function buscaNotaTotal($id){
        $call = "call usuarioBuscaNotaTotal(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($id));
        $obj = $exec->fetchobject();
        return $obj->notaTotal;
    }

    public function usuarioLogado(){
        if($this->getAtivo() == true){
            if($this->usuarioAvaliador()){
                echo "<a class='navbar-brand' href='#'><b>Bem vindo!</b> Chefe ".$this->getNome()."</a>";
            }else{
                echo "<a class='navbar-brand' href='#'> Patrulha ".$this->getNome();
                $notaTotalMenu = $this->buscaNotaTotal($this->getIdUser());
                if($notaTotalMenu > 0){
                    echo " Alerta! - <b>Pontos:</b> <i>".$notaTotalMenu."</i></a>";
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
                <li class='nav-item'>
                    <a class='btn btn-outline-success btn-sm' style="margin-right: 5px;" href='evolucao.php'>Evolução</a>
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
                    <a class='dropdown-item' href='#'  data-toggle='modal' data-target='#limpar'>Limpar Eventos</a>
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