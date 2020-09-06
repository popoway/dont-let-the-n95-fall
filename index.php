<?php
require("config.php");
require_once("modules/helper.php");

# Environment check
if (getSqliteVersion() != "enabled") die("SQLite3 must be installed and enabled on the server to use the app.");

# Start the session
session_start();

# Retrieve login status
if (!isset($_SESSION["loggedin"])) $_SESSION["loggedin"] = false;

# Define current page (home,goals.dates)
$page = $_GET['page'];

if (!isset($page)) {
  $page = "home"; # Define default page
  header("location:" . $site_url . "/?page=" . $page);
}

# Generate page content
$page_title = currentPageName($page);
require("modules/head.php");
if ($page == "home") require("modules/home.php");
else if ($page == "login") require("modules/login.php");
else if ($page == "register") require("modules/register.php");
else if ($page == "logout") require("modules/logout.php");
else if ($page == "game") require("modules/game.php");
else if ($page == "stats") require("modules/stats.php");
else if ($page == "top") require("modules/top.php");
else if ($page == "howto") require("modules/howto.php");
else if ($page == "debug") require("modules/debug.php");
else if ($page == "debug_logout") require("modules/debug_logout.php");
require("modules/tail.php");
