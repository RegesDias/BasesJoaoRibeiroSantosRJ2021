      <input type="hidden" name='id' value="<?=$evento->getId()?>">
      <input type="hidden" name='acao' value="alterar">
      <input type="hidden" name='alterar' value="alterar">
      <div class="container">
        <!-- Gallery -->
        <div class="row">
          <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
            <div class="card">
                <img
                src="img/<?=$evento->getImgParticipante()?>"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body">
                  <h5 class="card-title">Capa</h5>
                  <p class="card-text">
                    Esta imagem aparecera somente para os participantes
                  </p>
                  <input class="form-control-file" name="imgParticipante" type="file" />
                </div>
            </div>
          </div>
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card">
                <img
                src="img/<?=$evento->getImgCoodenacao()?>"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body">
                  <h5 class="card-title">Coordenação</h5>
                  <p class="card-text">
                    Esta imagem aparecera somente para a coordenação
                  </p>
                  <input class="form-control-file" name="imgCoodenacao" type="file"  class="fupload form-control"/>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="form-group">
          <div class="row">
            <div class="col-lg-10">
              <label>Nome</label>
              <input type="text" name='nome' value="<?=$evento->getNome()?>" class="form-control" placeholder="Nome">
            </div>
            <div class="col-lg-2">
            <label>Status</label>
            <?=htmlSelectStatus($evento->getAtivo())?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Início</label>
              <input type="datetime-local" value="<?=$evento->getInicio()?>" name="inicio" class="form-control" placeholder="Início">
            </div>
            <div class="col-lg-6">
            <label>Encerramento</label>
            <input type="datetime-local" value="<?=$evento->getEncerramento()?>" name="encerramento" class="form-control" placeholder="Encerramento">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Contato</label>
              <input type="email" value="<?=$evento->getContato()?>" name="contato" class="form-control" placeholder="Contato">
            </div>
            <div class="col-lg-6">
              <label>Inscrição</label>
              <input type="text" value="<?=$evento->getInscricao()?>" name="inscricao" class="form-control" placeholder="inscricao">
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