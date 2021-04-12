<?php
require_once('class/Conexao.php');
require_once('model/BaseFeitaModel.php');
class BaseFeita extends BaseFeitaModel{

    public function limpar(){
        $call = "call baseFeitasLimpar()";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute();
    }

    function insereBaseFeita(){
        $call = "call baseFeitasCadastrar(?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
            $this->getIdBase(),
            $this->getIdUser()
        ));
    }
}
?>