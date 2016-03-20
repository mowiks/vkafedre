<?php
	// модуль работы с пользователями

	/*
		Добавление нового пользователя в БД - регистрация
	*/

	function light_reg($link,$login,$pass,$repas){

		if(!strcmp($pass, $repas) == 0)
		{
			echo "Неверный повтор пароля";
			return 0;
		}

		$query = $link->query("SELECT * FROM `users` WHERE `login` LIKE '".$login."'");
		if($query->num_rows > 0) 
			{
				echo '<meta http-equiv="refresh" content="0;URL=reg.php?er=1">';
				return 0;
			}
		
		$query = $link->query("INSERT into `users` (`login`, `pass`) 
								VALUES('".$login."','".$pass."')");

		if ($query === TRUE){
   			auth($login,$pass,$link);
		}
		
		else echo(mysqli_error($link));
		return 1;
	}	

	function add_new_user($link,$user_data){
		
		$query = $link->query("INSERT into `users` (`login`, `pass`, `name`, `lastname`, `patronumic`, `birthday`, `group_num`) 
								VALUES('".$user_data['login']."','".$user_data['password']."','".$user_data['name']."'
	 									,'".$user_data['lastname']."','".$user_data['patronumic']."'
										,'".$user_data['birthday']."',".$user_data['group_num'].")");

		if ($query === TRUE){
   			 echo "ok";
		}
		
		else echo(mysqli_error($link));

	}

	/*
		Создать объект пользователя
	*/

	function obj_user($user_data){
		$user = array(
					'login'      => $user_data[0],
					'password'   => $user_data[1],
					'name'       => $user_data[2],
					'lastname'   => $user_data[3],
					'patronumic' => $user_data[4],
					'birthday'   => $user_data[5],
					'group_num'  => $user_data[6]
				);
		return $user;
	}

	/*
		Авторизация пользователя
	*/

	function auth($login,$pass,$link){
		$query = $link->query("SELECT * FROM `users` WHERE `login` LIKE '".$login."'");
		if(!$query){
			// echo "Не правильно введен логин и/или пароль!";
			return 0;
		}

		$data = $query->fetch_assoc();
		if(strcmp($pass, $data['pass']) != 0){
			// echo "Не правильно введен логин и/или пароль!";
			return 0;
		}
		$_SESSION['user'] = $data['id'];
		$_SESSION['user_data'] = array(
										'name' => $data['name'],
										'lastname' => $data['lastname'],
										'patronumic' => $data['patronumic'],
										'group_num' => $data['group_num'],
										'birthday' => $data['birthday']
									);
		// echo "Привет ".$data['name'];
		return 1;

	}

	/*
		Выход пользователя
	*/

	function logout(){
		session_destroy();
	}

	/*
		Взять пользовательский id
	*/

	function get_user_id($link,$login){
		$query = $link->query("SELECT `id` 
								FROM `users` 
								WHERE `login` LIKE '".$login."'");
		$id = $query->fetch_assoc();
		return $id['id'];
	}

	/*
		Взять пользовательские данные
	*/

	function get_user_data($link,$id){

		$query = $link->query("SELECT `login`, `pass`, `name`, `lastname`, `patronumic`, `birthday`, `group_num` 
								FROM `users` 
								WHERE `id` LIKE '".$id."'");

		$user_data = $query->fetch_array();
		// print_r($user_data);
		$user = obj_user($user_data);
		
		return $user;
	}

	/*
		Изменить пользовательские данные
	*/

	function edit_user_data($link,$user_data){
		$id = $_SESSION['user'];

		$query = $link->query("UPDATE  `users` SET  
								`name`  	= '".$user_data['name']."',
								`lastname`  = '".$user_data['lastname']."',
								`patronumic`= '".$user_data['patronumic']."',
								`birthday`  = '".$user_data['birthday']."', 
								`group_num` = '".$user_data['group_num']."'
								WHERE `id` =".$id.";");

		if ($query === TRUE){
   			 $_SESSION['user_data'] = array(
										'name' 		=> $user_data['name'],
										'lastname'  => $user_data['lastname'],
										'patronumic'=> $user_data['patronumic'],
										'group_num' => $user_data['group_num'],
										'birthday'  => $user_data['birthday']
									);
			return 1;
		}
		
		else echo(mysqli_error($link));
	}


	//изменение пароля
	function edit_pass($link,$pass){
		$id = $_SESSION['user'];

		$query = $link->query("UPDATE  `users` SET  
								`pass`  	= '".$pass."'
								WHERE `id` =".$id.";");

		if ($query === TRUE){
   			 // echo "ok";
			return 1;
		}
		
		else echo(mysqli_error($link));
	} 

	/*
		добавление/смена аватарки
	*/
	function add_ava(){
		$uploaddir = 'img/avas/';
		$ext = explode('.', basename($_FILES['userfile']['name']));
		$uploadfile = $uploaddir . $_SESSION['user'] .'.'. $ext[1];
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		    // echo "Файл корректен и был успешно загружен.\n";
		} else {
		    // echo "Возможная атака с помощью файловой загрузки!\n";
		}

	}

	//  Функция возвращает путь аватарки
	function get_ava(){
		$filename = "img/avas/".$_SESSION['user'].".jpg";

		if (file_exists($filename))
		    return 1;
	
	    return 0;
		
	}

?>