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
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
    header("location: " . $site_url . "/?page=login&username_err=1");
    exit();
  } else{
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
    header("location: " . $site_url . "/?page=login&password_err=1");
    exit();
  } else{
    $password = trim($_POST["password"]);
  }

  # Open the database connection
  $db = new SQLite3("../project1.sqlite3", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

  // Validate credentials
  if(empty($username_err) && empty($password_err)){
    $sql = "SELECT id, username, passwd FROM \"users\" WHERE username = \"" . $username . "\"";
    $statement = $db->prepare($sql);
    $result = $statement->execute();

    // Check if username exists, if yes then verify password
    while ($user = $result->fetchArray(SQLITE3_ASSOC)){
      if($user["passwd"] == $password) {
        // Password is correct
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        // Redirect user to home page
        header("location: " . $site_url . "/?page=home");
      }
      else {
        // Display an error message if password is not valid
        $password_err = "The password you entered was not valid.";
        header("location: " . $site_url . "/?page=login&password_err=2");
        exit();
      }
    }
    // Display an error message if username doesn't exist
    $username_err = "No account found with that username.";
    header("location: " . $site_url . "/?page=login&username_err=2");
    exit();
  }
  else {
    echo "Oops! Something went wrong. Please try again later.";
  }
  // Free the memory, this is NOT done automatically, while the script is running
  $result->finalize();
  // Close the database.
  $db->close();
}
else {
  header("location: " . $site_url . "/?page=login");
}
?>
