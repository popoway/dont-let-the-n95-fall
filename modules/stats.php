<?php
if($_SESSION["loggedin"] === false){
  header("location: " . $site_url . "/?page=home");
  exit;
}

# Start the session
session_start();

$username = $_SESSION["username"];
$easy_times_played = $easy_max_dropped = $easy_max_survived = 0;
$hard_times_played = $hard_max_dropped = $hard_max_survived = 0;

# Open the database connection
$db = new SQLite3("project1.sqlite3", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

# Calculate the stats
$sql = "SELECT COUNT(id) FROM \"records\" WHERE username = \"" . $username . "\" AND difficulty = \"easy\"";
$statement = $db->prepare($sql);
$result = $statement->execute();
while ($record = $result->fetchArray(SQLITE3_ASSOC)){
  $easy_times_played = $record["COUNT(id)"];
}
$sql = "SELECT COUNT(id) FROM \"records\" WHERE username = \"" . $username . "\" AND difficulty = \"hard\"";
$statement = $db->prepare($sql);
$result = $statement->execute();
while ($record = $result->fetchArray(SQLITE3_ASSOC)){
  $hard_times_played = $record["COUNT(id)"];
}
$sql = "SELECT MAX(total) FROM \"records\" WHERE username = \"" . $username . "\" AND difficulty = \"easy\"";
$statement = $db->prepare($sql);
$result = $statement->execute();
while ($record = $result->fetchArray(SQLITE3_ASSOC)){
  $easy_max_dropped = $record["MAX(total)"];
}
$sql = "SELECT MAX(total) FROM \"records\" WHERE username = \"" . $username . "\" AND difficulty = \"hard\"";
$statement = $db->prepare($sql);
$result = $statement->execute();
while ($record = $result->fetchArray(SQLITE3_ASSOC)){
  $hard_max_dropped = $record["MAX(total)"];
}
$sql = "SELECT MAX(survived) FROM \"records\" WHERE username = \"" . $username . "\" AND difficulty = \"easy\"";
$statement = $db->prepare($sql);
$result = $statement->execute();
while ($record = $result->fetchArray(SQLITE3_ASSOC)){
  $easy_max_survived = $record["MAX(survived)"];
}
$sql = "SELECT MAX(survived) FROM \"records\" WHERE username = \"" . $username . "\" AND difficulty = \"hard\"";
$statement = $db->prepare($sql);
$result = $statement->execute();
while ($record = $result->fetchArray(SQLITE3_ASSOC)){
  $hard_max_survived = $record["MAX(survived)"];
}


// Free the memory, this is NOT done automatically, while the script is running
$result->finalize();
// Close the database.
$db->close();

?>
  <section id="stats">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-6 text-center">
          <h1><?php echo $app_name; ?></h1>
          <h2>Statistics</h2>
          <p>Player name: <?php echo $username; ?></p>
          <h3>Easy</h3>
          <p>Times played: <?php echo $easy_times_played; ?></p>
          <p>Maximum boxes dropped: <?php echo $easy_max_dropped; ?></p>
          <p>Maximum boxes survived: <?php echo $easy_max_survived; ?></p>
          <h3>Hard</h3>
          <p>Times played: <?php echo $hard_times_played; ?></p>
          <p>Maximum boxes dropped: <?php echo $hard_max_dropped; ?></p>
          <p>Maximum boxes survived: <?php echo $hard_max_survived; ?></p>

          <p><a href="<?php echo $site_url . "/?page=home"; ?>">Back to Home Menu</a></p>
        </div>
        <div class="col-12 col-lg-3">
        </div>
      </div>
    </div>
  </section>
