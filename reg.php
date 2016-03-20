<?php 
	include("functions.php");
	
	if(!empty($_SESSION['user'])) echo '<meta http-equiv="refresh" content="0;URL=index.php">';

	if(!empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['repPass']))
	{
		light_reg($link,$_POST['login'],$_POST['pass'],$_POST['repPass']);
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<script src="js/main.js"></script>
	<script src="js/jquery-1.11.0.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title>Регистрация</title>
</head>
<body>
	<div class="reg-form">
		<div class="back">
			<a href="index.php">На главную</a>
			<?php if(!empty($_GET['er']) && $_GET['er'] == 1):?>
			<p>
				Такой пользователь уже существует!
			</p>
			<?php endif;?>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="reg.php">
			<div class="form-group">
				<label for="login" class="col-sm-2 control-label">Логин</label>
				<div class="col-sm-5">
					<input type="text" name="login" class="form-control" id="Email" placeholder="Введите логин"></div>
			</div>
			<div class="form-group">
				<label for="pass" class="col-sm-2 control-label">Пароль</label>
				<div class="col-sm-5">
					<input type="password" name="pass" class="form-control" id="pass" placeholder="Введите пароль"></div>
			</div>
			<div class="form-group">
				<label for="repPass" class="col-sm-2 control-label">Повтор пароля</label>
				<div class="col-sm-5">
					<input type="password" name="repPass" class="form-control" id="repPass" placeholder="Повторите пароль"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Регистрация</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
