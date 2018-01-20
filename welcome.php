<?php

	session_start();																					//rozpoczęcie sesji
	
	if(!isset($_SESSION['registrationOK']))																//przekierowanie do mainpage.php jesli uzytkownik jest juz zalogowany
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['registrationOK']);
	}
	
	if(isset($_SESSION['form_login'])) unset($_SESSION['form_login']);									//Usuwanie zmiennych pamiętajacych wartosci w nieudanej walidacji
	if(isset($_SESSION['form_email'])) unset($_SESSION['form_email']);
	if(isset($_SESSION['form_password1'])) unset($_SESSION['form_password1']);
	if(isset($_SESSION['form_password2'])) unset($_SESSION['form_password2']);
	if(isset($_SESSION['form_terms'])) unset($_SESSION['form_terms']);
	
	if(isset($_SESSION['e_login'])) unset($_SESSION['e_login']);										//Usuwanie błędów rejestracji
	if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if(isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
	if(isset($_SESSION['e_terms'])) unset($_SESSION['e_terms']);
	if(isset($_SESSION['e_recaptcha'])) unset($_SESSION['e_recaptcha']);
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<title>Projekt WWSIS</title>
</head>

<body>
	
	<p>Dziękujemy za rejestrację</p>
	<a href="index.php">Zaloguj się</a>

</body>

</html>

test?