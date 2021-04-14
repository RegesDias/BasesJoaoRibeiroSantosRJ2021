<?php if($usuario->getChefeBase() == 1){?>
  <h5><b>Cadastro de bases</b></h5>
  <hr/>
  <form method="post" method="POST" action="administrar.php?tp=Usuarios&ac=Buscar">
    <input type="hidden" name='acao' value="alterar">
    <input type="hidden" name='alterarBases' value="alterarBases">
    <input type="hidden" name='id' value="<?=$usuario->getIdUser()?>">
    <div class="form-group">
      <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <select class="select2" name="idBases[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                  <option value='1'>Alabama</option>
                  <option value='2'>Alaska</option>
                  <option value='3'>California</option>
                  <option value='4' >Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
            </div>
            <div class="col-lg-2">
              <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </div>
    </div>
  <form>
<?php }?>


