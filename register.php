<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && !isset($_SESSION['logged'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
	$email = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];
    if (empty($login) || empty($password) || empty($email) || empty($phonenumber)) {
        echo 'Wypełnij wszystkie dane.';
    } else {
        if (!file_exists('dbconfig.php')) {
            echo'Nie znaleziono pliku konfiguracyjnego bazy';
        } else {
            // Dane logowania do bazy
        require_once 'dbconfig.php';
            $mysqli = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);
            if ($mysqli->connect_error) {
                echo 'Problem z połączeniem się z bazą danych:'.$mysqli->connect_error.'['.$mysqli->connect_errno.']';
            }
			else {
				
                $login = trim(strip_tags($mysqli->real_escape_string($login)));
                $password = md5(hash('sha256', trim(strip_tags($mysqli->real_escape_string($password)))));
				$email = trim(strip_tags($mysqli -> real_escape_string($email)));
				$phonenumber = trim(strip_tags($mysqli -> real_escape_string($phonenumber)));
				
                $stmt = $mysqli->prepare("INSERT INTO `users`(`id`, `login`,`password`, `email`, `phone`) VALUES('', ? , ?, ?, ?)");
                $stmt->bind_param('sssi', $login, $password, $email, $phonenumber);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    echo 'Zostałeś pomyślnie zarejestrowany';
                    header('Location: index.php');
                } else {
                    echo 'Błąd podczas rejestracji';
                }
            }
        }
    }
}

?>