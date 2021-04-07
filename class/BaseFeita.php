<?php
require_once('model/BaseFeitaModel.php');
class BaseFeita extends BaseFeitaModel{
    function insereBaseFeita(){
        global $mysqli;
        $insertBaseFeita = "INSERT INTO baseFeitas (
                                        idBase, 
                                        idUser,
                                        ativo
                                    )VALUES(
                                    '".$this->getIdBase()."',
                                    '".$this->getIdUser()."',
                                    '1'
                                )";
        $in = $mysqli->query($insertBaseFeita);
    }

}
?>