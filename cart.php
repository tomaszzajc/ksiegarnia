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
	<input type="button" value="Twoje dane" onclick="window.location.href='updateuser.php'" />
	<input type="button" value="Koszyk" onclick="window.location.href='cart.php'" />
	<br /><br />

    <table class="db-table">
        <tr>
        <?php
		
            ini_set("display_errors", 0);
            require_once "connect.php";
            $connection = mysqli_connect($host, $db_user, $db_password);
			mysqli_query($connection, "SET CHARSET utf8");
			mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($connection, $db_name);
            
			//$result = mysqli_query($connection,"SELECT * FROM sessioncart WHERE userid='$userid'") or die('Nie można wyświetlić tabeli');
			
			$userid = $_SESSION['userid'];
			$result = mysqli_query($connection,"SELECT * FROM sessioncart INNER JOIN books ON sessioncart.booksid=books.id WHERE sessioncart.userid='$userid'") or die('Nie można wyświetlić tabeli');
			
			$quantity = mysqli_num_rows($result);
            echo "Ksiązki w koszyku: ".$quantity;
			
			if ($quantity>=1)
			{
echo<<<END
<th class="db-table">Okładka</th>
<th class="db-table">Seria</th>
<th class="db-table">Cykl</th>
<th class="db-table">Tytuł</th>
<th class="db-table">Tom</th>
<th class="db-table">Autor</th>
<th class="db-table">Wydawca</th>
<th class="db-table">Rok wydania</th>
<th class="db-table">Opis</th>
<th class="db-table">ISBN</th>
<th class="db-table">Cena</th>
</tr><tr>
END;
			}

			for ($i = 1; $i <= $quantity; $i++) 
			{		
			$row = mysqli_fetch_assoc($result);
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

echo<<<END
<td class="db-table"><img src="images/$a0" alt="$a1, $a2, $a3" height="250" width="150"></td>
<td class="db-table" width="100px">$a1</td>
<td class="db-table" width="100px">$a2</td>
<td class="db-table" width="100px">$a3</td>
<td class="db-table" width="50px">$a4</td>
<td class="db-table" width="200px">$a5</td>
<td class="db-table" width="200px">$a6</td>
<td class="db-table" width="50px">$a7</td>
<td class="db-table" width="600px">$a8</td>
<td class="db-table" width="50px">$a9</td>
<td class="db-table" width="50px">$a10</td>
</tr><tr>
END;
			}
		?>
	
		</tr>
	</table>

</body>

</html>