<?php
require_once('class/Conexao.php');
require_once('Usuario.php');
require_once('Nota.php');
require_once('BaseFeita.php');
require_once('model/BaseModel.php');
class Base extends BaseModel {

  public function limpar(){
    $call = "call baseLimpar()";
    $exec = Conexao::Inst()->prepare($call);
    $exec->execute();
  }

  public function burcaPorId(){
    $call = "call baseBurcaPorId(?)";
    $exec = Conexao::Inst()->prepare($call);
    $exec->execute(array($this->getId()));
    $obj = $exec->fetchobject();
    $this->novaBase($obj);
  }

  public function cadastrar(){
    global $respObj;
    $call = "call baseCadastrar(?,?,?,?,?,?,?)";
    $exec = Conexao::Inst()->prepare($call);
    $exec->execute(array(
        $this->getNome(),
        $this->getIdUser(),
        $this->getresposavelBase(),
        $this->getLink(),
        $this->getAtiva(),
        $this->getStatus(),
        $this->getOrdem(),
    ));
  
    //$this->setId(Usuarioi->insert_id);
    //$respObj->id = Usuarioi->insert_id;
  
  }

  public function alterar(){
    $call = "call baseAtualizar(?,?,?,?,?,?,?,?,?)";
    $exec = Conexao::Inst()->prepare($call);
    $exec->execute(array(
        $this->getNome(),
        $this->getIdUser(),
        $this->getResposavelBase(),
        $this->getImg(),
        $this->getLink(),
        $this->getAtiva(),
        $this->getStatus(),
        $this->getDataHora(),
        $this->getOrdem(),
        $this->getId()

    ));
  }
  
  public function listar(){
    $evento = new Evento;
    if($evento->getAtivo() == 0){?>
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4>Alerta!</h4>
        O Evento <b><?=$evento->getNome()?></b> encontra-se fechado.
      </div><?php
    }

    $user = new Usuario;
    if($user->getChefeBase() == true){
      $call = "call baseListarChefeBase(?, ?)";
      $exec = Conexao::Inst()->prepare($call);
      $exec->execute(array($user->getIdUser(),$user->getIdEvento()));
    }else{
      $call = "call baseListar(?)";
      $exec = Conexao::Inst()->prepare($call);
      $exec->execute(array($user->getIdEvento()));
    }
    return $exec;
  }
    
  public function entrar($id){
    $user = new Usuario;
    $this->setId($id);
    $this->burcaPorId();
    if(($this->getStatus() == 'Aberta') AND ($user->getIdBase() == Null)){
        $this->fechar();
        header('Location: '.$this->getLink());
    }else{
        msn(1);
    }
  }

  public function abrirAvaliar($id){
    global $respObj;
    if($respObj->nota >0){
      $user = new Usuario;
      $this->setId($id);
      $this->burcaPorId();
      if($this->getidUser()>0){
          $nota = new Nota;
            $nota->setIdBase($this->getId(),);
            $nota->setidUser($this->getIdUser(),);
            $nota->setNota($respObj->nota);
            $nota->setDataHora(date("Y-m-d G:i:s"));
            $nota->setAvaliadoP($user->getIdUser());

          $user->atualizaNotaTotal($nota);
          $user->sairDaBase($this->getIdUser());
          $nota->insereNota();
          $basefeita = new BaseFeita;
            $basefeita->novaBaseFeita(
              $this->getId(),
              $this->getIdUser()
            );
            $basefeita->insereBaseFeita();
          
          $this->abrir();
          msn(4);
       }
    }else{
      msn(3);
    }
  }

  public function fechar(){
    $user = new Usuario;
    $call = "call baseFechar(?, ?)";
    $exec = Conexao::Inst()->prepare($call);
    $exec->execute(array($user->getIdUser(),$this->getId()));
    $user->setIdBase($this->getid());
    $user->entrarNaBase();
  }
    
  public function abrir(){
    $call = "call baseAbrir(?)";
    $exec = Conexao::Inst()->prepare($call);
    $exec->execute(array($this->getId()));
  }

public function carregarImagem(){
  global $_FILES;
  $upImg = new Upload($_FILES['img']);
  $upImg->pastaDestino = "img";
  
  if($upImg->UploadArquivo()){
      $call = "call baseCarregarImagem(?,?)";
      $exec = Conexao::Inst()->prepare($call);
      $exec->execute(array($upImg->name,$this->getId()));
  }

  echo "<br><b><i>".$upImg->msn."</i></b>";
      
}

public function exibeNota($idBase){
  $nota = new Nota;
  $nota->burcaPorId($idBase);
  echo "<button class='btn btn-large btn-block btn-primary' href='#'><b>Nota ".$nota->getNota()."</b></button>";
}

  function botoes(){
    $user = new Usuario;
    $nota = new Nota;
    if($nota->avaliado($this->getId()) == true){
        $this->exibeNota($this->getId()); 
    }else{
      if($user->usuarioAvaliador() == true){
        $this->botaoVaziaAvaliar();
      }else{
        $this->botaoAbertoFechado();
      }
    }
  }

  public function retornaNome($id){
    if($id>0){
      $call = "call baseRetornaNome(?)";
      $exec = Conexao::Inst()->prepare($call);
      $exec->execute(array($id));
      $obj = $exec->fetchobject();
      return $obj->nome;
    }
  }
  

 public function botaoVaziaAvaliar(){
  $user = new Usuario;
  if(($this->getStatus() == 'Aberta')){
      echo "<button class='btn btn-large btn-block btn-success' disabled href='#'>Vazia</button>";
  }else{
    $userNomeBase = $user->retornaNome($this->getIdUser());
    ?>

      <form method="post">
        <label><b><font color="#FFF">Avaliar Patrulha <?=$userNomeBase?></font></b></label>
        <input type="number" min="1" max="10" step="0.5" name='nota' class="form-control" placeholder="Nota"><br>

        <button type="button" class="btn btn-large btn-block btn-primary" data-toggle="modal" data-target="#avaliar<?=$this->getId()?>">
          Abrir e Avaliar
        </button>

      <!-- Modal -->
      <div class="modal fade" id="avaliar<?=$this->getId()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Avaliar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Lança nota da patrulha <?=$userNomeBase?>?
            </div>
            <div class="modal-footer">
              <input type='hidden' name='acao' value='abrirAvaliar'>
              <input type='hidden' name='id' value='<?=$this->getId()?>'>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
              <input type='submit' value='Sim' class="btn btn-primary">
            </div>
            </form>
          </div>
        </div>
      </div>
      
      
      <?php
  }
 }

 public function botaoAbertoFechado(){
  $user = new Usuario;
  $evento = new Evento;
  if(($user->getIdBase() == Null)AND ($evento->getAtivo() == 1)){
      if($this->getStatus() === 'Aberta'){?>
          <form method="post" target="_blank" action="redireciona.php" OnSubmit="recarregar()">
            <input type='hidden' name='acao' value='entrar'>
            <input type='hidden' name='id' value='<?=$this->getId()?>'>
            <input type='submit' value='Aberta' class="btn btn-large btn-block btn-success">
          </form><?php
      }else{
        echo "<button class='btn btn-large btn-block btn-danger' disabled href='#'>Fechada</button>";
      }
    }else if($this->getIdUser() == $user->getIdUser()){?>
      <a href='<?=$this->getLink()?>' target="_blank" class='btn btn-large btn-block btn-warning' style="margin-right: 5px;"><b>Entrar na base</b></a>
    <?php }else{
        echo "<button class='btn btn-large btn-block btn-danger' disabled href='#'>Fechada</button>";
    }

 }

  public function imagem(){
    echo "<a href='#'>";
    echo "<img height='700' width='50' class='card-img-top img-fluid border-radius img-thumbnail' src='img/".$this->getImg()."' alt=''>";
    echo "</a>";
  }

  public function limparApp(){
    $user = new Usuario;
    $nota = new Nota;
    $baseFeita = new BaseFeita;
    if($user->getAdmin()){
      $nota->limpar(); 
      $this->limpar();
      $user->limpar();
      $baseFeita->limpar();?>
      <br><br>
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4>Alerta!</h4>
          Sistema Limpo e pronto para novo Evento!
        </div><?php
    }

  }

}
?>