<?php
if($_SESSION["loggedin"] === false){
  header("location: " . $site_url . "/?page=home");
  exit;
}
?>
  <style media="screen">
  body {
    height: 100vh;
    overflow-y: hidden;
  }
  </style>
  <script src = "assets/js/phaser.min.js"></script>
  <script src = "assets/js/game.js"></script>
  <div id = "thegame"></div>
