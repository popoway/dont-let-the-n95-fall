<?php
# Specify the development mode
$development_mode = "production";

# Define Site URL
if ($development_mode == "develop") {
  $site_url = "127.0.0.1:8080/project1";
}
elseif ($development_mode == "production") {
  $site_url = "https://venus.cs.qc.cuny.edu/~lemi2837/cs370/project1";
}

# Define CDN URL
$cdn_url = "https://static.popoway.me/ajax/libs";

# Specify the location and filename of the SQLite3 database
$sqlite3_filename = "project1.sqlite3";

# Specify application name
$app_name = "Don't Let the N95 Fall";
