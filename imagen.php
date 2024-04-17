<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      @media screen and (max-width: 410px){
      	body{
      		background-color: red;
      	}
      }
      #map {
        height: 100%;
      }
      .crop {
        background-color: red;
        position: relative;
        width: 300px;
        height: 300px;
        overflow: hidden;
      }
      .crop img {
        position: absolute;
        top: -100%;
        bottom: -100%;
        left: -100%;
        right: -100%;
        margin: auto; 
        height: auto;
        width: auto;
      }
      .imgCar{
        height: 400px;
      }
      #sizeImg{
        height:600px;
      }
    </style>
  </head>
  <body>
    <div class="">
      <img class="imgCar" src="img/car1.jpg" alt="...">
    </div>
    <div class="crop">
      <img id="sizeImg" src="img/car1.jpg" alt="...">
    </div>


</body>
</html>