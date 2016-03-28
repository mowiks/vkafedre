<?php 
	// модуль для работы с БД 

	//  подключение к БД 
	function connect_db(){
		$link = new mysqli("localhost", "root", "12345", "vkafedre");
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}

		$link->query("SET NAMES utf-8");
		$link->query("SET CHARACTER SET utf-8");
		$link->query("SET character_set_client = utf-8");
		$link->query("SET character_set_connection = utf-8");
		$link->query("SET character_set_results = utf-8");

		return $link;
	}
	

?>
