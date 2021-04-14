<input type="hidden" name='id' value="<?=$base->getId()?>">
      <input type="hidden" name='acao' value="alterar">
      <input type="hidden" name='alterar' value="alterar">
      <?php if($respObj->id > 0){?>
      <div class="container">
        <!-- Gallery -->
        <div class="row">
          <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
            <div class="card">
                <img
                src="img/<?=$base->getImg()?>"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body">
                  <h5 class="card-title">Capa</h5>
                  <p class="card-text">
                    Esta imagem será associada a base a ser criada
                  </p>
                  <input class="form-control-file" name="img" type="file" />
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php }?>
      <div class="container">
        <div class="form-group">
          <div class="row">
            <div class="col-lg-8">
              <label>Nome</label>
              <input type="text" name='nome' value="<?=$base->getNome()?>" class="form-control" placeholder="Nome">
            </div>
            <div class="col-lg-2">
              <label>Situação</label>
              <input type="text" name='status' value="<?=$base->getStatus()?>" class="form-control" placeholder="Nome">
            </div>
            <div class="col-lg-2">
            <label>Status</label>
            <?=htmlSelectStatus($base->getAtiva())?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Responsável pela base</label>
              <input type="text" value="<?=$base->getResposavelBase()?>" name="resposavelBase" class="form-control" placeholder="Responsável">
            </div>
            <div class="col-lg-6">
            <label>Link do Whatsapp</label>
            <input type="text" value="<?=$base->getLink()?>" name="link" class="form-control" placeholder="Link do grupo">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
          <div class="col-lg-6">
              <label>Evento</label>
              <?php $evento->htmlSelectEvento($base->getIdEvento())?>  
            </div>
            <div class="col-lg-6">
              <label>Número da Base</label>
              <input type="text" value="<?=$base->getOrdem()?>" name="ordem" class="form-control" placeholder="Responsável">
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