<?php
	session_start();
	
	if(!isset($_SESSION['loggedin']))																	//odeslanie do strony index.php jesli nie wykryto aktywnej sesji
	{
		header('Location: index.php');
		exit();
	}
?>

<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<title>Projekt WWSIS</title>
</head>

<body>

<?php
	echo "<p>Witaj ".$_SESSION['username'].'! 
	<input type="button" value="Wyloguj" onclick=window.location.href="logout.php" />
	<input type="button" value="Wyloguj i zeruj cookies" onclick=window.location.href="logoutnocookies.php" /> <br /><br />';
	
	if(isset($_COOKIE['visit']) && ($_COOKIE['visit']!=1))
	{
		$visitno = intval($_COOKIE['visit']);
		//$visitno++;
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
	<input type="button" value="Wyświetl wszystkie książki" onclick="window.location.href='show.php'" />
	<input type="button" value="Szukaj książkę" onclick="window.location.href='search.php'" />
<?php
	if(isset($_SESSION['loggedin']) && ($_SESSION['userpriv']=="admin"))
	{
	echo '<input type="button" value="Dodaj książkę" onclick=window.location.href="add.php" />
	<input type="button" value="Edytuj/Usuń książkę" onclick=window.location.href="update.php" /><br />';
	}
?>
	<input type="button" value="Twoje konto" onclick="window.location.href='updateuser.php'" />
	<input type="button" value="Koszyk" onclick="window.location.href='cart.php'" />

<?php
	$addressid = $_POST['addressid'];
	
	require_once "connect.php";
			
	$connection = mysqli_connect($host, $db_user, $db_password) or die("Błąd połączenia z bazą danych" . mysqli_error());
	mysqli_query($connection, "SET CHARSET utf8");
	mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	mysqli_select_db($connection, $db_name);
			
	$delete="DELETE FROM addresses WHERE addressid=$addressid";
		
	if (mysqli_query($connection, $delete))
	{
		echo "<p>Usunięto rekord!</p>";
	}
	else
	{
		echo "Nie udało się zaktualizować rekordu! Proszę wypełnić wszystkie pola!";
		echo "Error: " . $update . "<br>" . mysqli_error($connection);
	}

	mysqli_close($connection);

?>
 
</body>

</html>