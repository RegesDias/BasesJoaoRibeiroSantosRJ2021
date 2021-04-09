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
        global $mysqli;

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
        global $mysqli;
        $atualizarEvento = " UPDATE evento SET 
                                            nome = '".$this->getNome()."',
                                            inicio = '".$this->getInicio()."', 
                                            encerramento = '".$this->getEncerramento()."', 
                                            contato = '".$this->getContato()."', 
                                            inscricao = '".$this->getInscricao()."', 
                                            ativo = '".$this->getAtivo()."' 
                                    WHERE 
                                            id = '".$this->getId()."'";
        $ae = $mysqli->query($atualizarEvento);
    }
    public function cadastrar(){
        global $mysqli;
        global $respObj;
        $slq="INSERT INTO evento(
                                nome,
                                inicio,
                                encerramento, 
                                inscricao, 
                                contato,
                                ativo
                    )VALUES(
                            '".$this->getNome()."',
                            '".$this->getInicio()."',
                            '".$this->getEncerramento()."',
                            '".$this->getInscricao()."',
                            '".$this->getContato()."',
                            '".$this->getAtivo()."'
                    )
        ";
        $ae = $mysqli->query($slq);
        $this->setId($mysqli->insert_id);
        $respObj->id = $mysqli->insert_id;
    }
    public function htmlSelectEvento($id) {
        global $mysqli;
        $buscaEvento= "SELECT * FROM evento";
        $be = $mysqli->query($buscaEvento);
        echo "<select class='form-control' name='idEvento'>";
        while ($nt = $be->fetch_object()){
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