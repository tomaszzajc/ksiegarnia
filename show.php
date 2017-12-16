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
	<title>Księgarnia</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
	</style>
</head>

<body>

<?php
	if(isset($_SESSION['loggedin']) && ($_SESSION['userpriv']=="admin"))
	{
	echo '<input type="button" value="Dodaj" onclick=window.location.href="add.php" />
	<input type="button" value="Popraw/Usuń" onclick=window.location.href="update.php" />
	<input type="button" value="Zarządzaj użytkownikami" onclick=window.location.href="updateuser.php" />';
	}
?>
	<br /><br />

        <?php
		
            ini_set("display_errors", 0);
            require_once "connect.php";
            $connection = mysqli_connect($host, $db_user, $db_password);
			mysqli_query($connection, "SET CHARSET utf8");
			mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($connection, $db_name);
            
			$result = mysqli_query($connection,'SELECT * FROM books') or die('Nie można wyświetlić tabeli');
			$quantity = mysqli_num_rows($result);
			echo '<div class=w3-row-padding>';
			
			if ($quantity>=1)
			{	
				for ($i = 1; $i <= $quantity; $i++)
				{
					if($wiersz==4){
						ECHO '<div class="w3-row-padding">';
					}	
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
					$iloscZnakow=strlen($a8);
					$skraca='252';
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
								<p><form action="add_to_cart.php" method="POST">
									<input type="hidden" name="bookid" value='.$a11.'>
									<input type="submit" value="Dodaj do koszyka">
								</form></p>
								  <p><b>Opis: </b><br>'.$a8.'<a href=""> więcej.</a></p>
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


</body>

</html>