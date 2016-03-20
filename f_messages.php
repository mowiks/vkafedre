<?php
	// модуль работы с сообщениями 

	/*
		Новое сообщение
	*/

	function new_message($link,$to,$message){

		$query = $link->query("
				INSERT INTO `messages` (`m_from`, `m_to`, `text`) 
				VALUES ('".$_SESSION['user']."', '".$to."', '".$message."');
			");
		// if($query) echo "сообщение успешно отправленно!";
		// else echo "сообщение не отправленно!";

	}

	/*
		взять отправленные сообщения
	*/
	function sended_messages($link){
		$query = $link->query("
				SELECT * 
				FROM  `messages` 
				WHERE  `m_from` =".$_SESSION['user']."
				AND `deleted` =0
				ORDER BY `id` DESC
			");
		if($query->num_rows <= 0) return 0;
		while ($row = $query->fetch_assoc()) {
			$to = get_user_data($link,$row['m_to']);
			$messages[] = array(
							'id' => $row['m_to'],
							'id_mes' => $row['id'],
							'to' => $to['name']." ".$to['lastname'],
							'text' => $row['text']);
		}
		// print_r($messages);
		return $messages;
	}

	/*
		взять новые сообщения
	*/
	function taking_messages($link){
		$query = $link->query("
				SELECT * 
				FROM  `messages` 
				WHERE  `m_to` =".$_SESSION['user']."
				AND  `reed` =0
				AND  `deleted` =0
				ORDER BY `id` DESC
			");
		if($query->num_rows <= 0) return 0;
		while ($row = $query->fetch_assoc()) {
			$from = get_user_data($link,$row['m_from']);
			// $query_mes = $link->query("UPDATE  `messages` SET  `reed` =  '1' WHERE  `id` =".$row['id'].";");
			$messages[] = array(
							'id' => $row['m_from'],
							'id_mes' => $row['id'],
							'from' => $from['name']." ".$from['lastname'],
							'text' => $row['text']);
		}
		
		return $messages;
		
	}

	// Удаление сообщения

	function remove_message($link,$id_message){
		$query = $link->query("UPDATE `messages` SET  `deleted` =  '1' WHERE `id` =".$id_message);
		// if($query) echo "Пост успешно удален!";
		// else echo "Ошибка!";
	}

?>