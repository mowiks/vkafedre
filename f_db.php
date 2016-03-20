<?php 
	// модуль для работы с БД 

	//  подключение к БД 
	function connect_db(){
		$link = new mysqli("localhost", "root", "12345", "vkafedre");
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		return $link;
	}
	

?>
