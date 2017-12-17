<?php
	
	
	if(!isset($_SESSION['loggedin']))																	//odeslanie do strony index.php jesli nie wykryto aktywnej sesji
	{
		header('Location: index.php');
		exit();
	}
?>

<html lang="pl">


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
			
	$update="UPDATE users SET userpriv='admin' WHERE userid=$userid";
		
	if (mysqli_query($connection, $update))
	{
		echo "<p>Nadano uprawnienia!</p>";
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