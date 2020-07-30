<!DOCTYPE html>
<html>
<head>
<title>Google Maps API: Cara Menampilkan Lokasi dengan PHP dan MySQL</title>
<script  async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7CKYceeEYMnFQOIOW8hy9m6Qy0Bx3KAU&callback=initialize" async defer></script>
<script type="text/javascript">   
    var marker;
    function initialize(){
        // Variabel untuk menyimpan informasi lokasi
        var infoWindow = new google.maps.InfoWindow;
        //  Variabel berisi properti tipe peta
        var mapOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        } 
        // Pembuatan peta
        var peta = new google.maps.Map(document.getElementById('googleMap'), mapOptions);      
		// Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();
        // Pengambilan data dari database MySQL
        <?php
		// Sesuaikan dengan konfigurasi koneksi Anda
			echo "addMarker($latitude, $longitude);\n";
		?> 
        // Proses membuat marker 
        function addMarker(lat, lng ){
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: peta,
                position: lokasi
            });       
            peta.fitBounds(bounds);
            bindInfoWindow(marker, peta, infoWindow);
         }
        // Menampilkan informasi pada masing-masing marker yang diklik
        function bindInfoWindow(marker, peta, infoWindow, html){
            google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(peta, marker);
          });
        }
    }
</script>
</head>
<body>

  <div id="googleMap" style="width:1500px;height:700px;"></div>
 
</body>
</html>