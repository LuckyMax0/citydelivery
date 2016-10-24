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
	<?php
	if ($_SESSION['logged'] == true) {
	    ?>
	<script type="text/javascript">
	<?php
	$userid = $_SESSION['id'];
	echo 'var userid = '. json_encode($userid) .';';
	?>
	</script>
	<?php
}
	?>
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
        <div id="register_popup">
          LOLO
        </div>
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
                    <li id="addPackage"><img src="img/box1.svg" width="18px">Nadaj paczkę</li>
<?php
                    }
 ?>
                    <li id="setLocation"><img src="img/pin_grey.svg" style="width:18px;">Ustaw lokalizacje</li>
                    <?php
                    if ($_SESSION['logged'] != true) {
                        ?>
                    <li id="login"><img src="img/unlock.svg" width="18px">Zaloguj się</li>
                    <?php
                                        }
                     ?>
                    <li id="register"><img src="img/add_circle.svg" width="18px">Załóż konto</li>
                    <?php
                    if ($_SESSION['logged'] == TRUE) {
                        ?>
                    <li><img src="img/lock.svg" width="18px"><a href="logout.php">Wyloguj się</a></li>
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
                        <?php
                        if (isset($_SESSION['id']) && $_SESSION['logged'] == TRUE) {
                            if (file_exists('dbconfig.php')) {
                                // Dane logowania do bazy
                            require_once 'dbconfig.php';
                            // Schemat łączenia z bazą
                            $mysqli = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);
                            // Sprawdzanie połączenia
                            if ($mysqli->connect_error) {
                                echo 'Problem z połączeniem - '.$mysqli->connect_error.'['.$mysqli->connect_errno.']';
                            } else {
								$mysqli->set_charset("utf8");
                                $userid = $_SESSION['id'];
                                $result = $mysqli->query("SELECT * FROM `packages` WHERE senderid = '$userid' OR receiverid = '$userid' OR transporterid = '$userid' ORDER BY add_time DESC");
                                if ($result->num_rows > 0) {
                                    foreach ($result as $res):
										$start_latlng = $res['start_latlng'];
										$end_latlng = $res['end_latlng'];
										$id = $res['id'];
										echo '<li class="city_list_row" meta-start-point="'. $start_latlng .'" meta-end-point="'. $end_latlng .'" data-id="'. $id .'">';
										echo '<div class="city_list_elem_container">';
										if($res['senderid'] == $userid)
										{
											$mystatus = 'Wysłana przeze mnie';
										}
										elseif($res['receiverid'] == $userid)
										{
											$mystatus = 'Wysłana do mnie';
										}
										elseif($res['transporterid'] == $userid)
										{
											$mystatus = 'Transportowana przeze mnie';
										}
										$startaddress = $res['start_address'];
										$startcity = $res['start_city'];
										$startzipcode = $res['start_zipcode'];
										$endaddress = $res['end_address'];
										$endcity = $res['end_city'];
										$endzipcode = $res['end_zipcode'];										
                                        echo '<div class="city_list_elem_title""><div>'. $startaddress .', '. $startzipcode .' '. $startcity .' → '. $endaddress .', '. $endzipcode .' '. $endcity .'</div></div>';
										$size = $res['dimensions'];
										$mass = $res['mass'];
										$pcn = date("j.m.Y, H:i", $res['prefered_send_time']);
                						echo '<div class="city_list_elem_info"><div class="single_info">Rozmiar: '. $size .' [cm]</div><div class="single_info">Masa: '. $mass .' [kg]</div><div class="single_info" title="Preferowany Czas Nadania">PCN: '. $pcn .' </div><div class="single_info" title="Mój udział">'. $mystatus .'</div></div></div>';
										if($res['delivery_time'] != NULL && $res['delivery_time'] > 0)
										{
                    					echo '<div title="dostarczona" class="getDelivery"><i class="material-icons">check</i></div>';
										}
										echo '</li>';
                                    endforeach;
                                }
                            }
                            }
                        }
                         ?>
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
