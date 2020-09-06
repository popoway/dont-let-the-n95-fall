<?php
# Start the session
session_start();

# Open the database connection
$db = new SQLite3("project1.sqlite3", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

?>
  <section id="top">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-3">
        </div>
        <div class="col-12 col-lg-6 text-center">
          <h1><?php echo $app_name; ?></h1>
          <h2>Top 10 Scores</h2>
          <h3>Easy</h3>
          <table style="width:100%">
            <tr>
              <th>Top</th>
              <th>Username</th>
              <th>Dropped</th>
              <th>Survived</th>
            </tr>
            <?php
            # Calculate the stats
            $sql = "SELECT username, total, survived FROM \"records\" WHERE difficulty = \"easy\" AND hidden = 0 ORDER BY \"survived\" DESC, \"total\" ASC LIMIT 10";
            $statement = $db->prepare($sql);
            $result = $statement->execute();
            $top = 1;
            while ($record = $result->fetchArray(SQLITE3_ASSOC)){
            ?>
            <tr>
              <td><?php echo $top; ?></td>
              <td><?php echo $record["username"]; ?></td>
              <td><?php echo $record["total"]; ?></td>
              <td><?php echo $record["survived"]; ?></td>
            </tr>
            <?php
            $top = $top + 1;
            }
            ?>
          </table>
          <h3>Hard</h3>
          <table style="width:100%">
            <tr>
              <th>Top</th>
              <th>Username</th>
              <th>Dropped</th>
              <th>Survived</th>
            </tr>
            <?php
            # Calculate the stats
            $sql = "SELECT username, total, survived FROM \"records\" WHERE difficulty = \"hard\" AND hidden = 0 ORDER BY \"survived\" DESC, \"total\" ASC LIMIT 10";
            $statement = $db->prepare($sql);
            $result = $statement->execute();
            $top = 1;
            while ($record = $result->fetchArray(SQLITE3_ASSOC)){
            ?>
            <tr>
              <td><?php echo $top; ?></td>
              <td><?php echo $record["username"]; ?></td>
              <td><?php echo $record["total"]; ?></td>
              <td><?php echo $record["survived"]; ?></td>
            </tr>
            <?php
            $top = $top + 1;
            }
            ?>
          </table>
          <p><a href="<?php echo $site_url . "/?page=home"; ?>">Back to Home Menu</a></p>
        </div>
        <div class="col-12 col-lg-3">
        </div>
      </div>
    </div>
  </section>

<?php

// Free the memory, this is NOT done automatically, while the script is running
$result->finalize();
// Close the database.
$db->close();

?>
