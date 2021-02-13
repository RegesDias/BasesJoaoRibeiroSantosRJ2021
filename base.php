<!DOCTYPE html>
<html lang="en">
  <?php require_once("incl/head.php"); ?>
<body>
    <?php 
        require_once('incl/config.php');
        require_once('incl/nav.php');
    ?>  
<form action="base.php">
    <div class="container">
        <h1> Criar Base </h1>
        <p> Por favor digite abaixo os dados da nova base </p>
        <hr>

        <label for="Name"><b>Nome da Base</b></label>
        <input type="text" placeholder="Digite um nome" name="Nome" id="Nome" required>

        <label for="psw"><b>Senha</b></label>
        <input type="password" placeholder="Digite a senha" name="Psw" id="psw" required>

        <label for="psw-repeat"><b>Confirme a senha</b></label>
    <input type="password" placeholder="Confirme a Senha" name="psw-repeat" id="psw-repeat" required>
    <hr>