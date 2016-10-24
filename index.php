<?php
session_start();
?>
<!DOCTYPE HTML>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>City Delivery</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <meta name="theme-color" content="#00796B" />
    <meta name="viewport" content="width=device-width, user-scalable=no" />


    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=latin-ext" rel="stylesheet">
</head>

<body>

    <div id="container">
        <div id="add_delivery_fadeout" class="fadeout"></div>
        <div id="under_menu_fadeout" class="fadeout"></div>
<?php
if ($_SESSION['logged'] != true) {
    ?>
        <div id="login_popup" class="popup_hidden_down">
          <h1>Zaloguj się</h1>
          <form method="POST" action="login.php">
            <div class="form_group">
                <input type="text" name="login" class="normal_input" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Login</label>
            </div>
            <div class="form_group">
                <input type="password" name="password" class="normal_input" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Hasło</label>
            </div>
            <input type="submit" class="submit_btn" value="Zaloguj">
          </form>
        </div>
<?php

}
 ?>

        <div id="manual_location" class="popup_hidden_down">
          <h1>Gdzie jesteś?</h1>
          <p>Proszę, wprowadź nazwę miasta oraz województwa w którym się znajdujesz, abyśmy mogli wyświetlić Ci listę paczek znajdujących się w pobliżu.</p>
          <form>
            <input type="text" name="ms_city" placeholder="np. Sieradz" required>
            <input type="submit" value="Potwierdź" class="submit_btn">
          </form>
        </div>
        <?php
        if ($_SESSION['logged'] == true) {
            ?>
        <div id="new_delivery_popup" class="popup_hidden_down">
            <i id="new_delivery_closer" class="material-icons">close</i>
            <h3>Nadaj Paczkę</h3>
            <form id="new_delivery_form" method="POST" action="addpack.php">
                <div class="form_group">
                    <input type="text" name="start_address" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Ulica i numer domu/mieszkania nadawcy</label>
                </div>
                <div class="form_group">
                    <input type="text" name="end_address" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Ulica i numer domu/mieszkania odbiorcy</label>
                </div>
                <div class="form_group">
                    <input type="text" name="start_city" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Miasto nadawcy</label>
                </div>
                <div class="form_group">
                    <input type="text" name="end_city" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Miasto docelowe</label>
                </div>
                <div class="form_group">
                    <input type="text" name="start_zipcode" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Kod pocztowy nadawcy(NN-NNN)</label>
                </div>
                <div class="form_group">
                    <input type="text" name="end_zipcode" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Kod pocztowy docelowy(NN-NNN)</label>
                </div>
                <div class="form_group">
                    <input type="datetime-local" name="prefered_send_time" class="normal_input">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Preferowany czas odbioru od nadawcy</label>
                </div>
                <div class="form_group">
                    <input type="email" name="receiver_email" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Adres e-mail odbiorcu</label>
                </div>
                <div class="form_group">
                    <input type="text" name="dimensions" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Wymiary paczki(dł x szer x wys)</label>
                </div>
                <div class="form_group">
                    <input type="number" name="mass" class="normal_input" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Waga paczki(kg)</label>
                </div>
                <input type="submit" value="Nadaj" class="submit_btn">
            </form>
        </div>
        <?php
        } ?>
        <div id="navbar" class="navbar_closed">
            <div id="navbar_header">
                <i class="material-icons navbtn">close</i>
            </div>
            <div class="navbar_options">
                <ul>
                    <?php
                    if ($_SESSION['logged'] == true) {
                        ?>
                    <li id="addPackage"><img src="img/box1.svg">Nadaj paczkę</li>
<?php
                    }
 ?>
                    <li id="setLocation"><img src="img/pin_grey.svg" style="width:18px;">Ustaw lokalizacje</li>
                    <?php
                    if ($_SESSION['logged'] != true) {
                        ?>
                    <li id="login">Zaloguj się</li>
                    <?php
                                        }
                     ?>
                    <li>Opcja 4</li>
                    <?php
                    if ($_SESSION['logged'] == TRUE) {
                        ?>
                    <li><a href="logout.php">Wyloguj się</a></li>
                    <?php
                } ?>
                </ul>
            </div>
        </div>
        <header class="default-primary-color">
            <div id="header_container">
                <i class="material-icons navbtn">menu</i>
                <div id="textlogo"><span>City Deploy</span><span> Project</span></div>
            </div>
        </header>
        <div id="cards">
            <div class="card" id="mapcard">

                <div class="card_body">
                    <div id="map_container">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div id="sidecards_container">
                <div class="card" id="near_points_card">
                    <div class="card_header">
                        <span>Paczki w mieście</span>
                    </div>
                    <div class="card_body">
                        <ul>

                        </ul>
                    </div>
                </div>
                <div class="card" id="user_packages">
                    <div class="card_header">
                        <span>Paczki użytkownika</span>
                    </div>
                    <div class="card_body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvdkhVoUNfxjryKF8FJ3ZpsWLDJRfr3vY&callback=initMap" async defer></script>

</body>

</html>
