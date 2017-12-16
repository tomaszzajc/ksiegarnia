<?php
	session_start();
	
	if(!isset($_SESSION['loggedin']))																	//odeslanie do strony index.php jesli nie wykryto aktywnej sesji
	{
		header('Location: index.php');
		exit();
	}

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
		//$quantity=$_POST["quantity"];
		
		$insert="INSERT INTO sessioncart (id, userid, bookid, quantity) VALUES ('NULL', '$userid', '$bookid', '1')";
		
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
	header("Location:cart_show.php");
?>