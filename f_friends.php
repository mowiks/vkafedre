<?php
	// модуль для работы с базой друзей

	/*
		Добавление нового друга
	*/

	function new_friend($link,$to){
		$query = $link->query("INSERT INTO `friends` (`f_from` ,`f_to`)
						VALUES ('".$_SESSION['user']."',  '".$to."');
						");
		if($query){
			// echo "Успешно добавлен в друзья";
			return 1;
		}
		// echo "Ошибка!";
		return 0;

	}

	/*
		Убрать из друзей
	*/

	function remove_friend($link,$friend){
		$query = $link->query("UPDATE  `friends` SET  `deleted` =  '1' 
							WHERE  (`f_from` =".$_SESSION['user']." AND `f_to` =".$friend.")
							OR (`f_to` =".$_SESSION['user']." AND `f_from` =".$friend.")
							");
		mysqli_error($link);
	}

	// принять заявку в друзья

	function activate_friend($link,$id){
		$query = $link->query("UPDATE  `friends` SET  `activate` =  '1' WHERE  `id` =".$id);
	}

	/*
		Поиск друга
	*/

	function find_friend($link,$line){
		$line = explode(" ", $line);
		for ($i=0; $i < count($line); $i++) { 
			$query = $link->query("SELECT `id` FROM  `users` WHERE  `name` LIKE '".$line[$i]."'
															OR   `lastname` LIKE '".$line[$i]."'
															OR   `patronumic` LIKE '".$line[$i]."'
															OR   `group_num` LIKE '".$line[$i]."'");
			while ($row = $query->fetch_assoc()){
				$friends[] = $row['id'];
			}
		}
		if(!isset($friends)) return 0;
		$friends = array_unique($friends);
		for ($i=0; $i < count($friends); $i++) { 
			$friend = get_user_data($link,$friends[$i]);
			$res[]= array("id" => $friends[$i],"user" => $friend['name']." ".$friend['lastname']);
		}
		return $res;
		
	}

	/*
		Взять все новые заявки в друзья
	*/

	function get_new_friends($link){
		$query = $link->query("SELECT `id`,`f_from` FROM  `friends` WHERE  `f_to` =".$_SESSION['user']." AND `deleted` =0 AND `activate` =0 ORDER BY `id` DESC");
		if($query && $query->num_rows > 0){
			while ($row = $query->fetch_assoc()){
				$query_from = $link->query("SELECT * FROM `users` WHERE `id`=".$row['f_from']);
				$friend = $query_from->fetch_assoc();
			    $from[] = array('id' => $row['id'],
			    				'from' => $friend['name']." ".$friend['lastname'],
			    				'id_from' => $friend['id'],
			    				);
			}
		}
		else return 0;

		return $from;
	}

	/*
		проверка дружбы
	*/
	function is_friend($link,$id){
		$query = $link->query("SELECT * from `friends` WHERE (`f_from`=".$id." AND f_to=".$_SESSION['user']." AND `deleted`=0)
													OR (`f_from`=".$_SESSION['user']." AND f_to=".$id." AND `deleted`=0)");
		if($query->num_rows > 0 ) return 1;
		return 0;
	}

	/*
		Взять всех друзей
	*/

	function get_all_friends($link){
		$to = NULL;
		$query = $link->query("SELECT `f_to` FROM  `friends` WHERE  `f_from` =".$_SESSION['user']." AND `deleted` =0 AND `activate` =1");
		if($query){
			while ($row = $query->fetch_array()){
			    $from[] = $row['f_to'];
			}
		}
		
		$query = $link->query("SELECT `f_from` FROM  `friends` WHERE  `f_to` =".$_SESSION['user']." AND `deleted` =0 AND `activate` =1");
		if($query){
			while ($row = $query->fetch_array()){
			    $to[] = $row['f_from'];
			}
		}

		if(!empty($from)){
				if(!empty($to)) $all = array_merge($to,$from);
				else $all = $from;
		}
		else $all = $to;

		if(count($all) == 0) return 0;

		$query = $link->query("SELECT `id`,`name`, `lastname` FROM  `users` WHERE  `id` IN(".implode(',', $all).")");
		if($query){
			while ($row = $query->fetch_assoc()){
				$friends[] = array(
				'id' 		=>$row['id'],
			    'name' 		=>$row['name'],
			    'lastname'  => $row['lastname']
			    );
			}
		}
		else echo mysqli_error($link);

		return $friends;
	}
?>