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
	
	<form action="updateuser.php" method="POST">
		<input type="text" name="search" placeholder="Szukaj użytkownika..." />
		<input type="submit" value="Szukaj" />
	</form>
 
	<table class="db-table">
        <tr>
		<?php

			//ini_set("display_errors", 0);
			require_once "connect.php";
			
			$connection = mysqli_connect($host, $db_user, $db_password) or die("Błąd połączenia z bazą danych" . mysqli_error());
			mysqli_query($connection, "SET CHARSET utf8");
			mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			mysqli_select_db($connection, $db_name);
			
			if(isset($_POST['search']))
			{
				$searchq = $_POST['search'];
				$searchq = preg_replace("#[^0-9a-zA-Z]#i","",$searchq);
				
				$query = mysqli_query($connection, "SELECT * FROM users WHERE 
					username LIKE '%$searchq%' OR
					email LIKE '%$searchq%'") or die("Nie udało się wyszukać!");
				
				$quantity = mysqli_num_rows($query);
				echo "znaleziono: ".$quantity;
				
				if($quantity == 0)
				{
					echo "<br />Brak użytkowników o podanej wartości!";
				}
				else
				{
					if ($quantity>=1)
					{
echo<<<END
<th class="db-table">Login</th>
<th class="db-table">Email</th>
<th class="db-table">Uprawnienia</th>
<th class="db-table">Edycja rekordu</th>
</tr><tr>
END;
					}

					for ($i = 1; $i <= $quantity; $i++) 
					{		
					$row = mysqli_fetch_assoc($query);
					$a0 = "$row[username]";
					$a1 = "$row[email]";
					$a2 = "$row[userpriv]";
					$a3 = "$row[userid]";

echo<<<END
<td class="db-table" width="100px">$a0</td>
<td class="db-table" width="100px">$a1</td>
<td class="db-table" width="100px">$a2</td>
<td class="db-table" width="50px">
	<form action="addpriv.php" method="POST">
	<input type="hidden" name="userid" value="$a3">
    <input type="submit" value="Nadaj uprawnienia">
	</form>
	<form action="deletepriv.php" method="POST">
	<input type="hidden" name="userid" value="$a3">
    <input type="submit" value="Usuń uprawnienia">
	</form>
	<form action="deleteuser.php" method="POST">
	<input type="hidden" name="userid" value="$a3">
    <input type="submit" value="Usuń użytkownika">
	</form>
</td>
</td>
</tr><tr>
END;
					}
				}
			}
		?>
		</tr>
	</table>	
	
</body>

</html>