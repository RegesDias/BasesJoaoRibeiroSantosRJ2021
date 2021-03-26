<?php
require_once('model/EventoModel.php');
require_once('Usuario.php');
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
    public function buscarEventoNome() {
            global $mysqli;
            
            $buscaEvento= "SELECT * FROM evento WHERE nome like '%".$this->getNome()."%'";
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
    
    public Function fechaEvento(){
        global $mysqli;
        $atualizarEvento = "UPDATE evento SET ativo = '0' WHERE id = '".$this->getId()."'";
        $ae = $mysqli->query($atualizarEvento);
    }

    public Function abreEvento(){
        global $mysqli;
        $atualizarEvento = "UPDATE evento SET ativo = '1' WHERE id = '".$this->getId()."'";
        $ae = $mysqli->query($atualizarEvento);
    }
}

?>