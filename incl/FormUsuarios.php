<input type="hidden" name='idUser' value="<?=$usuario->getIdUser()?>">
      <input type="hidden" name='acao' value="alterar">
      <input type="hidden" name='alterar' value="alterar">     
      <div class="container">
        <div class="form-group">
          <div class="row">
            <div class="col-lg-10">
              <label>Nome</label>
              <input type="text" name='nome' value="<?=$usuario->getNome()?>" class="form-control" placeholder="Nome">
            </div>
            <div class="col-lg-2">
            <label>Status</label>
            <?=htmlSelectStatus($usuario->getAtivo())?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Administrador</label>
              <input type="text" value="<?=$usuario->getAdmin()?>" name="admin" class="form-control" placeholder="Administrador">
            </div>
            <div class="col-lg-6">
            <label>Chefe de base</label>
            <input type="text" value="<?=$usuario->getChefeBase()?>" name="chefeBase" class="form-control" placeholder="Chefe de base">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Id do Evento</label>
              <input type="text" value="<?=$usuario->getIdEvento()?>" name="idEvento" class="form-control" placeholder="Id do evento">
            </div>
            <div class="col-lg-6">
              <label>Chefe Coordenador</label>
              <input type="text" value="<?=$usuario->getChefeCoord()?>" name="chefeCoord" class="form-control" placeholder="Chefe Coordenador">
            </div>
          </div>
          <div class="form-group">
          <div class="row">
            
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