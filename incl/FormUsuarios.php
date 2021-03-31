<input type="hidden" name='id' value="<?=$usuario->getIdUser()?>">
      <input type="hidden" name='acao' value="alterar">
      <input type="hidden" name='alterar' value="alterar">     
      <div class="container">
      <!--
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
              <label>Início</label>
              <input type="datetime-local" value="<?=$usuario->getInicio()?>" name="inicio" class="form-control" placeholder="Início">
            </div>
            <div class="col-lg-6">
            <label>Encerramento</label>
            <input type="datetime-local" value="<?=$usuario->getEncerramento()?>" name="encerramento" class="form-control" placeholder="Encerramento">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Contato</label>
              <input type="email" value="<?=$usuario->getContato()?>" name="contato" class="form-control" placeholder="Contato">
            </div>
            <div class="col-lg-6">
              <label>Inscrição</label>
              <input type="text" value="<?=$usuario->getInscricao()?>" name="inscricao" class="form-control" placeholder="inscricao">
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
        -->
      </div>