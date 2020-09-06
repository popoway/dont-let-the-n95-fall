  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-6 text-center">
          <h1><?php echo $app_name; ?></h1>
          <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
          ?>
          <p>
            Welcome, <?php echo $_SESSION["username"]; ?>!
            <a href="<?php echo $site_url; ?>/?page=logout">Logout</a>
          </p>
          <?php
          if ($_GET['finishGame'] == 1) echo "<p>Thank you for playing the game. Check your statistics or play another game.</p>";
          ?>
          <div id="mainMenu" class="container">
            <div>
              <button type="button" class="btn btn-primary" onclick="window.location.href = '<?php echo $site_url; ?>/?page=game&difficulty=easy';">Play Game (Easy)</button>
            </div>
            <div>
              <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo $site_url; ?>/?page=game&difficulty=hard';">Play Game (Hard)</button>
            </div>
            <div>
              <button type="button" class="btn btn-info" onclick="window.location.href = '<?php echo $site_url; ?>/?page=stats';">Statistics</button>
            </div>
          <?php
          }
          else {
          ?>
          <?php
          if ($_GET['finishRegister'] == 1) echo "<p>Account has been successfully created. Now you can log in to play!</p>";
          else echo "<p>You're not logged in. Log in or create an account to play.</p>";
          ?>
          <div id="mainMenu" class="container">
            <div>
              <button type="button" class="btn btn-primary" onclick="window.location.href = '<?php echo $site_url; ?>/?page=login';">Log in</button>
            </div>
            <div>
              <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?php echo $site_url; ?>/?page=register';">Register</button>
            </div>
          <?php
          }
          ?>
            <div>
              <button type="button" class="btn btn-light" onclick="window.location.href = '<?php echo $site_url; ?>/?page=top';">Top 10</button>
            </div>
            <div>
              <button type="button" class="btn btn-success" onclick="window.location.href = '<?php echo $site_url; ?>/?page=howto';">How to Play</button>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-3">
        </div>
      </div>
    </div>
  </section>
