<?php 

	include("functions.php");
	if(!empty($_GET['act']) && $_GET['act'] == '1'){
		activate_friend($link,$_GET['id']);
		$_GET['act'] = '0';
	}
	if(!empty($_GET['del']) && $_GET['del'] == '1' && !empty($_GET['id'])){
		remove_friend($link,$_GET['id']);
		$_GET['del'] = '0';
	}
	$messages = taking_messages($link);
	$friends = get_all_friends($link);
	$new_friends = get_new_friends($link);
	if(!empty($_GET['o']) && $_GET['o'] == '1'){
		
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
					<li class="active"> 
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
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Поиск нового друга"></div>
					<button type="submit" class="btn btn-default">Поиск</button>
				</form>
			</div>
			<!-- /.navbar-collapse -->
		</nav>
	</header>

	<section class="main">
		<div class="row">
			
			<div class="col-md-6">
				<div class="panel panel-default">
					
					
					<div class="panel-heading">
						<h3 class="panel-title">Мои друзья</h3>
					</div>
					<?php if($friends != 0):?>
					<?php for ($i=0; $i < count($friends); $i++):?>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-sm-2 thumbnail">
									<img src="img/avas/<?=$friends[$i]['id']?>.jpg" alt="" class="">
								</div>
								<div class="col-sm-6">
									<a href="friend.php?id=<?=$friends[$i]['id']?>"><?=$friends[$i]['name']?> <?=$friends[$i]['lastname']?></a>
									<p>
										<a href="friends.php?del=1&id=<?=$friends[$i]['id']?>" class="btn btn-danger btn-sm active" >Удалить</a>
									</p>
								</div>
							</div>
						</div>
					</div>
					<?php endfor;?>
					<?php else:?>
						<div class="panel-body">
							<p>Нет друзей</p>	
						</div>
					<?php endif;?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					
					
					<div class="panel-heading">
						<h3 class="panel-title">Заявки в друзья</h3>
					</div>
					<?php if($new_friends != 0):?>
					<?php for ($i=0; $i < count($new_friends); $i++):?>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-sm-2 thumbnail">
									<img src="img/avas/<?=$new_friends[$i]['id_from']?>.jpg" alt="" class="">
								</div>
								<div class="col-sm-6">
									<a href="friend.php?id=<?=$new_friends[$i]['id_from']?>"><?=$new_friends[$i]['from']?></a>
									<p>
										<a href="friends.php?act=1&id=<?=$new_friends[$i]['id']?>" class="btn btn-primary btn-sm active" >Принять</a>
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
