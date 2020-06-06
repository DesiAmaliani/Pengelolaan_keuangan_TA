<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="<?php echo base_url(); ?>tampilan/assets/img/logo-cuplik.PNG" type="image/x-icon"/>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Aplikasi Pengelolaan Keuangan PT. Cuplik Media Center</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>tampilan/node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>tampilan/node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>tampilan/node_modules/weathericons/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>tampilan/node_modules/summernote/dist/summernote-bs4.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>tampilan/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>tampilan/assets/css/components.css"> 
  <script type="text/javascript" src="<?php echo base_url(); ?>tampilan/assets/js/page/Chart.js"></script>

</head>

<body>
  
<?php $this->load->view($header) ?>
<?php $this->load->view($nav) ?>
  <?php $this->load->view($container) ?>
  <!-- General JS Scripts -->

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>tampilan/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?php echo base_url(); ?>tampilan/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
  <!-- <script src="<?php echo base_url(); ?>tampilan/node_modules/chart.js/dist/Chart.min.js"></script> -->
  <script src="<?php echo base_url(); ?>tampilan/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>tampilan/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>tampilan/node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>tampilan/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  
  
  <!-- Template JS File -->
  <script src="<?php echo base_url(); ?>tampilan/assets/js/scripts.js"></script>
  <script src="<?php echo base_url(); ?>tampilan/assets/js/custom.js"></script>
  <script>
    $(function() {
      $('#only-number').on('keydown', '#no_hp', function(e){
          -1!==$
          .inArray(e.keyCode,[46,8,9,27,13,110,190]) || /65|67|86|88/
          .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey)
          || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey|| 48 > e.keyCode || 57 < e.keyCode)
          && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
      });
    })
</script>

  <!-- Page Specific JS File -->
  <!-- <script src="<?php echo base_url(); ?>tampilan/assets/js/page/index-0.js"></script> -->
</body>
</html>
