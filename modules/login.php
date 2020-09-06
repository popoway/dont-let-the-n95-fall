<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: " . $site_url . "/?page=home");
  exit;
}
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Render login errors from loginUpload
if ($_GET['username_err'] == 1) $username_err = "Please enter username.";
if ($_GET['username_err'] == 2) $username_err = "No account found with that username.";
if ($_GET['password_err'] == 1) $password_err = "Please enter your password.";
if ($_GET['password_err'] == 2) $password_err = "The password you entered was not valid.";
?>
  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-6 text-center">
          <h1><?php echo $app_name; ?></h1>
          <form action="<?php echo $site_url . "/modules/loginUpload.php"; ?>" method="post">
            <h2>Login</h2>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="<?php echo $site_url . "/?page=register"; ?>">Create one now</a>.</p>
            <p><a href="<?php echo $site_url . "/?page=home"; ?>">Back to Home Menu</a></p>
          </form>
        </div>
        <div class="col-12 col-lg-3">
        </div>
      </div>
    </div>
  </section>
