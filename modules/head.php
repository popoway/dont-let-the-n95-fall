<?php
# Is page title specified?
if (!isset($page_title)) $page_title = "Untitled";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo $cdn_url; ?>/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://static.popoway.me/fonts/monoton/monoton.min.css">
  <link rel="stylesheet" href="<?php echo $site_url; ?>/assets/css/main.css">
  <title><?php echo $page_title; ?> - <?php echo $app_name; ?></title>
</head>
<body>
