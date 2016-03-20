<?php 
	session_start();
	include("f_db.php");
	include("f_user.php");
	include("f_friends.php");
	include("f_messages.php");
	include("f_posts.php");
	
	$link = connect_db();
	$link->query("SET NAMES utf8");

	//$user = obj_user(array('anton','123123','Антон','ФОКИН','Юрьевич','1991-02-08','81'));
	//edit_user_data($link,$user);
	// $user = get_user_data($link,"anton");
	// auth("anton","123123",$link);

	// echo"
	// 	<form enctype='multipart/form-data' action='functions.php?o=1' method='POST'>
	// 	    <input type='hidden' name='MAX_FILE_SIZE' value='20000000' />
	// 	    Отправить этот файл: <input name='userfile' type='file' />
	// 	    <input type='submit' value='Send File' />
	// 	</form>
	// 	";

	// if(@$_GET['o'] == 1){
	// 	add_ava();
	// }
	// new_friend($link,"112");
	// get_all_friends($link);
	// remove_friend($link,'2');
	// new_message($link,'2',"араоыровларывлра выоары а ыовар орвао ыв");
	// taking_messages($link);
	// sended_messages($link);
	// new_post($link,"sajdf валрывоаро");
	// one_post($link,'3');
	// remove_post($link,'1');
	// edit_post($link,"askdjas klajd флыдов  флыов",'1');

?>