//FUNKCJE POMOCNICZE

function numberToRoman(int) {
    if (!+int)
        return false;
    var digits = String(+int).split(""),
        key = ["", "C", "CC", "CCC", "CD", "D", "DC", "DCC", "DCCC", "CM",
            "", "X", "XX", "XXX", "XL", "L", "LX", "LXX", "LXXX", "XC",
            "", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX"
        ],
        roman = "",
        i = 3;
    while (i--)
        roman = (key[+digits.pop() + (i * 10)] || "") + roman;
    return Array(+digits.join("") + 1).join("M") + roman;
}

function timestampToDate(timestamp) {
    var date = new Date(timestamp * 1000);
    var day = date.getDate();
    var month = date.getMonth();
    month = numberToRoman(month);
    var hours = date.getHours();
    var minutes = "0" + date.getMinutes();
    var formattedTime = day + '.' + month + ' ' + hours + ':' + minutes.substr(-2);
    return formattedTime
}

function toggleNav() {
    var nav = document.querySelector('#navbar');
    var fade = document.querySelector('#under_menu_fadeout');
    var fadeState = fade.style.display;
    if (fadeState == 'block') {
        setTimeout(function() {
            fade.style.display = 'none';
        }, 400);
    } else {
        fade.style.display = 'block';
    }
    nav.classList.toggle('navbar_closed');
    setTimeout(function() {
        fade.classList.toggle('fadeout_on');
    }, 50);
}

function loginPopup() {
    var fade = document.querySelector('#add_delivery_fadeout');
    var popup = document.querySelector('#login_popup')
    fade.style.display = 'block';
    popup.style.display = "block"
    $("#add_delivery_fadeout").unbind("click", closeAddDeliveryPopup);
    $('#add_delivery_fadeout').bind("click", hideLoginPopup);
    setTimeout(function() {
        fade.classList.toggle('fadeout_on');
        popup.classList.toggle('popup_hidden_down');
    }, 50);
}

function hideLoginPopup() {
    var fade = document.querySelector('#add_delivery_fadeout');
    var popup = document.querySelector('#login_popup')
    popup.classList.toggle('popup_hidden_down');
    fade.classList.toggle('fadeout_on');
    $('#add_delivery_fadeout').unbind("click", hideLoginPopup);
    $('#add_delivery_fadeout').bind("click", closeAddDeliveryPopup);
    setTimeout(function() {
        popup.style.display = 'none';
        fade.style.display = 'none';
    }, 400);
}

function manualCitySubmit(e) {
    var form = this.parentElement;
    var input = form.querySelector('[name=ms_city]').value
    e.preventDefault();
    $.get({
        url: 'https://maps.googleapis.com/maps/api/geocode/json',
        data: {
            address: input
        },
        success: function(suc) {
            var position = suc.results[0].geometry.location;
            alternativeMapInit(position);
            hideLocationPopup();
            return;
        },
        error: function(err) {
            console.log(err);
            return;
        }
    })
}

function showLocationPopup() {
    var fade = document.querySelector('#add_delivery_fadeout');
    var popup = document.querySelector('#manual_location')
    fade.style.display = 'block';
    popup.style.display = "block"
    $("#add_delivery_fadeout").unbind("click", closeAddDeliveryPopup);
    setTimeout(function() {
        fade.classList.toggle('fadeout_on');
        popup.classList.toggle('popup_hidden_down');
    }, 50);
}

function hideLocationPopup() {
    var fade = document.querySelector('#add_delivery_fadeout');
    var popup = document.querySelector('#manual_location')
    popup.classList.toggle('popup_hidden_down');
    fade.classList.toggle('fadeout_on');
    $('#add_delivery_fadeout').bind("click", closeAddDeliveryPopup);
    setTimeout(function() {
        popup.style.display = 'none';
        fade.style.display = 'none';
    }, 400);
}

function liveLocation(map) {
    function live(pos) {
        var lat = pos.coords.latitude;
        var lng = pos.coords.longitude;
        var marker = new google.maps.Marker({
            position: {
                lat,
                lng
            },
            map: map,
            title: 'User Position!'
        });
        var newPos = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
        if (marker) marker.setPosition(newPos)
    }


    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(live)
    }
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        scrollwheel: true,
        zoom: 13,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: true,
        streetViewControl: false,
        rotateControl: true,
        fullscreenControl: false,
        mapTypeId: 'roadmap'
    });

    if (navigator.geolocation) {
        var options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
            map.setZoom(13);
            // liveLocation(map);
            getCityPackages({
                pos
            }, map)
        }, function locationError() {
            showLocationPopup();
        });
    } else {
        //NIEWSPIERANA GEOLOKALIZACJA
        return;
    }
}

function alternativeMapInit(pos) {
    map = new google.maps.Map(document.getElementById('map'), {
        scrollwheel: true,
        zoom: 13,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: true,
        streetViewControl: false,
        rotateControl: true,
        fullscreenControl: false,
        mapTypeId: 'roadmap'
    });
    map.setCenter(pos);
    map.setZoom(13);
    // liveLocation(map);
    getCityPackages({
        pos
    }, map)
}

function addDelivery() {
    var fade = document.querySelector('#add_delivery_fadeout');
    var popup = document.querySelector('#new_delivery_popup');
    fade.style.display = 'block';
    popup.style.display = 'block';
    setTimeout(function() {
        popup.classList.toggle('popup_hidden_down');
        fade.classList.toggle('fadeout_on');
    }, 50);
}

function closeAddDeliveryPopup() {
    var fade = document.querySelector('#add_delivery_fadeout');
    var popup = document.querySelector('#new_delivery_popup');
    popup.classList.toggle('popup_hidden_down');
    fade.classList.toggle('fadeout_on');
    setTimeout(function() {
        popup.style.display = 'none';
        fade.style.display = 'none';
    }, 400);
}

function initializePackagesPoints(packages, map) {
    var card = document.querySelector('#near_points_card>.card_body');
    var packagesList = '';
    var points = [];
    packages.forEach(function(package) {
      var id = package.id;
        var startplace = package.startAddress;
        var endplace = package.endAddress;
        var mass = package.mass;
        var pst = package.preferedSendTime;
        pst = timestampToDate(pst);
        var size = package.dimensions
        var startPoint = package.startPoint;
        var endPoint = package.endPoint;
        var distanceToStartPoint = package.distance.toString();
        distanceToStartPoint = distanceToStartPoint.substr(0, 4) + 'km'
        var row = `<li class="city_list_row" meta-start-point="${startPoint}" meta-end-point="${endPoint}" data-id="${id}">
                    <div class="city_list_elem_container">
                      <div class='city_list_elem_title'><div>${startplace} \&#8594; ${endplace}</div></div class='city_list_elem_title'>
                      <div class='city_list_elem_info'><div class="single_info">Rozmiar: ${size}</div><div class="single_info">Odległość od nadawcy: ${distanceToStartPoint}</div><div class="single_info">Masa: ${mass}</div><div class="single_info" title="Preferowany Czas Nadania">PCN: ${pst}</div></div>
                    </div>
                    <div class='getDelivery'><i class="material-icons">add</i></div>

                    </li>`;
        packagesList = packagesList.concat(row);
    })
    card.innerHTML = packagesList;
    $('.city_list_elem_container').click(refreshMap);
    $('.getDelivery').click(writePackageDelivery);
}

function writePackageDelivery() {
  var dataElem = $(this).parent();
  console.log(dataElem.attr('data-id'));
}

function refreshMap() {
    // var myLatlng = new google.maps.LatLng(51.6628856, 19.3489427);
    var startCoords = $(this).parent().attr('meta-start-point').split(',');
    var endCoords = $(this).parent().attr('meta-end-point').split(',');
    startCoords[0] = parseFloat(startCoords[0]);
    startCoords[1] = parseFloat(startCoords[1]);
    endCoords[0] = parseFloat(endCoords[0]);
    endCoords[1] = parseFloat(endCoords[1]);

    var startLatLng = new google.maps.LatLng(startCoords[0], startCoords[1]);
    var endLatLng = new google.maps.LatLng(endCoords[0], endCoords[1]);

    var mapOptions = {
        zoom: 13,
        center: startLatLng
    }
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    var startMarker = new google.maps.Marker({
        position: startLatLng,
        title: "Miejsce odbioru paczki",
        icon: "img/pin_red.png"
    });
    var endMarker = new google.maps.Marker({
        position: endLatLng,
        title: "Miejsce nadania paczki",
        icon: "img/pin_green.png"
    });
    startMarker.setMap(map);
    endMarker.setMap(map);
}

function getCityPackages(position, map) {
    $.ajax({
        url: "http://164.132.196.156:3030/getCityPackages",
        method: "POST",
        data: {
            "location": position
        },
        success: function(packages) {
            initializePackagesPoints(packages, map);
            return;
        },
        error: function(err) {
            console.log(err);
            return;
        }
    })
}




(function() {
    $('#manual_location>form>.submit_btn').click(manualCitySubmit)
    $('.navbtn').click(toggleNav);
    $('#addPackage').click(addDelivery);
    $('#new_delivery_closer').click(closeAddDeliveryPopup);
    $('#add_delivery_fadeout').bind("click", closeAddDeliveryPopup);
    $('#under_menu_fadeout').click(toggleNav);
    $('#setLocation').click(showLocationPopup);
    $('#login').click(loginPopup);
})()
