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
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }

    .ticket {
      display: flex;
      width: 800px;
      height: 400px;
      background-color: #ffffff;
      border: 2px solid #000000;
      margin: 20px auto;
      position: relative;
    }

    .left-section {
      width: 35%;
      background-color: #009fd4;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .left-section img {
      width: 100px;
      height: 100px;
    }

    .left-section h1 {
      font-size: 24px;
      margin-top: 20px;
    }

    .center-section {
      width: 50%;
      padding: 20px;
      text-align: center;
      position: relative;
      background-color: #f0f0f0;
      background-image: 
          linear-gradient(135deg, rgba(0, 0, 0, 0.1) 25%, transparent 50%, transparent 50%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.1) 75%, transparent 75%, transparent),
          linear-gradient(45deg, rgba(0, 0, 0, 0.1) 25%, transparent 25%, transparent 50%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.1) 75%, transparent 75%, transparent),
          radial-gradient(circle at 10% 10%, rgba(0, 0, 0, 0.05) 0%, transparent 50%);
      background-size: 20px 20px, 20px 20px, 80px 80px;
      background-repeat: repeat, repeat, repeat;
    }

    .right-section{
      width: 15%;
      position: relative;

      background-color: #7fd9fb;
      background-image: 
          linear-gradient(135deg, rgba(0, 0, 0, 0.1) 25%, transparent 25%, transparent 50%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.1) 75%, transparent 75%, transparent),
          linear-gradient(45deg, rgba(0, 0, 0, 0.1) 25%, transparent 25%, transparent 50%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.1) 75%, transparent 75%, transparent),
          radial-gradient(circle at 10% 10%, rgba(0, 0, 0, 0.05) 0%, transparent 50%);
      background-size: 20px 20px, 20px 20px, 80px 80px;
      background-repeat: repeat, repeat, repeat;
    }
    span.coin_box{
      display: block;
      height: 60px;
      /* background: white; */
      width: 75px;
      border-radius: 50%;
      align-content: center;
      text-align: center;
      margin: 25px auto;
      font-size: 22px;
      font-weight: 600;
      background: aliceblue;
      border: 3px solid #4594b5;
    }
    
  </style>
</head>

<body>
  <div class="ticket">
    <div class="left-section">
      <div style="text-align: center; padding: 10px; border: 3px solid white; border-radius: 4px; box-shadow: 5px 5px 10px black inset;">
        <img src="http://localhost/white_globe.png" alt="Lotería Nacional">
        <h1>Lotería Nacional</h1>
      </div>
    </div>
    <div class="center-section">
      <h2>S.E. LOTERIAS Y APUESTAS DEL ESTADO</h2>
      <div class="countdown" id="countdown" style="width: 100%; padding: 10px 0px; background: black; color: white; font-size: 28px; border-radius: 4px;">

      </div>
      <h1>SABADO</h1>
      <h3>LOTERIA NACIONAL</h3>
      <p>Decima parte del billete para el sorteo del dia</p>
      <h1 style="font-size: 24px;">sabado <?php echo date("j M, Y h:i a", strtotime($settings['time_limit']))?></h1>
    </div>
    <div class="right-section">
      <span class="coin_box" style="border-radius: 4px;height: 35px; font-size: 18px">060/24</span>
      <span class="coin_box" style="height: 75px; width: 90px">
        6<sup>a</sup>
        <strong style="font-size: 14px; display: block; font-weight: 600;">SERIE</strong>
      </span>
      <span class="coin_box" style="border-radius: 4px;">
        4
        <strong style="font-size: 12px; display: block; font-weight: 500;">FRACCION</strong>
      </span>
      <span class="coin_box" style="height: 95px; border-radius: 30%">
        <strong style="font-size: 14px; display: block; font-weight: 600;">PRECIO</strong>
        6
        <strong style="font-size: 14px; display: block; font-weight: 600;">EUROS</strong>
      </span>
    </div>
  </div>

  <script>
    // Convert PHP date to JavaScript date
    var targetDate = new Date("<?php echo $settings['time_limit']; ?>").getTime();

    function updateCountdown() {
        var now = new Date().getTime();
        var distance = targetDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML =
            days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the countdown is finished
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }

    // Update the countdown every 1 second
    var x = setInterval(updateCountdown, 1000);
  </script>
</body>

</html>