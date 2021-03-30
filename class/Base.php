<?php
require_once('Usuario.php');
require_once('Nota.php');
require_once('BaseFeita.php');
require_once('model/BaseModel.php');
class Base extends BaseModel {
    public function listar(){
        $user = new Usuario;
        $evento = new Evento;
        global $mysqli;
        if($user->getChefeBase() == true){
          $basesql = "SELECT 
                                base.id,
                                base.ordem,
                                base.idUser,
                                base.idEvento,
                                base.ResposavelBase,
                                base.nome,
                                base.img,
                                base.link,
                                base.status,
                                base.ativa,
                                base.dataHora
                             FROM
                                  base,
                                  evento
                                WHERE
                                  base.idevento = evento.id AND
                                  evento.ativo = '1' AND
                                  ResposavelBase = '$user->getIdUser()' AND 
                                  idEvento = '".$user->getIdEvento()."' 
                                ORDER BY ordem ";
        }else{
          $basesql = "SELECT 
                                base.id,
                                base.ordem,
                                base.idUser,
                                base.idEvento,
                                base.ResposavelBase,
                                base.nome,
                                base.img,
                                base.link,
                                base.status,
                                base.ativa,
                                base.dataHora          
                          FROM
                                    base,
                                    evento 
                                  WHERE 
                                    base.idevento = evento.id AND
                                    evento.ativo = '1' AND
                                    idEvento = '".$user->getIdEvento()."' 
                                  ORDER BY ordem";
        }
        $bases = $mysqli->query($basesql);
        if($bases->num_rows == 0){?>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Alerta!</h4>
            O Evento <b><?=$evento->getNome()?></b> encontra-se fechado.
          </div><?php
        }
        return $bases;
    }
 
    public function imagem(){
      echo "<a href='#'>";
      echo "<img height='700' width='50' class='card-img-top img-fluid border-radius img-thumbnail' src='img/".$this->getImg()."' alt=''>";
      echo "</a>";
    }
    
    public function entrar($id){
          global $mysqli;
          $user = new Usuario;
          $this->burcarBasePorId($id);
          if(($this->getStatus() == 'Aberta') AND ($user->getIdBase() == Null)){
              $this->fecharBase();
              header('Location: '.$this->getLink());
          }else{?>
              <div class="alert alert-warning">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <h4>Alerta!</h4>
              Foi quase... mas infelizmente esta base já foi acessada
              </div><?php
          }
    }

    public function fecharBase(){
      global $mysqli;
      $user = new Usuario;
      $updateBase="UPDATE base SET status = 'Fechada', idUser = '".$user->getIdUser()."' WHERE id = '".$this->getId()."'";
      $ub = $mysqli->query($updateBase);
      $user->setIdBase($this->getid());
      $user->entrarUsuarioDaBase();
    }

    public function abrirAvaliar($id){
        global $respObj;
        $user = new Usuario;
        $this->burcarBasePorId($id);

        $nota = new Nota;
        $nota->setIdBase($this->getId(),);
        $nota->setidUser($this->getIdUser(),);
        $nota->setNota($respObj->nota);
        $nota->setDataHora(date("Y-m-d G:i:s"));
        $nota->setAvaliadoP($user->getIdUser());
        $user->atualizaNotaTotal($nota);
        $user->sairUsuarioDaBase($this->getIdUser());
        $nota->insereNota();
        $basefeita = new BaseFeita;
        $basefeita->novaBaseFeita(
          $this->getId(),
          $this->getIdUser()
        );
        
        $basefeita->insereBaseFeita();

        $this->setStatus('Aberta');
        $this->atualizaStatus();

    }
    public Function atualizaStatus (){
      global $mysqli;
      $atualizarBase = "UPDATE base SET status = '".$this->getStatus()."' WHERE id = '".$this->getId()."'";
      $ab = $mysqli->query($atualizarBase);
    }


 public function exibeNota($idBase){
    $nota = new Nota;
    $nota->burcarNotaPorId($idBase);
    echo "<button class='btn btn-large btn-block ' disabled href='#'>Nota ".$nota->getNota()."</button>";
 }

 //BOTOES ##################################################
 function botoes(){
    $user = new Usuario;
    $nota = new Nota;
    if($nota->avaliado($this->getId()) == true){
        $this->exibeNota($this->getId()); 
    }else{
      if(($user->getAdmin()!= true)){
        $this->botaoAbertoFechado();
      }else{
        $this->botaoVaziaAvaliar();
      }
    }
 }

 public function botaoVaziaAvaliar(){
  $user = new Usuario;
  if(($this->getStatus() == 'Aberta') and ($user->getAdmin() == true)){
      echo "<button class='btn btn-large btn-block btn-success' disabled href='#'>Vazia</button>";
  }else{ ?>
      <form method="post">
      <label>Avaliar Patrulha <?=retornaNome($this->getIdUser() ,'user')?></label>
      <input type="number" min="1" max="10" step="0.5" name='nota' class="form-control" placeholder="Nota">
      <input type='hidden' name='acao' value='abrirAvaliar'>
      <input type='hidden' name='id' value='<?=$this->getId()?>'>
      <label></label>
      <input type='submit' value='Abrir e Avaliar' class="btn btn-large btn-block btn-primary">
      </form><?php
  }
 }

 public function botaoAbertoFechado(){
   $user = new usuario;
  if($user->getIdBase() == Null){
      if($this->getStatus() === 'Aberta'){?>
          <form method="post" target="_blank" action="redireciona.php" OnSubmit="recarregar()">
            <input type='hidden' name='acao' value='entrar'>
            <input type='hidden' name='id' value='<?=$this->getId()?>'>
            <input type='submit' value='Aberta' class="btn btn-large btn-block btn-success">
          </form><?php
      }else{
        echo "<button class='btn btn-large btn-block btn-danger' disabled href='#'>Fechada</button>";
      }
    }else{
        echo "<button class='btn btn-large btn-block btn-danger' disabled href='#'>Fechada</button>";
    }
 }
 

 public function burcarBasePorId($id){
    global $mysqli;
    $sql = "SELECT * FROM base WHERE id = '$id' ";
    $buscaBase = $mysqli->query($sql);
    $bb = $buscaBase->fetch_object();
    //$base = new Base;
    $this->novaBase($bb);
}

}
?>