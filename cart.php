<?php
	
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
			$result = mysqli_query($connection,"SELECT * FROM sessioncart JOIN books ON books.bookid = sessioncart.bookid WHERE sessioncart.userid='$userid'") or die('Nie można wyświetlić tabeli');
			
			$quantity = mysqli_num_rows($result);
            echo "    Ksiązki w koszyku: ".$quantity;
			
			if ($quantity>=1)
			{
echo<<<END
<th class="db-table" width="100px">Seria</th>
<th class="db-table" width="200px">Tytuł</th>
<th class="db-table" width="40px">Tom</th>
<th class="db-table" width="250px">Autor</th>
<th class="db-table" width="40px">Ilość</th>
<th class="db-table" width="40px">Cena</th>

</tr><tr>
END;
			}
			$dSum == 0;
			for ($i = 1; $i <= $quantity; $i++) 
			{		
			$row = mysqli_fetch_assoc($result);
			$a1 = "$row[seriestitle]";
			$a2 = "$row[volumetitle]";
			$a3 = "$row[volumeno]";
			$a4 = "$row[author]";
			$a5 = "$row[orderquantity]";
			$a6 = "$row[price]";
			$a7 = "$row[bookid]";
			$a8 = "$row[id]";
			$dSum = $dSum + "$row[price]";

echo<<<END
<td class="db-table" width="10px">$a1</td>
<td class="db-table" width="200px">$a2</td>
<td class="db-table" width="40px" align="center">$a3</td>
<td class="db-table" width="250px">$a4</td>
<td class="db-table" width="40px" align="center">$a5</td>
<td class="db-table" width="40px" align="center">$a6</td>
<td class="db-table"  width="20px" align="center">
	<form action="deletecart.php" method="POST">
		<input type="hidden" name="id" value="$a8">
    	<button type="submit" class="w3-button w3-white">
			<i class="fa fa-minus-square w3-margin-right"></i>Usuń
		</button>
	</form>
</td>
</tr><tr>

END;
			}
		?>
	
		</tr>
	</table>
	
	<?php echo "Wartość łączna zamówienia: " .$dSum. " PLN"; ?>
	
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
            echo "<br /><br />";
			echo "    Wybierz adres dostawy: ";
			
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
</tr><tr>
END;
			}

			for ($i = 1; $i <= $quantity; $i++) 
			{		
			$row = mysqli_fetch_assoc($result);
			$a10 = "$row[addresstype]";
			$a11 = "$row[street]";
			$a12 = "$row[number]";
			$a13 = "$row[aptno]";
			$a14 = "$row[zipcode]";
			$a15 = "$row[city]";
			$a16 = "$row[country]";
			$a17 = "$row[addressid]";

echo<<<END
<td class="db-table" width="100px">$a10</td>
<td class="db-table" width="100px">$a11</td>
<td class="db-table" width="50px" align="center">$a12</td>
<td class="db-table" width="50px" align="center">$a13</td>
<td class="db-table" width="50px" align="center">$a14</td>
<td class="db-table" width="200px">$a15</td>
<td class="db-table" width="150px">$a16</td>
<td class="db-table" width="20px" align="center">
	<form action="orderconfirmation.php" method="POST">
	<div class="checkbox">
    <input type="checkbox" class="form-control input-lg" name="addressid" value="$a17"
	</div>
	<?php if (isset($a17) && $a17=="$addressid") echo "checked";?>
	</form>
</td>
</tr><tr>
END;
			}
		?>
		
		</tr>
	</table>
<?php	
echo<<<END
	<form action="orderconfirmation.php" method="POST">
		<input type="hidden" name="bookid" value='.$a7.'>
		<input type="hidden" name="quantity" value='.$a5.'>
		<input type="hidden" name="price" value='.$a6.'>
		<input type="hidden" name="addressid" value='.$a17.'>
    	<button type="submit" class="w3-button w3-white">
			<i class="fa fa-minus-square w3-margin-right"></i>Złóż zamówienie
			
			
			
			
		</button>
		
	</form>
END;
?>
</body>

</html>