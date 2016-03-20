<?php

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
	<title>Регистрация нового пользователя</title>
</head>
<body >

	<div class="registration">
		<h1>Введите ваши данные для регистрации</h1>
		<form action="registretion.php" class="form-horizontal" method="POST" role="form">
			<div class="form-group">
				<div class="col-lg-8">
					<input type="text" class="form-control" id="name" placeholder="Введите ваше имя">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8">
					<input type="text" class="form-control" id="surname" placeholder="Введите вашу фамилию">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8">
					<input type="text" class="form-control" id="patronumic" placeholder="Введите ваше отчество">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8">
					<input type="email" class="form-control" id="email" placeholder="Введите вашу электронную почту">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8">
					<input type="text" class="form-control" id="telephone" placeholder="Введите ваш номер телефона">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8">
					<input type="password" class="form-control" id="pass" placeholder="Введите желаемый пароль">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8">
					<input type="password" class="form-control" id="repass" placeholder="Повторите пароль">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-8">
					<input type="button" value="Регистрация" class="btn btn-default">
				</div>
			</div>
		</form>
	</div>
</body>
</html>