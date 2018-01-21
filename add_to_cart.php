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
		$orderquantity=1;
		$price = $_POST['price'];
		
		$insert="INSERT INTO sessioncart (userid, bookid, orderquantity, price) VALUES ('$userid', '$bookid', '$orderquantity', '$price') 
		ON DUPLICATE KEY UPDATE orderquantity=orderquantity+$orderquantity";
		
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