<?php
	session_start();
	if((!isset($_POST['login'])) || (!isset($_POST['password'])))										//cofnięcie do index.php w przypadku błędnych danych logowania
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
		$login = $_POST['login'];																		//odczytanie loginu i hasła z tablicy POST
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");												//zamiana znaków specjalnych w login na encje html (blokuje SQL injection, XSS)
		
		if ($result = @$connection->query(																//identyfikacja danych wprowadzonych przez użytkownika jako string (blokuje SQL injection, XSS)
		sprintf("SELECT * FROM users WHERE username='%s'",
		mysqli_real_escape_string($connection, $login))))
		{
			$users_quantity = $result->num_rows;														//sprawdzenie ile jest użytkowników zgodnych z zapytaniem
			if($users_quantity>0)
			{
				$row = $result->fetch_assoc();															//pobranie danych użytkownika
				if(password_verify($password, $row['password']))
				{
					$_SESSION['loggedin'] = true;														//ustawienie sesji jako zalogowany
					$_SESSION['userid'] = $row['userid'];												//pobranie userid
					$_SESSION['username'] = $row['username'];											//pobranie username
					$_SESSION['userpriv'] = $row['userpriv'];
				
					unset($_SESSION['error']);															//wyłączenie błędu sesji
					$result->close();																	//wyczyszczenie wyniku zapytania SQL z pamięci
					header('Location: mainpage.php');													//przekierowanie do mainpage.php
				}
				else
				{
					$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';	//włączenie błędu sesji i wyświetlenie informacji oraz przekierowanie do strony logowania
					header('Location: index.php');
				}
			}
		}
		$connection->close();																			//zamknięcie połączenia z bazą danych
	}
?>
