<?php 

	include("functions.php");

	$messages = taking_messages($link);
	$friends = get_all_friends($link);
	if(!empty($_GET['logout']) && $_GET['logout']== '1')
	{
		logout();
		$_GET['logout'] = 0;
		echo '<meta http-equiv="refresh" content="0;URL=auth.php">';
	}

	if(!empty($_GET['p']) && $_GET['p'] == '1' && !empty($_POST['post'])){
		new_post($link,$_POST['post'],$_POST['title']);
		$_GET['p'] = 0;
	}
	if(!empty($_GET['del']) && $_GET['del'] == '1' && !empty($_GET['id'])){
		remove_post($link,$_GET['id']);
		$_GET['del'] = 0;
	}

	if(!empty($_SESSION['user'])){
		$user = get_user_data($link,$_SESSION['user']);
		$posts = all_post_from($link,$_SESSION['user']);
	}
	else
	{
		echo '<meta http-equiv="refresh" content="0;URL=auth.php">';
	}

	if(!empty($_GET['ava']) && $_GET['ava'] == '1' && isset($_FILES['userfile'])){
		add_ava();
		$_GET['ava'] = 0;
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}

	if(!empty($_GET['m']) && $_GET['m'] == '1' && !empty($_POST['text'])){
		new_message($link,$_POST['to'],$_POST['text']);
		$_GET['m'] = 0;
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
					<img src="img/avas/<?=$_SESSION['user']?>.jpg">
					<?php else:?>
					<img src="img/avas/default.jpg">
					<?php endif;?>
					

					<div class="caption">
						<h4>
							<?=$user['lastname']?>&nbsp;<?=$user['name']?>
							<span class="badge online">Online</span>
						</h4>
<!--
						<form enctype='multipart/form-data' action='index.php?ava=1' method='POST'>
					 	    <input type='hidden' name='MAX_FILE_SIZE' value='20000000' />
					 	    Выберите аватарку: <input name='userfile' class="form-control" type='file' />
					 	    <button type="submit" style="margin-top: .5em;" class="btn btn-primary btn-sm">Сменить аватарку</button>
					 	</form>
-->
					</div>
				</div>
				<div class="thumbnail">
					<form action="index.php?m=1" method="POST">
						<h5>Отправить сообщение</h5>
						<select class="form-control" name="to">
							<?php for($i =0;$i < count($friends); $i++):?>
							<option value="<?=$friends[$i]['id']?>"><?=$friends[$i]['name']." ".$friends[$i]['lastname']?></option>
							<?php endfor;?>
						</select>
						<p>Текс сообщения</p>
						<textarea style="resize:none;" name="text" class="form-control" rows="5"></textarea>
						<?php if($friends != 0):?>
						<button type="submit" style="margin-top: .5em;" class="btn btn-primary btn-sm">Отправить</button>
						<?php endif;?>
					</form>
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
						<h3 class="panel-title">Мои посты</h3>
					</div>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-heading"><h5>Создать новый пост</h5></div>
							<div class="panel-body">
								<form action="index.php?p=1" method="POST">
									<p>Заголовок поста</p>
									<input type="text" name="title" class="form-control">
									<p>Текст поста</p>
									<textarea style="resize:none;" name="post" class="form-control" rows="5"></textarea>
									<button type="submit" style="margin-top: .5em;" class="btn btn-primary btn-sm">Создать</button>
								</form>
							</div>
						</div>
					</div>
					<?php if($posts != 0):?>
					<?php for ($i=0; $i < count($posts); $i++):?>
					<div class="panel-body">
						<div class="panel panel-default">
							<div class="panel-body">
								<h5>Запостил 
									<a href="">
										<?=$_SESSION['user_data']['lastname']?> <?=$_SESSION['user_data']['name']?> 
									</a>
								</h5>
								<a href="index.php?del=1&id=<?=$posts[$i]['id_post']?>">Удалить</a>
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
