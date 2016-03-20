<?php 

	include("functions.php");
	$messages = taking_messages($link);
	if(empty($_GET['line'])) echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	$find = find_friend($link,$_GET['line']);

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
							<li class="active">
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
							
							<li>
								<a href="profile.php">Редактировать данные</a>
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
			
			<div class="col-md-12">
				<div class="panel panel-default">
					
					
					<div class="panel-heading">
						<h3 class="panel-title">Заявки в друзья</h3>
					</div>

					<?php if($find != 0):?>
					<?php for ($i=0; $i < count($find); $i++):?>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-sm-2 thumbnail">
									<img src="img/avas/<?=$find[$i]['id']?>.jpg" alt="" class="">
								</div>
								<div class="col-sm-6">
									<a href="friend.php?id=<?=$find[$i]['id']?>"><?=$find[$i]['user']?></a>
									<p>
										<a href="friend.php?n=1&id_f=<?=$find[$i]['id']?>&id=<?=$find[$i]['id']?>" class="btn btn-primary btn-sm active" >Добавить</a>
									</p>
								</div>
							</div>
						</div>
					</div>
					<?php endfor;?>
					<?php else:?>
						<div class="panel-body">
							<p>Нет заявок</p>	
						</div>
					<?php endif;?>

				</div>
			</div>
		</div>

	</section>

	<footer class="main"></footer>

</body>
</html>
