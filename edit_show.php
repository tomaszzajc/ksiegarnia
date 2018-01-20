<?php

	
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

<div class="w3-container" >	
<?php
	if(isset($_SESSION['loggedin']) && ($_SESSION['userpriv']=="admin"))
	{
		echo '<input type="button" value="Dodaj książkę" onclick=window.location.href="add.php" />
		<input type="button" value="Edytuj/Usuń książkę" onclick=window.location.href="update.php" />
		<input type="button" value="Zarządzaj użytkownikami" onclick=window.location.href="updateuser.php" /><br /><br />';
	}
?>

	<br><h2>Popraw książkę</h2>

<?php
	$bookid = $_POST['bookid'];
	$bookid = $GLOBALS["bookid"];

	require_once "connect.php";
			
	$connection = mysqli_connect($host, $db_user, $db_password) or die("Błąd połączenia z bazą danych" . mysqli_error());
	mysqli_query($connection, "SET CHARSET utf8");
	mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	mysqli_select_db($connection, $db_name);
			
	$query = mysqli_query($connection, "SELECT * FROM books WHERE bookid LIKE '$bookid'") or die("Nie udało się wyszukać!");
	
	$row = mysqli_fetch_assoc($query);
	$a0 = "$row[imageurl]";
	$a1 = "$row[seriestitle]";
	$a2 = "$row[subseriestitle]";
	$a3 = "$row[volumetitle]";
	$a4 = "$row[volumeno]";
	$a5 = "$row[author]";
	$a6 = "$row[publisher]";
	$a7 = "$row[year]";
	$a8 = "$row[description]";
	$a9 = "$row[isbn]";
	$a10 = "$row[price]";
	$a11 = "$row[bookid]";
	$a12 = "$row[quantity]";
?>

	<form action="edit.php" method="POST" enctype="multipart/form-data">
		Seria: <input type="text" size="80" name="seriestitle" value="<?php echo $a1; ?>" required><br /><br /> 
		Cykl: <input type="text" size="80" name="subseriestitle" value="<?php echo $a2; ?>" required><br /><br />
		Tytuł tomu: <input type="text" size="80" name="volumetitle" value="<?php echo $a3; ?>" required><br /><br />
		Numer tomu: <input type="text" size="80" name="volumeno" value="<?php echo $a4; ?>" required><br /><br />
		Autor: <input type="text" size="80" name="author" value="<?php echo $a5; ?>" required><br /><br />
		Wydawca: <input type="text" size="80" name="publisher" value="<?php echo $a6; ?>" required><br /><br />
		Rok wydania: <input type="text" size="80" name="year" value="<?php echo $a7; ?>" required><br /><br />
		Opis: <textarea rows="12" cols="80" name="description" required><?php echo $a8; ?></textarea><br /><br />
		ISBN: <input type="text" size="80" name="isbn" value="<?php echo $a9; ?>" required><br /><br />
		Cena: <input type="text" size="80" name="price" value="<?php echo $a10; ?>" required><br /><br />
		Ilość: <input type="text" size="80" name="quantity" value="<?php echo $a12; ?>" required><br /><br />
		Okładka: <input type="file" name="imageurl"><br /><br />
		<input type="hidden" name="bookid" value="<?php echo $a11; ?>">
		<input type="submit" name="edit" value="Popraw książkę">
	</form>
 
	 <?php
		ini_set("display_errors", 0);
		require_once "connect.php";
		
		$path="images/";
		
		if (isset($_POST["edit"]))
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
			$bookid=$_POST["bookid"];
			$img=$_POST["imageurl"];
			$quantity=$_POST["quantity"];
			
			$path=$path.$_FILES['imageurl']['name'];
				
			if(move_uploaded_file($_FILES['imageurl']['tmp_name'],$path))
			{
			echo " ".basename($_FILES['imageurl']['name'])." został wgrany<br/>";
			
			$img=$_FILES['imageurl']['name'];
				

			}else{
				$img='brak.png';
			}
			//else
			//{
			//	echo "Wystąpił błąd, powtórz operację lub sprawdź ścieżkę do pliku";
			//}
						$update="UPDATE books SET 
			seriestitle='$seriestitle',
			subseriestitle='$subseriestitle',
			volumetitle='$volumetitle',
			volumeno=$volumeno,
			author='$author',
			publisher='$publisher',
			year=$year,
			description='$description',
			isbn='$isbn',
			price=$price,
			imageurl='$img',
			quantity='$quantity'
			WHERE bookid=$bookid";
			
			if (mysqli_query($connection, $update))
			{
				echo "Poprawiono rekord!";
			}
			else
			{
				echo "Nie udało się utworzyć nowego rekordu! Proszę wypełnić wszystkie pola!";
				echo "Error: " . $update . "<br>" . mysqli_error($connection);
			}
			
			
			
			mysqli_close($connection);
			
			
	$bookid = $_POST['bookid'];
	
	require_once "connect.php";
			
	$connection = mysqli_connect($host, $db_user, $db_password) or die("Błąd połączenia z bazą danych" . mysqli_error());
	mysqli_query($connection, "SET CHARSET utf8");
	mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	mysqli_select_db($connection, $db_name);
			
	$query = mysqli_query($connection, "SELECT * FROM books WHERE bookid LIKE '$bookid'") or die("Nie udało się wyszukać!");
	
	$row = mysqli_fetch_assoc($query);
	$a0 = "$row[imageurl]";
	$a1 = "$row[seriestitle]";
	$a2 = "$row[subseriestitle]";
	$a3 = "$row[volumetitle]";
	$a4 = "$row[volumeno]";
	$a5 = "$row[author]";
	$a6 = "$row[publisher]";
	$a7 = "$row[year]";
	$a8 = "$row[description]";
	$a9 = "$row[isbn]";
	$a10 = "$row[price]";
	$a11 = "$row[bookid]";
	$a12 = "$row[quantity]";

		}
	 ?>
 </div>
</body>

</html>