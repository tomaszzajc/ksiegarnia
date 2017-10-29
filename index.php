<?php
	session_start();																					//rozpoczęcie sesji
	
	if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==true))									//przekierowanie do mainpage.php jesli uzytkownik jest juz zalogowany
	{
		header('Location: mainpage.php');
		exit();
	}
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<title>Projekt WWSIS</title>
</head>

<body>
	
	<p>Strona dostępna po zalogowaniu lub <a href="register.php">zarejestrowaniu</a></p>
	
	<form action="login.php" method="POST">
		Login: <br /> <input type="text" name="login" /> <br />
		Hasło: <br /> <input type="password" name="password" /> <br /><br />
		<input type="submit" value="Zaloguj się" />
	</form>
	
<?php
	if(isset($_SESSION['error']))	echo $_SESSION['error'];											//wyświetlenie informacji o niepoprawnych danych logowania w przypadku błędnych danych
?>

</body>

</html>