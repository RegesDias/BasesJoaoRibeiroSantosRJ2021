<?php
require_once('class/Conexao.php');
require_once('model/NotaModel.php');
class Nota extends NotasModel{

    public function limpar(){
        $call = "call notasLimpar()";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute();
    }

    function burcaPorId($idBase){
        $user = new Usuario;
        $call = "call notaBurcaPorId(?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($user->getIdUser(),$idBase));
        $obj = $exec->fetchobject();
        $this->novaNota($obj);
    }
    public function exibeNota($idBase){
        $this->burcaPorId($idBase);
        echo "<button class='btn btn-large btn-block btn-primary' href='#'><b>Nota ".$this->getNota()."</b></button>";
      }

    function insereNota(){
        $call = "call notaCadastrar(?,?,?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
            $this->getIdBase(),
            $this->getIdUser(),
            $this->getNota(),
            $this->getAvaliadoPor()
        ));
    }

    function avaliado($idBase,$idUser){
        $call = "call notaBurcaPorId(?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($idUser,$idBase));
        $obj = $exec->fetchobject();
        $this->novaNota($obj);
        if($this->getIdBase() != '' ){
            return true;
        }else{
            return false;
        }
    }
}
?>