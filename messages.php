<?php 

	include("functions.php");

	if(!empty($_GET['del']) && $_GET['del'] == '1'){
		remove_message($link,$_GET['id']);
		$_GET['del'] = 0;
	}
	if(!empty($_GET['n']) && $_GET['n'] == '1'){
		$messages = taking_messages($link);
		// $_GET['n'] = 0;
	}
	if(!empty($_GET['o']) && $_GET['o'] == '1'){
		$messages = sended_messages($link);
		// $_GET['o'] = 0;
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
							<?php if(!empty($_GET['n']) && $_GET['n'] == 1):?>
								<li class="active">
									<a href="messages.php?n=1">Принятые сообщения <span class="badge pull-right"><?=count($messages)?></span></a>
								</li>
								<li>
									<a href="messages.php?o=1">Отправленные сообщения</a>
								</li>
							<?php else:?>
							<li>
								<a href="messages.php?n=1">Принятые сообщения <span class="badge pull-right"><?=count($messages)?></span></a>
							</li>
							<li class="active">
								<a href="messages.php?o=1">Отправленные сообщения</a>
							</li>
							<?php endif;?>
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
			
			<div class="col-sm-6 col-md-9">
				<div class="panel panel-default">
					
					<?php if($messages):?>
					<div class="panel-heading">
						<h3 class="panel-title">Новые сообщения</h3>
					</div>
					<?php for ($i=0; $i < count($messages); $i++):?>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<?php if(!empty($_GET['n']) && $_GET['n'] == 1):?>
								<h5>Отправил 
									<a href="<?="friend.php?id=".$messages[$i]['id']?>">
										<?=$messages[$i]['from']?>
									</a>
								</h5>
								<?php else:?>
								<h5>Кому 
									<a href="<?="friend.php?id=".$messages[$i]['id']?>">
										<?=$messages[$i]['to']?>
									</a>
								</h5>
								<?php endif;?>
								<p>
									<?=$messages[$i]['text']?>
								</p>
								<a href="messages.php?n=1&del=1&id=<?=$messages[$i]['id_mes']?>">Удалить</a>
							</div>
						</div>
					</div>
					<?php endfor;?>
					<?php else:?>
					<div class="panel-body">Нет новых сообщений</div>
					<?php endif;?>

				</div>
			</div>
		</div>

	</section>

	<footer class="main"></footer>

</body>
</html>
