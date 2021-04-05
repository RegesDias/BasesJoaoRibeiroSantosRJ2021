<?php
require_once('model/EventoModel.php');
require_once('Usuario.php');
require_once("Upload.php");
class Evento extends EventoModel{
    public function buscarEventoId() {
        global $mysqli;
        $user = new Usuario;
        $buscaEvento= "SELECT * FROM evento WHERE id ='".$user->getIdEvento()." AND ativo = 1'";
        $be = $mysqli->query($buscaEvento);
        $nt = $be->fetch_object();
        $evento = new Evento;
        $evento->novoEvento($nt);
        return $evento;
    }
    public function buscarEventoNomeId($id=null) {
            global $mysqli;
            if($id == null){
                $buscaEvento= "SELECT * FROM evento WHERE nome like '%".$this->getNome()."%'";
                
            }else{
                $buscaEvento= "SELECT * FROM evento WHERE id = '$id'";
            }
            $evento = $mysqli->query($buscaEvento);
            return $evento;
    }
    public function buscarBanner() {
        $user = new Usuario;
        if($user->getAdmin() == 1){
            return $this->getImgCoodenacao();
        }else if($user->getChefeBase()==1){
            return $this->getImgChefeBase();
        }else if($user->getAtivo()==1){
            return $this->getImgParticipante();
        }else{
            $this->setImgParticipante('2021semanaEscoteira.jpeg');
            return $this->getImgParticipante();
        }


    }
    public function carregarImagem(){
        global $_FILES;
        global $mysqli;
        $upImgParticipante = new Upload($_FILES['imgParticipante']);
        $upImgParticipante->pastaDestino = "img";
        
        if($upImgParticipante->UploadArquivo()){
            $sql = " UPDATE evento SET imgParticipante = '$upImgParticipante->name' WHERE id = '".$this->getId()."'";
            $ae = $mysqli->query($sql);
        }

        $upImgCoodenacao = new Upload($_FILES['imgCoodenacao']);
        $upImgCoodenacao->pastaDestino = "img";
        
        if($upImgCoodenacao->UploadArquivo()){
            $sql = " UPDATE evento SET imgCoodenacao = '$upImgCoodenacao->name' WHERE id = '".$this->getId()."'";
            $ae = $mysqli->query($sql);
        }
        echo "<br><b><i>".$upImgCoodenacao->msn."</i></b>";
        echo "<br><b><i>".$upImgParticipante->msn."</i></b>";
            
    }
    public function Alterar(){
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
    public function Cadastrar(){
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

}

?>