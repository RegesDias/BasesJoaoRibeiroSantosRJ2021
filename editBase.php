<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
        print_r($respPost);
        if($respPost['acao']=='cadastroBase'){
            $insertBase = "INSERT INTO base(nome, Chave, status, ativa) VALUES ($nome,$Chave, aberta, 1)";
            $ib = $mysqli->query($insertBase);

            
        }
    ?>  
    <div class="container">
        <h1> Editar Base </h1>
        <p> Por favor digite abaixo os dados da base</p>
        <hr>
        <form method="post">
            <div class="form-group">
                <label for="Name">Digite o novo nome</label>
                <input type="text" name="nome" class="form-control" id="Nome" aria-describedby="nameHelp" placeholder="Digite um nome">
            </div>


            <div class="form-group">
                <label for="ConfirmPassword"> Digite a nova senha</label>
                <input type="password" name="novaSenha" class="form-control" id="newPassword" placeholder="Insira nova senha">
            </div>

                <input type="hidden" valor="cadastroBase" name="acao">
           
            
            <div class="form-group">
                <label for="Status">Selecione o status da base</label>
                <select class="form-control"name="Status" id="Status">
                    <option>Aberta</option>
                    <option>Fechada</option>
                    
                </select>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="Ativa" class="form-check-input" id="checkMark">
                <label class="form-check-label" for="checkMark">Ativa</label>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
       
    <hr>