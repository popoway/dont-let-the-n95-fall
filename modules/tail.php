  <footer id="tail" style="padding-top: 56px;">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-6 text-center">
          <p>
            <sub style="text-align: center">
              <span>&copy; <?php echo date("Y"); ?> Ming Lei. All rights reserved.</span>
              <?php if ($page != "debug") echo "<a href=\"" . $site_url . "/?page=debug\">Debug</a>"; ?>
            </sub>
          </p>
        </div>
        <div class="col-12 col-lg-3">
        </div>
      </div>
    </div>
  </footer>

  <script src="<?php echo $cdn_url; ?>/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="<?php echo $cdn_url; ?>/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="<?php echo $site_url; ?>/assets/js/main.js"></script>
</body>
</html>
