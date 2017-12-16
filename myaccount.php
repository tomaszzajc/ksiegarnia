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
	
<table class="db-table">
        <tr>
        <?php
		
            ini_set("display_errors", 0);
            require_once "connect.php";
            $connection = mysqli_connect($host, $db_user, $db_password);
			mysqli_query($connection, "SET CHARSET utf8");
			mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($connection, $db_name);
            
			$userid = $_SESSION['userid'];
			$result = mysqli_query($connection,"SELECT * FROM addresses WHERE userid='$userid'") or die('Nie można wyświetlić tabeli');
			$quantity = mysqli_num_rows($result);
            echo "Adresy: ".$quantity;
			
			if ($quantity>=1)
			{
echo<<<END
<th class="db-table">Odbiorca</th>
<th class="db-table">Ulica</th>
<th class="db-table">Nr domu</th>
<th class="db-table">Nr mieszkania</th>
<th class="db-table">Kod pocztowy</th>
<th class="db-table">Miasto</th>
<th class="db-table">Kraj</th>
<th class="db-table">Usuń adres</th>
</tr><tr>
END;
			}

			for ($i = 1; $i <= $quantity; $i++) 
			{		
			$row = mysqli_fetch_assoc($result);
			$a0 = "$row[addresstype]";
			$a1 = "$row[street]";
			$a2 = "$row[number]";
			$a3 = "$row[aptno]";
			$a4 = "$row[zipcode]";
			$a5 = "$row[city]";
			$a6 = "$row[country]";
			$a7 = "$row[addressid]";

echo<<<END
<td class="db-table" width="100px">$a0</td>
<td class="db-table" width="100px">$a1</td>
<td class="db-table" width="50px">$a2</td>
<td class="db-table" width="50px">$a3</td>
<td class="db-table" width="50px">$a4</td>
<td class="db-table" width="200px">$a5</td>
<td class="db-table" width="200px">$a6</td>
<td class="db-table" width="50px">
	<form action="deleteaddress.php" method="POST">
	<input type="hidden" name="addressid" value="$a7">
    <input type="submit" value="Usuń">
	</form>
</td>
</tr><tr>
END;
			}
		?>
		
		</tr>
	</table>
	
	<input type="button" value="Dodaj adres" onclick=window.location.href="addaddress.php" />
	
</body>

</html>