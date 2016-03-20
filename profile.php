<?php 
	include("functions.php");
	$messages = taking_messages($link);
	if(!empty($_SESSION['user'])){
			$user = get_user_data($link,$_SESSION['user']);
		}
	else
	{
		echo '<meta http-equiv="refresh" content="0;URL=auth.html">';
	}
	
	$edit = 0;
	if(!empty($_GET['e']) && $_GET['e'] == '1' && 
		!empty($_POST['name']) && !empty($_POST['lastname']) && 
		!empty($_POST['patronumic']) && !empty($_POST['birthday']) && 
		!empty($_POST['group_num']))
	{
		$user = obj_user(array('1','1',$_POST['name'],$_POST['lastname'],$_POST['patronumic'],$_POST['birthday'],$_POST['group_num']));
		$edit = edit_user_data($link,$user);
		if(!empty($_POST['pass'])) edit_pass($link,$_POST['pass']);
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
	<title>Главная</title>
</head>
<body>
	<header class="main">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
				</button>
				<a class="navbar-brand" href="#">VKafedre</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="index.php">Моя страница</a>
					</li>
					<li>
						<a href="friends.php">Мои друзья</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Мои сообщения <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="messages.php?n=1">Принятые сообщения <span class="badge pull-right"><?=count($messages)?></span></a>
							</li>
							<li>
								<a href="messages.php?o=1">Отправленные сообщения</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Функции <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							
							<li class="active">
								<a href="#">Редактировать данные</a>
							</li>
							<hr>
							<li class="exit">
								<a href="index.php?logout=1">Выйти</a>
							</li>
						</ul>
					</li>
				</ul>
				<form class="navbar-form navbar-left" action="search.php" role="search">
					<div class="form-group">
						<input type="text" name="line" class="form-control" placeholder="Поиск нового друга"></div>
					<button type="submit" class="btn btn-default">Поиск</button>
				</form>
			</div>
			<!-- /.navbar-collapse -->
		</nav>
	</header>

	<section class="main">
		<div class="row">

			<form action="profile.php?e=1" method="POST">
				<div class="col-sm-6 col-md-9 user-data">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Информация о пользователе</h3>
						</div>
						<div class="panel-body">
							<?php if($edit):?>
							<p style="color:green">Данные успешно изменены!</p>
							<?php endif;?>
							<p>
								Фамилия: <input type="text" name="lastname" value="<?=$user['lastname']?>">
							</p>
							<p>
								Имя: <input type="text" name="name" value="<?=$user['name']?>">
							</p>
							<p>
								Отчество: <input type="text" name="patronumic" value="<?=$user['patronumic']?>">
							</p>
							<p>
								Группа: ИУ7 - <input type="text" name="group_num" value="<?=$user['group_num']?>">
							</p>
							<p>
								Дата рождения: <input type="text" name="birthday" value="<?=$user['birthday']?>">
							</p>
							<p>
								Новый пароль: <input type="password" name="pass">
							</p>
							<button type="submit" class="btn btn-primary">Сохранить</button>
						</div>
					</div>
				</div>
			</form>

		</div>

	</section>

	<footer class="main"></footer>

</body>
</html>
