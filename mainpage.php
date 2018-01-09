<?php
	session_start();
	
	if(!isset($_SESSION['loggedin']))																	//odeslanie do strony index.php jesli nie wykryto aktywnej sesji
	{
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>

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

<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-animate-left" background-image: url("http://4.bp.blogspot.com/-bldk4nqnE6k/VGaQe8RDdrI/AAAAAAAAzVM/gam6lF4fol4/s1600/20141114100727.jpg") style="z-index:3;width:300px;" id="mySidebar"><br> <!--background-image: url("http://4.bp.blogspot.com/-bldk4nqnE6k/VGaQe8RDdrI/AAAAAAAAzVM/gam6lF4fol4/s1600/20141114100727.jpg") style="z-index:3;width:300px;"-->
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
 <img src="http://4.bp.blogspot.com/-bldk4nqnE6k/VGaQe8RDdrI/AAAAAAAAzVM/gam6lF4fol4/s1600/20141114100727.jpg" style="width:95%;" class="w3-round"><br><br>
    <h4><b>Menu</b></h4>
    <p class="w3-text-grey"></p>
  </div>
  <div class="w3-bar-block">
  <p class="w3-padding w3-text-teal">
  <?php
		echo "Witaj ".$_SESSION['username'].'!<br>';
		
		if(isset($_COOKIE['visit']))
		{
			$visitno = intval($_COOKIE['visit']);
			$visitno++;
			setcookie("visit", "$visitno", time()+3600*24);
			echo "To są twoje $visitno odwiedziny!<br> Witaj ponownie!";
		}
		else
		{
			setcookie("visit", "1", time()+3600*24);
			echo "To jest Twoja 1-sza wizyta!";
		}
	?>
	</p>
    <a href="mainpage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Ksiązki</a> 
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw w3-margin-right"></i>O nas</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>Kontakt</a>
	<a href="myaccount.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>Twoje konto</a>
	<a href="cart_show.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-shopping-cart fa-fw w3-margin-right"></i>Twój koszyk</a>
	<a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-lock fa-fw w3-margin-right"></i>Wyloguj</a>
	
  </div>
    <div class="w3-panel w3-large">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
    </div>
  </nav>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="book">
    <a href="#"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>Księgarnia</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16" >
      <span class="w3-margin-right">Filter:</span> 
      <form action="mainpage.php" method="POST"  style="display: inline;">
        <input type="text"  class="w3-input w3-border" style="width:200px;display: inline;" name="search" placeholder="Szukaj książek..." required/>
        <button type="submit" class="w3-button w3-white" style="display: inline;">
												<i class="fa fa-search w3-margin-right"></i>  Szukaj
				</button>
      </form>
      <button class="w3-button w3-white" style="display: inline;" onclick="window.location.href='show.php'"><i class="fa fa-th-large w3-margin-right"></i>Wszystkie</button>
     <!-- <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
      <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button> -->
    </div>
    </div>
  </header>


  <?php include 'show.php';?>


<div class="w3-container w3-padding-large" style="margin-bottom:32px" id="about">
    <h4><b>O nas</b></h4>
    <p>	Ksiegarnia jest jednym z największych sprzedawców książek w Polsce. Każdego dnia zespół 300 osób pracuje nad tym, aby każde z ponad 200 tysięcy zamówień składanych miesięcznie zostało zrealizowane z najwyższą jakością.
		Ekspresową wysyłkę i szeroką ofertę gwarantuje nam nasz magazyn o powierzchni prawie 4100 m², znajdujący się w jednym z najnowocześniejszych parków logistycznych w Europie – Goodman Kraków Airport Logistics Centre. Może on pomieścić aż 1 000 000 egzemplarzy książek. Przechowujemy w nim 80 000 tytułów, które jesteśmy w stanie wysłać nawet w ciągu 15 minut od złożenia zamówienia. Klienci z Krakowa, Warszawy, Wrocławia, Poznania, Łodzi, Katowic i Rzeszowa mogą odbierać swoje zamówienia w 20 naszych punktach odbioru bez dodatkowych kosztów dostawy!
		Bonito.pl wysłało pierwszą książkę w 2006 roku, więc obchodzimy już 11 urodziny. W tym roku przekroczymy liczbę 8 milionów zrealizowanych zamówień! Dziękujemy za okazane zaufanie – to dzięki niemu rozwijamy się w tak szybkim tempie. Dołożymy wszelkich starań aby każdy z Klientów był zadowolony z wysokiej jakości obsługi i niskich cen, jakie oferujemy.
</p>
    <hr>    
  
  <!-- Contact Section -->
  <div class="w3-container w3-padding-large w3-grey">
    <h4 id="contact"><b>Kontakt</b></h4>
    <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
        <p>email@email.com</p>
      </div>
      <div class="w3-third w3-teal">
        <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
        <p>Wrocław PL</p>
      </div>
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
        <p>512312311</p>
      </div>
    </div>
    <hr class="w3-opacity">
    <form action="/action_page.php" target="_blank">
      <div class="w3-section">
        <label>Nazwa</label>
        <input class="w3-input w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-section">
        <label>Email</label>
        <input class="w3-input w3-border" type="text" name="Email" required>
      </div>
      <div class="w3-section">
        <label>Wiadomość</label>
        <input class="w3-input w3-border" type="text" name="Message" required>
      </div>
      <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fa fa-paper-plane w3-margin-right"></i>Wyślij wiadomość</button>
    </form>
  </div>


	<!-- Footer -->
	<footer class="w3-container w3-padding-32 w3-dark-grey">
  <div class="w3-row-padding">
    <div class="w3-third">
      <h3>FOOTER</h3>
      <p>
	  	  </p>
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">wwsis</a></p>
    </div>
  
    <div class="w3-third">
      <!--<h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>-->
    </div>

    <div class="w3-third">
      <h3>Tagi</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Książka</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">London</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Komiks</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">DIY</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Powieść</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Family</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Tekst</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Shopping</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Księgarnia</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Games</span>
      </p>
    </div>

  </div>
  </footer>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>



</body>

</html>