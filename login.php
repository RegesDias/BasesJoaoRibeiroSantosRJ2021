<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Semana Escoteira</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<?php require_once('incl/config.php'); ?>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
		<?php if($respGet->id == 'login'){?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>Alerta!</h4>
					Usuário ou senha incorretos...
			</div>
		<?php }?>
			<div class="card-header"><br>
				<h3><b><i>Semana Escoteira 2021</i></b></h3>
				<div class="d-flex justify-content-end social_icon">
                    <a href="https://www.facebook.com/escoteirosrj"><span><i class="fab fa-facebook-square"></i></span></a>
				</div>
			</div>
			<div class="card-body">
                <form method="post" action="index.php">
                    <input type="hidden" name='acao' value='entrar'>
                    <input type="hidden" name='entrarSair' value='1'>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name='user' class="form-control" placeholder="Nome do usuário">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name='passwd' class="form-control" placeholder="senha">
					</div>
					<div class="form-group">
						<input type="submit" value="Entrar" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Bem vindo a semana escoteira!
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>