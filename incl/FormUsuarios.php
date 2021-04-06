<input type="hidden" name='idUser' value="<?=$usuario->getIdUser()?>">
      <input type="hidden" name='acao' value="alterar">
      <input type="hidden" name='alterar' value="alterar">     
      <div class="container">
        <div class="form-group">
          <div class="row">
            <div class="col-lg-8">
              <label>Nome</label>
              <input type="text" name='nome' value="<?=$usuario->getNome()?>" class="form-control" placeholder="Nome">
            </div>
            <div class="col-lg-2">
            <label>Chave</label>
              <input type="text" name='chave' value="<?=$usuario->getChave()?>" class="form-control" placeholder="chave">
            </div>
            <div class="col-lg-2">
            <label>Status</label>
              <?=htmlSelectStatus($usuario->getAtivo())?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-4">
              <label>Administrador</label>
                <?=htmlSelectSimNao($usuario->getAdmin(), "admin")?>
            </div>
            <div class="col-lg-4">
            <label>Chefe de base</label>
              <?=htmlSelectSimNao($usuario->getChefeBase(), "chefeBase")?>
            </div>
            <div class="col-lg-4">
              <label>Chefe Coordenador</label>
              <?=htmlSelectSimNao($usuario->getChefeCoord(), "chefeCoord")?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Id do Evento</label>
              <?php $evento->htmlSelectEvento($usuario->getIdEvento())?>  
            </div>
            <div class="col-lg-6">
                <label>Grupo Escoteiro</label>
                <input type="text" value="<?=$usuario->getGrupo()?>" name="grupo" class="form-control" placeholder="Grupo Escoteiro">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-10">
          </div>
            <div class="col-lg-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </div>



  <!-- Select2 -->
  <link rel="stylesheet" href="css/select2.min.css">

                  <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                    <option>Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
              

<!-- jQuery -->
<script src="jquery/jquery.min.js"></script>
<!-- Select2 -->
<script src="js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>