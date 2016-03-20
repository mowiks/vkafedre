<?php 

	include("functions.php");
	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		$user = get_user_data($link,$id);
		$posts = all_post_from($link,$id);
	}
	if(!empty($_GET['n']) && $_GET['n'] == 1 && !empty($_GET['id_f'])){
		new_friend($link,$_GET['id_f']);
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
					<li class="active">
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
								<a href="messages.php?n=1">
									Принятые сообщения 
									<?php if($messages != 0):?>
									<span class="badge pull-right"><?=count($messages)?></span>
									<?php else:?>
									<span class="badge pull-right">0</span>
									<?php endif;?>
								</a>
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
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail">
					
					<?php if(get_ava()):?>
					<img src="img/avas/<?=$id?>.jpg">
					<?php else:?>
					<img src="img/avas/default.jpg">
					<?php endif;?>
					

					<div class="caption">
						<h4>
							<?=$user['lastname']?>&nbsp;<?=$user['name']?>
						</h4>
						<?php if(!is_friend($link,$id)):?>
						<a href="friend.php?n=1&id_f=<?=$id?>&id=<?=$id?>">Добавить в друзья</a>
						<?php endif;?>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-9 user-data">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Информация о пользователе</h3>
					</div>
					<div class="panel-body">
						<p>
							Фамилия: <?=$user['lastname']?>
						</p>
						<p>
							Имя: <?=$user['name']?>
						</p>
						<p>
							Отчество: <?=$user['patronumic']?>
						</p>
						<p>
							Группа: ИУ7 - <?=$user['group_num']?>
						</p>
						<p>
							Дата рождения: <?=$user['birthday']?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Посты</h3>
					</div>
					<?php if($posts != 0):?>
					<?php for ($i=0; $i < count($posts); $i++):?>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<h5>Запостил 
									<a href="">
										<?=$user['lastname']?> <?=$user['name']?> 
									</a>
								</h5>
								<h4><?=$posts[$i]['title']?></h4>
								<p>
									<?=$posts[$i]['text']?>
								</p>
							</div>
						</div>
					</div>
					<?php endfor;?>
					<?php else:?>
					<div class="panel-body">Нет постов</div>
					<?php endif;?>
				</div>
			</div>
		</div>

	</section>

	<footer class="main"></footer>

</body>
</html>
