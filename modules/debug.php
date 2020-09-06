<style media="screen">
  li {
    word-break: break-all;
  }
  code {
    word-break: normal;
  }
</style>
<h1>Debug Tools</h1>
<h2>Host</h2>
<ul>
  <li>Host name: <?php echo gethostname(); ?></li>
  <li>Site URL: <?php echo $site_url; ?></li>
  <li>PHP version: <?php echo PHP_VERSION_ID; ?></li>
  <li>SQLite: <?php echo getSqliteVersion(); ?></li>
  <li>Server timestamp: <?php echo(date("Y-m-d h:m:s T+Z")); ?></li>
</ul>
<h2>Application</h2>
<ul>
  <li>App name: <?php echo $app_name; ?></li>
  <li>Development mode: <?php echo $development_mode; ?></li>
</ul>
<h2>Session</h2>
<ul>
  <li>Session deployed: <?php echo isset($_SESSION) ? 'Yes' : 'No'; ?></li>
  <li>Session content: <br><code><?php print_r($_SESSION); ?></code></li>
  <li>Logged in: <?php echo (!empty($_SESSION[loggedin])) ? 'Yes' : 'No'; ?></li>
  <li>Clear session: <a href="<?php echo $site_url; ?>/?page=debug_logout">Force Logout<a></li>
</ul>
<h2>Database</h2>
<ul>
  <li>SQLite path: <?php echo realpath($sqlite3_filename); ?></li>
  <li>File readable: <?php echo is_readable($sqlite3_filename) ? 'Yes' : 'No'; ?></li>
  <li>File writable: <?php echo is_writable($sqlite3_filename) ? 'Yes' : 'No'; ?></li>
  <li>File executable: <?php echo is_executable($sqlite3_filename) ? 'Yes' : 'No'; ?></li>
  <?php
  # Open the database connection
  $db = new SQLite3($sqlite3_filename, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
  ?>
  <li><code>user</code> table:
    <ul>
      <?php
      $statement = $db->prepare('SELECT * FROM "users" ORDER BY "id" ASC');
      $result = $statement->execute();
      while ($user = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<li><code>";
        var_dump($user);
        echo "</code></li>";
      }
      ?>
    </ul>
  </li>
  <span>Note: passwords are actually stored with encryption.</span>
  <li><code>records</code> table:
    <ul>
      <?php
      $statement = $db->prepare('SELECT * FROM "records" ORDER BY "id" ASC');
      $result = $statement->execute();
      while ($records = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<li><code>";
        var_dump($records);
        echo "</code></li>";
      }
      ?>
    </ul>
  </li>
</ul>
<?php
// Free the memory, this is NOT done automatically, while the script is running
$result->finalize();
// Close the database.
$db->close();
?>
<a href="<?php echo $site_url; ?>/?page=home">Back to home page</a>
