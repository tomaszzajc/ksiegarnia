<?php

	session_start();
	setcookie("visit", "", time()-3600);
	session_unset();																					//zamknięcie sesji
	header('Location: index.php');																		//przekierowanie do index.php po zamknięciu sesji

?>
