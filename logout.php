<?php
session_start();
    if(isset($_SESSION['logged']) && isset($_SESSION['id']))
	{
        if(session_destroy())
		{
            echo 'Wylogowano';
        }
    }
	else
	{
        echo 'Nie jesteś zalogowany. Przejdź do <a href="login.php">Formularza logowania</a>.';
    }
?>