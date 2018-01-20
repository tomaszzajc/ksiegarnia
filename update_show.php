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
	
	<form action="update.php" method="POST">
		<input type="text" name="search" placeholder="Szukaj książek..." />
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
				
				$query = mysqli_query($connection, "SELECT * FROM books WHERE 
					seriestitle LIKE '%$searchq%' OR
					subseriestitle LIKE '%$searchq%' OR
					volumetitle LIKE '%$searchq%' OR
					author LIKE '%$searchq%' OR
					publisher LIKE '%$searchq%' OR
					year LIKE '%$searchq%' OR
					isbn LIKE '%$searchq%'") or die("Nie udało się wyszukać!");
				
				$quantity = mysqli_num_rows($query);
				echo "znaleziono: ".$quantity."<br><br>";
				
				if($quantity == 0)
				{
					echo "<br />Brak książek o podanej wartości!";
				}
				else
				
					$wiersz=0;
					for ($i = 1; $i <= $quantity; $i++) 
					{	
						
						if($wiersz==4){
							ECHO '<div class="w3-row-padding">';
						}	

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
					$iloscZnakow=strlen($a8);
					$skraca='100';
					if ($iloscZnakow>$skraca) {
						$ucina = $skraca-$iloscZnakow;
						$a8 = substr($a8, 0, $ucina);
						$a8 = $a8.'...';
					}
			


echo'<div class="w3-quarter w3-container w3-margin-bottom">'.
'<img src="/ksiegarnia/images/'.$a0.
'" alt="Brak okładki" style="width:100%" class="w3-hover-opacity">
		<div class="w3-container w3-white">
			<p><b>Seria: </b>'.$a1.'</p>
			<p><b>Tytuł: </b>'.$a3.'</p>
			<p><b>Wydawnictwo: </b>'.$a6.'</p>
			<p><b>Autor </b>'.$a5.'</p>
			<p><b>Cena: </b>'.$a10.'</p>
			<p><b>Opis: </b><br>'.$a8.'<a href=""></a></p>
			<form action="edit.php" method="POST" style="float: left">
			<input type="hidden" name="bookid" value="'.$a11.'">
			<input type="submit" value="Edytuj">
			</form>
			<form action="delete.php" method="POST" style="float: left">
			<input type="hidden" name="bookid" value="'.$a11.'">
			<input type="submit" value="Usuń">
			</form>
		</div>
	</div>';

if($wiersz==3)
{
	$wiersz = 0;
	ECHO '</div>';
}
else
{
	$wiersz++; 
}

					}
				}
			
		?>
		</tr>
	</table>	
	
</body>

</html>