<?php
	// модуль работы с постами

	/*
		Новый пост
	*/

	function new_post($link,$post,$title){
		$query = $link->query("
				INSERT INTO `posts` (`p_from`, `text`, `title`) 
				VALUES ('".$_SESSION['user']."', '".$post."','".$title."');
			");
		// if($query) echo "Успешно запостчено!";
		// else echo "Не запостчено!";
	}

	/*
		взять все посты от одного человека по переданному id пользователя
	*/

	function all_post_from($link,$from){
		$query = $link->query("
				SELECT * 
				FROM  `posts` 
				WHERE  `p_from` =".$from."
				AND  `deleted` =0
				ORDER BY `id` DESC
			");
		while ($row = $query->fetch_assoc()) {
			$posts[] = array('from' => $row['p_from'],
							'id_post' => $row['id'],
							'text' => $row['text'],
							'title' => $row['title']
							);
		}
		// print_r($posts);
		if($query->num_rows <= 0) return 0;
		return $posts;
	}

	/*
		взять данные одного СВОЕГО поста для редактирования по id поста
	*/

	function one_post($link,$id_post){
		$query = $link->query("
				SELECT * 
				FROM  `posts` 
				WHERE  `id` =".$id_post."
				AND  `deleted` =0
			");

		while ($row = $query->fetch_assoc()) {
			$posts[] = array('from' => $row['p_from'],
							'text' => $row['text']);
		}
		
		print_r($posts);
		return $posts;
	}

	/*
		Удалить пост
	*/

	function remove_post($link,$id_post){
		$query = $link->query("UPDATE `posts` SET  `deleted` =  '1' WHERE `id` =".$id_post);
		// if($query) echo "Пост успешно удален!";
		// else echo "Ошибка!";
	}

	/*
		Редактировать пост
	*/

	function edit_post($link,$text,$id_post){
		$query = $link->query("UPDATE `posts` 
								SET `text` ='".$text."' 
								WHERE `id` =".$id_post);

		if($query) echo "Пост успешно изменен!";
		else echo "Ошибка!";
	}
?>