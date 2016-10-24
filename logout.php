<?php
session_start();
    if(isset($_SESSION['logged']) && isset($_SESSION['id']))
	{
        if(session_destroy())
		{
            echo 'Wylogowano';
            header('Location: index.php');
        }
    }
	else
	{
        echo 'Nie jesteś zalogowany. Przejdź do <a href="index.php">Formularza logowania</a>.';
    }
?>