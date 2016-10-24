<?php
// Start sesji
session_start();
// Czy sesja już istnieje (= użytkownik zalogowany)
if (isset($_SESSION['logged'])) {
    echo 'Jesteś już zalogowany! <a href="logout.php">Wyloguj się</a>';
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
        // Przekazanie danych z POST do zmiennych
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (empty($login) || empty($password)) {
            if (empty($login) && empty($password)) {
                echo 'Nie wprowadzono żadnych danych';
            } else {
                if (empty($login)) {
                    echo 'Nie podano loginu';
                } elseif (empty($password)) {
                    echo 'Nie podano hasła';
                }
            }
        } else {
            // Czy istnieje plik z konfiguracją bazy
            if (!file_exists('dbconfig.php')) {
                echo'Nie znaleziono pliku konfiguracyjnego bazy';
            } else {
                // Dane logowania do bazy
                require_once 'dbconfig.php';
                // Schemat łączenia z bazą
                $mysqli = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);
                // Sprawdzanie połączenia
                if ($mysqli->connect_error) {
                    echo 'Problem z połączeniem - '.$mysqli->connect_error.'['.$mysqli->connect_errno.']';
                } else {
                    $login = trim(strip_tags($mysqli->real_escape_string($login)));
                    $password = md5(hash('sha256', trim(strip_tags($mysqli->real_escape_string($password)))));
                    $result = $mysqli->query("SELECT id FROM `users` WHERE login = '$login' and password = '$password'");
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_row();
                        $_SESSION['id'] = $row[0];
                        $_SESSION['logged'] = true;
                        header('Location: index.php');
                    } else {
                        echo 'Brak użytkownika z podanymi danymi w bazie.';
                    }
                }
            }
        }
    }
}
ob_end_flush();
?>
