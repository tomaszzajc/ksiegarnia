<?php
	session_start();
	
	if(!isset($_SESSION['loggedin']))																	//odeslanie do strony index.php jesli nie wykryto aktywnej sesji
	{
		header('Location: index.php');
		exit();
	}
?>

<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="style.css" type="text/css">
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

Dziękujemy za zakup w naszej księgarni

<?php

	require_once "connect.php";																			//sprawdzenie czy istnieje plik z danymi do połączenia się z bazą danych
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);									//pobranie danych dostępowych do połączenia z bazą danych SQL

	if($connection->connect_errno!=0)																	//sprawdzenie czy udało się połączyć
	{
		echo "Error: ".$connection->connect_errno;														//wyświetlenie błędu połączenia, gdy nie można się połączyć
	}
	else
	{
		$userid = $_SESSION['userid'];
		$bookid = $_POST['bookid'];
		$addressid = $_POST['addressid'];
		$orderquantity=1;
		
		$insert="INSERT INTO sessioncart (userid, bookid, orderquantity) VALUES ('$userid', '$bookid', '$orderquantity') ON DUPLICATE KEY UPDATE orderquantity=orderquantity+".$orderquantity.";
		
		if (mysqli_query($connection, $insert))
		{
			echo "<p>Dodano do koszyka!</p>";
			header('Location: cart.php');
		}
		else
		{
			echo "Nie udało się dodać do koszyka!<br />";
			echo "Error: " . $insert . "<br>" . mysqli_error($connection);
		}
	
		$connection->close();
	}
	
	mysqli_close($connection);
?>
 
</body>

</html>