<?php
require("../config.php");
require_once("helper.php");

# Start the session
session_start();

if($_SESSION["loggedin"] === false){
  header("location: " . $site_url . "/?page=home");
  exit;
}
// Define variables and initialize with empty values
$username = $difficulty = $total = $survived = $user_agent = $ip_address = "";
$hidden = 0;

$username = $_SESSION["username"];
$difficulty = $_GET["difficulty"];
$total = $_GET["total"];
$survived = $_GET["survived"];

//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else {
  $ip_address = $_SERVER['REMOTE_ADDR'];
}
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$user_agent = trim($user_agent);

// Processing game data
if($_SERVER["REQUEST_METHOD"] == "GET"){

  # Open the database connection
  $db = new SQLite3("../project1.sqlite3", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

  // Check input errors before inserting in database
  if(!empty($username) && !empty($difficulty) && !empty($total) && !empty($survived) && !empty($user_agent) && !empty($ip_address)){

    $query_value = "INSERT INTO \"records\" (\"username\", \"difficulty\", \"total\", \"survived\", \"user_agent\", \"created\", \"hidden\", \"ip_address\") VALUES (\"" . $username . "\", \"" . $difficulty . "\", \"" . $total . "\", \"" . $survived . "\", \"" . $user_agent . "\", \"" . gmdate('Y-m-d H:i:s') . "\", \"" . $hidden . "\", \"" . $ip_address . "\")";
    # Insert the user to database
    $db->exec('BEGIN');
    $db->query($query_value);
    # REMEMBER TO SET UP SQLite WRITE (e.g. 777) PERMISSION PROPERLY!!!
    $db->exec('COMMIT');
    // Redirect user to home page
    header("location: " . $site_url . "/?page=home&finishGame=1");
    // Free the memory, this is NOT done automatically, while the script is running
    $result->finalize();
    // Close the database.
    $db->close();
  }
  else {
    header("location: " . $site_url . "/?page=game&difficulty=easy");
  }
}
else {
  header("location: " . $site_url . "/?page=game&difficulty=easy");
}
?>
