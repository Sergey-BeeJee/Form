<?php
	//Connecting the DataBase
	require 'data/db.php';
	//collecting POST
	$email = $_POST['email'];
	$name = $_POST['firstName'];
	$surname = $_POST['surname'];
	$middleName = $_POST['middleName'];
	$datatime = $_POST['datatime'];
	$message = $_POST['message'];
	$phone = $_POST['phone'];
	//creating a table and adding it to it
	$answers = R::dispense('answers');
	$answers->Surname = htmlspecialchars($surname);
	$answers->firstName = htmlspecialchars($name);
	$answers->middleName = htmlspecialchars($middleName);
	$answers->email = $email;
	$answers->phone = $phone;
	$answers->datetime = $datatime;
	$answers->message = $message;
	R::store($answers);
	//email title and subject
	$subject = "=?utf-8?B?".base64_encode("Сообщение с сайта")."?=";
	$header = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";
	//sending to email
	$success = mail($config['emailAdmin'], $subject, $message, $header);
	//response from the server
	echo $success;
?>