<?php 
	include("functions.php");
	$check = 1;
	if(!empty($_GET['a']) && $_GET['a'] == 1)
	{
		if(!empty($_POST['login']) && !empty($_POST['pass'])){
			$check = auth($_POST['login'],$_POST['pass'],$link);
			if($check) echo '<meta http-equiv="refresh" content="0;URL=index.php">';
		}
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
	<title>Авторизация</title>
</head>
<body>
	<div class="auth-form">
		<div class="auth-cell">
			<h4>Введите ваши данные чтобы войти</h4>
			<h5>или <a href="reg.php">зарегеструйтесь</a></h5>
			<?php if(!$check):?>
			<p style="color:red;">Не правильный логин или пароль</p>
			<?php endif;?>
			<form class="form-horizontal" role="form" method="POST" action="auth.php?a=1">
				<div class="form-group">
					<label for="Email" class="col-sm-2 control-label">Логин</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"></div>
				</div>
				<div class="form-group">
					<label for="pass" class="col-sm-2 control-label">Пароль</label>
					<div class="col-sm-5">
						<input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Войти</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
