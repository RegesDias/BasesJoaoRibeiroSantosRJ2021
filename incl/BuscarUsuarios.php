<form method="post">
    <div class="form-group">
        <label for="Name">Nome</label>
        <input type="text" name="nome" class="form-control" id="Nome" aria-describedby="nameHelp" placeholder="Digite um nome">
    </div>
    <div class="form-group">
        <label for="Password">Senha</label>
        <input type="password" name="senha" class="form-control" id="Password" placeholder="Senha">
    </div>
    <div class="form-group">
        <label for="ConfirmPassword"> Confirme sua senha</label>
        <input type="password" name="confirmSenha" class="form-control" id="ConfirmPassword" placeholder="Confirme sua senha">
    </div>
    <input type="hidden" valor="cadastroUsuario" name="acao">
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>