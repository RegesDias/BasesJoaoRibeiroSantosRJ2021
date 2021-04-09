<?php
require_once('class/Conexao.php');
require_once('model/NotaModel.php');
class Nota extends NotasModel{

    function burcaPorId($idBase){
        $user = new Usuario;
        $call = "call notaBurcaPorId(?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($user->getIdUser(),$idBase));
        $obj = $exec->fetchobject();
        $this->novaNota($obj);
        $exec->closeCursor();
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
    
    public function avaliado($idBase){
        $user = new Usuario;
        $this->burcaPorId($idBase);
        if($this->getIdBase() != '' ){
            return true;
        }else{
            return false;
        }
   }
}
?>