<?php
require_once('class/Conexao.php');
require_once('model/BaseFeitaModel.php');
class BaseFeita extends BaseFeitaModel{

    public function limpar(){
        $call = "call baseFeitasLimpar()";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute();
    }

    function cadastrar(){
        $date = new DateTime();
        $date->getTimestamp();
        $data = $date->format('Y-m-d H:i:s');
        $call = "call baseFeitasCadastrar(?,?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
            $this->getIdBase(),
            $this->getIdUser(),
            $data
        ));
    }

    public function buscaPorIdBase($idBase) {
        $call = "call baseFeitaBuscaPorIdBase(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($idBase));
        return $exec;
    }

    function sair(){
        $date = new DateTime();
        $date->getTimestamp();
        $data = $date->format('Y-m-d H:i:s');
        $call = "call baseFeitaSaida(?,?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
            $this->getIdBase(),
            $this->getIdUser(),
            $data
        ));
    }

    function contarPatrulhas($idBase){
        $call = "call baseFeitaContarPatrulhas(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($idBase));
        $obj = $exec->fetchobject();
        return $obj;
    }
}
?>