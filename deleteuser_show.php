<?php
	
	
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
	if(isset($_SESSION['loggedin']) && ($_SESSION['userpriv']=="admin"))
	{
	echo '<input type="button" value="Dodaj książkę" onclick=window.location.href="add.php" />
	<input type="button" value="Edytuj/Usuń książkę" onclick=window.location.href="update.php" />
	<input type="button" value="Zarządzaj użytkownikami" onclick=window.location.href="updateuser.php" /><br /><br />';
	}
?>

<?php
	$userid = $_POST['userid'];
	
	require_once "connect.php";
			
	$connection = mysqli_connect($host, $db_user, $db_password) or die("Błąd połączenia z bazą danych" . mysqli_error());
	mysqli_query($connection, "SET CHARSET utf8");
	mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	mysqli_select_db($connection, $db_name);
			
	$delete="DELETE FROM users WHERE userid=$userid";
		
	if (mysqli_query($connection, $delete))
	{
		echo "<p>Usunięto użytkownika!</p>";
	}
	else
	{
		echo "Nie udało się zaktualizować rekordu! Proszę wypełnić wszystkie pola!";
		//echo "Error: " . $update . "<br>" . mysqli_error($connection);
	}

	mysqli_close($connection);
	

?>
 
</body>

</html>