
<?php
require_once('model/UsuarioModel.php');
class Usuario extends UsuarioModel{
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
    public function atualizaNotaTotal($nota) {
            global $mysqli;
            //Atualiza nota total
            $notaTotal = $mysqli->query("SELECT notaTotal FROM user WHERE id ='".$nota->idUser."'");
            //$nt = $notaTotal->fetch_object();
            $novoTotal = $nt->notaTotal+$nota;
            //$not = $mysqli->query("UPDATE user SET notaTotal = '$novoTotal' WHERE id = '$idUser'");
    }
}
?>