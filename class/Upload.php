<?php
$url = $_SERVER["PHP_SELF"];
if(preg_match("Upload.php", "$url")){
    header("Location: ../index.php");
}

class Upload{
    //Extenções permitidas
    var $ext = array (".gif",".jpg",".jpeg",".png");
    var $pastaDestino;
    var $final_name;
    var $msn;

    //Dados Arquivo
    var $name;
    var $type;
    var $tmp_name;
    var $error;
    var $size;

    function __construct($arq){
        $this->name = $arq['name'];
        $this->type = $arq['type'];
        $this->tmp_name = $arq['tmp_name'];
        $this->error = $arq['error'];
        $this->size = $arq['size'];
    }

    public function novoNomePasta(){
        $partes =explode('/',$this->type);
        $ext = strtolower(".".$partes['1']);
        $this->name = md5(date("dmYHis")).$ext;
        $this->final_name = $this->pastaDestino."/".$this->name; 
    }
    public function verificarExtencao(){
        for($i=0;$i<=count($this->ext);$i++){
            if($this->ext[$i] == $this->type){
                $arquivoPermitido=true;
            }
        }
        if($arquivoPermitido==false){
            $this->msn .= "Extensão de arquivo não permitido!";
        }
        return $arquivoPermitido;
    }

    function UploadArquivo(){
        if($this->error == 0){
            $this->novoNomePasta();
            if ($this->verificarExtencao()){
                if (move_uploaded_file($this->tmp_name, $this->final_name)){
                    return true;
                }else{
                    $this->msn .= " Falha no envio!";
                    return false;
                }
            }
        }
    }
}
?>