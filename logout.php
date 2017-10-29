<?php

	session_start();
	session_unset();																					//zamknięcie sesji
	header('Location: index.php');																		//przekierowanie do index.php po zamknięciu sesji

?>
