<?php

session_start();
// Czy jest POST i czy jest zalogowany
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && isset($_SESSION['logged'])) {
    // ID Nadawcy z sesji
    $senderid = $_SESSION['id'];
    // Dane z POST
    // Adres nadawcy
    $start_address = $_POST['start_address'];
    $start_city = $_POST['start_city'];
    $start_zipcode = $_POST['start_zipcode'];
    // Adres odbiorcy
    $end_address = $_POST['end_address'];
    $end_city = $_POST['end_city'];
    $end_zipcode = $_POST['end_zipcode'];
    // Preferowany czas dostarczenia
    $prefered_send_time = $_POST['prefered_send_time'];
    // Mail odbiorcy (do weryfikacji istnienia konta i pobrania danych)
    $receiver_email = $_POST['receiver_email'];
    // Wymiary przesylki
    $dimensions = $_POST['dimensions'];
    // Masa przesylki
    $mass = $_POST['mass'];
    // Weryfikacja wpisania pol
    if (empty($start_address) || empty($start_city) || empty($start_zipcode) || empty($end_address) || empty($end_city) || empty($end_zipcode) || empty($prefered_send_time) || empty($receiver_email) || empty($dimensions) || empty($mass)) {
        echo 'Wypełnij wszystkie pola.';
    } else {
        if (!file_exists('dbconfig.php')) {
            echo'Nie znaleziono pliku konfiguracyjnego bazy';
        } else {
            // Dane logowania do bazy
        require_once 'dbconfig.php';
            $mysqli = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);
            if ($mysqli->connect_error) {
                echo 'Problem z połączeniem się z bazą danych:'.$mysqli->connect_error.'['.$mysqli->connect_errno.']';
            } else {
                $mysqli->set_charset("utf8");
                // Filtrowanie maila odbiorcy
                $receiver_email = trim(strip_tags($mysqli->real_escape_string($receiver_email)));
                if (!filter_var($receiver_email, FILTER_VALIDATE_EMAIL)) {
                    return 'Niepoprawny adres E-mail odbiorcy.';
                }
                // Zapytanie ID odbiorcy
                $receiverquery = $mysqli->query("SELECT `id` FROM `users` WHERE email = '$receiver_email'");
                if ($receiverquery->num_rows == 1) {
                    $receiver = $receiverquery->fetch_row();
                    // Ustalenie zmiennej z ID odbiorcy
                    $receiverid = $receiver[0];

                    // Filtrowanie danych wprowadzonych
                    $start_address = trim(strip_tags($mysqli->real_escape_string($start_address)));
                    $start_city = trim(strip_tags($mysqli->real_escape_string($start_city)));
                    $start_zipcode = trim(strip_tags($mysqli->real_escape_string($start_zipcode)));
                    $end_address = trim(strip_tags($mysqli->real_escape_string($end_address)));
                    $end_city = trim(strip_tags($mysqli->real_escape_string($end_city)));
                    $end_zipcode = trim(strip_tags($mysqli->real_escape_string($end_zipcode)));
                    $prefered_send_time = trim(strip_tags($mysqli->real_escape_string($prefered_send_time)));
                    $dimensions = trim(strip_tags($mysqli->real_escape_string($dimensions)));
                    $mass = trim(strip_tags($mysqli->real_escape_string($mass)));

                    // Generowanie kodu dostarczenia
                    $receivecode = time();
                    $receivecode = 'CD'. $receivecode .'';
                    $receivecode = md5($receivecode);

                    // Okreslenie wspolrzednych
                    $address = ''. $start_address .' '. $start_city .' '. $start_zipcode .'';
                    $start = geocode($address);
                    $start_lat = $start[0];
                    $start_lon = $start[1];
                    $start_latlng = ''. $start_lat .','. $start_lon .'';
                    $address = ''. $end_address .' '. $end_city .' '. $end_zipcode .'';
                    $end = geocode($address);
                    $end_lat = $end[0];
                    $end_lon = $end[1];
                    $end_latlng = ''. $end_lat .','. $end_lon .'';

                    // Wysłanie do bazy
                    $stmt = $mysqli->prepare("INSERT INTO `packages` (`id`, `senderid`, `start_address`, `start_city`, `start_zipcode`, `start_latlng`, `receiverid`, `end_address`, `end_city`, `end_zipcode`, `end_latlng`, `prefered_send_time`, `dimensions`, `mass`, `add_time`, `delivery_confirmation_code`) VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?)");
                    $stmt->bind_param('issssissssisis', $senderid, $start_address, $start_city, $start_zipcode, $start_latlng, $receiverid, $end_address, $end_city, $end_zipcode, $end_latlng, $prefered_send_time, $dimensions, $mass, $receivecode);
                    $stmt->execute();

                    if ($stmt->affected_rows == 1) {
                        echo 'Przesyłka dodana pomyślnie';
                    } else {
                        echo 'Błąd podczas dodawania przesyłki!';
                        printf("Error: %s.\n", $stmt->error);
                    }
                } else {
                    echo 'Brak zarejestrowanego użytkownika (odbiorcy) z podanym email!';
                }
            }
        }
    }
}
