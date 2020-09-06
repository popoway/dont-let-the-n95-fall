<?php
function getSqliteVersion() {
  if (extension_loaded('pdo_sqlite') && extension_loaded('sqlite3')) return "enabled";
  else return "not installed";
}
function currentPageName($page) {
  if ($page == "home") return "Home";
  else if ($page == "register") return "Register";
  else if ($page == "login") return "Log in";
  else if ($page == "stats") return "Statistics";
  else if ($page == "top") return "Top Players and Scores";
  else if ($page == "howto") return "How to Play";
  else if ($page == "game") return "Game in Progress";
  else if ($page == "debug") return "Debug Tools";
  else return null;
}
