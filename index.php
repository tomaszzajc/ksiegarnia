<?php
	session_start();																					//rozpoczęcie sesji
	
	if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==true))									//przekierowanie do mainpage.php jesli uzytkownik jest juz zalogowany
	{
		header('Location: mainpage.php');
		exit();
	}
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<title>Projekt WWSIS</title>
	<link rel="stylesheet" href="login-style.css" type="text/css">
 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>

<body>

<section id="login">
    
<div class="container">
    	
<div class="row">
    	    
<div class="col-xs-12">
        	    
<div class="form-wrap">
                
<h1>Witamy w księgarni</h1>
		<form role="form" action="login.php" method="POST" id="login-form" autocomplete="off">
			<div class="form-group">
                            
				<label for="login" class="sr-only">Login</label>
                            
				<input type="text" name="login" id="email" class="form-control" placeholder="Login">
                        
			</div>

			<div class="form-group">
                            
				<label for="password" class="sr-only">Password</label>
                            
				<input type="password" name="password" id="key" class="form-control" placeholder="Hasło">
                        
			</div>

			<input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Zaloguj">

		</form>
		<p class="forget">Jeśli nie posiadasz konta <a href="register.php">zarejestruj się!</a></p>                    
<hr>
        	    
</div>
    		
</div> <!-- /.col-xs-12 -->
    	
</div> <!-- /.row -->
    
</div> <!-- /.container -->

</section>

	
<?php
	if(isset($_SESSION['error']))	echo $_SESSION['error'];											//wyświetlenie informacji o niepoprawnych danych logowania w przypadku błędnych danych
?>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>