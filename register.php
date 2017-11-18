<?php
	session_start();
	
	if(isset($_POST['email']))
	{
		$all_OK=true;																					//Walidacja rejestracji
		
		$login = $_POST['login'];																		//Sprawdzenie czy login jest poprawny
		if((strlen($login)<3) || (strlen($login)>20))
		{
			$all_OK=false;
			$_SESSION['e_login']="Login musi mieć od 3 do 20 znaków!";
		}
		if(ctype_alnum($login)==false)
		{
			$all_OK=false;
			$_SESSION['e_login']="Tylko litery i cyfry (bez znaków specjalnych)!";
		}
		
		$email = $_POST['email'];																		//Sprawdzenie czy e-mail jest poprawny
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$all_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		$password1 = $_POST['password1'];																//Sprawdzenie czy hasła są poprawne
		$password2 = $_POST['password2'];
		if((strlen($password1)<8) || (strlen($password1)>20))
		{
			$all_OK=false;
			$_SESSION['e_password']="Hasło musi mieć od 8 do 20 znaków";
		}
		$password_hash = password_hash($password1, PASSWORD_DEFAULT);									//Zahashowanie hasła
		
		if(!isset($_POST['terms']))																		//Sprawdzenie czy regulamin jest zaakceptowany
		{
			$all_OK=false;
			$_SESSION['e_terms']="Regulamin musi być zaakceptowany!";
		}
		
		if($password1!=$password2)
		{
			$all_OK=false;
			$_SESSION['e_password']="Podane hasła nie są identyczne";
		}
		
		$secretkey = "6LdhSzYUAAAAAIRoffB5qDR2YuYcDZBE1VLLacbD";										//Sprawdzenie czy recaptcha została potwierdzona
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response='.$_POST['g-recaptcha-response']);
		$response = json_decode($check);
		if($response->success==false)
		{
			$all_OK=false;
			$_SESSION['e_recaptcha']="Potwierdź, że nie jesteś botem!";
		}	
		
		$_SESSION['form_login'] = $login;																//Utworzenie zmiennych sesyjnych do autouzupełniania pól podczas błędu w rejestracji
		$_SESSION['form_email'] = $email;
		$_SESSION['form_password1'] = $password1;
		$_SESSION['form_password2'] = $password2;
		if(isset($_POST['terms']))$_SESSION['form_terms'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0)															//sprawdzenie czy udało się połączyć z bazą danych
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result = $connection->query("SELECT userid FROM users WHERE username='$login'");		//Sprawdzenie czy podany login jest już w bazie danych
				if(!$result) throw new Exception($connection->error);
				$login_quantity = $result->num_rows;
				if($login_quantity>0)
				{
					$all_OK=false;
					$_SESSION['e_login']="Istnieje już konto z tym loginem!";
				}
				
				$result = $connection->query("SELECT userid FROM users WHERE email='$email'");			//Sprawdzenie czy podany e-mail jest już w bazie danych
				if(!$result) throw new Exception($connection->error);
				$email_quantity = $result->num_rows;
				if($email_quantity>0)
				{
					$all_OK=false;
					$_SESSION['e_email']="Istnieje już konto z tym adresem e-mail!";
				}
				
				if($all_OK==true)																		//Dodanie użytkownika do bazy danych
				{
					if($connection->query("INSERT INTO users VALUES(NULL, '$login', '$email', '$password_hash', NULL)"))
					{
						$_SESSION['registrationOK']=true;
						header('Location: welcome.php');
					}
					else
					{
						throw new Exception($connection->error);
					}
				}
				$connection->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span class="error">Błąd serwera! Przepraszamy za niedogodności!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
	}
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<title>Projekt WWSIS</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
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
						<h1>Rejestracja</h1>
							<form role="form" method="POST" id="login-form" autocomplete="off">
								<div class="form-group"> 
									<input type="text" name="login" id="email" class="form-control" placeholder="Login" value="<?php
										if(isset($_SESSION['form_login']))
										{
											echo $_SESSION['form_login'];
											unset($_SESSION['form_login']);
										}
									?>" name="login">
								
									<?php
										if(isset($_SESSION['e_login']))
										{
											echo '<div class="error">'.$_SESSION['e_login'].'</div>';
											unset($_SESSION['e_login']);
										}
									?>
								</div>
								<div class="form-group"> 
								<input type="text" id="email" class="form-control" placeholder="Email" value="<?php
										if(isset($_SESSION['form_email']))
										{
											echo $_SESSION['form_email'];
											unset($_SESSION['form_email']);
										}
									?>" name="email"> 
								</div>
								<?php
									if(isset($_SESSION['e_email']))
									{
										echo '<div class="error">'.$_SESSION['e_email'].'</div>';
										unset($_SESSION['e_email']);
									}
								?>
								<div class="form-group"> 
								<input type="password" id="password1" class="form-control" placeholder="Hasło" value="<?php
									if(isset($_SESSION['form_password1']))
									{
										echo $_SESSION['form_password1'];
										unset($_SESSION['form_password1']);
									}
								?>" name="password1">
								</div>
								<?php
									if(isset($_SESSION['e_password']))
									{
										echo '<div class="error">'.$_SESSION['e_password'].'</div>';
										unset($_SESSION['e_password']);
									}
								?>
								<div class="form-group"> 
								<input type="password" id="password" class="form-control" placeholder="Powtórz hasło" value="<?php
									if(isset($_SESSION['form_password2']))
									{
										echo $_SESSION['form_password2'];
										unset($_SESSION['form_password2']);
									}
								?>" name="password2">
								</div>
								<div class="form-group"> 
									<label class="form-control" autocomplete="off">
									<input type="checkbox" name="terms" class="forgot" <?php
										if(isset($_SESSION['form_terms']))
										{
											echo "checked";
											unset($_SESSION['form_terms']);
										}
									?> /> Akceptuję regulamin strony
									</label>
								</div>
								<?php
									if(isset($_SESSION['e_terms']))
									{
										echo '<div class="error">'.$_SESSION['e_terms'].'</div>';
										unset($_SESSION['e_terms']);
									}
								?>
								
								<div class="g-recaptcha" data-sitekey="6LdhSzYUAAAAAPO9_293dtT65UrDK26mYUXTecDJ"></div> <br />
								
								<?php
									if(isset($_SESSION['e_recaptcha']))
									{
										echo '<div class="error">'.$_SESSION['e_recaptcha'].'</div>';
										unset($_SESSION['e_recaptcha']);
									}
								?>
								<div class="container">
									<div class="row text-center">
									<ul id="topbar">
										<input type="submit" value="Rejestracja" class="btn btn-custom btn-lg" class="pull-left"/>
										<input type="button" value="Logowanie" class="btn btn-custom btn-lg" class="pull-right" onclick="window.location.href='index.php'" />
									</ul>
									</div>
								</div>    
							</form>
							<hr>  	    
					</div>
				</div> <!-- /.col-xs-12 -->
			</div> <!-- /.row -->    
		</div> <!-- /.container -->
	</section>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</body>

</html>