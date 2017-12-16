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
	<input type="button" value="Twoje konto" onclick="window.location.href='myaccount.php'" />
	<input type="button" value="Koszyk" onclick="window.location.href='cart.php'" /><br />
<?php
	if(isset($_SESSION['loggedin']) && ($_SESSION['userpriv']=="admin"))
	{
	echo '<input type="button" value="Dodaj książkę" onclick=window.location.href="add.php" />
	<input type="button" value="Edytuj/Usuń książkę" onclick=window.location.href="update.php" />
	<input type="button" value="Zarządzaj użytkownikami" onclick=window.location.href="updateuser.php" /><br /><br />';
	}
?>

	<br><h2>Dodaj książkę</h2>
	
	<form action="add.php" method="POST" enctype="multipart/form-data">
		Seria: <input type="text" name="seriestitle"> 
		Cykl: <input type="text" name="subseriestitle"> 
		Tytuł tomu: <input type="text" name="volumetitle"> 
		Numer tomu: <input type="text" name="volumeno"><br /><br />
		Autor: <input type="text" name="author"><br /><br />
		Wydawca: <input type="text" name="publisher"> 
		Rok wydania: <input type="text" name="year"><br /><br />
		Opis: <textarea rows="10" cols="100" name="description"></textarea><br /><br />
		ISBN: <input type="text" name="isbn"><br /><br />
		Cena: <input type="text" name="price"><br /><br />
		Okładka: <input type="file" name="imageurl"><br /><br />
		 <input type="submit" name="add" value="Dodaj książkę">
	 </form>
 
	 <?php
		ini_set("display_errors", 0);
		require_once "connect.php";
		
		$path="images/";
		
		if (isset($_POST["add"]))
		{
			$connection = mysqli_connect($host, $db_user, $db_password) or die("Błąd połączenia z bazą danych" . mysqli_error());
			mysqli_query($connection, "SET CHARSET utf8");
			mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			mysqli_select_db($connection, $db_name);
			
			$seriestitle=$_POST["seriestitle"];
			$subseriestitle=$_POST["subseriestitle"];
			$volumetitle=$_POST["volumetitle"];
			$volumeno=$_POST["volumeno"];
			$author=$_POST["author"];
			$publisher=$_POST["publisher"];
			$year=$_POST["year"];
			$description=$_POST["description"];
			$isbn=$_POST["isbn"];
			$price=$_POST["price"];
			
			$path=$path.$_FILES['imageurl']['name'];
			if(move_uploaded_file($_FILES['imageurl']['tmp_name'],$path))
			{
				echo " ".basename($_FILES['imageurl']['name'])." został wgrany<br/>";
				$img=$_FILES['imageurl']['name'];
				
			}else
				{$img='brak.png';}
				
			
				
				
				$insert="INSERT INTO books (seriestitle, subseriestitle, volumetitle, volumeno, author, publisher, year, description, isbn, price, imageurl)
				VALUES ('$seriestitle', '$subseriestitle', '$volumetitle', $volumeno, '$author', '$publisher', $year, '$description', '$isbn', $price, '$img')";	
			
			
			
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
		}
	 ?>
 
</body>

</html>