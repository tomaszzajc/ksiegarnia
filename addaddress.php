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
	<input type="button" value="Twoje konto" onclick="window.location.href='myaccount.php'" />
	<input type="button" value="Koszyk" onclick="window.location.href='cart.php'" />

	<br><h2>Dodaj adres</h2>
	
	<form action="addaddress.php" method="POST" enctype="multipart/form-data">
		Odbiorca: <input type="text" name="addresstype"><br /><br />
		Ulica: <input type="text" name="street"> 
		Nr domu: <input type="text" name="number"> 
		Nr mieszkania: <input type="text" name="aptno"><br /><br />
		Kod pocztowy: <input type="text" name="zipcode">
		Miasto: <input type="text" name="city"><br /><br />
		Kraj: <input type="text" name="country"><br /><br />
		 <input type="submit" name="add" value="Dodaj adres">
	 </form>
 
	 <?php
		ini_set("display_errors", 0);
		require_once "connect.php";
			
		if (isset($_POST["add"]))
		{
			$connection = mysqli_connect($host, $db_user, $db_password) or die("Błąd połączenia z bazą danych" . mysqli_error());
			mysqli_query($connection, "SET CHARSET utf8");
			mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			mysqli_select_db($connection, $db_name);
			
			$userid=$_SESSION['userid'];			
			$addresstype=$_POST["addresstype"];
			$street=$_POST["street"];
			$number=$_POST["number"];
			$aptno=$_POST["aptno"];
			$zipcode=$_POST["zipcode"];
			$city=$_POST["city"];
			$country=$_POST["country"];
			
			$insert="INSERT INTO addresses (userid, addresstype, street, number, aptno, zipcode, city, country)
			VALUES ($userid, '$addresstype', '$street', '$number', '$aptno', '$zipcode', '$city', '$country')";	
		}
		else
		{
			echo "Wystąpił błąd, powtórz operację lub sprawdź ścieżkę do pliku";
		}
			
		if (mysqli_query($connection, $insert))
		{
			echo "Utworzono nowy rekord!";
		}
		else
		{
			echo "Nie udało się utworzyć nowego rekordu! Proszę wypełnić wszystkie pola!";
			echo "Error: " . $insert . "<br>" . mysqli_error($connection);
		}
			
		mysqli_close($connection);
	 ?>
 
</body>

</html>