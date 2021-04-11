<?php
require_once('model/EventoModel.php');
require_once("Upload.php");
class Evento extends EventoModel{

    public function burcaPorId() {
        $user = new Usuario;
        $call = "call eventoBuscarPorId(?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array($user->getIdEvento()));
        $obj = $exec->fetchobject();
        $this->novoEvento($obj); 
    }

    public function buscaPorIdNome($id=null) {
        if($id == null){
            $call = "call eventoBuscarPorNome(?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array('%'.$this->getNome().'%'));
        }else{
            $call = "call eventoBuscarPorId(?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array($id));
        }
        return $exec;
    }

    public function buscarBanner() {
        $user = new Usuario;
        if($user->getChefeCoord() == 1){
            return $this->getImgCoodenacao();
        }else if($user->getChefeBase()==1){
            return $this->getImgChefeBase();
        }else if($user->getAtivo()==1){
            return $this->getImgParticipante();
        }
    }

    public function carregarImagem(){
        global $_FILES;

        $upImgParticipante = new Upload($_FILES['imgParticipante']);
        $upImgParticipante->pastaDestino = "img";
        if($upImgParticipante->UploadArquivo()){
            $call = "call eventoImgParticipante(?,?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array($this->getId(),$upImgParticipante->name));
        }

        $upImgCoodenacao = new Upload($_FILES['imgCoodenacao']);
        $upImgCoodenacao->pastaDestino = "img";
        if($upImgCoodenacao->UploadArquivo()){
            $call = "call eventoImgCoodenacao(?,?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array($this->getId(),$upImgCoodenacao->name));
        }

        $upImgChefeBase= new Upload($_FILES['imgChefeBase']);
        $upImgChefeBase->pastaDestino = "img";
        if($upImgChefeBase->UploadArquivo()){
            $call = "call eventoImgChefeBase(?,?)";
            $exec = Conexao::Inst()->prepare($call);
            $exec->execute(array($this->getId(),$upImgChefeBase->name));
        }
        
        echo "<br><b><i>".$upImgChefeBase->msn."</i></b>";
        echo "<br><b><i>".$upImgCoodenacao->msn."</i></b>";
        echo "<br><b><i>".$upImgParticipante->msn."</i></b>";
            
    }
    public function alterar(){
        $call = "call eventoAlterar(?,?,?,?,?,?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
                        $this->getNome(),
                        $this->getInicio(),
                        $this->getEncerramento(),
                        $this->getContato(),
                        $this->getInscricao(),
                        $this->getAtivo(),
                        $this->getId()
        ));
    }

    public function cadastrar(){
        global $respObj;
        $call = "call eventoCadastrar(?,?,?,?,?,?)";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute(array(
                        $this->getNome(),
                        $this->getInicio(),
                        $this->getEncerramento(),
                        $this->getInscricao(),
                        $this->getContato(),
                        $this->getAtivo()
        ));
        //$this->setId(Usuarioi->insert_id);
        //$respObj->id = Usuarioi->insert_id;
    }
    public function htmlSelectEvento($id) {
        $call = "call eventoListar()";
        $exec = Conexao::Inst()->prepare($call);
        $exec->execute();

        echo "<select class='form-control' name='idEvento'>";
        while ($nt = $exec->fetchobject()){
            $status = null;
            if($id == $nt->id){
                $status = 'selected';
            }
            echo "<option $status value='$nt->id'>$nt->nome</option>";
        }
        echo "</select>";
    }

}

?>