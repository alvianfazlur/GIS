<!DOCTYPE html>
<html lang="en">
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Pengangguransky</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/landingpage/css/animate.css" />
    <link rel="stylesheet" href="assets/landingpage/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/landingpage/css/all.min.css" />
    <link rel="stylesheet" href="assets/landingpage/css/icofont.min.css" />
    <link rel="stylesheet" href="assets/landingpage/css/swiper.min.css" />
    <link rel="stylesheet" href="assets/landingpage/css/odometer.css" />
    <link rel="stylesheet" href="assets/landingpage/css/lightcase.css" />
    <link rel="stylesheet" href="assets/landingpage/css/style.css" />

	<style>
		html, body {
			height: 100%;
      margin-top: 20px;
      margin-left: 10px;
		}
    #imageSlider {
      height: 200px;
      overflow: hidden;
    }

    .carousel-inner img {
      object-fit: cover;
      height: 100%;
    }
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
    #legend {
      background-color: white;
      padding: 10px;
      border-radius: 5px;
    }
    .circle {
      width: 10px;
      height: 10px;
      display: inline-block;
      margin-right: 5px;
    }
	</style>

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="/lib/remixicon/fonts/remixicon.css" />
        <link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css" />
    
        <!-- Template CSS -->
        <link rel="stylesheet" href="/assets/css/style.min.css" />
	
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
          <a href="/" class="sidebar-logo">Idle Tracker</a>
        </div>
        <!-- sidebar-header -->
        <div id="sidebarMenu" class="sidebar-body">
          <div class="nav-group show">
            <a href="#" class="nav-label">Dashboard</a>
            <ul class="nav nav-sidebar">
              <li class="nav-item">
                <a href="/lp" class="nav-link"><i class="ri-map-pin-line"></i> <span>Map</span></a>
              </li>
              <li class="nav-item">
                <a href="../dashboard/events.html" class="nav-link"><i class="ri-database-line"></i> <span>Database</span></a>
              </li>
              <li class="nav-item">
                <a href="../dashboard/sales.html" class="nav-link"><i class="ri-contacts-line"></i> <span>Contact Us</span></a>
              </li>
            </ul>
          </div>

        </div>
        <!-- sidebar-body -->
        <!-- sidebar-footer -->
      </div>
      <!-- sidebar -->
  
      <div class="header-main px-3 px-lg-4">
        <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>
  
        <div class="form-search me-auto">
          <input type="text" class="form-control" placeholder="Search" />
          <i class="ri-search-line"></i>
        </div>
        <!-- form-search -->
  

      </div>
      <!-- header-main -->

      <div class="main main-app p-2 p-lg-2">
        <div id="map" style="width: 100%;"></div>
        <div id="legend" class="leaflet-control"></div>
      </div>
<script src="https://cdn.jsdelivr.net/leaflet/1.3.1/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/dataset.js"></script>
<script src="/dataloker.js"></script>

<script>
	
    const map = L.map('map').setView([-7.6440623,112.7734131], 8);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

  var legend = L.control({
    position: 'bottomright'
  });

legend.onAdd = function(map) {
    var div = L.DomUtil.get('legend');
    div.innerHTML = '<h4>Chloropleth</h4>' +
        '<div><span class="circle" style="background-color: #800026;"></span> Parah</div>' +
        '<div><span class="circle" style="background-color: #BD0026;"></span> Parah</div>' +
        '<div><span class="circle" style="background-color: #E31A1C;"></span> Parah</div>' +
        '<div><span class="circle" style="background-color: #FC4E2A;"></span> Sedang</div>' +
        '<div><span class="circle" style="background-color: #FD8D3C;"></span> Sedang</div>' +
        '<div><span class="circle" style="background-color: #FEB24C;"></span> Rendah</div>' +
        '<div><span class="circle" style="background-color: #FED976;"></span> Rendah</div>' +
        '<div><span class="circle" style="background-color: #FFEDA0;"></span> Aman</div>';
    return div;
};

legend.addTo(map);

  var officeIcon = L.icon({
        iconUrl: 'assets/kantor.png',
        iconSize:    [35, 35], // size of the icon
    });
    function getColor(d) {
        return d > 1000 ? '#800026' :
            d > 500  ? '#BD0026' :
            d > 200  ? '#E31A1C' :
            d > 100  ? '#FC4E2A' :
            d > 50   ? '#FD8D3C' :
            d > 20   ? '#FEB24C' :
            d > 10   ? '#FED976' :
                        '#FFEDA0';
    }

    function style(feature) {
        return {
            fillColor: getColor(feature.properties.density),
            weight: 2,
            opacity: 2,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

// L.geoJson(geoJsonData, {style: style}).addTo(map);
L.geoJson(geoJsonData, {
  style: style,
  onEachFeature: function(feature, layer) {
    layer.bindPopup("<strong> Nama Daerah : </strong>" + feature.properties.wadmkk);
  }
}).addTo(map);

$.getJSON('assets/geojson/dataloker.geojson', function (data) {
        L.geoJSON(data, {
            pointToLayer: function (feature, latlng) {
                return L.marker(latlng, {
                    icon: officeIcon
                });
            },

            onEachFeature: function (feature, layer) {
                var properties = feature.properties;

                // Membuat popup dengan informasi titik
                var popupContent = '<div style="text-align: center; font-family: Poppins, sans-serif; font-size: 14px;">';
                popupContent += '<div style="text-align: center;">';
                popupContent += '<h3>' + properties.name + '</h3>';
                popupContent += '<img src="' + properties.image + '" style="width: 150px;height: 150px">';
                popupContent += '<br><br><strong>Lowongan Yang Tersedia : </strong><br>' + properties.lowongan;
                popupContent += '<br><strong>Alamat :</strong><br>' + properties.location;
                popupContent += '</div>';
                layer.bindPopup(popupContent);
            }
        }).addTo(map);
    });
</script>

<div id="carouselExampleControls" class="carousel slide w-20 mx-auto" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/assets/img/laravel.png" class="d-block w-100" alt="..." >
    </div>
    <div class="carousel-item">
      <img src="/assets/img/leaflet.svg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/assets/img/geojson.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/assets/img/mysql.png" class="d-block w-100" alt="...">
    </div>
  </div>
 <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>

<script src="/lib/jquery/jquery.min.js"></script>
<script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/lib/jquery.flot/jquery.flot.js"></script>
<script src="../lib/jquery.flot/jquery.flot.stack.js"></script>
<script src="../lib/jquery.flot/jquery.flot.resize.js"></script>
<script src="../lib/jquery.flot/jquery.flot.threshold.js"></script>
<script src="../lib/chart.js/chart.min.js"></script>
<script src="../lib/jqvmap/jquery.vmap.min.js"></script>
<script src="../lib/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="/assets/js/script.js"></script>
<script src="/assets/js/db.data.js"></script>
<script src="/assets/js/db.sales.js"></script>

<footer class="footer footer--four">
  <div class="footer__top padding-tb bg-home6">
      <div class="container">
          <div class="row g-4 justify-content-center">
              <div class="col-lg-3 col-sm-6 col-12">
                  <div class="footer__about">
                      <div class="footer__title wow fadeInUp" data-wow-delay=".5s">
                          <h5>IdleTracker</h5>
                      </div>
                      <div class="footer__body wow fadeInUp" data-wow-delay=".5s">
                          <p>Website ini didedikasikan untuk menyajikan informasi tentang data pengangguran di
                              Jawa Timur secara visual.</p>
                          <ul>
                              <li>
                                  <div class="icon"><i class="icofont-phone"></i></div>
                                  <div class="text">+62-813-5703-0197</div>
                              </li>
                              <li>
                                  <div class="icon"><i class="icofont-envelope"></i></div>
                                  <div class="text">kulitjeruk720@gmail.com</div>
                              </li>
                              <li>
                                  <div class="icon"><i class="icofont-google-map"></i></div>
                                  <div class="text">PENS, Surabaya</div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-sm-6 col-12">
                  <div class="footer__timetable">
                      <div class="footer__title wow fadeInUp" data-wow-delay=".5s">
                          <h5>Working Days</h5>
                      </div>
                      <div class="footer__body wow fadeInUp" data-wow-delay=".5s">
                          <ul>
                              <li>
                                  <div class="left">Monday</div>
                                  <div class="right">08AM - 5PM</div>
                              </li>
                              <li>
                                  <div class="left">Tuesday</div>
                                  <div class="right">08AM - 5PM</div>
                              </li>
                              <li>
                                  <div class="left">Wednesday</div>
                                  <div class="right">08AM - 5PM</div>
                              </li>
                              <li>
                                  <div class="left">Thursday</div>
                                  <div class="right">08AM - 5PM</div>
                              </li>
                              <li>
                                  <div class="left">Friday</div>
                                  <div class="right">08AM - 11AM</div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-lg-2 col-sm-6 col-12">
                  <div class="footer__link">
                      <div class="footer__body wow fadeInUp" data-wow-delay=".5s">
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="footer__bottom wow fadeInUp" data-wow-delay=".5s">
      <div class="container">
          <p>&copy; 2023 <a href="index.html">IdleTracker</a> all Right Reserved by <a href="#"
                  target="_blank">Webgis09</a></p>
      </div>
  </div>
</footer>


            <script src="assets/landingpage/js/jquery.js"></script>
            <script src="assets/landingpage/js/bootstrap.bundle.min.js"></script>
            <script src="assets/landingpage/js/waypoints.min.js"></script>
            <script src="assets/landingpage/js/swiper.min.js"></script>
            <script src="assets/landingpage/js/jquery.counterup.min.js"></script>
            <script src="assets/landingpage/js/circularProgressBar.min.js"></script>
            <script src="assets/landingpage/js/wow.min.js"></script>
            <script src="assets/landingpage/js/isotope.pkgd.min.js"></script>
            <script src="assets/landingpage/js/viewport.jquery.js"></script>
            <script src="assets/landingpage/js/odometer.min.js"></script>
            <script src="assets/landingpage/js/lightcase.js"></script>
            <script src="assets/landingpage/js/functions.js"></script>
</body>

