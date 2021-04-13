<?php
session_start();
//EXIBIR ERROS
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
  ini_set("display_errors", 1);
//FILTROS
    $respObj = (object) filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $respGet = (object) filter_input_array(INPUT_GET, FILTER_DEFAULT);

//OBJETOS
    require_once('class/Usuario.php');
    require_once('class/Evento.php');
    $user = new Usuario;
    $user->buscarBaseOcupada();
    $evento = new Evento;

//TESTE DE SESSAO
    if($respObj->entrarSair == '1'){
      $acao = $respObj->acao;
      $id = $respObj->id;
      $user->$acao($id);
      $user = new Usuario;
    }

//FUNÇOES GENERICAS

    function msn ($i, $msn=null){

      if(isset($msn[2])){
        $i = 99;
      }

      switch ($i) {
        case 0:
            return null;
        case 1:
          $tipo ='warning';
          $titulo ='Alerta!';
          $texto = 'Foi quase... mas infelizmente esta base já foi acessada';
          break;
        case 2:
          $tipo ='danger';
          $titulo ='Alerta!';
          $texto = 'Usuário ou senha incorretos...';
          break;
        case 3:
          $tipo ='danger';
          $titulo ='Alerta!';
          $texto = 'É necessario Preencher a nota';
          break;
        case 4:
            $tipo ='success';
            $titulo ='Avaliado';
            $texto = 'Nota lançada com sucesso!';
            break;
        case 5:
          $tipo ='success';
          $titulo ='Sucesso';
          $texto = 'Cadastramento Executado!';
          break;
        case 6:
            $tipo ='success';
            $titulo ='Sucesso';
            $texto = 'Alteração Executada!';
            break;
        case 99:
          $tipo ='danger';
          $titulo ='Erro';
          $texto = $msn[2];
          break;
      }    
      
      echo "<div class='alert alert-$tipo'>";
      echo "<button type='button' class='close' data-dismiss='alert'>×</button>";
      echo "<h4>$titulo</h4>";
      echo  $texto;
      echo "</div>";
    }

  function dataHoraBr($data){
    $dt = new DateTime($data);
    return $dt->format('Y-m-d\TH:i:s');
  }

  function exibeDataHoraBr($data){
    $dt = new DateTime($data);
    return $dt->format('d-m-Y H:i');
  }

  function print_p($obj){
    echo "<pre>";
      print_r($obj);
    echo "</pre>";
  }
  function tirarAcentos($string){
    return preg_replace(array(
                            "/(á|à|ã|â|ä)/",
                            "/(Á|À|Ã|Â|Ä)/",
                            "/(é|è|ê|ë)/",
                            "/(É|È|Ê|Ë)/",
                            "/(í|ì|î|ï)/",
                            "/(Í|Ì|Î|Ï)/",
                            "/(ó|ò|õ|ô|ö)/",
                            "/(Ó|Ò|Õ|Ô|Ö)/",
                            "/(ú|ù|û|ü)/",
                            "/(Ú|Ù|Û|Ü)/",
                            "/(ñ)/",
                            "/(Ñ)/"
                            ),
                            explode(" ","a A e E i I o O u U n N"),$string);
  }
  function htmlSelectStatus($status){
    if($status == 1){
      $status = 'selected';
    }
    $Html="
          <select class='form-control' name='ativo'>
              <option value='0'>Inativo</option>
              <option $status value='1'>Ativo</option>
          </select>";
    return $Html;
  }
  function htmlSelectSimNao($status, $name){
    if($status == 1){
        $status = 'selected';
    }
    $Html="
          <select class='form-control' name='$name'>
              <option value='0'>Não</option>
              <option $status value='1'>Sim</option>
          </select>";
    return $Html;
  }
  function htmlModal($idModal, $texto, $id){?>
      <div class="modal fade" id="<?=$idModal?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Avaliar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?=$texto?>
            </div>
            <div class="modal-footer">
              <input type='hidden' name='acao' value='abrirAvaliar'>
              <input type='hidden' name='id' value='<?=$id?>'>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
              <input type='submit' value='Sim' class="btn btn-primary">
            </div>
          </div>
        </div>
      </div>
  <?php }

  function status($status){
    if($status == 1){
        $status = 'Ativo';
    }else{
      $status = 'Inativo';
    }
    return $status;
  }
  ?>