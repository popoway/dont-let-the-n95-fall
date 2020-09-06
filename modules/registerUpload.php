<?php
require("../config.php");
require_once("helper.php");

# Start the session
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: " . $site_url . "/?page=home");
  exit;
}
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  # Open the database connection
  $db = new SQLite3("../project1.sqlite3", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

  // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
    header("location: " . $site_url . "/?page=register&username_err=1");
    exit();
  } else{
    // Validate username
    $sql = "SELECT id FROM \"users\" WHERE username = \"" . trim($_POST["username"]) . "\"";
    $statement = $db->prepare($sql);
    $result = $statement->execute();
    // Check if username exists
    while ($user = $result->fetchArray(SQLITE3_ASSOC)){
      if(!empty($user["id"])) {
        $username_err = "This username is already taken.";
        header("location: " . $site_url . "/?page=register&username_err=2");
        // Free the memory, this is NOT done automatically, while the script is running
        $result->finalize();
        // Close the database.
        $db->close();
        exit();
      }
      else {
        echo "Oops! Something went wrong. Please try again later.";
      }
    }
    $username = trim($_POST["username"]);
  }
  // Free the memory, this is NOT done automatically, while the script is running
  $result->finalize();
  // Close the database.
  $db->close();


  // Check if password is empty
  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
    header("location: " . $site_url . "/?page=register&password_err=1");
    exit();
  } elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "Password must have atleast 6 characters.";
    header("location: " . $site_url . "/?page=register&password_err=2");
    exit();
  } else{
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = "Please confirm password.";
      header("location: " . $site_url . "/?page=register&confirm_password_err=1");
      exit();
  } else{
      $confirm_password = trim($_POST["confirm_password"]);
      if(empty($password_err) && ($password != $confirm_password)){
          $confirm_password_err = "Password did not match.";
          header("location: " . $site_url . "/?page=register&confirm_password_err=2");
          exit();
      }
  }

  # Open the database connection
  $db = new SQLite3("../project1.sqlite3", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

  // Check input errors before inserting in database
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

    $query_value = "INSERT INTO \"users\" (\"username\", \"passwd\", \"created\") VALUES (\"" . $username . "\", \"" . $password . "\", \"" . gmdate('Y-m-d H:i:s') . "\")";
    # Insert the user to database
    $db->exec('BEGIN');
    $db->query($query_value);
    # REMEMBER TO SET UP SQLite WRITE (e.g. 777) PERMISSION PROPERLY!!!
    $db->exec('COMMIT');
    // Redirect user to home page
    header("location: " . $site_url . "/?page=home&finishRegister=1");
    // Free the memory, this is NOT done automatically, while the script is running
    $result->finalize();
    // Close the database.
    $db->close();
  }
  else {
    echo "Oops! Something went wrong. Please try again later.";
  }
}
else {
  header("location: " . $site_url . "/?page=register");
}
?>
