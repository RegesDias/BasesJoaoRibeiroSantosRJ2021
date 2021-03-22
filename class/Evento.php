<?php
require_once('model/EventoModel.php');
require_once('Usuario.php');
class Evento extends EventoModel{
    public function buscarEvento() {
        global $mysqli;
        $user = new Usuario;
        $buscaEvento= "SELECT * FROM evento WHERE id ='".$user->getIdEvento()." AND ativo = 1'";
        $be = $mysqli->query($buscaEvento);
        $nt = $be->fetch_object();
        $evento = new Evento;
        $evento->novoEvento(
            $nt->id,
            $nt->nome,
            $nt->inicio,	
            $nt->enceramento,	
            $nt->contato,
            $nt->inscricao,
            $nt->dataHora,
            $nt->ativo,
            $nt->imgParticipante,
            $nt->imgCoodenacao,
        );
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
}

?>