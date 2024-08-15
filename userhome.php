<?php
  include("includes/connection.php");
  include("includes/session_check_user.php");
	include("includes/data.php");
	require("alert/alert.php");
	$settings = getById("tbl_settings","1");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $settings['app_name']?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/chocolat/dist/css/chocolat.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />

</head>

<style>
  .centerit {
    right: 50%;
    bottom: 50%;
    transform: translate(50%, 50%);
    position: absolute;
  }
</style>

<body>

  <div id="particles-js"></div>
  <!-- stats - count particles -->
  <!-- particles.js lib - https://github.com/VincentGarreau/particles.js -->
  <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <!-- stats.js lib -->
  <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>

  <div class="col-sm-6 col-md-4 col-md-offset-4 centerit">
    <div class="card" id="sample-login">

      <div class="card-header" style="text-align:center; display:block;font-size: x-large; color: #1b2c33;">
        <h3 style="text-align:center;"><?php echo $settings['header_title']?></h3>
      </div>

      <div class="card-header" style="text-align:center; display:block;font-size: x-large; color: #4f8f10;">
        <h3 style="text-align:center;"><?php echo $settings['variable_link']?></h3>
      </div>

      <div class="card-header" style="text-align:center; display:block;>
                          <div class=" col-sm-12 col-md-7">
        <img style="max-width: 60%; object-fit: cover;" src="images/variable/<?php echo $settings['variable_image'];?>"
          alt="">
      </div>
    </div>

    <div class="card-body pb-0">



    </div>
  </div>
  </div>
  </div>

  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/prism/prism.js"></script>
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>

</html>