<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: " . $site_url . "/?page=home");
  exit;
}
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $confirm_password_err = "";

// Render login errors from registerUpload
if ($_GET['username_err'] == 1) $username_err = "Please enter username.";
if ($_GET['username_err'] == 2) $username_err = "This username is already taken.";
if ($_GET['password_err'] == 1) $password_err = "Please enter your password.";
if ($_GET['password_err'] == 2) $password_err = "Password must have atleast 6 characters.";
if ($_GET['confirm_password_err'] == 1) $confirm_password_err = "Please confirm password.";
if ($_GET['confirm_password_err'] == 2) $confirm_password_err = "Password did not match.";
?>
  <section id="register">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-6 text-center">
          <h1><?php echo $app_name; ?></h1>
          <form action="<?php echo $site_url . "/modules/registerUpload.php"; ?>" method="post">
            <h2>Register</h2>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required minlength=6>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required minlength=6>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="<?php echo $site_url . "/?page=login"; ?>">Login here</a>.</p>
            <p><a href="<?php echo $site_url . "/?page=home"; ?>">Back to Home Menu</a></p>
          </form>
        </div>
        <div class="col-12 col-lg-3">
        </div>
      </div>
    </div>
  </section>
