<?php
	session_start();
	
	if(!isset($_SESSION['loggedin']))																	//odeslanie do strony index.php jesli nie wykryto aktywnej sesji
	{
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="style.css" type="text/css">
	<title>Projekt WWSIS</title>
</head>

<body>

<?php
	echo "<p>Witaj ".$_SESSION['username'].'! 
	<input type="button" value="Wyloguj" onclick=window.location.href="logout.php" />
	<input type="button" value="Wyloguj i zeruj cookies" onclick=window.location.href="logoutnocookies.php" /> <br /><br />';
	
	if(isset($_COOKIE['visit']))
	{
		$visitno = intval($_COOKIE['visit']);
		$visitno++;
		setcookie("visit", "$visitno", time()+3600*24);
		echo "To są twoje $visitno odwiedziny! Witaj ponownie!";
	}
	else
	{
		setcookie("visit", "1", time()+3600*24);
		echo "To jest Twoja 1-sza wizyta!";
	}
?>

	<br /><br />
	<input type="button" value="Wyświetl wszystkie" onclick="window.location.href='show.php'" />
	<input type="button" value="Szukaj" onclick="window.location.href='search.php'" />
<?php
	if(isset($_SESSION['loggedin']) && ($_SESSION['userpriv']=="admin"))
	{
	echo '<input type="button" value="Dodaj" onclick=window.location.href="add.php" />
	<input type="button" value="Popraw" onclick=window.location.href="update.php" />
	<input type="button" value="Usuń" onclick=window.location.href="delete.php" />';
	}
?>

</body>

</html>