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
        if(($user->getAdmin() == 1)OR($user->getChefeBase() == 1)){
            return $this->getImgCoodenacao();
        }else if($user->getAtivo()==1){
            return $this->getImgParticipante();
        }else{
            $this->setImgParticipante('2021semanaEscoteira.jpeg');
            return $this->getImgParticipante();
        }


    }
    public function carregarImagemEvento(){
        global $_FILES;
        global $mysqli;
        $upArquivo = new Upload($_FILES['imgParticipante']);
        $upArquivo->pastaDestino = "img";
        
        if($upArquivo->UploadArquivo()){
            $atualizarImgEvento = " UPDATE evento SET imgParticipante = '$upArquivo->name' WHERE id = '".$this->getId()."'";
            echo $atualizarImgEvento.'<br>';
            $ae = $mysqli->query($atualizarImgEvento);
        }

        $upArquivo = new Upload($_FILES['imgCoodenacao']);
        $upArquivo->pastaDestino = "img";
        
        if($upArquivo->UploadArquivo()){
            $atualizarImgEvento = " UPDATE evento SET imgCoodenacao = '$upArquivo->name' WHERE id = '".$this->getId()."'";
            echo $atualizarImgEvento.'<br>';
            $ae = $mysqli->query($atualizarImgEvento);
        }
        echo "<b><i>".$upArquivo->msn."</i></b>";
            
    }
    public function alterarDados(){
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
        
        //$ae = $mysqli->query($atualizarEvento);
    }
    public function CadastrarEvento(){
        global $mysqli;
        echo teste;
    }

}

?>