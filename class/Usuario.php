<?php
require_once('Base.php');
require_once('model/UsuarioModel.php');
class Usuario extends UsuarioModel{
    public function logar() {
        global $respObj;
        global $mysqli;
        $senha  = md5($respObj->passwd);
        if ($login = $mysqli->query("SELECT * FROM user WHERE senha = '$senha' AND chave = '$respObj->user'")) {
            $acesso = $login->fetch_object();
                if($acesso->ativo == 1){    
                    $_SESSION['idUser'] = $acesso->id;
                    $_SESSION['nome'] = $acesso->nome;
                    $_SESSION['ativo'] = $acesso->ativo;
                    $_SESSION['admin'] = $acesso->admin;
                    $_SESSION['chefeBase'] = $acesso->chefeBase;
                    $_SESSION['Evento'] = $acesso->idEvento;
                }else{?>
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4>Alerta!</h4>
                        Usuário ou senha incorretos...
                    </div><?php
                }
        }
    }
    public function sair() {
        $_SESSION['idUser'] = null;
        $_SESSION['nome'] = null;
        $_SESSION['ativo'] = null;
        $_SESSION['admin'] = null;
        $_SESSION['chefeBase'] = null;
        $_SESSION['Evento'] = null;

    }
    public function atualizaNotaTotal($nota) {
            global $mysqli;
            $base = new Base;
            $base = $base->burcarBasePorId($nota->getIdBase());
            if($base->getStatus() == 'Fechada'){
                $buscaNotaTotal = "SELECT notaTotal FROM user WHERE id ='".$nota->getIdUser()."'";
                $notaTotal = $mysqli->query($buscaNotaTotal);
                $nt = $notaTotal->fetch_object();
                $novoTotal = $nt->notaTotal+$nota->getNota();
                $atualizaNotaTotal = "UPDATE user SET notaTotal = '$novoTotal' WHERE id = '".$nota->getIdUser()."'";
                $not = $mysqli->query($atualizaNotaTotal);
            }
    }
}
?>